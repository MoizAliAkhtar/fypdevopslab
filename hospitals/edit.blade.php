@extends('voyager::master')

@section('content')
<style>
    body, .page-content {
        background-color: #ffebee !important;
    }

    .panel-bordered {
        border: 1px solid #e57373 !important;
    }

    .panel-heading {
        background-color: #e57373 !important;
        color: #000 !important;
        padding: 15px;
        border-bottom: 1px solid #e57373 !important;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .panel-title i {
        color: #fff !important;
    }

    .panel-title {
        color: white !important;
        font-weight: 600;
        font-size: 18px;
    }

    .form-group label {
        font-weight: 600;
        color: #444;
    }

    .form-control {
        border: 1px solid #e57373 !important;
        box-shadow: none !important;
        border-radius: 6px;
    }

    .btn-primary {
        background-color: transparent !important;
        border: 1px solid #e57373 !important;
        color: #e57373 !important;
        padding: 10px 20px;
        font-size: 16px;
    }

    .btn-primary i {
        color: #e57373 !important;
    }

    .btn-primary:hover {
        background-color: #e57373 !important;
        color: white !important;
    }

    .btn-primary:hover i {
        color: white !important;
    }

    .btn-secondary {
        background-color: transparent !important;
        border: 1px solid #555 !important;
        color: #555 !important;
        padding: 10px 20px;
        font-size: 16px;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background-color: #555 !important;
        color: white !important;
    }
</style>

<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="voyager-edit"></i> Edit Hospital</h3>
                    <a href="{{ route('admin.hospitals') }}" class="btn btn-secondary">
                        <i class="voyager-home"></i> Back
                    </a>
                </div>
                <div class="panel-body">

                    <form action="{{ route('hospitals.update', $hospital->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" id="username" value="{{ $hospital->username }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $hospital->email }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ $hospital->phone_number }}" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea class="form-control" name="address" id="address" rows="3" required>{{ $hospital->address }}</textarea>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="voyager-check"></i> Update Hospital
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@stop
