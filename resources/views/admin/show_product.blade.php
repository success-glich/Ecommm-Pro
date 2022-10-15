<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags --> -->
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
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('msg'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                    {{session()->get('msg')}}
                </div>

                @endif
                <div class="">
                    <div class="div_center">
                        <h2 class="h2_font">List Products</h2>
                    </div>

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Product </h4>
                                </p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product Title</th>
                                                <th>Description</th>
                                                <th>Quantity</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Discount</th>
                                                <th>Product Image</th>
                                                <th>Action</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                       
                                            @foreach($data as $data)
                                            <tr >
                                                <td>{{$data->title}}</td>
                                                <td>{{$data->description}}</td>
                                                <td>{{$data->quantity}}</td>
                                                <td>{{$data->category}}</td>
                                                <td>{{$data->price}}</td>
                                                <td>{{$data->discount_price}}</td>

                                                <td>

                                                <div >
                                                
                                                 <img style="width: 200px ; height:200px" src="{{asset('storage/product/'.$data->image)}}" alt="image" width="200" height="200">
                                                 </div>
                                                 </td>
                                                <td><a href="{{url('/update_product',$data->id)}}" class="btn btn-success">Edit</a></td>
                                                <td>
                                                    <a href="{{url('/delete_product',$data->id)}}"  onclick="return confirm('Are You Sure to Delete ?')" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach

                                     
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main-panel ends -->


        <!-- container-scroller -->
        @include('admin.script')
</body>

</html>