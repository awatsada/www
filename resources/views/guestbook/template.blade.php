<!DOCTYPE html>
<html lang="en">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
   	<link rel="stylesheet" href="{{url('/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('/css/bootstrap-theme.min.css')}}">
	<link rel="stylesheet" href="{{url('/css/social-buttons.css')}}">

 <body>
@include("guestbook.header")  

@yield("content")

@include("guestbook.footer")
 
     <!-- JavaScripts -->
    <script src="{{url('/js/jquery.min.js')}}"></script>
    <script src="{{url('/js/bootstrap.min.js')}}"></script>
</body>
</html>