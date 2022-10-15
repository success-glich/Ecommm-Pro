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
                        <h2 class="h2_font">Add Category</h2>
                    </div>
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title">Default form</h4>-->
                                <form action="{{url('/add_category')}}" method="post" class="forms-sample">
                                    @csrf
                                    <div class="form-group">
                                        <label for="category">Category Name</label>
                                        <input style="color:white" type="text" name="category" class="form-control" id="ca" placeholder="Write Category name">
                                    </div>




                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Category List</h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Category</th>
                            <th>Action</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $data)
                          <tr>
                            <td>{{$data->category_name}}</td>
                            <td>
                                <a href="">
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </a>
                            </td>
                            <td>
                            <a onclick="return confirm('Are You Sure to Delete ?')" href="{{url('delete_category',$data->id)}}" class="btn btn-danger" >
                               Delete </a>
                            </td>
                           
                          </tr>
                          @endforeach
                        
                        </tbody>
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