<!DOCTYPE html>

<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="XF Technology dashboard">
    <meta name="author" content="Hiro">
    <link rel="icon" href="">
	@include('layouts.assets')
</head>
<body>
	@include('layouts.header')

<!-- BEGIN CONTAINER -->
<div class="container-fluid">
	 <div class="row">
        
 @include('layouts.sidebar')


	@yield('content')
	
	
	</div>
</div>
@include('layouts.footer')
</body>
</html>
