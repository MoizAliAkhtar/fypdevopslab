@extends('voyager::master')

@section('content')
<div class="page-content container-fluid">
    <h1 class="page-title"><i class="voyager-book"></i> Donation Histories</h1>

    <div class="panel panel-bordered">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Donor Name</th>
                            <th>Donor Email</th>
                            <th>Patient Name</th>
                            <th>Blood Group</th>
                            <th>Location</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($histories as $history)
                            <tr>
                                <td>{{ $history->donor->name ?? 'N/A' }}</td>
                                <td>{{ $history->donor->email ?? 'N/A' }}</td>
                                <td>{{ $history->patient->name ?? 'N/A' }}</td>
                                <td>{{ $history->blood_group }}</td>
                                <td>{{ $history->location }}</td>
                                <td>{{ $history->created_at->format('d M, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No donation histories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
