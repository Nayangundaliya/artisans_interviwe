@extends('layouts.app')

@section('content')
<div class="container">
    <h3> Customer Mail Send</h3>
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
        <form action="{{ route('selectedmailsend') }}" class="form"  method="POST">
            @csrf
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="emails" class="form-label">Email</label>
                        <select class="form-control select2" name="emails[]" multiple="multiple" id="emailSelect">
                            {{-- <option value="all">Select All</option> --}}
                            @foreach ($customerdatas as $data)
                                <option value="{{ $data->email }}">{{ $data->email }}</option>
                            @endforeach
                        </select>
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

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        // Initialize Select2
        $('#emailSelect').select2({
            placeholder: "Select email(s)",
            allowClear: true
        });

        // Handle "Select All" functionality
        $('#emailSelect').on('change', function () {
            const selectedValues = $(this).val();

            if (selectedValues && selectedValues.includes('all')) {
                // Select all valid options (exclude "all")
                const allValues = $('#emailSelect option').not('[value="all"]').map(function () {
                    return $(this).val();
                }).get();

                $('#emailSelect').val(allValues).trigger('change');
            }
        });

        // Remove "all" before form submission
        $('form').on('submit', function () {
            const selectedValues = $('#emailSelect').val();

            if (selectedValues && selectedValues.includes('all')) {
                // Remove "all" from the selection
                $('#emailSelect').val(
                    selectedValues.filter(value => value !== 'all')
                );
            }
        });
    });
</script>
@endsection

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection