@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
		<div class="card card-default">

      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

			<div class="card-header card-header-border-bottom">
				<h2>Create Contact</h2>
			</div>
			<div class="card-body">
				<form method="post" action="{{ route('store.contact') }}">
          @csrf
					<div class="form-group">
						<label for="exampleFormControlInput1">Contact Email</label>
						<input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Email">

					</div>

          <div class="form-group">
						<label for="exampleFormControlInput1">Contact Phone</label>
						<input type="text" name="phone" class="form-control" id="exampleFormControlInput1" placeholder="Phone">

					</div>


					<div class="form-group">
						<label for="exampleFormControlTextarea1">Contact Address</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address" placeholder="Address"></textarea>
					</div>

					<div class="form-footer pt-4 pt-5 mt-4 border-top">
						<button type="submit" class="btn btn-primary btn-default">Submit</button>
						<button type="submit" class="btn btn-secondary btn-default">Cancel</button>
					</div>
				</form>
			</div>
		</div>





@endsection
