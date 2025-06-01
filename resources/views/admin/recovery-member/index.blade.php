@extends('admin.includes.master')

@section('admin.content')
<!-- Add Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .toast-success {
        background-color: #28a745 !important;
    }

    .toast-error {
        background-color: #dc3545 !important;
    }

    .toast-info {
        background-color: #17a2b8 !important;
    }

    .card {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
 

    .card-header {
        background: linear-gradient(135deg, #4a6fff 0%, #77e3fa 100%);
        border-bottom: none;
        padding: 20px 25px;
        color: white;
    }

    .card-header span {
        font-weight: 600;
        font-size: 20px;
    }
    
    .content-header {
        background-color: #f8f9fa;
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .breadcrumb {
        background: transparent;
        padding: 0;
    }
    
    .breadcrumb-item a {
        color: black !important;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    
    .breadcrumb-item a:hover {
        color: #2a4cd5 !important;
        text-decoration: none;
    }
    
    .text-secondary {
        color: #444 !important;
        font-size: 22px;
        font-weight: 600;
    }

    .table-responsive {
        border-radius: 10px;
        overflow-x: auto;
        width: 100%;
        -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
        margin-bottom: 15px;
    }
    
    /* Make sure the table takes up full width and forces horizontal scroll */
    #membersTable {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        min-width: 1200px; /* Increased minimum width */
    }
    
    /* DataTables specific scrolling fixes */
    .dataTables_wrapper .dataTables_scroll {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .dataTables_wrapper .dataTables_scrollBody {
        width: 100%;
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch;
    }

    /* Force table cells to have adequate spacing */
    #membersTable th, 
    #membersTable td {
        min-width: 100px;
        white-space: nowrap;
    }

    /* Clear any potential floating elements that may interfere with scrolling */
    .card-body {
        overflow: hidden;
    }
    
    .badge {
        padding: 8px 12px;
        font-weight: 500;
        border-radius: 30px;
        letter-spacing: 0.5px;
        font-size: 11px;
        border: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(0,0,0,0.15);
    }

    .badge-male {
        background: linear-gradient(135deg, #007bff, #6610f2);
        color: white;
    }

    .badge-female {
        background: linear-gradient(135deg, #e83e8c, #fd7e14);
        color: white;
    }

    .badge-other {
        background: linear-gradient(135deg, #6c757d, #343a40);
        color: white;
    }
    
    .badge-primary {
        background: linear-gradient(135deg, #4a6fff, #77e3fa);
        border: none;
    }
    
    .badge-secondary {
        background: linear-gradient(135deg, #6c757d, #adb5bd);
        color: white;
    }
    
    .badge-info {
        background: linear-gradient(135deg, #17a2b8, #4cdfe8);
        color: white;
    }
    
    /* Custom styling for DataTables */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 20px;
        border: 1px solid #ddd;
        padding: 8px 15px;
        transition: all 0.3s ease;
    }
    
    .dataTables_wrapper .dataTables_filter input:focus {
        box-shadow: 0 0 0 3px rgba(74, 111, 255, 0.25);
        border-color: #4a6fff;
    }
    
    .dataTables_wrapper .dataTables_length select {
        border-radius: 20px;
        border: 1px solid #ddd;
        padding: 5px 10px;
    }
</style>

<main class="main">
    <title>Fitness Gym | {{$title}}</title>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <span class="text-secondary">
                        Recover Members
                    </span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                home
                            </a>
                        </li>
                        <li class="breadcrumb-item ">
                            recover Members
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <i class="fas fa-user-clock mr-2"></i>
                    Recover Members
                    <span class="badge badge-primary badge-pill ml-2">
                        {{ count($members) }} Members
                    </span>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="membersTable">
                        <thead>
                            <tr>
                                <th style="text-align: center;">#</th>
                                <th style="text-align: center;">Member<br>Image</th>
                                <th style="text-align: center;">Member<br>Name</th>
                                <th style="text-align: center;">Contact<br>Number</th>
                                <th style="text-align: center;">Member<br>Payment</th>
                                <th style="text-align: center;">Membership<br>Duration</th>
                                <th style="text-align: center;">Member<br>Category</th>
                                <th style="text-align: center;">Member<br>Fees</th>
                                <th style="text-align: center;">Membership<br>Joined Date</th>
                                <th style="text-align: center;">Membership<br>Exipry Date</th>
                                <th style="text-align: center;">Required<br>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($members as $member)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">
                                    @if($member->image)
                                    <img class="img-rounded"
                                        style="border-radius: 5px; padding: 5px;"
                                        src="{{ asset($member->image) }}" alt="Image" width="60"
                                        height="60">
                                    @else
                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px; border-radius: 5px; margin: 0 auto;">
                                        <i class="fas fa-user text-secondary fa-2x"></i>
                                    </div>
                                    @endif
                                </td>
                                <td class="align-middle member-name">{{ ucwords($member->name) }}</td>
                                <td class="align-middle">{{ $member->contact_no }}</td>
                                <td class="align-middle">
                                    <span class="badge badge-{{ $member->payment_mode == 'Cash Payment' ? 'secondary' : 'info' }} badge-pill">
                                        {{ $member->payment_mode == 'Cash Payment' ? 'Cash' : 'Online' }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    {{ ucwords(explode(' ', $member->membership_duration)[0]) }}
                                    {{ (explode(' ', $member->membership_duration)[0] == 1) ? 'Month' : 'Months' }}
                                </td>
                                <td class="align-middle">
                                    <span class="badge badge-{{ $member->category == 'atmiya_student' ? 'male' : ($member->category == 'atmiya_staff' ? 'female' : 'other') }}">
                                        {{ $member->category == 'atmiya_student' ? 'Male' : ($member->category == 'atmiya_staff' ? 'Female' : 'Other') }}
                                    </span>
                                </td>
                                <td class="align-middle font-weight-bold">₹{{ $member->fees }}</td>
                                <td class="align-middle" style="white-space: nowrap;">
                                    {{ date('d-m-Y', strtotime($member->joining_date)) }}
                                </td>
                                <td class="align-middle" style="white-space: nowrap;">
                                    {{ date('d-m-Y', strtotime($member->end_date)) }}
                                </td>
                                <td class="align-middle">
                                    <form action="{{ route('recover.member', $member->id) }}"
                                        method="POST"
                                        class="recover-form"
                                        data-member-name="{{ $member->name }}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success recover-btn" title="Recover this member">
                                            <i class="fas fa-sync-alt recover-icon"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Empty state when no records -->
            @if(count($members) == 0)
            <div class="text-center py-5">
                <i class="fas fa-user-slash fa-3x text-secondary mb-3"></i>
                <h5>No deleted members found</h5>
                <p class="text-muted">When you delete members, they will appear here for recovery</p>
            </div>
            @endif
        </div>
    </div>
</main>

<!-- Add Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable with enhanced mobile scrolling
        $('#membersTable').DataTable({
            "autoWidth": false,
            "scrollCollapse": true,
            "scrollX": true,
            "paging": true,
            "lengthMenu": [10, 25, 50, 100],
            "responsive": false,
            "order": [[0, 'asc']],
            "language": {
                "search": "<i class='fas fa-search'></i> _INPUT_",
                "searchPlaceholder": "Search members...",
                "lengthMenu": "Show _MENU_ members per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ members",
                "infoEmpty": "No deleted members found",
                "infoFiltered": "(filtered from _MAX_ total deleted members)",
            },
            // Force redraw on tab/window resize to fix scrolling issues
            "drawCallback": function() {
                $(window).trigger('resize');
            },
            // Initialize with proper scroll width
            "initComplete": function() {
                $(window).trigger('resize');
                // Add touch event handlers for better mobile scrolling
                $('.dataTables_scrollBody').css('overflow-x', 'auto');
            }
        });

        // Configure Toastr
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 5000,
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
            preventDuplicates: true
        };

        // Show flash messages as toasts
        @if(session('success'))
        toastr.success('{{ session('
            success ') }}');
        @endif

        @if(session('error'))
        toastr.error('{{ session('
            error ') }}');
        @endif

        // Handle recover form submission
        $('.recover-form').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var memberName = form.data('member-name');
            var row = form.closest('tr');

            if (confirm('Are you sure you want to recover ' + memberName + '?')) {
                // Show loading state
                var button = form.find('button');
                var icon = form.find('i');
                button.prop('disabled', true);
                icon.removeClass('fa-sync-alt').addClass('fa-spinner fa-spin');

                toastr.info('Recovering ' + memberName + '... Please wait.');

                // Submit the form
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        toastr.success(memberName + ' has been recovered successfully!');

                        // Animate row removal
                        row.css('background-color', '#d4edda');
                        setTimeout(function() {
                            row.fadeOut(300, function() {
                                $(this).remove();
                                // Check if table is now empty
                                if ($('#membersTable tbody tr').length === 0) {
                                    $('#membersTable').DataTable().destroy();
                                    $('#membersTable').parent().parent().html(
                                        '<div class="text-center py-5">' +
                                        '<i class="fas fa-user-slash fa-3x text-secondary mb-3"></i>' +
                                        '<h5>No deleted members found</h5>' +
                                        '<p class="text-muted">When you delete members, they will appear here for recovery</p>' +
                                        '</div>'
                                    );
                                }
                            });
                        }, 1000);
                    },
                    error: function(xhr) {
                        toastr.error('Error recovering member. Please try again.');
                        button.prop('disabled', false);
                        icon.removeClass('fa-spinner fa-spin').addClass('fa-sync-alt');
                    }
                });
            }
        });
    });
</script>
@endsection