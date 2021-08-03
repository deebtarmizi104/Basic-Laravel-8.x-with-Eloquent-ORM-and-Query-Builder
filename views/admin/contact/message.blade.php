@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
          <div class="row">
            <h4>Admin Message</h4>
            <br>
            <br>

          <div class="col-md-12">
            <div class="card">


              <div class="card-header">All Message Data</div>
          <table class="table">
  <thead>
    <tr>
      <th scope="col">SL</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Subject</th>
      <th scope="col">Message</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

      @php ($i = 1)
      @foreach($messages as $message)
        <tr>
          <th scope="row">{{ $i++ }}</th>
          <td>{{ $message->name }}</td>
          <td>{{ $message->email }}</td>
          <td>{{ $message->subject }}</td>
          <td>{{ $message->message }}</td>


          <td>

              <a href="{{ url('message/delete/'.$message->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>

          </td>
        </tr>
      @endforeach
  </tbody>
</table>


    </div>
    </div>


    </div>


  </div>
@endsection
