@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Create Customer</h3>
    <div class="row">
        @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <form action="{{ route('customerstore') }}" class="form"  method="POST">
            @csrf
                <div class="col-md-6">
                    <input type="text" name="view" hidden value="view">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Number</label>
                        <input type="text" name="number" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Address</label>
                        <input type="textl" class="form-control" name="address" id="exampleInputEmail1" placeholder="Enter Address">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
    </div>
</div>

@endsection