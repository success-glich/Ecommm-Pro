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
</head>

<body>
      <!-- header section -->
      @include('home.header')
      <!-- slider section -->
      <!-- end slider section -->
   <!-- why section -->
   <!-- end why section -->

   <!-- arrival section -->
   <!-- end arrival section -->

   <!-- product section -->
   @include('home.product_view')


   <!-- Comment adn reply system starts here -->
   <div style="text-align: center; padding:0 0 30px 0;">
      <h1 style="font-size: 30px; text-align:center; padding:20px 0 20px 0;"> Comments</h1>
      <form action="{{url('add_comment')}}" method="post">
         @csrf
         <textarea style="height: 150px;width:600px;" name="comment" placeholder="Comment Soething here" name=""></textarea>
         <br>
         <!-- <a href="" type="submit" class="btn btn-primary">Comment</a> -->
         <input type="submit" value="Comment" class="btn btn-primary">
      </form>
   </div>
   <div style="padding-left:20%;">
      <h1 style="font-size:20px; padding:0 0 30px 0">All Comments</h1>
      @foreach($comment as $comment)
      <div>
         <b>{{$comment->name}}</b>
         <p>{{$comment->comment}}</p>
         <a style="color:blue;" class="reply" href="javascript::void(0)" onclick="reply(this)" data-Commentid="{{$comment->id}}">Reply</a>
         @foreach($reply as $rep)

         @if($rep->comment_id==$comment->id)
         <div style="padding-left: 3%; padding-bottom:10px;">

               <b>{{$rep->name}}</b>
               <p>{{$rep->reply}}</p>
         <a style="color:blue;" class="reply" href="javascript::void(0)" onclick="reply(this)" data-Commentid="{{$comment->id}}">Reply</a>

         </div>
         @endif
         @endforeach
      </div>
      @endforeach
    <!-- Reply Text Box -->
    
      <div style="display:none;" id="replyDiv">
      <form action="{{url('add_reply')}}" method="POST">
         @csrf
            <input type="hidden" id = "commentId" name="commentId">
         <textarea style="height:100px; width:500px;" name="reply" id="" placeholder="Write something here" require></textarea>
         <br>
         <!-- <a href="" type="submit" class="btn btn-outline-primary">Reply</a> -->
         <button type="submit"  class="btn btn-outline-primary"> Reply</button>
         <a href="javascript::void(0)" class="btn btn-outline-warning" onclick="reply_close(this)">Close</a>
         </form>
      </div>
   </div>
   <!-- Comment adn reply system ends here -->

   <!-- end product section -->

   <!-- subscribe section -->
   <!-- end subscribe section -->
   <!-- client section -->
   <!-- end client section -->
   <!-- footer start -->
   @include('home.footer')

   <!-- footer end -->
   <div class="cpy_">
      <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

         Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

      </p>
   </div>

 
   <!-- jQery -->
   <script src="home/js/jquery-3.4.1.min.js"></script>
   <script>
      // $(document).ready(function() {
      //    alert("hello world")
      //    // $(".reply").click(function() {
      //    //    $("#test").hide();
      //    // });
      // });


      // jQuery methods go here...

      function reply(caller){
         // alert("hellow");
         // console.log(typeof caller);
         // caller.appendChildElement()
         document.getElementById('commentId').value=$(caller).attr('data-Commentid');
         $('#replyDiv').insertAfter($(caller));
         $('#replyDiv').show();
                  // $(document).ready(function(){

      // jQuery methods go here...

      }
      function reply_close(caller){
         $('#replyDiv').hide();
      }
   </script>
   <!-- keep us on the samepage even after refreshing -->
     <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
   <!-- popper js -->
   <script src="home/js/popper.min.js"></script>
   <!-- bootstrap js -->
   <script src="home/js/bootstrap.js"></script>
   <!-- custom js -->
   <script src="home/js/custom.js"></script>
</body>

</html>