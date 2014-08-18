@section('title') Daftar Widget @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Daftar Widget
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.widget._menu')

		<ul class="nav nav-pills">
			<li class="disabled">
				<a>Total Data : <b>{{$widgets->getTotal()}}</b></a>
			</li>
			<li class="disabled">
				<a>Sortir by : <b>{{$widgets['sortir']}}</b></a>
			</li>
			<li class="disabled">
				<a>Status by : <b>{{$widgets['status']}}</b></a>
			</li>
		</ul>

		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:40px;"> No. </th>
					<th> Title </th>
					<th> Opsi </th>
				</tr>
			</thead>
			<tbody>
				@if($widgets['items'])
				@foreach($widgets['items'] as $widget)
					<tr>
						<td> {{$itemNumber++}} </td>
						<td>
							<h4>{{$widget['title']}}</h4>
							<p>{{$widget['description']}}</p>
						</td>
						<td>
							<a href="{{route('admin.widget.group', $widget['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-gear"></i>
								Kelola
							</a>
							@if($widget['status'] == 'enabled')
								{{Form::asmoyoLink('Disable', 'PUT', route('admin.widget.disable', $widget['id']),
									array(
										'icon'	=> 'fa fa-power-off',
										'class'	=> 'btn btn-danger btn-sm'
									),
									'Apakah anda yakin ?'
								)}}
							@elseif($widget['status'] == 'disabled')
								{{Form::asmoyoLink('Enable', 'PUT', route('admin.widget.enable', $widget['id']),
									array(
										'icon'	=> 'fa fa-check',
										'class'	=> 'btn btn-success btn-sm'
									),
									'Apakah anda yakin ?'
								)}}
							@endif
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

		{{$widgets->appends(array('sortir' => $widgets['sortir'], 'status' => $widgets['status']))->links()}}

	</div>
</div>