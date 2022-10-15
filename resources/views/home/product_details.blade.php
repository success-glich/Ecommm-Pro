<!DOCTYPE html>
<html>
   <head>
    <!-- <base href="/public"> -->
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
       <!-- header section -->
       @include('home.header')
         <!-- slider section -->
         <!-- end slider section -->
    
      <div style="margin: auto; width:50%; padding:30px" class="col-sm-6 col-md-4 col-lg-4 col-center">
            <div class="box">
               <div class="option_container">
               
               </div>
               <div class="img-box" style="padding:20px">
                  <img src="/storage/product/{{$product->image}}" alt="" width="300" height="300">
               </div>
               <div class="detail-box">
                  <h5>
                     {{$product->title}}
                  </h5>

                  @if($product->discount_price!=null)
                  <h6 style="color:red">
                     Discount  price
                     <br>
                     ${{$product->discount_price}}
                  </h6>
                  <h6 style="text-decoration:line-through; color:blue; padding-top:0px" >
                     Price
                     <br>
                     ${{$product->price}}
                  </h6>
                  @else
                  <h6 style="color:blue">
                     Price
                     <br>
                     ${{$product->price}}
                  </h6>

                  @endif
                  <h6>Product Category :{{$category->category_name}}</h6>
                  <h6>Product Details :{{$product->description}}</h6>
                  <h6>Avialabe Quantity :{{$product->quantity}}</h6>
                  <form action="{{url('add_cart',$product->id)}}" method="post">
                        @csrf
                        <div style="display:fle">
                       <input style="border-radius:25px; margin-left:23px; width:113px;"  type="number" name="quantity" value="1" min="1" class="option1">
                        <input style="border-radius:25px; padding:8px 34px;" class="option2" type="submit" value="Add To Cart">
                     </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         </div>
  <!-- why section -->
   
      @include('home.footer')
    
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/home/js/custom.js"></script>
   </body>
</html>