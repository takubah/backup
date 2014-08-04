@section('title') Tampilan @stop

<div class="row">
	<div class="col-md-8">
		<div class="asmoyo-box" style="background:none;">
			<h3 class="box-header">
				<i class="fa fa-laptop"></i>
				Atur Tampilan
			</h3>
			<div class="box-content">
				<h4>Daftar Widget &raquo;</h4>
				<div class="row">
					<div class="col-md-12">
						@foreach($widgets as $w)
							<div class="asmoyo-widget-list panel panel-default pull-left">
								<div class="panel-heading">
									<h4 class="panel-title">
										{{$w['title'] ?: $w['widgetName']}}
									</h4>
								</div>
								<div class="panel-body">
									{{$w['description']}}
								</div>
								<div class="panel-footer">
									<div class="dropdown pull-right">
										<a data-toggle="dropdown" class="btn btn-sm btn-primary">
											<i class="fa fa-plus"></i> Add
										</a>
										{{HTML::select(
											'<asmoyo:'.$w["pseudo"]["object"].' type='.$w["pseudo"]["type"].' sortir='.$w["pseudo"]["sortir"].'>',
											$widgetContainer,
											array('class' => 'dropdown-menu widget-chooser'),
											array('data-title' => $w['title'])
										)}}
									</div>
									<div style="clear:both;"></div>
								</div>
							</div>
						@endforeach
					</div>
				</div> <!-- End Row -->

			</div>
		</div>
	</div>
	

	<div class="col-md-4">
		<div class="asmoyo-box">
			<h3 class="box-header">
				Sidebar Kiri
			</h3>
			<div class="box-content" id="sideLeft">
				<!-- ajax content -->
			</div>
		</div>

		<div class="asmoyo-box">
			<h3 class="box-header">
				Sidebar Kanan
			</h3>
			<div class="box-content" id="sideRight">
				<!-- ajax content -->
			</div>
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
				// initialize variable
				var el 		= $(this),
					target 	= '#'+ el.attr('data-target'),
					title 	= el.attr('data-title'),
					content	= '{'+ el.attr('data-value') +'}',
					urlPost = (target == '#sideRight')
						? "{{route('admin.display.ajaxSidebarAdd', 'right')}}"
						: "{{route('admin.display.ajaxSidebarAdd', 'left')}}",
					url 	= (target == '#sideRight')
						? "{{route('admin.display.ajaxSidebar', 'right')}}"
						: "{{route('admin.display.ajaxSidebar', 'left')}}";

				// add proses
				$( target ).html('loading...');
				$.ajax({
					type: "POST",
					url: urlPost,
					data: { title: title, content: content }
				})
				.success(function( msg )
				{					
					if (msg) {
						$.get(url, function(data,status)
						{
							$( target ).html(data);
						});
					} else {
						alert('error');
					}
				});

				/*$.get(url, function(data,status)
				{
					$( target ).html(data);
				});*/
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