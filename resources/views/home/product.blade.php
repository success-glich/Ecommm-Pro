<section class="product_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">
         <h2>
            Our <span>products</span>
         </h2>
         <br>
         <div>
            <form action="{{url('product_search')}}" method="get">
               @csrf

            <input style="width: 500px;" type="text" name="search" id="" placeholder="Search for Product">
            <input type="submit" value="Search">
            </form>
         </div>
      </div>
      @if(session()->has('msg'))
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            {{session()->get('msg')}}
         </div>
      @endif
      <div class="row">

         @foreach($product as $data)
         <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="box">
               <div class="option_container">
                  <div class="options">
                     <a href="{{url('product_details',$data->id)}}" class="option1">
                        Product Details
                     </a>
                     <form action="{{url('add_cart',$data->id)}}" method="post">
                        @csrf
                       <input style="border-radius:25px; margin-left:23px; width:113px;"  type="number" name="quantity" value="1" min="1" class="option1">
                     <input style="border-radius:25px; padding:8px 34px;" class="option2" type="submit" value="Add To Cart">
                     </form>
                  </div>
               </div>
               <div class="img-box">
                  <img src="/storage/product/{{$data->image}}" alt="">
               </div>
               <div class="detail-box">
                  <h5>
                     {{$data->title}}
                  </h5>

                  @if($data->discount_price!=null)
                  <h6 style="color:red">
                     Discount <br> price
                     <br>
                     ${{$data->discount_price}}
                  </h6>
                  <h6 >
                     Price
                     <div style="text-decoration:line-through; color:blue;">
                     <br>
                     ${{$data->price}}
                     </div>
                  </h6>
                  @else
                  <h6 style="color:blue">
                     Price
                     <br>
                     ${{$data->price}}
                  </h6>

                  @endif

               </div>
            </div>
         </div>
         @endforeach


      </div>
      <div class="box">
        <!-- <a href=""> -->
            <!-- View All products -->
            {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
         <!-- </a> -->
      </div>
   </div>
</section>