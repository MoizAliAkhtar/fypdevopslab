@extends('voyager::master')

@section('content')
<div class="page-content" style="background-color:#ffebee; min-height:100vh;">
    <div class="container mt-5">
        <div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h1 class="page-title mb-2 mb-md-0 text-dark">
                <i class="voyager-eye"></i> View Hospital Request
            </h1>
            <div>
                <a href="{{ route('admin.hospitals.requests') }}" class="btn btn-danger">
                    <i class="voyager-list"></i> Back to Requests
                </a>
            </div>
        </div>

        {{-- Request Details --}}
        <div class="card shadow-sm p-4 mb-4">
            <h3 class="text-dark mb-3">Hospital Request Details</h3>
            <table class="table table-bordered">
                <tr>
                    <th>Hospital Name</th>
                    <td>{{ $hospitalRequest->hospital_name }}</td>
                </tr>
                <tr>
                    <th>City</th>
                    <td>{{ $hospitalRequest->city }}</td>
                </tr>
                <tr>
                    <th>Blood Group</th>
                    <td>{{ $hospitalRequest->blood_group }}</td>
                </tr>
                <tr>
                    <th>Units Required</th>
                    <td>{{ $hospitalRequest->units_required }}</td>
                </tr>
                <tr>
                    <th>Required Date</th>
                    <td>{{ \Carbon\Carbon::parse($hospitalRequest->required_date)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td>{{ $hospitalRequest->contact_number }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $hospitalRequest->email }}</td>
                </tr>
            </table>
        </div>

        {{-- Donor Matches --}}
        <div class="card shadow-sm p-4">
            <h3 class="text-dark mb-3">Matched Donors</h3>

            @if($matches->isEmpty())
                <p class="text-muted">No donor matches found for this request.</p>
            @else
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Blood Group</th>
                            <th>Location</th>
                            <th>Phone</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matches as $match)
                            <tr>
                                <td>{{ $match->donor_name }}</td>
                                <td>{{ $match->donor_blood_group }}</td>
                                <td>{{ $match->donor_location }}</td>
                                <td>{{ $match->donor_phone }}</td>
                                <td>{{ $match->donor_email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
