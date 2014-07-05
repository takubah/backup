@section('title') Daftar Halaman @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-files-o"></i>
		Halaman Website
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.page._menu')

		<table class="table table-hover">
			<thead>
				<tr>
					<th> No. </th>
					<th> Title </th>
					<th> Opsi </th>
				</tr>
			</thead>
			<tbody>
				@if($pages->getTotal())
				@foreach($pages as $page)
					<tr>
						<td> {{$itemNumber++}} </td>
						<td> {{$page['title']}} </td>
						<td>
							<a href="{{route('admin.page.edit', $page['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{Form::asmoyoLink('Hapus', 'DELETE', route('admin.page.destroy', $page['id']), array(
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

		{{$pages->links()}}

	</div>
</div>