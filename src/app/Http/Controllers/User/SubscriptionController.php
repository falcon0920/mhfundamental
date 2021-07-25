<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Checkout\Session as Checkout;
use Stripe\StripeClient;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
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
            'success_url'          => 'https://example.com/checkout/success.php', // 成功時リダイレクトURL
            'cancel_url'           => 'https://example.com/checkout/cancel.php',  // 失敗時リダイレクトURL
        ]);

        $user = $request->user();
        return view('user.subscription.index')->with([
            'intent' => $user,
            'session' => $session
        ]);

    }
}
