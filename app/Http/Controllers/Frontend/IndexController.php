<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\AboutUs;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

/**
 *
 */
class IndexController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function home(){
        $banners=Banner::where(['status'=>'active','condition'=>'banner'])->orderBy('id','DESC')->limit('5')->get();
        $promo_banner=Banner::where(['status'=>'active','condition'=>'promo'])->orderBy('id','DESC')->get();
        $categories=Category::where(['status'=>'active','is_parent'=>1])->limit(3)->orderBy('id',"DESC")->get();
        $new_products=Product::where(['status'=>'active','conditions'=>'new'])->orderBy('id','DESC')->limit('10')->get();
        $featured_products=Product::where(['status'=>'active','is_featured'=>1])->orderBy('id','DESC')->limit('10')->get();

        return view('frontend.index',compact([
            'banners','categories','new_products','featured_products','promo_banner'
        ]));
    }
    // about-us

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function aboutUs(){
        $about=AboutUs::first();
        return view('frontend.pages.about_us',compact('about'));
    }
    // contact-us

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function contactUs(){
        return view('frontend.pages.contact_us');
    }

    // customer contact

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function contactSubmit(Request $request){
        $this->validate($request,[
            'f_name'=>'string|required',
            'l_name'=>'string|required',
            'email'=>'email|required',
            'subject'=>'min:4|string|required',
            'message'=>'string|nullable|max:200',
        ]);
        $data=$request->all();
        Mail::to('admin@gmail.com')->send(new Contact($data));
        return back()->with('success','Successfull send your enquiry');
    }
    // shop

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function shop(Request $request){
        $products=Product::query();
        if(!empty($_GET['category'])){
            $slugs=explode(',',$_GET['category']);
            $cat_ids=Category::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            $products=$products->whereIn('cat_id',$cat_ids);
        }

        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='priceAsc'){
                $products=$products->where(['status'=>'active'])->orderBy('offer_price','ASC');
            }
            if($_GET['sortBy']=='priceDesc'){
                $products=$products->where(['status'=>'active'])->orderBy('offer_price','DESC');
            }
            if($_GET['sortBy']=='discAsc'){
                $products=$products->where(['status'=>'active'])->orderBy('price','ASC');
            }
            if($_GET['sortBy']=='discDesc'){
                $products=$products->where(['status'=>'active'])->orderBy('price','DESC');
            }
            if($_GET['sortBy']=='titleAsc'){
                $products=$products->where(['status'=>'active'])->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='titleDesc'){
                $products=$products->where(['status'=>'active'])->orderBy('title','DESC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            $price[0]=floor($price[0]) ;
            $price[1]=ceil($price[1]) ;
            $products=$products->whereBetween('offer_price',$price)->where('status','active')->paginate(12);
        }
        else{
            $products=$products->where('status','active')->paginate(12);
        }
        $cats=Category::where(['status'=>'active','is_parent'=>1])->with('products')->orderBy('title','ASC')->get();
        return view('frontend.pages.product.shop',compact('products','cats'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function shopFilter(Request $request){
        $data=$request->all();
        // Category filter
        $catUrl='';
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catUrl)){
                    $catUrl .='&category='.$category;
                }
                else{
                    $catUrl .=','.$category;
                }
            }
        }
        //sort filter
        $sortByUrl="";
        if(!empty($data['sortBy'])){
            $sortByUrl .='&sortBy='.$data['sortBy'];
        }
        //price filter
        $price_range_Url="";
        if(!empty($data['price_range'])){
            $price_range_Url .= '&price='.$data['price_range'];
        }
        return \redirect()->route('shop',$catUrl.$sortByUrl.$price_range_Url);
    }

    //autosearch

    /**
     * @param Request $request
     * @return array|string[]
     */
    public function autoSearch(Request $request){
        $query=$request->get('term','');
        $products=Product::where('title','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach($products as $product){
            $data[]=array('value'=>$product->title,'id'=>$product->id);
        }
        if(count($data)){
            return $data;
        }
        else{
            return ['value'=>"No Result Found",'id'=>''];
        }
    }

    //search product

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request){
        $query=$request->input('query');
        $products=Product::where('title','LIKE','%'.$query.'%')->orderBy('id','DESC')->paginate(12);
        $cats=Category::where(['status'=>'active','is_parent'=>1])->with('products')->orderBy('title','ASC')->get();
        return view('frontend.pages.product.shop',compact('products','cats'));
    }

    // Filter product by category.

    /**
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function productCategory(Request $request, $slug){
        $category=Category::with(['products'])->where('slug',$slug)->first();
        $sort='';

        if($request->sort !=null){
            $sort=$request->sort;
        }

        $products=Product::query();
        $products=$products->where('cat_id',$category->id);
        if($category==null){
            return view('errors.404');
        }
        elseif(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='priceAsc'){
                $products=$products->where(['status'=>'active'])->orderBy('offer_price','ASC');
            }
            if($_GET['sortBy']=='priceDesc'){
                $products=$products->where(['status'=>'active'])->orderBy('offer_price','DESC');
            }
            if($_GET['sortBy']=='discAsc'){
                $products=$products->where(['status'=>'active'])->orderBy('price','ASC');
            }
            if($_GET['sortBy']=='discDesc'){
                $products=$products->where(['status'=>'active'])->orderBy('price','DESC');
            }
            if($_GET['sortBy']=='titleAsc'){
                $products=$products->where(['status'=>'active'])->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='titleDesc'){
                $products=$products->where(['status'=>'active'])->orderBy('title','DESC');
            }
        }

        $products=$products->where('status','active')->paginate(12);


        $route='product-category';

        if($request->ajax()){

            $view=view('frontend.layouts._single-product',compact('products'))->render();
            return response()->json(['html'=>$view]);

        }
        $cats=Category::where(['status'=>'active','is_parent'=>1])->with('products')->orderBy('title','ASC')->get();
        return view('frontend.pages.product.product-category',compact(['category','route','products','cats']));
    }

    //    Product detail

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string
     */
    public function productDetail($slug){
        $product=Product::with('rel_prods')->where('slug',$slug)->first();
        if($product){
            return view('frontend.pages.product.product-detail',compact('product'));
        }
        else{
            return 'Product detail not found';
        }
    }

