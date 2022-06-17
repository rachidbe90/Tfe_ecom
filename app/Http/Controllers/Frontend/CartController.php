<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductAttribute;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 *
 */
class CartController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cart(){
        return view('frontend.pages.cart.index');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function cartStore(Request $request){
        $product_qty=$request->input('product_qty');
        $product_size=$request->input('product_size');
        $product_id=$request->input('product_id');
        $product=Product::getProductByCart($product_id);
        $price=$request->input('product_price');

        $cart_array=[];
        $product_attr=ProductAttribute::where(['product_id'=>$product_id,'size'=>$request->input('product_size')])->first();

        foreach(Cart::instance('shopping')->content() as $item){
            if($item->model->id==$product_id && $item->options->size==$product_size && $item->qty>=$product_attr->stock){
                $response['status']=false;
                $response['total']=Cart::subtotal();
                $response['cart_count']=Cart::instance('shopping')->count();
                $response['message']="Stock insufficient.";
                return $response;
            }
            $cart_array[]=$item->id;
        }

        if($product_attr->stock < $product_qty){
            $response['status']=false;
            $response['total']=Cart::subtotal();
            $response['cart_count']=Cart::instance('shopping')->count();
            $response['message']="Stock insufficient.";
            return $response;

        }

        $result=Cart::instance('shopping')->add($product_id,$product[0]['title'],$product_qty,$price,['size'=>$request->input('product_size')])->associate('App\Models\Product');

        Session::forget('coupon');

        if($result){
            $response['status']=true;
            $response['product_id']=$product_id;
            $response['total']=Cart::subtotal();
            $response['cart_count']=Cart::instance('shopping')->count();
            $response['message']="Item was added to your cart";
        }
        if($request->ajax()){
            $header=view('frontend.layouts.header')->render();
            $response['header']=$header;
        }
        return $response;
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function cartDelete(Request $request){
        $id=$request->input('cart_id');
        Cart::instance('shopping')->remove($id);
        $response['status']=true;
        $response['message']="Cart successfully removed";
        $response['total']=Cart::subtotal();
        $response['cart_count']=Cart::instance('shopping')->count();

        Session::forget('coupon');

        if($request->ajax()){
            $header=view('frontend.layouts.header')->render();
            $response['header']=$header;
            $cart_list=view('frontend.layouts._cart-lists')->render();
            $response['cart_list']=$cart_list;

        }
        return json_encode($response);

    }

    /**
     * @param Request $request
     * @return array
     */
    public function cartUpdate(Request $request){

        $product_id=$request->productID;
        $product_attr=ProductAttribute::where(['product_id'=>$product_id,'size'=>$request->productSize])->first();

        $rowId=$request->input('rowId');
        $request_quantity=$request->input('product_qty');
        $productQuantity=$request->input('productQuantity');

//        if($request_quantity>$productQuantity){
//            $response['status']=false;
//        }
        if($product_attr->stock < $request_quantity){
            $response['status']=false;
            $message="We currently do not have enough items in stock";
        }
        elseif($request_quantity<1){
            $message="You can't add less than 1 quantity";
            $response['status']=false;
        }
        else{
            Cart::instance('shopping')->update($rowId,$request_quantity);
            $message="Quantity was updated successfully";
            $response['status']=true;
            $response['total']=Cart::subtotal();
            $response['cart_count']=Cart::instance('shopping')->count();

            Session::forget('coupon');

        }
        if($request->ajax()){
            $header=view('frontend.layouts.header')->render();
            $cart_list=view('frontend.layouts._cart-lists')->render();
            $response['header']=$header;
            $response['cart_list']=$cart_list;
            $response['message']=$message;
        }
        return $response;
    }

//    Coupon

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function couponAdd(Request $request){
        $coupon=Coupon::where('code',$request->input('code'))->first();
        if(!$coupon){
            return back()->with('error','Invalid coupon code, Please enter valid coupon code');
        }
        if($coupon){
            $total_price=(float)str_replace(',','',Cart::instance('shopping')->subtotal());
            session()->put('coupon',[
                'id'=>$coupon->id,
                'code'=>$coupon->code,
                'value'=>$coupon->discount($total_price),
            ]);
            return back()->with('success','Coupon applied successfully');
        }
    }
}
