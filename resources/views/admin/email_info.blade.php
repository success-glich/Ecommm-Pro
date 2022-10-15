<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    @include("admin.css")
    <style>
        label{
            display: inline-block;
            width: 200px;
            font-size:15px;
            font-weight: bold;
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

                <h1 style="text-align:center; font-size: 25px;">Send Email to {{$order->email}}</h1>

                <form action="{{url('send_user_email',$order->id)}}" method="POST">
                    @csrf
                <div style="padding-left:35%; padding-top:30px">
                    <label for="">Email Greeting</label>
                    <input style="color:black" type="text" name="greeting" id="">
                </div>
                <div style="padding-left:35%; padding-top:30px">
                    <label for="">Email FirstLine:</label>
                    <input style="color:black" type="text" name="firstline" id="">
                </div>
                <div style="padding-left:35%; padding-top:30px">
                    <label for="">Email Body:</label>
                    <input style="color:black" type="text" name="body" id="">
                </div>
                <div style="padding-left:35%; padding-top:30px">
                    <label for="">Email Button Name:</label>
                    <input style="color:black" type="text" name="button" id="">
                </div>
                <div style="padding-left:35%; padding-top:30px">
                    <label for="">Email Url:</label>
                    <input style="color:black" type="text" name="url" id="">
                </div>
                <div style="padding-left:35%; padding-top:30px">
                    <label for="">Email Last Line:</label>
                    <input style="color:black" type="text" name="lastline" id="">
                </div>
                <div style="padding-left:35%; padding-top:30px">
                    <input style="color:black" type="submit" value="Send Email" class="btn btn-info" id="">
                </div>


                </form>
            </div>
        </div>

        <!-- container-scroller -->
        @include('admin.script')
</body>

</html>