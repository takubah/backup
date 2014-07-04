@section('content')
	
	<div class="row">
    <div class="col-md-9">
		<div class="asmoyo-box login-box">
			<h3 class="box-header">
				<i class="fa fa-sign-in"></i>
				Login
			</h3>
			<div class="box-content">
				{{ Form::open(array('url' => 'foo/bar', 'class' => 'form-horizontal')) }}
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">
							Email
						</label>
						<div class="col-sm-10">
							{{Form::text('email', null, array('class' => 'form-control', 'id' => 'email', 'placeholder' => 'email'))}}
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-2 control-label">
							Password
						</label>
						<div class="col-sm-10">
							{{Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'password'))}}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember"> Remember me
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default">Login &raquo;</button>
						</div>
					</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
	</div>

@stop