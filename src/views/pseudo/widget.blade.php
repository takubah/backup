@if($attr['type'] == 'list')

	<ul class="nav asmoyo-list">
		@if( $widget['group']['content'] )
		@foreach($widget['group']['content'] as $r)
			<li>
				<a @if($r['link']) href="{{$r['link']}}" @endif >
					{{$r['title']}}
				</a>
			</li>
		@endforeach
		@else
			Tidak ada
		@endif
	</ul>

@elseif($attr['type'] == 'grid')

	<div class="asmoyo-grid row">
		@if( $widget['group']['items'] )
		@foreach($widget['group']['items'] as $r)
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
		@if( $widget['group']['items'] )
		@foreach($widget['group']['items'] as $r)
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
	
	@if($widget['group'])
		<div class="media">
			<a href="{{route('category.show', $widget['group']['slug'])}}" class="pull-left thumbnail">
				<img class="media-object" src="{{getMedia($widget['group']['cover']['file'])}}" alt="{{$widget['group']['cover']['alt']}}" style="width:{{$attr['size']}};">
			</a>
			<div class="media-body">
				<h4 class="media-heading"> <a href="{{route('category.show', $widget['group']['slug'])}}">{{$widget['group']['title']}}</a> </h4>
				<p>{{$widget['group']['description']}}</p>
			</div>
		</div>
	@endif

@endif