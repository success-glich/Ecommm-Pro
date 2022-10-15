
    <!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
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
        @include('admin.body')
        <!-- main-panel ends -->
      
    <!-- container-scroller -->
   @include('admin.script')
  </body>
</html>