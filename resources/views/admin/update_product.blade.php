<!DOCTYPE html>
<html lang="en">

<head>

<!-- <base href="/public"> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <style>
        .div_center {
            text-align: center;
            padding-top: 40px;

        }

        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }
    </style>
    @include("admin.css")
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include("admin.sidebar")
        <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        @include("admin.header")
        <!-- partial -->
        <!-- main-panel ends -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('msg'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                    {{session()->get('msg')}}
                </div>

                @endif
                <div class="div_center">
                    <h2 class="h2_font">Update Product</h2>
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h4 class="card-title">Default form</h4>-->
                            <form action="{{url('/update_product_confirm',$product->id)}}" method="post" class="forms-sample" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="category">Product Title :</label>
                                    <input style="color:#ffab00" type="text" name="title" class="form-control" value="{{$product->title}}" placeholder="Write Category name" required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Product Description :</label>
                                    <input style="color:#ffab00" type="text" name="desc" class="form-control" value="{{$product->description}}" placeholder="Write a Description" required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Product Price :</label>
                                    <input style="color:#ffab00" type="number" name="price" value="{{$product->price}}"class="form-control" placeholder="Write a Price" required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Discount Price :</label>
                                    <input style="color:#ffab00" type="number" name="discount" value="{{$product->discount_price}}" class="form-control" placeholder="Write a Discount">
                                </div>
                                <div class="form-group">
                                    <label for="category">Product Quantity :</label>
                                    <input style="color:#ffab00" type="number" min="0" name="quantity"  value="{{$product->quantity}}"class="form-control" placeholder="Write a Quantity" required>
                                </div>
                                <div class="form-group" >
                                    <label for="exampleSelectGender">Product Category</label>
                                    <select style="background-color:white; " name="category" class="form-control" id="" required>
                                        <!-- <option value="null" selected>Add a Category</option> -->
                                            @foreach($category as $data)
                                            @if($product->category==$data->id)
                                        <option value="{{$data->id}}" selected>{{$data->category_name}}</option>
                                            @else
                                        <option value="{{$data->id}}" >{{$data->category_name}}</option>
                                            
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category">Current Product Image:</label>
                                    <img src="/storage/product/{{$product->image}}" height="200" width="200" alt="">
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="category"> Change Product Image  :</label>
                                    <input style="color:#ffab00" type="file"  name="image" class="form-control" >
                                </div>





                                <button type="submit" class="btn btn-warning mr-2">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>


            </div>
        </div>
    </div>

    <!-- container-scroller -->
    @include('admin.script')
</body>

</html>