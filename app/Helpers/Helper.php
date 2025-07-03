<?php
use App\Models\User;
use App\Models\Option;
use App\Models\Gateway;
use App\Models\Currency;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Date;
use App\Notifications\SendNotification;
use Kreait\Firebase\Messaging\CloudMessage;
use Illuminate\Support\Facades\Notification;

function cache_remember(string $key, callable $callback, int $ttl = 1800): mixed
{
    return cache()->remember($key, env('CACHE_LIFETIME', $ttl), $callback);
}

function get_option($key)
{
    return cache_remember($key, function () use ($key) {
        return Option::where('key', $key)->first()->value ?? [];
    });
}

function formatted_date(string $date = null, string $format = 'd M, Y'): ?string
{
    return !empty($date) ? Date::parse($date)->format($format) : null;
}

function notify_users($users = [])
{
    return User::where('role', 'superadmin')
        ->orWhere('role', 'admin')
        ->orWhereIn('id', $users)
        ->get();
}

function sendNotification($id, $url, $users, $admin_msg = null, $influ_msg = null, $client_msg = null)
{
    $notify = [
        'id' => $id,
        'url' => $url,
        'admin_msg' => $admin_msg,
        'influ_msg' => $influ_msg,
        'client_msg' => $client_msg,
    ];

    Notification::send($users, new SendNotification($notify));
}

function currency_format($amount, $type = "icon", $decimals = 2, $currency = null)
{
    $amount = number_format($amount, $decimals);
    $currency = $currency ?? default_currency();

    if ($type == "icon" || $type == "symbol") {
        if ($currency->position == "right") {
            return $amount . $currency->symbol;
        } else {
            return $currency->symbol . $amount;
        }
    } else {
        if ($currency->position == "right") {
            return $amount . ' ' . $currency->code;
        } else {
            return $currency->code . ' ' . $amount;
        }
    }
}

function convert_money($amount, $currency, $multiply = true)
{
    if ($currency->code == default_currency('code')) {
        return $amount;
    } else {
        if ($multiply) {
            return $amount * $currency->rate;
        } else {
            return $amount / $currency->rate;
        }
    }
}

function payable(float | int $amount, Gateway $gateway)
{
    if ($gateway->currency->code == default_currency('code')) {
        return $amount + $gateway->charge;
    } else {
        return (convert_to_default_amount($gateway->charge, $gateway->currency) * $gateway->currency->rate) + $gateway->charge;
    }
}

function convert_to_default_amount($amount, $currency)
{
    return $amount * $currency->rate;
}

function default_currency($key = null, Currency $currency = null): object | int | string
{
    $currency = $currency ?? cache_remember('default_currency', function () {
        $currency = Currency::whereIsDefault(1)->first();

        if (!$currency) {
            $currency = (object) ['name' => 'Indian Rupee', 'code' => 'INR', 'rate' => 1, 'symbol' => '₹', 'position' => 'left', 'status' => 1, 'is_default' => 1];
        }

        return $currency;
    });

    return $key ? $currency->$key : $currency;
}

function sendPushNotify($title, $body, $token)
{
    if (file_exists(public_path('uploads/service-account-credentials.json'))) {
        $firebase_credential = (new Factory)->withServiceAccount(public_path('uploads/service-account-credentials.json'));

        $messaging = $firebase_credential->createMessaging();

        $message = CloudMessage::fromArray([
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
            'token' => $token,
        ]);

        try {

            $messaging->send($message);
            return true;

        } catch (\Kreait\Firebase\Exception\MessagingException $e) {
            Log::error('Firebase Notification Error', ['error' => $e->getMessage()]);
            return false;
        }
    } else {
        return false;
    }
}

function languages() {
    return [
        'en' => ['name' => 'English', 'flag' => 'us'],
        'ar' => ['name' => 'Arabic', 'flag' => 'sa'],
        'bn' => ['name' => 'Bengali', 'flag' => 'bd'],
        'zh' => ['name' => 'Chinese', 'flag' => 'cn'],
        'fr' => ['name' => 'French', 'flag' => 'fr'],
        'de' => ['name' => 'German', 'flag' => 'de'],
        'hi' => ['name' => 'Hindi', 'flag' => 'in'],
        'es' => ['name' => 'Spanish', 'flag' => 'es'],
        'ja' => ['name' => 'Japanese', 'flag' => 'jp'],
        'rum' => ['name' => 'Romanian', 'flag' => 'ro'],
        'vi' => ['name' => 'Vietnamese', 'flag' => 'vn'],
        'it' => ['name' => 'Italian', 'flag' => 'it'],
        'th' => ['name' => 'Thai', 'flag' => 'th'],
        'bs' => ['name' => 'Bosnian', 'flag' => 'ba'],
        'nl' => ['name' => 'Dutch', 'flag' => 'nl'],
        'pt' => ['name' => 'Portuguese', 'flag' => 'pt'],
        'pl' => ['name' => 'Polish', 'flag' => 'pl'],
        'he' => ['name' => 'Hebrew', 'flag' => 'il'],
        'hu' => ['name' => 'Hungarian', 'flag' => 'hu'],
        'fi' => ['name' => 'Finland', 'flag' => 'fi'],
        'el' => ['name' => 'Greek', 'flag' => 'gr'],
        'ko' => ['name' => 'Korean', 'flag' => 'kr'],
        'ms' => ['name' => 'Malay', 'flag' => 'my'],
        'id' => ['name' => 'Indonesian', 'flag' => 'id'],
        'fa' => ['name' => 'Persian', 'flag' => 'ir'],
        'tr' => ['name' => 'Turkish', 'flag' => 'tr'],
        'sr' => ['name' => 'Serbian', 'flag' => 'rs'],
        'km' => ['name' => 'Khmer', 'flag' => 'khm'],
        'uk' => ['name' => 'Ukrainian', 'flag' => 'ua'],
        'lo' => ['name' => 'Lao', 'flag' => 'la'],
        'ru' => ['name' => 'Russian', 'flag' => 'ru'],
        'cs' => ['name' => 'Czech', 'flag' => 'cz'],
        'kn' => ['name' => 'Kannada', 'flag' => 'ka'],
        'mr' => ['name' => 'Marathi', 'flag' => 'mh'],
        'sv' => ['name' => 'Swedish', 'flag' => 'se'],
        'da' => ['name' => 'Danish', 'flag' => 'dk'],
        'ur' => ['name' => 'Urdu', 'flag' => 'pk'],
        'sq' => ['name' => 'Albanian', 'flag' => 'al'],
        'sk' => ['name' => 'Slovak', 'flag' => 'sk'],
        'bur' => ['name' => 'Burmese', 'flag' => 'mm'],
        'ti' => ['name' => 'Tigrinya', 'flag' => 'er'],
        'kz' => ['name' => 'Kazakhastan', 'flag' => 'kz'],
        'az' => ['name' => 'Azerbaijani', 'flag' => 'az'],
        'zh-cn' => ['name' => 'Chinese (CN)', 'flag' => 'zh-cn'],
        'zh-tw' => ['name' => 'Chinese (TW)', 'flag' => 'zh-tw'],
        'pt-br' => ['name' => 'Portuguese (BR)', 'flag' => 'pt-br'],
        'tz' => ['name' => 'Swahili', 'flag' => 'tz'],
    ];
}

