@extends('voyager::master')

@section('content')
    <style>
        .voyager .pagination .active>a {
            background-color: #ffffff !important;
            color: #e57373 !important;
            border: 1px solid #e57373 !important;
            box-shadow: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: transparent !important;
            color: #e57373 !important;
            border-radius: 5px !important;
            padding: 6px 12px !important;
            margin: 0 4px !important;
        }

        /* Force override active (current) button */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #ffffff !important;
            color: #e57373 !important;
        }

        /* Force override active (current) button on hover/focus */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:focus {
            background-color: #ffe5e9 !important;
            color: #c62828 !important;
        }

        /* Hover effect for regular buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #ffe5e9 !important;
            color: #c62828 !important;
            border-color: #e57373 !important;
        }

        /* Remove blue box-shadow or outline from focused buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        body,
        .page-content {
            background-color: #ffebee !important;
        }

        .btn {
            color: #e57373 !important;
            background-color: transparent !important;
            padding: 10px 20px !important;
            font-size: 16px !important;
        }

        .page-header .btn {
            margin: 5px 20px 5px 20px;
            color: #e57373 !important;
            font-size: 16px !important;
        }

        .btn i,
        .voyager-people,
        .voyager-plus,
        .voyager-trash,
        .voyager-archive,
        .voyager-chat,
        .voyager-eye,
        .voyager-edit {
            color: #e57373 !important;
        }

        .btn:hover {
            background-color: #e57373 !important;
            color: white !important;
        }

        .btn:hover i {
            color: white !important;
        }

        #hospitalFeedbackTable {
            background-color: #ffebee !important;
            border: 1px solid #e57373 !important;
        }

        #hospitalFeedbackTable thead th {
            background-color: #e57373;
            border: 1px solid white !important;
            color: #000 !important;
            font-weight: 600;
        }

        #hospitalFeedbackTable tbody td {
            border: 1px solid white !important;
        }

        .panel-bordered {
            border: 1px solid #e57373;
        }

        .table-hover tbody tr:hover {
            background-color: #ffe5e9 !important;
        }

        .action-btns {
            display: flex;
            gap: 5px;
            align-items: center;
        }
    </style>

    @if(session('success'))
        <div class="alert alert-success" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
            {{ session('error') }}
        </div>
    @endif

    <div class="page-content">
        <div class="container mt-5">
            <div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-4">
                <h1 class="page-title mb-2 mb-md-0 text-dark">
                    <i class="voyager-chat"></i> Hospital Feedback
                </h1>
                <div class="d-flex flex-wrap">
                    <a href="{{ route('voyager.dashboard') }}" class="btn">
                        <i class="voyager-home"></i> Home
                    </a>
                </div>
            </div>

            <div class="panel panel-bordered">
                <div class="panel-body">
                    @if($feedbacks->count())
                        <div class="table-responsive">
                            <table id="hospitalFeedbackTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Satisfaction Level</th>
                                        <th>Requests Fulfilled</th>
                                        <th>Recommend</th>
                                        <th>Opinion</th>
                                        <th>Submitted At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($feedbacks as $index => $feedback)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $feedback->satisfaction_level }}</td>
                                            <td>{{ $feedback->requests_fulfilled }}</td>
                                            <td>{{ $feedback->recommend ? 'Yes' : 'No' }}</td>
                                            <td>{{ $feedback->opinion }}</td>
                                            <td>{{ $feedback->created_at->format('d M Y h:i A') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No feedback submitted yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#hospitalFeedbackTable').DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                order: [[5, 'desc']] // Default sort by Submitted At column descending
            });
        });

        setTimeout(() => document.querySelector('.alert')?.remove(), 3000);
    </script>
@endsection