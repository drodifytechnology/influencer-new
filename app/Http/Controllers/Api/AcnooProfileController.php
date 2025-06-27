<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AcnooProfileController extends Controller
{
    use HasUploader;

    public function index()
    {
        $user = User::with('categories:id,name')->findOrFail(auth()->id());
        return response()->json([
            'message' => __('Data fetched successfully.'),
            'data' => $user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string',
            'phone' => 'required|max:11',
            'address' => 'nullable|string',
            'category' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:10240',
        ]);

        $user = User::findOrFail(auth()->id());
        $user->update($request->except('image') + [
            'socials' => $request->socials,
            'is_setupped' => 1,
            'image' => $request->image ? $this->upload($request, 'image', $user->image) : $user->image,
            'lang_expertise' => $request->lang_expertise ? [
                'name' => $request->name,
                'level' => $request->lavel,
            ] : [],
        ]);

        $user->categories()->sync($request->category_id);

        return response()->json([
            'message' => __('Profile updated successfully.'),
            'data' => $user->load('categories:id,name'),
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => __('Current password does not match with old password.')
            ], 422);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message'   => __('Password changed successfully.'),
        ]);
    }
}
