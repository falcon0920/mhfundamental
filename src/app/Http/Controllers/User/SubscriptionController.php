<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Subscriptions;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session as Checkout;
use Stripe\StripeClient;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
        $stripe = new StripeClient(env("STRIPE_SECRET"));

        $session = $stripe->checkout->sessions->create([
       //\Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
       // $session = Checkout::create([
            'payment_method_types' => ['card'],
            'line_items'           => [[
                'name'        => 'MHfundamental',                           // 商品名
                'amount'      => 7700,                                 // 金額
                'currency'    => 'jpy',                               // 単位
                'quantity'    => 1,                                   // 数量
            ]],
            'success_url'          => 'http://localhost:8000/user/subscription/success', // 成功時リダイレクトURL
            'cancel_url'           => 'http://localhost:8000/user/subscription/cancel',  // 失敗時リダイレクトURL
        ]);
        $token = $request->stripeToken;
        $user = Auth::user();
        try {
            $customer = \Stripe\Customer::create([
                'card' => $token,
                'name' => $user->name,
                'description' => $user->id
            ]);
        }catch(\Stripe\Exception\CardException $e) {
            return false;
        }

        $subscription = new Subscriptions();
        $subscription->fill([
            'user_id' => Auth::id(),
            'stripe_id' => $customer -> id
        ]);
        $subscription->save();
        return view('user.subscription.index')->with([
            'intent' => $user,
            'session' => $session
        ]);

    }
}
