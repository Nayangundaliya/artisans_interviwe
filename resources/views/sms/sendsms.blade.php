@extends('layouts.app')

@section('content')
<div class="container">
    <h3> Customer Sms Send</h3>
    @if (session()->has('success'))
                <div class="message success alert alert-success alert-dismissible">
                    {{ session()->get('success') }}
                </div>
                @endif
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
    <form action="{{ route('sms.send') }}" method="POST">
        @csrf
        <input type="" name="number" value="{{ $customerdata->number }}" hidden>
        <input type="" name="name" value="{{ $customerdata->name }}" hidden>
        <input type="" name="id" value="{{ $customerdata->id }}" hidden>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" disabled value="{{ $customerdata->number }}" class="form-control" >
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" class="form-control" placeholder="Enter your message" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Send SMS</button>
    </form>
    </div>
</div>

@endsection
