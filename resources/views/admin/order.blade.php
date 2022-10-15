<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    @include("admin.css")
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
                        <h2 class="h2_font">All Orders</h2>

                    </div>
                    <div style="padding-left:400px; padding-bottom:30px;">
                        <form action="{{url('search')}}" method="get">
                            @csrf

                        <input style="color:black" type="text" name="search" placeholder="Search Order" id="">
                        <input type="submit" value="Search" class="btn btn-outline-primary">
                        </form>
                    </div>

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Order </h4>
                                </p>
                                <div style=" color:white" class="table-responsive table-lg">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Product Title</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Payment Status</th>
                                                <th>Delivery Status</th>
                                                <th>Image</th>
                                                <th>Delivered</th>
                                                <th>Print PDF</th>
                                                <th>Send Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($order as $order)
                                            <tr>
                                                <td>{{$order->name}}</td>
                                                <td>{{$order->email}}</td>
                                                <td>{{$order->address}}</td>
                                                <td>{{$order->product_title}}</td>
                                                <td>{{$order->quantity}}</td>
                                                <td>{{$order->price}}</td>
                                                <td>{{$order->payment_status}}</td>
                                                <td>{{$order->delivery_status}}</td>
                                                <td >

                                                    <div>

                                                        <img style="width: 200px ; height:200px" src="{{asset('storage/product/'.$order->image)}}" alt="image" width="200" height="200">
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($order->delivery_status=='Processing')
                                                    <a href="{{url('delivered',$order->id)}}" onclick="return confirm('Are you sure this product is delivered!!!')" class="btn btn-primary">Delivered</a>
                                                    @else
                                                    <p class="text text-success">Delivered</p>
                                                    @endif

                                                </td>
                                                <td>
                                                    <a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary">Print PDF</a>
                                                </td>
                                                <td>
                                                    <a href="{{url('send_email',$order->id)}}" class="btn btn-info">Send Email</a>
                                                </td>

                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="16" style="font-size: 20px; text-align:center; color:white;">
                                                    No Data Found
                                                </td>
                                            </tr>
                                           
                                            @endforelse

                                        </tbody>




                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- container-scroller -->
        @include('admin.script')
</body>

</html>