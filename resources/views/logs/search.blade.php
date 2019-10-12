@extends('layouts.app');

@section('content')
<hr>

<div class="col">
	<h1>Logs matching {{ $search }}</h1>
</div>

<div class="col">
	@include('logs.list')
</div>
@endsection
