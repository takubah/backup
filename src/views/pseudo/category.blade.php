@if($attr['type'] == 'list')

	<ul class="nav asmoyo-list">
		@if( $repo )
		@foreach($repo as $r)
			<li>
				<a href="{{route('category.show', $r['slug'])}}">
					{{$r['title']}}
				</a>
				@if( $r['child'] )
					<ul class="asmoyo-list">
						@foreach($r['child'] as $child)
							<li>
								<a href="{{route('category.show', $child['slug'])}}">
									{{$child['title']}}
								</a>
							</li>
						@endforeach
					</ul>
				@endif
			</li>
		@endforeach
		@else
			Tidak ada kategori
		@endif

	</ul>

@elseif($attr['type'] == 'grid')

	<div class="asmoyo-grid row">
		@if( $repo['items'] )
		@foreach($repo['items'] as $r)
			<div class="item col-md-3">
				<a href="{{route('category.show', $r['slug'])}}" class="thumbnail">
					<div class="image" style="background-image:url('{{getMedia($r['cover']['file'])}}'); height:{{$attr['imageSize']}};"> </div>
				</a>
				<p class="caption">
					{{$r['title']}}
				</p>
			</div>
		@endforeach
		@else
			Tidak ada kategori
		@endif
	</div>

@elseif($attr['type'] == 'media-object')

	<!-- Here is content -->

@elseif($attr['type'] == 'detail')

	<!-- Here is content -->

@elseif($attr['type'] == 'inline')

	<!-- Here is content -->

@endif