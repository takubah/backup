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
					<div class="image" style="background-image:url('{{getMedia($r['cover']['file'])}}'); height:{{$attr['size']}};"> </div>
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
	
	<ul class="media-list asmoyo-media-object">
		@if( $repo['items'] )
		@foreach($repo['items'] as $r)
			<li class="media">
				<a href="{{route('category.show', $r['slug'])}}" class="pull-left thumbnail">
					<img class="media-object" src="{{getMedia($r['cover']['file'])}}" alt="{{$r['cover']['alt']}}" style="width:{{$attr['size']}};">
				</a>
				<div class="media-body">
					<h4 class="media-heading"> <a href="{{route('category.show', $r['slug'])}}">{{$r['title']}}</a> </h4>
					@if($attr['description']) <p>{{$r['description']}}</p> @endif
				</div>
			</li>
		@endforeach
		@else
			Tidak ada kategori
		@endif
	</ul>

@elseif($attr['type'] == 'detail')
	
	@if($repo)
		<div class="media">
			<a href="{{route('category.show', $repo['slug'])}}" class="pull-left thumbnail">
				<img class="media-object" src="{{getMedia($repo['cover']['file'])}}" alt="{{$repo['cover']['alt']}}" style="width:{{$attr['size']}};">
			</a>
			<div class="media-body">
				<h4 class="media-heading"> <a href="{{route('category.show', $repo['slug'])}}">{{$repo['title']}}</a> </h4>
				<p>{{$repo['description']}}</p>
			</div>
		</div>
	@endif

@endif