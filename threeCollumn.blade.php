@extends('asmoyoTheme.baretshow.layout')

@section('structure')

	<div class="container">
		
		<div class="row">
			
			<div class="col-lg-2">
				{{$left}}
			</div>

			<div class="col-lg-8">
				{{$content}}
			</div>

			<div class="col-lg-2">
				{{$right}}
			</div>

		</div>

	</div>

@stop