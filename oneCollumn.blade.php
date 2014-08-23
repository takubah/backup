@extends('asmoyoTheme.standard.layout')

@section('structure')
	
	<div class="container body-container">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-12">
                        <div class="content">
                            @section('content')
                            	{{$content}}
                            @show
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop