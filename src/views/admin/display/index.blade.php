@section('title') Tampilan @stop

<div class="row">
	<div class="col-md-8">
		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-th-large"></i>
				Daftar Widget
			</h3>
			<div class="box-content">
				<ul class="widget-draggable nav">
					@foreach($widgets as $w)
						<h4>{{$w['title']}}</h4>

						@if($w['groups'])
						@foreach($w['groups'] as $g)
						<li>
							<a>
								{{$g['title']}}
							</a>
						</li>
						@endforeach
						@endif

					@endforeach
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="asmoyo-box toggle">
			<h3 class="box-header">
				<i class="fa fa-laptop"></i>
				Sidebar Kiri
			</h3>
			<div class="box-content">
				<ul class="widget-sortable nav">
					<li> &nbsp; </li>
				</ul>
				<hr>
				<div class="text-right">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-check"></i>
						Simpan
					</button>
				</div>
			</div>
		</div>

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-laptop"></i>
				Sidebar Kanan
			</h3>
			<div class="box-content">
				<ul class="widget-sortable nav">
					
				</ul>
				<hr>
				<div class="text-right">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-check"></i>
						Simpan
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

@section('javascripts')
	@parent
	{{HTML::script('//code.jquery.com/ui/1.11.0/jquery-ui.js')}}
	<script type="text/javascript">
		$(function() {
			$( ".widget-sortable" ).sortable({
				revert: true,
				receive: function(event, ui) {
					// $(this).html('test');
				}
			});
			$( ".widget-draggable li" ).draggable({
				connectToSortable: ".widget-sortable",
				helper: "clone",
				revert: "invalid",
				cursor: "move"
			});

			/*$(".widget-sortable").sortable({
				stop: function(event, ui) {
					var sortable = $(".widget-sortable").sortable('toArray');
					console.log(sortable);
				}
			});*/

		});
	</script>
@stop