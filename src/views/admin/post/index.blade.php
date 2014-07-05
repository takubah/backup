@section('title') Daftar Posting @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-file-text-o"></i>
		Daftar Posting
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.post._menu')

		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:40px;"> No. </th>
					<th> Title </th>
					<th> Kategori </th>
					<th> Opsi </th>
				</tr>
			</thead>
			<tbody>
				@if($posts->getTotal())
				@foreach($posts as $post)
					<tr>
						<td> {{$itemNumber++}} </td>
						<td> {{$post['title']}} </td>
						<td> {{$post['groupable']['title']}} </td>
						<td>
							<a href="{{route('admin.post.edit', $post['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{Form::asmoyoLink('Hapus', 'DELETE', route('admin.post.destroy', $post['id']), array(
								'icon'	=> 'fa fa-trash-o',
								'class'	=> 'btn btn-danger btn-sm'
							))}}
						</td>
					</tr>
				@endforeach
				@else
					<tr>
						<td colspan="3">
							<h4>Tidak ada data</h4>
						</td>
					</tr>
				@endif
			</tbody>
		</table>

		{{$posts->links()}}

	</div>
</div>