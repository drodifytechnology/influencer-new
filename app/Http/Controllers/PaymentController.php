<?php

namespace App\Http\Controllers;

use App\Helpers\HasUploader;
use App\Models\Gateway;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    use HasUploader;

    public function index($order_id)
    {
        $order = Order::with('influencer:id,name')->findOrFail($order_id);
        $gateways = Gateway::with('currency:id,code,rate,symbol,position')->get();

        return view('payments.index', compact('gateways', 'order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function payment(Request $request, $order_id, $gateway_id)
    {
        $request->validate([
            'phone' => 'max:15|min:5',
        ]);

        $gateway = Gateway::findOrFail($gateway_id);
        $order = Order::with('influencer:id,name,email,balance')->findOrFail($order_id);

        if ($gateway->is_manual) {
            $request->validate([
                'attachment' => 'required|max:2048|file',
            ]);

            DB::beginTransaction();
            try {

                Transaction::create([
                    'user_id' => auth()->id(),
                    'amount' => $order->total_amount,
                    'type' => 'credit',
                    'notes' => $order->description,
                ]);

                $order->update([
                    'payment_status' => 'paid',
                    'gateway_id' => $gateway->id,
                ]);

                DB::commit();
                return redirect(route('order.status', ['status' => 'success']))->with('message', __('Order payment completed.'));

            } catch (\Exception $e) {
                DB::rollback();
                return redirect(route('order.status', ['status' => 'failed']))->with('message', __('Something went wrong!'));
            }
        }

        $amount = $order->amount - $order->discount_amount;

        if ($gateway->namespace == 'App\Library\SslCommerz') {
            Session::put('fund_callback.success_url', '/payment/success');
            Session::put('fund_callback.cancel_url', '/payment/failed');
        } else {
            Session::put('fund_callback.success_url', '/payment/success');
            Session::put('fund_callback.cancel_url', '/payment/failed');
        }

        $payment_data['currency'] = $gateway->currency->code ?? 'USD';
        $payment_data['email'] = $order->influencer->email;
        $payment_data['name'] = $order->influencer->name;
        $payment_data['phone'] = $order->influencer->phone;
        $payment_data['billName'] = __('Make order payment');
        $payment_data['amount'] = $amount;
        $payment_data['test_mode'] = $gateway->test_mode;
        $payment_data['charge'] = $gateway->charge ?? 0;
        $payment_data['pay_amount'] = round(convert_money($amount, $gateway->currency) + $gateway->charge);
        $payment_data['gateway_id'] = $gateway->id;
        $payment_data['request_from'] = 'merchant';

        foreach ($gateway->data ?? [] as $key => $info) {
            $payment_data[$key] = $info;
        }

        session()->put('order_id', $order->id);
        session()->put('gateway_id', $gateway->id);

        $redirect = $gateway->namespace::make_payment($payment_data);
        return $redirect;
    }

    public function success()
    {
        DB::beginTransaction();
        try {

            $gateway = Gateway::findOrFail(session('gateway_id'));
            $order = Order::with('influencer:id,name,email,balance,device_token', 'user:id,name,device_token')->findOrFail(session('order_id'));

            sendPushNotify('Order Placed Successfully.', 'Thank you, ' . $order->user->name . '! Your order and payment has been completed successfully.', $order->user->device_token);
            sendPushNotify('New order placed!', 'Good news, ' . $order->influencer->name . '! New order has been placed to your service by '. $order->user->name. '.', $order->influencer->device_token);

            $order->update([
                'payment_status' => 'paid',
                'gateway_id' => $gateway->id,
            ]);

            sendNotification($order->id, route('admin.dashboard.index', ['id' => $order->id]), notify_users([$order->influencer_id, $order->user_id]), admin_msg:__('New order created.'), influ_msg:__("New order placed."), client_msg:__("Order places successfully."));

            session()->forget('gateway_id');
            session()->forget('order_id');

            DB::commit();
            return redirect(route('order.status', ['status' => 'success']))->with('message', __('Order payment completed.'));

        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('order.status', ['status' => 'failed']))->with('message', __('Something went wrong!'));
        }
    }

    public function failed()
    {
        return redirect(route('order.status', ['status' => 'failed']))->with('error', __('Transaction failed, Please try again.'));
    }

    public function sslCommerzSuccess(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!$request->value_a || !$request->value_b || !$request->value_c) {
                return redirect(route('order.status', ['status' => 'failed']))->with('error', __('Transaction failed, Please try again.'));
            }

            $gateway = Gateway::findOrFail(session('gateway_id'));
            $order = Order::with('influencer:id,name,email,balance,device_token', 'user:id,name,device_token')->findOrFail(session('order_id'));

            $order->update([
                'payment_status' => 'paid',
                'gateway_id' => $gateway->id,
            ]);

            sendPushNotify('Order Placed Successfully.', 'Thank you, ' . $order->user->name . '! Your order and payment has been completed successfully.', $order->user->device_token);
            sendPushNotify('New order placed!', 'Good news, ' . $order->influencer->name . '! New order has been placed to your service by '. $order->user->name. '.', $order->influencer->device_token);

            sendNotification($order->id, route('admin.dashboard.index', ['id' => $order->id]), notify_users([$order->influencer_id, $order->user_id]), admin_msg:__('New order created.'), influ_msg:__("New order placed."), client_msg:__("Order places successfully."));

            session()->forget('gateway_id');
            session()->forget('order_id');

            DB::commit();
            return redirect(route('order.status', ['status' => 'success']))->with('message', __('Order payment completed.'));

        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('order.status', ['status' => 'failed']))->with('message', __('Something went wrong!'));
        }
    }

    public function sslCommerzFailed()
    {
        return redirect(route('order.status', ['status' => 'failed']))->with('error', __('Transaction failed, Please try again.'));
    }

    public function orderStatus()
    {
        if (request('status') == 'success') {
            return 'success';
        } else {
            return 'failed';
        }
    }
}
