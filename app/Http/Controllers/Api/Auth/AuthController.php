<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\NewAccessToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|max:100',
            'email' => 'required|email',
            'device_token' => 'required|string',
            'primary_platform' => 'required_if:role,influencer',
            'social_username' => 'required_if:role,influencer', 
            'follower_count' => 'required_if:role,influencer', 
            'content_category' => 'required_if:role,user', 
            'role' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && $user->is_setupped) {
            return response()->json([
                'message' => 'This email is already exists.',
            ], 406);
        }
        $code = random_int(100000, 999999);
        $expire = now()->addMinutes(env('OTP_VISIBILITY_TIME') ?? 3);
        $data = [       
            'code' => $code,
            'name' => $request->name,
        ];

        $user = User::updateOrCreate(['email' => $request->email], $request->except('password') + [
                    'remember_token' => $code,
                    'email_verified_at' => $expire,
                    'password' => Hash::make($request->password),
                ]);

        if (env('QUEUE_MAIL')) {
            Mail::to($request->email)->queue(new WelcomeMail($data));
        } else {
            Mail::to($request->email)->send(new WelcomeMail($data));
        }


        sendPushNotify(
            'Welcome to our platform!',
            'Hi ' . $request->name . ', your account has been successfully created. Please check your email for verification.',
            $user->device_token
        );


        sendNotification($user->id, route('admin.users.index', ['users' => $user->role]), notify_users([$user->id]), admin_msg: __('New '.$request->role.' Registered.'), influ_msg: $request->role === 'influencer' ?  __("Sign up successfully.") : null, client_msg: $request->role === 'user' ? __('Sign up successfully') : null);


        return response()->json([
            'message' => 'An otp code has been sent to you email. Please check and confirm.',
            'data' => $user,
        ]);
    }

    public function     submitOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|min:4|max:15',
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => __('User not found'),
            ], 404);
        }

        if ($user->remember_token == $request->otp) {
            if ($user->email_verified_at > now()) {

                Auth::login($user);
                $token = $user->createToken('createToken')->plainTextToken;
                $accessToken = $user->createToken('createToken');
                $this->setAccessTokenExpiration($accessToken);

                $user->update([
                    'remember_token' => NULL,
                    'email_verified_at' => now(),
                ]);

                return response()->json([
                    'message' => 'Logged In successfully!',
                    'id' => $user->id,
                    'role' => $user->role,
                    'token' => $token
                ]);

            } else {
                return response()->json([
                    'error' => __('The verification otp has been expired.')
                ], 400);
            }
        } else {
            return response()->json([
                'error' => __('Invalid otp.')
            ], 404);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'email' => 'required|email',
            'device_token' => 'required|string',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            $user = auth()->user();

            if ($user->role != 'influencer' && $user->role != 'user') {
                return response()->json([
                    'message' => 'You can not login as ' .$user->role. ' from the app!'
                ], 406);
            }

            if ($user->remember_token && !$user->is_setupped) { // If user didn't verify email

                $code = random_int(100000, 999999);
                $expire = now()->addMinutes(env('OTP_VISIBILITY_TIME') ?? 3);
                $data = [
                    'code' => $code,
                    'name' => $request->name,
                ];

                if (env('MAIL_USERNAME')) {
                    if (env('QUEUE_MAIL')) {
                        Mail::to($request->email)->queue(new WelcomeMail($data));
                    } else {
                        Mail::to($request->email)->send(new WelcomeMail($data));
                    }
                } else {
                    return response()->json([
                        'message' => __('Mail service is not configured. Please contact your administrator.'),
                    ], 406);
                }

                User::where('email', $request->email)->first()->update(['remember_token' => $code, 'email_verified_at' => $expire]);

                return response()->json([
                    'message' => 'An otp code has been sent to your email. Please check and confirm.',
                ], 201);
            }

            $data = [
                'id' => $user->id,
                'role' => $user->role,
                'name' => $user->name,
                'email' => $user->email,
                'is_setupped' => $user->is_setupped,
                'token' => $user->createToken('createToken')->plainTextToken,
            ];

            $user->update([
                'device_token' => $request->device_token,
            ]);

            return response()->json([
                'message' => 'User login successfully!',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid email or password!'
            ], 404);
        }
    }

    public function socialLogin(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'access_token' => 'required|string',
        //     'provider' => 'required|string',
        // ]);
         $request->validate([
            'access_token' => 'required|string',
            'provider' => 'required|string',
            'role' => 'required|in:user,influencer',

             
        ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Validation Error',
        //         'errors' => $validator->errors(),
        //     ], 422);
        // }
        
        $provider = $request->provider;
        try {
            // Use stateless because we don't use session
            $socialUser = Socialite::driver($provider)
                ->stateless()
                ->userFromToken($request->access_token);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid social token',
                'error' => $e->getMessage(),
            ], 401);
        }

        // Find or create user
        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email_verified_at' => now(),
                'password' => bcrypt(Str::random(16)),
                'provider' => $provider,
                'role' => $request->role,
                'provider_id' => $socialUser->getId(),
            ]
        );

        // Generate token (Laravel Sanctum assumed)
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'id' => $user->id,
            'role' => $user->role,
            'name' => $user->name,
            'email' => $user->email,
            'is_setupped' => $user->is_setupped,
            'token' => $token,
            
        ]);
    }
    protected function setAccessTokenExpiration(NewAccessToken $accessToken)
    {
        $expiration = now()->addMinutes(Config::get('sanctum.expiration'));

        DB::table('personal_access_tokens')
            ->where('id', $accessToken->accessToken->id)
            ->update(['expires_at' => $expiration]);
    }

    public function signOut() : JsonResponse
    {
        if (auth()->user()->tokens()) {
            auth()->user()->tokens()->delete();

            return response()->json([
                'message' => __('Sign out successfully'),
            ]);
        } else {
            return response()->json([
                'message' => __('Unauthorized'),
            ], 401);
        }
    }

    public function refreshToken()
    {
        if (auth()->user()->tokens()) {

            auth()->user()->currentAccessToken()->delete();
            $data['token'] = auth()->user()->createToken('createToken')->plainTextToken;
            return response()->json($data);

        } else {
            return response()->json([
                'message' => __('Unauthorized'),
            ], 401);
        }
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $code = random_int(100000, 999999);
        $expire = now()->addMinutes(env('OTP_VISIBILITY_TIME') ?? 3);
        $data = [
            'code' => $code,
            'name' => $request->name,
        ];

        if (env('MAIL_USERNAME')) {
            if (env('QUEUE_MAIL')) {
                Mail::to($request->email)->queue(new WelcomeMail($data));
            } else {
                Mail::to($request->email)->send(new WelcomeMail($data));
            }
        } else {
            return response()->json([
                'message' => __('Mail service is not configured. Please contact your administrator.'),
            ], 406);
        }

        User::where('email', $request->email)->first()->update(['remember_token' => $code, 'email_verified_at' => $expire]);

        return response()->json([
            'message' => 'An otp code has been sent to your email. Please check and confirm.',
        ]);
    }
}

