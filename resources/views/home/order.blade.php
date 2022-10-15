<!DOCTYPE html>
<html>

<head>
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
    <style>
        .center{
            margin:auto;
            width: 70%;
            padding: 30px;
            text-align: center;
        }
        table,th,td{
            border:1px solid black;
        }
        .th_deg{
            padding: 15px;
            background-color: skyblue;
            font-size: 20px;
        }
        .img_deg{
            height: 200px;
            width: 200px;
        }
    </style>
</head>

<body>
        <!-- header section -->
        @include('home.header')
        <!-- slider section -->
        <div class="center">
            <table>
                <thead>
                    <th  class="th_deg">Product Title</th>
                    <th  class="th_deg">Quantity</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">payment Status</th>
                    <th class="th_deg">Delivery Status</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Cancel Order</th>
                </thead>
                <tbody>
                    @foreach($order as $order)
                    <tr>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                <td><img class="th_img" src="/storage/product/{{$order->image}}" alt="" ></td>

                      <td>
                        @if($order->delivery_status=='Processing')
                        <a href="{{url('cancel_order',$order->id)}}" onclick="return confirm('Are You Sure to Cancel this Order!!')" class="btn btn-danger">Cancel Order </a>
                        @else
                            <p class="text text-success">Not Allowed</p>
                        @endif
                      </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

    <!-- footer end -->

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