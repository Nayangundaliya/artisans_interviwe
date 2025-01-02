@extends('layouts.app')

@section('content')
<div class="content-wrapper mt-3">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <h3>Customer List</h3>
                @if (session()->has('success'))
                <div class="message success alert alert-success alert-dismissible">
                    {{ session()->get('success') }}
                </div>
                @endif
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-tools d-flex justify-content-end">
                                <a href="{{ route('customercreate') }}" class="btn btn-sm bg-success"><b>Add Customer</b></a>
                            </div>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customerdatas as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->number }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td>
                                                <a href="{{ route('singlemailtemp', $value->id) }}"
                                                    class="fas fa-trash text-primary ml-3" data-toggle="tooltip"
                                                    data-placement="top" title="Send Mail">Mail</a>&nbsp;&nbsp;&nbsp;
                                                    <a href="{{ route('smscreate', $value->id) }}"
                                                        class="fas fa-trash text-primary ml-3" data-toggle="tooltip"
                                                        data-placement="top" title="Send SMS">SMS</a>&nbsp;&nbsp;&nbsp;
                                                        <a href="{{ route('customerdelete', $value->id) }}"
                                                            class="fas fa-trash text-danger ml-3" data-toggle="tooltip"
                                                            data-placement="top" title="Delete Record">Delete</a>&nbsp;&nbsp;&nbsp;</td>
                                                    
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