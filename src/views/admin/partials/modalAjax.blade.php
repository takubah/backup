@section('javascripts')
	<!-- Modal -->
	<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="mediaModalLabel">Modal title</h4>
				</div>
				<div class="modal-body" id="modal_body">
					Not Found !
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	@parent

	<script type="text/javascript">
		/*$(function(){
			$('#mediaModal').on('loaded.bs.modal', function () {
				alert('loaded event fired!');
			});

			$('#mediaModal').on('hide.bs.modal', function (e) {
				$('.media_item').click(function() {
					console.log( $(this).attr('data-image') );
				});
			});
		});*/
	</script>
@stop