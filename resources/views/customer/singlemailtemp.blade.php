@extends('layouts.app')

@section('content')
<div class="container">
    <h3> Customer Mail Send</h3>
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
        <form action="{{ route('singlemailsend') }}" class="form"  method="POST">
            @csrf
                <div class="col-md-6">
                    <input type="text" name="customer_id" hidden value="{{ $customerdata->id }}">
                    <input type="text" name="customer_email" hidden value="{{ $customerdata->email }}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input type="text" name="" class="form-control" placeholder="Enter Name" value="{{ $customerdata->email }}" disabled>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Enter Subject">
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Message</label>
                        <input type="text" class="form-control" name="message" id="exampleInputEmail1" placeholder="Enter Message">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
              </form>
    </div>
</div>

@endsection