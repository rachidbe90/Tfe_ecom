<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\RazorpayController;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

/**
 *
 */
class CheckoutController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function checkout(){
        $user=Auth::user();
        return view('frontend.pages.checkout.checkout',compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function checkoutStore(Request $request){
        $this->validate($request,[
            'first_name'=>'bail|string|required',
            'last_name'=>'bail|string|required',
            'email'=>'bail|email|required|exists:users,email',
            'phone'=>'required',
            'country'=>'bail|string|required',
            'city'=>'bail|string|required',
            'postcode'=>'numeric',
            'street'=>'bail|string|required',
            'num'=>'bail|numeric|required',
            'note'=>'bail|string|nullable',
            'sub_total'=>'required',
            'total_amount'=>'required',
            'delivery_charge'=>'nullable|numeric',
            'payment_method'=>'bail|string|required',
        ]);
//        return $request->all();

        $order=new Order;
        $order['user_id']=auth()->user()->id;
        $order['order_number']=Str::upper('ORD-'.Str::random(6));
        $order['sub_total']=$request->sub_total;
        if(Session::has('coupon')){
            $order['coupon']=Session::get('coupon')['value'];
        }
        else{
            $order['coupon']=0;
        }
        $order['total_amount']=(float)str_replace(',','',$request->total_amount);

        $order['payment_method']=$request->payment_method;
        $order['payment_status']='unpaid';
        $order['condition']='pending';
        $order['delivery_charge']=$request->delivery_charge;
        $order['first_name']=$request->first_name;
        $order['last_name']=$request->last_name;
        $order['email']=$request->email;
        $order['phone']=$request->phone;
        $order['country']=$request->country;
        $order['city']=$request->city;
        $order['postcode']=$request->postcode;
        $order['street']=$request->street;
        $order['num']=$request->num;
        $order['note']=$request->note;

        $status=$order->save();
        if($status){
            session()->put('order_id',$order->id);
        }


        foreach(Cart::instance('shopping')->content() as $item){
            $product_id[]=$item->id;
            $product=Product::find($item->id);
            $quantity=$item->qty;
            $size=$item->options->has('size') ? $item->options->size : '';
            if($size !=null){
                ProductAttribute::where('product_id',$item->id)->where('size',$size)->decrement('stock',$quantity);
            }
            $price=$item->price;
            $order->products()->attach($product,['quantity'=>$quantity,'size'=>$size,'price'=>$price]);
        }
        if($order['payment_method']=='paypal'){
            $paypal=new PaypalController;
            return $paypal->getCheckout();
        }

        if($status){
            Mail::to($order['email'])->send(new OrderMail($order));
            Cart::instance('shopping')->destroy();
            Session::forget('coupon');
            return redirect()->route('complete',$order['order_number']);
        }
        else{
            return redirect()->back()->with('error','Please try again');
        }
    }

    /**
     * @param $order_id
     * @param $payment
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function checkout_done($order_id, $payment){
        $order=Order::findOrFail($order_id);
        $order->payment_status='paid';
        $order->payment_details=$payment;
        $status=$order->save();
//        var_dump( $order);
        if($status){
            Mail::to($order['email'])->send(new OrderMail($order));
            Cart::instance('shopping')->destroy();
            Session::forget('coupon');
            return redirect()->route('complete',$order['order_number']);
        }
    }

    /**
     * @param $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function complete($order){
        $order=$order;
        return view('frontend.pages.checkout.complete',compact('order'));
    }
}
