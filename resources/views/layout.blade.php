<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Tomoni - @yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{asset('/assets/img/icon.ico')}}" type="image/x-icon"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <script src="{{asset('/assets/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["{{asset('/assets/css/fonts.min.css')}}"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
    </script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
rel="stylesheet">
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<link src="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"  type='text/css'>
<link rel="stylesheet" href="{{asset('/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/atlantis.min.css')}}">
	<link href="{{asset('/assets/styles.css')}}" rel="stylesheet" />
    <link href="{{asset('/assets/prism.css')}}" rel="stylesheet" />
    <link href="{{asset('/assets/css/iconResource.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('/assets/css/validate.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/progress.css')}}">
    @toastr_css
</head>
<body>
    @include('commons.headerPage')
    @include('commons.sidebarPage')
	<div class="wrapper">
        @yield('content', 'Default content')
    </div>
</body>
@jquery
    @toastr_js
    @toastr_render

<link rel="stylesheet" href="{{asset('/assets/js/supplier/invoice.js')}}">
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.1/jquery.validate.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.1/jquery.validate.min.js"></script>
<script src="{{asset('/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{asset('/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('/assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/js/plugin/chart.js/chart.min.js')}}"></script>
<script src="{{asset('/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
{{-- <script src="{{asset('/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script> --}}
<script type="text/javascript" src="{{asset('/assets/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}" charset="utf-8"></script>
<script src="{{asset('/assets/js/plugin/chart-circle/circles.min.js')}}"></script>
<script src="{{asset('/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('/assets/js/atlantis.min.js')}}"></script>
<script src="{{asset('/assets/prism.js')}}"></script>
<script src="{{asset('/assets/prism-normalize-whitespace.min.js')}}"></script>
<script type="text/javascript">
	// Optional
	Prism.plugins.NormalizeWhitespace.setDefaults({
		'remove-trailing': true,
		'remove-indent': true,
		'left-trim': true,
		'right-trim': true,
	});

	// handle links with @href started with '#' only
	$(document).on('click', 'a[href^="#"]', function(e) {
		// target element id
		var id = $(this).attr('href');

		// target element
		var $id = $(id);
		if ($id.length === 0) {
			return;
		}

		// prevent standard hash navigation (avoid blinking in IE)
		e.preventDefault();

		// top position relative to the document
		var pos = $id.offset().top - 80;

		// animated top scrolling
		$('body, html').animate({scrollTop: pos});
	});
</script>
</html>
