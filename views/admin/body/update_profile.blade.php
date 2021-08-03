@extends('admin.admin_master')

@section('admin')

<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Profile Update</h2>
			</div>

      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      
			<div class="card-body">
				<form class="form-pill" method="post" action="{{ route('userprofile.update') }}">
          @csrf
					<div class="form-group">
						<label for="exampleFormControlInput3">User Name</label>
						<input type="text" name="name" class="form-control" value="{{ $user['name'] }}">

					</div>

          <div class="form-group">
						<label for="exampleFormControlInput3">User Email</label>
						<input type="text" name="email" class="form-control" value="{{ $user['email'] }}">

					</div>


          <button type="submit" class="btn btn-primary btn-default" name="button">Update Profile</button>
				</form>
			</div>
		</div>

@endsection