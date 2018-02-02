{{-- 主要布局文件 --}}
<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title', 'ZjBLOG') - {{ setting('site_name', 'Laravel 社区') }}</title>
    <meta name="description" content="@yield('description', setting('seo_description', 'IT 爱好者社区。'))" />
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', '博客,社区,论坛,开发者论坛'))" />

	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	@yield('styles')

</head>
<body>
	<div id="app" class="{{ route_class() }}-page">
        {{-- 引入头部布局 --}}
		@include('layouts._header')

		<div class="container">
			@include('layouts._message')
			@yield('content')

		</div>

		@include('layouts._footer')
	</div>
	@if (app()->isLocal())
        @include('sudosu::user-selector')
    @endif
	{{-- 引入js文件 --}}
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	@yield('scripts')

</body>
</html>