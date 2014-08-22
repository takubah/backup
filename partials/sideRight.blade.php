<div class="rightContainer sideContainer">
	@if( getSidebar('right') )
		@foreach( getSidebar('right') as $right )

			<div class="right side">
				@if( $right['title'] )
					<h3 class="right-title side-title">
						{{$right['title']}}
					</h3>
				@endif
				<div class="right-content side-content">
					{{$right['content']}}
				</div>
			</div>

		@endforeach
	@endif
</div>