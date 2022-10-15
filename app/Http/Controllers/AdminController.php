<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Notifications\SendEmailNotification;
use Illuminate\Notifications\Notification;
use PDF;

class AdminController extends Controller
{
    // category Start here
    public function view_category(){
        $data=Category::all();
        return view('admin.category',compact('data'));
    }
    public function add_category(Request $request){
        $data=new Category();
        $data->category_name=$request->category;
        $data->save();
        return redirect()->back()->with('msg','Category Added Successfully');
    }
    public function delete_category($id){
        $data= Category::find($id);
        $data->delete();
        return redirect()->back()->with('msg',"Category Deleted SuccessFully");
    }

    //Category End here

    /* Product Strat Here */
    public function view_product(){
        $category= Category::all();
        return view('admin.product',compact("category"));
        // return view('admin.product');
    }

    public function add_product(Request $request){
        $product = new Product();
        // echo "<pre>";
        // print_r($request->post());
        // die();
        $product->title=$request->title;
        $product->description=$request->desc;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->discount;
        $product->category=$request->category;

        // $imagename=time().'.'.$image->getClientOriginalExtension
        $image=$request->file('image');
        $ext=$image->extension();
        $image_name=time().'.'.$ext;
        $image->storeAs('/public/product',$image_name);
        $product->image=$image_name;

        $product->save();

        return redirect()->back()->with('msg',"Product Added SuccessFully");
    }
    public function show_product(){
        $data=Product::all();

        return view('admin.show_product',compact("data"));
    }
    public function delete_product($id){
        $data= Product::find($id);
        $data->delete();
        return redirect()->back()->with('msg',"Product Deleted SuccessFully");
    }

    public function update_product($id){
        // $product=Product::find($id);
        $category=Category::all();
        $product=Product::find($id);
        return view('admin.update_product',compact("category","product"));

    }
    public function update_product_confirm(Request $request,$id){
        $product=Product::find($id);
        $product->title=$request->title;
        $product->description=$request->desc;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->discount;
        $product->category=$request->category;
        $image=$request->file('image');
        if($image){

            $ext=$image->extension();
            $imagename=time().'.'.$ext;
            $image->storeAs('/public/product',$imagename);
            $product->image=$imagename;
        }
        $product->save();
        return redirect()->back()->with("msg","Updated Successfully");

    }
    /* Product Strat End Here */

    //Order
    public function order(){
            $order =Order::all();
        return view('admin.order',compact("order"));
    }
    public function delivered($id){
        $order=Order::find($id);
        $order->delivery_status="delivered";
        $order->payment_status="Paid";
        $order->save();
        return redirect()->back();
    }

    public function print_pdf($id){


            $order=order::find($id);
            $pdf =PDF::loadView('admin.pdf',compact('order'));
            return $pdf->download('order_details.pdf');
    }
    public function send_email($id){
        $order=Order::find($id);
            return view('admin.email_info',compact('order'));
    }
    public function send_user_email(Request $request,$id){
        $order=order::find($id);
        
        $details=[
            'greeting'=>$request->greeting,
            'firstline'=>$request->firstline,
            'body'=>$request->body,
            'button'=>$request->button,
            'url'=>$request->url,
            'lastline'=>$request->lastline,


        ];
        // Notification::send($order,new SendEmailNotification($details));
        Notification::send($order, new SendEmailNotification($details));


        return redirect()->back();
    }
    public function searchdata(Request $request){

        $searchText=$request->search;
        $order=order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->get();
        return view('admin.order',compact('order'));
    }
}
