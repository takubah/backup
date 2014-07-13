@section('stylesheets')
	@parent
	{{asmoyoAsset( 'plugin/sortable/jquery-sortable.css', 'admin')}}
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-arrows-alt"></i>
		Susun Urutan
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.page._menu')
	
		{{Form::open(array('method' => 'PUT', 'route' => 'admin.page.editOrderSave'))}}
			<nav class="navbar navbar-inverse" role="navigation">
				<div class="container-fluid">
					
					<ul id="page-sortir" class="nav navbar-nav">
						@if($pages)
						@foreach($pages as $page)

							@if( ! $page['parent_id'])
								<li data-id="{{$page['id']}}" data-title="{{$page['title']}}">
									<a style="cursor:pointer;">
										{{$page['title']}}
									</a>
								</li>
							@else
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										Dropdown <span class="caret"></span>
									</a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another action</a></li>
										<li><a href="#">Something else here</a></li>
										<li class="divider"></li>
										<li><a href="#">Separated link</a></li>
										<li class="divider"></li>
										<li><a href="#">One more separated link</a></li>
									</ul>
								</li>
							@endif
						@endforeach
						@endif
					</ul>
				</div>
			</nav>

			{{Form::textarea('result_sortir', null, array('id'=>'serialize_output', 'style'=>'visibility:hidden; position:absolute;'))}}

			<br><br><br>
			<div class="text-center">
				<button type="submit" class="btn btn-lg btn-primary">
					<i class="fa fa-check"></i>
					Simpan Perubahan
				</button>
			</div>

		{{Form::close()}}
	</div>
</div>

@section('javascripts')
	@parent
	{{asmoyoAsset( 'plugin/sortable/jquery-sortable.js', 'admin')}}
	<script type="text/javascript">
		var group = $("#page-sortir").sortable({
			group: 'nav',
			nested: false,
			vertical: false,
			exclude: '.divider-vertical',
			onDragStart: function($item, container, _super) {
				$item.find('#page-sortir .dropdown-menu').sortable('disable')
				_super($item, container)
			},
			onDrop: function($item, container, _super) {
				$item.find('#page-sortir .dropdown-menu').sortable('enable');
				_super($item, container);

				var data = group.sortable("serialize").get();

			    var jsonString = JSON.stringify(data, null, ' ');

			    $('#serialize_output').text(jsonString);
			    // _super(item, container)
			}
		});
		$("#page-sortir .dropdown-menu").sortable({
			group: 'nav'
		});
	</script>
@stop