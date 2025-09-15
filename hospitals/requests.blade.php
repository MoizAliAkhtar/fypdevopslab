@extends('voyager::master')

@section('content')

    <style>
        .badge-pending {
            background-color: #ff9800;
            /* Orange */
            color: white;
        }

        .badge-approved {
            background-color: #4caf50;
            /* Green */
            color: white;
        }

        .badge-completed {
            background-color: #2196f3;
            /* Blue */
            color: white;
        }

        .badge-rejected {
            background-color: #f44336;
            /* Red */
            color: white;
        }

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

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #ffffff !important;
            color: #e57373 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:focus {
            background-color: #ffe5e9 !important;
            color: #c62828 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #ffe5e9 !important;
            color: #c62828 !important;
            border-color: #e57373 !important;
        }

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

        #requestsTable {
            background-color: #ffebee !important;
            border: 1px solid #e57373 !important;
        }

        #requestsTable thead th {
            background-color: #e57373;
            border: 1px solid white !important;
            color: #000 !important;
            font-weight: 600;
            text-align: center;
        }

        #requestsTable tbody td {
            border: 1px solid white !important;
            vertical-align: middle !important;
            text-align: center;
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
            justify-content: center;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }

        .badge-danger {
            background-color: #e57373;
            color: white;
        }

        .badge-secondary {
            background-color: #ccc;
            color: black;
        }

        /* Loader spinner */
        .spinner-border {
            width: 1rem;
            height: 1rem;
            border: 2px solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            display: inline-block;
            animation: spin 0.75s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="page-content">
        <div class="container mt-5">
            <div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-4">
                <h1 class="page-title mb-2 mb-md-0 text-dark">
                    <i class="voyager-archive"></i> Hospital Requests
                </h1>
                <div>
                    <a href="{{ route('admin.hospitals') }}" class="btn">
                        <i class="voyager-home"></i> Back to Hospitals
                    </a>
                </div>
            </div>

            <h2 class="text-center mb-4 text-dark">Hospital Requests List</h2>

            <div class="table-container">
                <div class="table-responsive">
                    <table id="requestsTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Hospital Name</th>
                                <th>City</th>
                                <th>Blood Group</th>
                                <th>Units Required</th>
                                <th>Required Date</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Reason</th>
                                <th>Urgent</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hospitalRequests as $index => $request)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $request->hospital_name }}</td>
                                    <td>{{ $request->city }}</td>
                                    <td>{{ $request->blood_group }}</td>
                                    <td>{{ $request->units_required }}</td>
                                    <td>{{ \Carbon\Carbon::parse($request->required_date)->format('d M Y') }}</td>
                                    <td>{{ $request->contact_number }}</td>
                                    <td>{{ $request->email }}</td>
                                    <td>{{ $request->reason }}</td>
                                    <td>
                                        @if($request->is_urgent)
                                            <span class="badge badge-danger">Yes</span>
                                        @else
                                            <span class="badge badge-secondary">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($request->status == 'pending')
                                            <span class="badge badge-pending">Pending</span>
                                        @elseif($request->status == 'approved')
                                            <span class="badge badge-approved">Approved</span>
                                        @elseif($request->status == 'completed')
                                            <span class="badge badge-completed">Completed</span>
                                        @elseif($request->status == 'rejected')
                                            <span class="badge badge-rejected">Rejected</span>
                                        @else
                                            <span class="badge badge-secondary">Unknown</span>
                                        @endif
                                    </td>
                                    <td class="action-btns">
                                        <!-- View Button -->
                                        <a href="{{ route('admin.hospitals.viewRequest', $request->id) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="voyager-eye"></i> View
                                        </a>

                                        <!-- Search Button -->
                                        <button class="btn btn-sm btn-primary searchBtn" data-id="{{ $request->id }}">
                                            <i class="voyager-search"></i> Search
                                        </button>

                                        <!-- Delete Form -->
                                        <form action="{{ route('hospitals.deleteRequest', $request->id) }}" method="POST"
                                            class="delete-form" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="voyager-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('#requestsTable').DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
            });

            // Search Button Click with loader
            $(document).on('click', '.searchBtn', function () {
                let btn = $(this);
                let id = btn.data('id');
                let originalHtml = btn.html();

                // Show loader
                btn.prop('disabled', true).html('<span class="spinner-border"></span> Searching...');

                $.ajax({
                    url: '/search-donors/' + id + '/hospital',
                    type: 'GET',
                    success: function (response) {
                        if (response.success && response.matches && response.matches.length > 0) {
                            let html = '';
                            response.matches.forEach(function (donor) {
                                html += `
                                        <div class="card mb-2 shadow-sm">
                                            <div class="card-body p-2">
                                                <h6 class="mb-1">${donor.name} 
                                                    <span class="badge bg-danger">${donor.blood_group}</span>
                                                </h6>
                                                <p class="mb-0">
                                                    <strong>Location:</strong> ${donor.location}<br>
                                                    <strong>Phone:</strong> ${donor.phone}
                                                </p>
                                            </div>
                                        </div>
                                    `;
                            });
                            $('#matchList').html(html);
                        } else {
                            $('#matchList').html('<p class="text-muted">No matching donors found.</p>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error fetching matches.');
                    },
                    complete: function () {
                        // Restore button
                        btn.prop('disabled', false).html(originalHtml);
                    }
                });
            });

            // SweetAlert for delete confirmation
            $('.delete-form').on('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This request will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });


    </script>

@endsection
