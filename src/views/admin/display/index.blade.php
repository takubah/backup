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
						@foreach($widgets['items'] as $w)
							<div class="asmoyo-widget-list panel panel-default pull-left">
								<div class="panel-heading">
									<h4 class="panel-title">
										{{$w['title']}}
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
										<ul class="dropdown-menu widget-chooser">
											@foreach ($widgetContainer as $target => $text)
												<li>
													<a data-target="{{$target}}" data-widget="{{$w['slug']}}" data-value="{<asmoyo:widget name={{$w['slug']}} item=0>}" data-title="">
														{{$text}}
													</a>
												</li>
											@endforeach
										</ul>
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

		{{--@if($pages['items'])
		@foreach($pages['items'] as $page)
			<div class="asmoyo-box">
				<h3 class="box-header">
					{{$page['title']}}
				</h3>
				<div class="box-content" id="page_{{$page['id']}}">
					<!-- ajax content -->
				</div>
			</div>
		@endforeach
		@endif--}}
	</div>
</div>

@section('javascripts')
	@parent
	{{HTML::script('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js')}}
	<script type="text/javascript">
		$(function() {
			// load side left
			$( '#sideLeft' ).html('loading...');
			$.get("{{route('admin.display.ajaxSidebar', 'left')}}", function(data,status)
			{
				$( '#sideLeft' ).html(data);
			});

			// load side right
			$( '#sideRight' ).html('loading...');
			$.get("{{route('admin.display.ajaxSidebar', 'right')}}", function(data,status)
			{
				$( '#sideRight' ).html(data);
			});

			$('.widget-chooser > li > a').click(function(){
				// initialize variable
				var el 		= $(this),
					target 	= '#'+ el.attr('data-target'),
					title 	= el.attr('data-title'),
					widget 	= el.attr('data-widget'),
					content	= el.attr('data-value');

				if(target == '#sideRight')
				{
					var urlPost = "{{route('admin.display.ajaxSidebarAdd', 'right')}}",
						url 	= "{{route('admin.display.ajaxSidebar', 'right')}}";
				} else if(target == '#sideLeft') {
					var urlPost = "{{route('admin.display.ajaxSidebarAdd', 'left')}}",
						url 	= "{{route('admin.display.ajaxSidebar', 'left')}}";
				} else {
					var urlPost = "{{route('admin.display.ajaxSidebarAdd', 'page')}}",
						url 	= "{{route('admin.display.ajaxSidebar', 'page')}}";
				}

				// add proses
				$( target ).html('loading...');
				$.ajax({
					type: "POST",
					url: urlPost,
					data: { title: title, widget: widget, content: content }
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