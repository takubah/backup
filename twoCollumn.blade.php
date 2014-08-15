@extends('asmoyoTheme.standard.layout')

@section('structure')
	
	<div class="container-fluid asmoyo-container">
        <div class="row">
            <div class="col-md-8">
                <div class="content">
                    @section('content')
                        {{$content}}
                    @show
                </div>
            </div>

            <div class="col-md-4">
                @section('sideRight')
                    
                @show
            </div>
        </div>
    </div>

@stop