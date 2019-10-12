<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'WPBot Logs') }}</title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<div id="app">
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<a class="navbar-brand" href="{{ url('/') }}">
				{{ config('app.name', 'WPBot Logs') }}
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<!-- Left Side Of Navbar -->
				<ul class="navbar-nav mr-auto">
					<div class="btn-group" role="group" aria-label="Navigate between days">
						<a href="{{ App\Http\Controllers\Logs::previousLogDateLink( isset( $log_date ) ? $log_date : null ) }}" class="btn btn-outline-primary text-white my-2 my-sm-0">&laquo; Back one day</a>
						<a href="/" class="btn btn-outline-primary text-white my-2 my-sm-0">Today</a>
						<a href="{{ App\Http\Controllers\Logs::nextLogDateLink( isset( $log_date ) ? $log_date : null ) }}" class="btn btn-outline-primary text-white my-2 my-sm-0">Forward one day &raquo;</a>
					</div>
				</ul>

				<form class="form-inline mt-2 mt-md-0" action="/search" method="post">
					@csrf

					<input name="s" class="form-control mr-sm-2" type="text" placeholder="Search logs" aria-label="Search logs" @if ( isset( $search ) ) value="{{ $search }}" @endif>
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>
		</nav>

		<main class="py-4">

			@if (session('status'))
				<hr>

				<div class="alert alert-info" role="alert">
					{{ session('status') }}
				</div>
			@endif

			@yield('content')
		</main>
	</div>
</body>
</html>
