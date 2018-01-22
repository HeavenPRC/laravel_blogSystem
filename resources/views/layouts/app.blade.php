{{-- 主要布局文件 --}}
<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title','欢迎~！')-IT博客社区</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
	<div id="app" class="{{ route_class() }}-page">
        {{-- 引入头部布局 --}}
		@include('layouts._header')

		<div class="container">

			@yield('content')

		</div>

		@include('layouts._footer')
	</div>
	{{-- 引入js文件 --}}
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>