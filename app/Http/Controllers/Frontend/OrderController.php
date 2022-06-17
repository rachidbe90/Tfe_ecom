<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

/**
 *
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $orders=Order::orderBy('id',"DESC")->get();
        return view('backend.order.index',compact('orders'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function orderStatus(Request $request){
        $order=Order::find($request->input('order_id'));
        if($order){
            if($request->input('condition')=='delivered'){
                foreach($order->products as $item){
                    $product=Product::where('id',$item->pivot->product_id)->first();
                    $productAtt=ProductAttribute::where('product_id',$product->id)->first();
                    $stock=$productAtt->stock;
                    $stock -=$item->pivot->quantity;
                    $productAtt->update(['stock'=>$stock]);
                    Order::where('id',$request->input('order_id'))->update(['payment_status'=>'paid']);
                }
            }
            $status=Order::where('id',$request->input('order_id'))->update(['condition'=>$request->input('condition')]);
            if($status){
                return back()->with('success','Order successfully updated');
            }
            else{
                return back()->with('error','Something went wrong');
            }
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::find($id);
        if($order){
            return view('backend.order.show',compact('order'));
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order=Order::find($id);
        if($order){
            $status=$order->delete();
            if($status){
                return redirect()->route('order.index')->with('success','Order successfully deleted');
            }
            else{
                return back()->with('error','Something went wrong!');
            }
        }
        else{
            return back()->with('error','Data not found');
        }
    }
}
