<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EComm</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
  
    @include('header')
    @yield('content')
    @include('footer')
</body>
<style>
    .custom-login
    {
        height:400px;
        padding-top:100px;
    }
    .slider_image
    {
        height:400px !important;
    }
    .custom-product
    {
        height : 500px;
    }
    .slider_text
    {
      background-color :skyblue;  
      color: black;
    }
    .tranding-img
    {
        height:100px;
    }
    .tranding-items
    {
        float:left;
        width:20%;
    }
    .tranding-wrapper
    {
        margin:20px;
    }
    .detail-image
    {
        height:200px
    }
    .searchbox{
        width : 500px !important;
    }
    .cart-list-devider{
        border-bottom : 1px solid #ccc;
        margin-bottom:20px;
        padding-bottom :20px
    }
</style>
</html>