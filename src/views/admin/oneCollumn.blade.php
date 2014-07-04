@extends('asmoyo::admin.layout')

@section('structure')
	
	<div class="container-fluid">
        <div class="row">
            <div class="col-md-1"> &nbsp; </div>

            <div class="col-md-11">

                <div class="row">
                    <div class="col-md-8">
                        <div class="content">
                            @section('content')
                            	{{$content}}                      
                            @show
                        </div>
                    </div>

                    <div class="col-md-4">
                        @section('sideLeft')
                            
                        @show
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop