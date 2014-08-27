@extends('asmoyoTheme.baretshow.layout')

@section('structure')

	<div class="container">
		<div class="row">

			<div class="col-lg-8">
				{{$content}}
			</div>

			<div class="col-lg-4">
				@include('asmoyoTheme.baretshow.partials.sideRight')
			</div>

		</div>
	</div>

@stop