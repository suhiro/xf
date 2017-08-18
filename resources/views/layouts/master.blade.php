<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>XF | Dashboard</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="production log" name="description"/>
<meta content="Hiro" name="author"/>
	@include('layouts.assets')
</head>
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
	@include('layouts.header')
	<div class="clearfix"></div>

<!-- BEGIN CONTAINER -->
<div class="page-container">
 @include('layouts.sidebar')




	@yield('content')
	
	@include('layouts.footer')
	
</div>
	
</body>
</html>
