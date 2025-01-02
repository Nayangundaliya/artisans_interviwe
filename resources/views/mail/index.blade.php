@extends('layouts.app')

@section('content')
<div class="content-wrapper mt-3">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <h3>Customer Mail List</h3>
                @if (session()->has('success'))
                <div class="message success alert alert-success alert-dismissible">
                    {{ session()->get('success') }}
                </div>
                @endif
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if (session()->has('massage'))
                        <div class="alert alert-success alert-dismissible " role="alert">
                            <h5>{{ session()->get('massage') }}</h5>
                        </div>
                        @endif

                        <div class="card-body table-responsive">
                            {{-- <a class="btn btn-sm btn-secondary" id="time_slot_csv" style="float:right;">Export
                                CSV</a> --}}
                            <table class="table table-bordered table-striped " id="subscribeTbl">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($maildatas as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->customer_email }}</td>
                                        <td>{{ $value->subject }}</td>
                                        <td>{{ $value->message }}</td>
                                        <td>{{ $value->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $value->created_at->format('H:i:s') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection