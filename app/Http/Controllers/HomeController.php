<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Reply;
use Session;
use Stripe;
// use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    //
    public function redirect(){
        $usertype=Auth::user()->usertype;
        if($usertype=='1'){
            $total_product=Product::all()->count();
            $total_order=Order::all()->count();
            $total_user=User::all()->count();
            $cart=Cart::find(Auth::user()->id)->count();
            $order=order::all();
            $total_revenue=0;
            foreach($order as $order){
                $total_revenue+=$order->price;

            }
            $total_delivered=order::where('delivery_status','=','delivered')->get()->count();
            $total_processing=order::where('delivery_status','=','Processing')->get()->count();
            return view("admin.home",compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
        }else{
         $product=Product::paginate(3);
         $comment=comment::orderby('id','desc')->get();
         $reply =Reply::all();

            return view("home.userpage",compact("product",'comment','reply'));
        }
    }
    public function index(){
        $product=Product::paginate(3);
        $comment=comment::orderby('id','desc')->get();

        $reply =Reply::all();

        return view('home.userpage',compact("product",'comment','reply'));
    }
    public function product_details($id){
        $product=Product::find($id);
        $category=Category::find($product->category);
     

        return view('home.product_details',compact('product','category'));
    }
    public function add_cart(Request $request ,$id){
        if(Auth::id()){
            $user=Auth::user();
            $userid=$user->id;
            // dd($user);
            $product=Product::find($id);
            $product_exist_id=cart::where('product_id','=',"$id")->where('user_id','=',"$userid")->get('id')->first();
            // dd($product_exist_id);
            // echo $product_exist_id;
            // die;
            if($product_exist_id){
                $carts=cart::find($product_exist_id);
                $cart=$carts[0];
                // dd($cart);
                $quantity= $cart->quantity;
                // $quantity=10;
                // echo $qn;
                $cart->quantity=$quantity+$request->quantity;
                if($product->discount_price!=null){
                    $cart->price=($product->price-$product->discount_price);
    
                }else{
    
                    $cart->price=$product->price;
                }
                // $cart->quantity=($request->quantity) + $quantity;

                $cart->save();
                // return redirect()->back()->with('msg','Product Added Successfully');
                Alert::success('Product Added Successfully','We have added product to the cart');
                return redirect()->back();

            }else{

                $cart=new Cart();
                $cart->name=$user->name;
                $cart->email=$user->email;
                $cart->phone=$user->phone;
                $cart->address=$user->address;
                $cart->user_id=$user->id;
                $cart->product_title=$product->title;
                $cart->image=$product->image;
                $cart->product_id=$product->id;
                if($product->discount_price!=null){
                    $cart->price=$product->price-$product->discount_price;
    
                }else{
    
                    $cart->price=$product->price;
                }
                $cart->quantity=$request->quantity;
                $cart->save();
                Alert::success('Product Added Successfully','We have added product to the cart');

                // return redirect()->back()->with('msg','Product Added Successfully');
                return redirect()->back();

            }



        }else{
            return redirect('login');

        }


        //cart
    }
    public function show_cart(){
        if(Auth::id()){

            $id =Auth::user()->id;
            $cart=cart::where('user_id','=',$id)->get();
    
            return view('home.showcart',compact('cart'));
        }else{
            return redirect('login');
        }
    }
    public function remove_cart($id){
            $cart=cart::find($id);
            $cart->delete();
            return redirect()->back();
    }

    //Order 
    public function cash_order(){
        $user=Auth::user();
        $userid=$user->id;
        // dd($userid);
        $data=cart::where('user_id','=',$userid)->get();
        // dd($data);
        foreach($data as $data){
            $order=new Order();
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->product_id=$data->product_id;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->payment_status='cash On delivery';
            $order->delivery_status='Processing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();

        }
        return redirect()->back()->with('msg','We Received Your Order. We will connect with you soon...');;

    }

    //stripe payment
    public function stripe($totalprice){

        return view('home.stripe',compact('totalprice'));
    }
  
    public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice* 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for Payement" 
        ]);
        $user=Auth::user();
        $userid=$user->id;
        // dd($userid);
        $data=cart::where('user_id','=',$userid)->get();
        // dd($data);
        foreach($data as $data){
            $order=new Order();
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->product_id=$data->product_id;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->payment_status='Paid';
            $order->delivery_status='Processing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();

        }
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }
    public function show_order(){

        if(Auth::id()){
            $user=Auth::user();
            $userid=$user->id;
            $order=order::where('user_id','=',"$userid")->get();


            return view('home.order',compact('order'));
        }else{
            return redirect('login');
        }
    }
    public function cancel_order($id){
        $order =order::find($id);
        $order->delivery_status="You canceled the order";
        $order->save();
        return redirect()->back();
    }
    public function add_comment(Request $request){
        if(Auth::id()){

            $comment=new Comment(); 
            // $user_id=Auth::user()->id;
            $comment->name=Auth::user()->name;
            $comment->user_id=Auth::user()->id;
            $comment->comment=$request->comment;
            $comment->save();
            return redirect()->back();
        }else{
            return redirect("login");
        }
    }
    public function add_reply(Request $request){
        if(Auth::id()){
            $reply=new Reply();
            $reply->name=Auth::user()->name;
            $reply->user_id=Auth::user()->id;
            $reply->comment_id=$request->commentId;
            $reply->reply=$request->reply;
            $reply->save();
            return redirect()->back();

        }else{
            return redirect('login');
        }
    }

    public function product_search(Request $request){
        $search_text=$request->search;
        $product=product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"%$search_text%")->paginate(3);
        $comment=comment::orderby('id','desc')->get();
        $reply =Reply::all();
        return view('home.userpage',compact('product','comment','reply'));


    }
    public function search_product(Request $request){
        $search_text=$request->search;
        $product=product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"%$search_text%")->paginate(3);
        $comment=comment::orderby('id','desc')->get();
        $reply =Reply::all();
        return view('home.all_product',compact('product','comment','reply'));


    }
    public function products(){
        $product=Product::paginate(3);
        $comment=comment::orderby('id','desc')->get();
        $reply =Reply::all();

        return view('home.all_product',compact('product','comment','reply'));
        // return redirect()->back()->with
    }
}
