@extends('asmoyoTheme.standard.layout')

@section('structure')
	
	<div class="container body-container">
        <div class="row">
            <div class="col-md-9">
                <div class="content">
                    @section('content')
                        {{$content}}
                    @show
                </div>
            </div>

            <div class="col-md-3">
                @section('sideRight')
                    @include('asmoyoTheme.standard.partials.sideRight')
                @show
            </div>
        </div>
    </div>

@stop