//    user auth

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function userAuth(){
        return view('frontend.auth.auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function loginSubmit(Request $request){
        $this->validate($request,[
            'email'=>'email|required|exists:users,email',
            'password'=>'required|min:4',
        ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'status'=>'active'])){
            Session::put('user',$request->email);
            return redirect()->route('user.dashboard')->with('success','Successfully login');
        }
        else{
            return back()->with('error','Invalid email & password!');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registerSubmit(Request $request){
        $this->validate($request,[
            'username'=>'nullable|string',
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);
        $data=$request->all();
        $check=$this->create($data);
        Session::put('user',$data['email']);
        Auth::login($check);
        if($check){
            return redirect()->route('home')->with('success','Successfully registered');
        }
        else{
            return back()->with('error',['Please check your credentials']);
        }

    }

    /**
     * @param array $data
     * @return mixed
     */
    private function create(array $data){
        return User::create([
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            'username'=>$data['username'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userLogout(){
        Session::forget('user');
        Auth::logout();
        return \redirect()->home()->with('success','Successfully logout');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function userDashboard(){
        $user=Auth::user();

        return view('frontend.user.dashboard',compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function userOrder(){
        $user=Auth::user();
        $orders=Order::where('user_id',$user->id)->latest()->get();
        return view('frontend.user.order',compact('user','orders'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function userAddress(){
        $user=Auth::user();

        return view('frontend.user.address',compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function userAccount(){
        $user=Auth::user();

        return view('frontend.user.account',compact('user'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function billingAddress(Request $request, $id){
        $user=User::where('id',$id)->update([
            'country'=>$request->country,
            'city'=>$request->city,
            'postcode'=>$request->postcode,
            'street'=>$request->street,
            'num'=>$request->num]);
        if($user){
            return back()->with('success','Billing address successfully updated');
        }
        else{
            return back()->with('error','Something went wrong');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function shippingAddress(Request $request, $id){
        $user=User::where('id',$id)->update([
            'scountry'=>$request->scountry,
            'scity'=>$request->scity,
            'spostcode'=>$request->spostcode,
            'sstreet'=>$request->sstreet,
            'snum'=>$request->snum]);
        if($user){
            return back()->with('success','Shipping address successfully updated');
        }
        else{
            return back()->with('error','Something went wrong');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateAccount(Request $request, $id){
        $this->validate($request,[
            'newpassword'=>'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'oldpassword'=>'nullable|min:4',
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'username'=>'nullable|string',
            'phone'=>'nullable|min:8',
        ]);
        $hashpassword=Auth::user()->password;

        if($request->oldpassword==null && $request->newpassowrd==null){
            User::where('id',$id)->update(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'username'=>$request->username,'phone'=>$request->phone]);
            return back()->with('success','Account successfully updated');

        }
        else{
            if(\Hash::check($request->oldpassword,$hashpassword)){
                if(!\Hash::check($request->newpassword,$hashpassword)){
                    User::where('id',$id)->update(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'username'=>$request->username,'phone'=>$request->phone,'password'=>Hash::make($request->newpassword)]);
                    return back()->with('success','Account successfully updated');

                }else{
                    return back()->with('error','New password can not be same with old password');
                }
            }
            else{
                return back()->with('error','Old password does not match');
            }
        }

    }
}
