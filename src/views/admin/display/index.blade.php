@section('title') Tampilan @stop

<div class="row">
	<div class="col-md-8">
		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-th-large"></i>
				Daftar Widget
			</h3>
			<div class="box-content">

				<div class="row">
					<div class="col-md-6">
						<ul class="list-group">
							@foreach($widgets as $w)
								<h4>{{$w['title']}}</h4>

								@if($w['groups'])
								@foreach($w['groups'] as $g)
								<li class="list-group-item">
									<div class="dropdown" style="background:none; cursor:pointer; float:right;">
										<a data-toggle="dropdown" class="btn btn-xs btn-primary">
											<i class="fa fa-plus"></i> add
										</a>
										{{HTML::select(
											'<asmoyo:category type=grid sortir=title-descending size=80px>',
											$widgetContainer,
											array('class' => 'dropdown-menu widget-chooser', 'style' => 'text-align:left;'),
											array('data-title' => $g['title'])
										)}}
									</div>

									<h4 class="list-group-item-heading">
										{{$g['title']}}
									</h4>
									<p class="list-group-item-text">
										{{$g['description']}}
									</p>
								</li>
								@endforeach
								@endif

							@endforeach
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="list-group">
							<li class="list-group-item">
								<div class="dropdown" style="background:none; cursor:pointer; float:right;">
									<a data-toggle="dropdown" class="btn btn-xs btn-primary">
										<i class="fa fa-plus"></i> add
									</a>
									{{HTML::select(
										'<asmoyo:category type=grid sortir=title-descending size=80px>',
										$widgetContainer,
										array('class' => 'dropdown-menu widget-chooser', 'style' => 'text-align:left;'),
										array('data-title' => $g['title'])
									)}}
								</div>
								<h4 class="list-group-item-heading">
									Kategori
								</h4>
								<p class="list-group-item-text">
									ini adalah kategori widget
								</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<div class="col-md-4">
		<div class="asmoyo-box toggle">
			<h3 class="box-header">
				<i class="fa fa-laptop"></i>
				Sidebar Kiri
			</h3>
			<div class="box-content" id="sideLeft">
				<!-- ajax content -->
			</div>
			<!-- <div class="box-footer">
				<div class="text-center">
					<button type="submit" class="btn btn-primary btn-sm">
						<i class="fa fa-check"></i>
						Simpan
					</button>
				</div>
			</div> -->
		</div>

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-laptop"></i>
				Sidebar Kanan
			</h3>
			<div class="box-content" id="sideRight">
				<!-- ajax content -->
			</div>
			<!-- <div class="box-footer">
				<div class="text-center">
					<button type="submit" class="btn btn-primary btn-sm">
						<i class="fa fa-check"></i>
						Simpan
					</button>
				</div>
			</div> -->
		</div>
	</div>
</div>

@section('javascripts')
	@parent
	{{HTML::script('//code.jquery.com/ui/1.11.0/jquery-ui.js')}}
	<script type="text/javascript">
		$(function() {
			$( '#sideRight' ).html('loading...');
			$.get("{{route('admin.display.ajaxSidebar', 'right')}}", function(data,status)
			{
				$( '#sideRight' ).html(data);
			});

			$( '#sideLeft' ).html('loading...');
			$.get("{{route('admin.display.ajaxSidebar', 'left')}}", function(data,status)
			{
				$( '#sideLeft' ).html(data);
			});

			$('.widget-chooser > li > a').click(function(){
				var el 		= $(this),
					target 	= '#'+ el.attr('data-target'),
					value 	= '{'+ el.attr('data-value') +'}',
					url 	= (target == '#sideRight')
						? "{{route('admin.display.ajaxSidebar', 'right')}}"
						: "{{route('admin.display.ajaxSidebar', 'left')}}";

				console.log(url, target, value, el.attr('data-title') );

				$( target ).html('loading...');
				$.get(url, function(data,status)
				{
					$( target ).html(data);
				});
			});

			/*$( ".widget-draggable li" ).draggable({
				connectToSortable: ".widget-sortable",
				helper: "clone",
				revert: "invalid",
				cursor: "move",
				start: function( event, ui ) {
					$('.widget-sortable').append('<li class="placeholder"> Place Here </li>');
				},
				stop: function( event, ui ) {
					$('.widget-sortable .placeholder').remove();
				}
			});*/
		});
	</script>
@stop