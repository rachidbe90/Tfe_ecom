<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\CheckoutController;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

/**
 *
 */
class PaypalController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \PayPalHttp\HttpException
     * @throws \PayPalHttp\IOException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getCheckout(){
        $clientID=env('PAYPAL_CLIENT_ID');
        $clientSecret=env('PAYPAL_CLIENT_SECRET');

        if(get_setting('paypal_sandbox')==1){
            $environment=new SandboxEnvironment($clientID,$clientSecret);
        }
        else{
            $environment=new ProductionEnvironment($clientID,$clientSecret);
        }

        $client=new PayPalHttpClient($environment);

        $order=Order::findOrFail(session()->get('order_id'));

        $amount=$order->total_amount;

        $request=new OrdersCreateRequest();

        $request->prefer('return=representation');

        $request->body=[
            "intent"=>"CAPTURE",
            "purchase_units" => [[
                "reference_id" => rand(00000,99999),
                "amount" => [
                    "value" => number_format($amount,2,'.',''),
                    "currency_code" => 'EUR',
                ]
            ]],
            "application_context" => [
                "cancel_url" => url('paypal/payment/cancel'),
                "return_url" => url('paypal/payment/done'),
            ]
        ];

        try{
            $response=$client->execute($request);

            return Redirect::to($response->result->links[1]->href);
        }
        catch (\HttpException $ex){
            dd($ex);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getCancel(Request $request){
        $request->session()->forget('order_id');
        return \redirect()->route('home')->with('error','Sorry payment cancelled');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \PayPalHttp\HttpException
     * @throws \PayPalHttp\IOException
     */
    public function getDone(Request $request){
        $clientID=env('PAYPAL_CLIENT_ID');
        $clientSecret=env('PAYPAL_CLIENT_SECRET');

        if(get_setting('paypal_sandbox')==1){
            $environment=new SandboxEnvironment($clientID,$clientSecret);
        }
        else{
            $environment=new ProductionEnvironment($clientID,$clientSecret);
        }

        $client=new PayPalHttpClient($environment);

        $orderCaptureRequest=new OrdersCaptureRequest($request->token);
        $orderCaptureRequest->prefer('return=representation');

        try{
            $response=$client->execute($orderCaptureRequest);
            $checkoutController=new CheckoutController;
            return $checkoutController->checkout_done($request->session()->get('order_id'),json_encode($response));
        }
        catch (\HttpException $ex){
            dd($ex);
        }
    }
}
