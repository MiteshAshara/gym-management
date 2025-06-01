@extends('admin.includes.master')

@section('admin.content')
<style>
    .summary-card {
        border-radius: 15px;
        transition: all 0.3s;
        border: none;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

   

    .renewal-count {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .renewal-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .urgent-renewal {
        background-color: rgba(255, 193, 7, 0.15);
    }

    .very-urgent-renewal {
        background-color: rgba(220, 53, 69, 0.15);
    }

    .action-btn {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 3px;
        transition: all 0.3s;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .action-btn i {
        font-size: 1.1rem;
    }

    .filtered-highlight {
        background-color: rgba(0, 123, 255, 0.05) !important;
    }

    /* Fix for DataTables search and filter conflicts */
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 10px;
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-right: 15px;
        font-size: 1.5rem;
    }

    .badge {
        padding: 6px 10px;
        font-weight: 500;
        border-radius: 6px;
    }

    .filter-container {
        position: relative;
    }

    .filter-container:before {
        content: "\f0b0";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        left: 10px;
        top: 8px;
        color: #6c757d;
        z-index: 10;
    }

    #filterPeriod {
        padding-left: 30px;
        border-radius: 20px;
        border: 1px solid #dee2e6;
        background-color: #f8f9fa;
        font-weight: 500;
    }

    /* Add styling for expired memberships */
    .expired-badge {
        background-color: #dc3545;
        color: white;
    }

    .active-badge {
        background-color: #28a745;
        color: white;
    }

    /* Filter status indicator */
    .filter-status {
        display: none;
        padding: 8px 15px;
        margin-top: 10px;
        background-color: #f8f9fa;
        border-radius: 6px;
        font-size: 0.9rem;
        border-left: 4px solid #3f51b5;
    }

    .filter-status.active {
        display: block;
    }

    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }

    .table-container {
        border-radius: 10px;
        overflow: hidden;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
    }

    .page-heading {
        font-size: 1.5rem;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 0;
    }

    .breadcrumb-link {
        text-decoration: none;
        transition: color 0.2s;
    }

    .breadcrumb-link:hover {
        color: #007bff !important;
    }

    .card-title-with-icon {
        display: flex;
        align-items: center;
    }

    .card-title-with-icon i {
        margin-right: 8px;
    }
</style>

<main class="main">
    <title>Fitness Gym | {{$title}}</title>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <h6 class="page-heading">
                        Upcoming Renewals
                    </h6>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="breadcrumb-link text-secondary" href="{{ route('admin.dashboard') }}">
                                home
                            </a>
                        </li>
                        <li class="breadcrumb-item active">renewals</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Renewal Summary Cards -->
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card summary-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-danger text-white">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <div class="renewal-count text-danger">{{ $todayRenewals ?? 0 }}</div>
                                <div class="renewal-label">Due Today</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card summary-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-warning text-white">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <div class="renewal-count text-warning">{{ $thisWeekRenewals ?? 0 }}</div>
                                <div class="renewal-label">Due This Week</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card summary-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-info text-white">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <div class="renewal-count text-info">{{ $thisMonthRenewals ?? 0 }}</div>
                                <div class="renewal-label">Due This Month</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card summary-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-success text-white">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <div class="renewal-count text-success">{{ $totalRenewals ?? 0 }}</div>
                                <div class="renewal-label">Total Renewals</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title-with-icon">
                        <i class="fas fa-user-clock"></i>Members Due for Renewal
                    </h5>
                    <div class="filter-container">
                        <select id="filterPeriod" class="form-control form-control-sm">
                            <option value="all">Display All Renewals</option>
                            <option value="today">Due Today</option>
                            <option value="week">Due This Week</option>
                            <option value="month">Due This Month</option>
                            <option value="expired">Expired Memberships</option>
                            <option value="active">Active Memberships</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body table-container">
                <div id="filterStatus" class="filter-status">
                    <span id="filterDescription">All members</span>
                </div>
                <div class="table-responsive mt-2">
                    <table id="membersTable" class="table table-hover text-center">
                        <thead>
                            <tr>    
                                <th>#</th>                            
                                <th>Member<br>Image</th>
                                <th>Member<br>Name</th>
                                <th>Contact<br>Number</th>
                                <th>Membership<br>Duration</th>
                                <th>Payment<br>Amount</th>
                                <th>Member<br>Joining Date</th>
                                <th>Membership<br>Expiry Date</th>
                                <th>Membership<br>Left Days</th>
                                <th>Required<br>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $member)
                                @php
                                    $daysRemaining = (int)\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($member->end_date), false);
                                    $today = \Carbon\Carbon::now()->format('d-m-Y');
                                    $rowClass = '';
                                    $statusBadge = '';
                                    
                                    if($daysRemaining < 0) {
                                        $rowClass = 'very-urgent-renewal';
                                        $statusBadge = '<span class="badge badge-danger">Expired</span>';
                                    } elseif($daysRemaining == 0) {
                                        $rowClass = 'very-urgent-renewal';
                                        $statusBadge = '<span class="badge badge-danger">Expires Today (' . $today . ')</span>';
                                    } elseif($daysRemaining <= 3) {
                                        $rowClass = 'urgent-renewal';
                                        $statusBadge = '<span class="badge badge-warning">' . $daysRemaining . ' Days Left</span>';
                                    } else {
                                        $statusBadge = '<span class="badge badge-info">' . $daysRemaining . ' Days Left</span>';
                                    }
                                @endphp
                                <tr class="{{ $rowClass }}" data-days="{{ $daysRemaining }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($member->image)
                                            <img class="rounded" src="{{ asset($member->image) }}" alt="Image" width="50" height="50" style="object-fit: cover;">
                                        @else
                                            <div class="bg-secondary rounded text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ ucwords($member->name) }}</td>
                                    <td>{{ $member->contact_no }}</td>
                                    <td>
                                        {{ ucwords(explode(' ', $member->membership_duration)[0]) }}
                                        {{ (explode(' ', $member->membership_duration)[0] == 1) ? 'Month' : 'Months' }}
                                    </td>
                                    <td>₹{{ $member->fees }}</td>
                                    <td>{{ date('d-m-Y', strtotime($member->joining_date)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($member->end_date)) }}</td>
                                    <td>{!! $statusBadge !!}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('reneable.edit', $member->id) }}" class="action-btn btn-primary text-white" title="Renew">
                                                <i class="fas fa-sync-alt"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="action-btn btn-success text-white" onclick="sendWhatsAppMessage('{{ $member->contact_no }}', '{{ ucfirst($member->name) }}', '{{ date('d-m-Y', strtotime($member->end_date)) }}')" title="Send WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Member Details Modal -->
<div class="modal fade" id="memberDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Member Details</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody >
                        <tr>
                            <th>Name</th>
                            <td id="memberName"></td>
                        </tr>
                        <tr>
                            <th>Member Image</th>
                            <td><img id="memberImage" src="" alt="Member Image" width="100"
                                    style="display: none; border-radius: 5px;"></td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td id="memberContact"></td>
                        </tr>
                        <tr>
                            <th>University Department</th>
                            <td id="memberDepartment"></td>
                        </tr>
                        <tr>
                            <th>Study Semester</th>
                            <td id="memberSemester"></td>
                        </tr>
                        <tr>
                            <th>Payment Mode</th>
                            <td id="memberPayment"></td>
                        </tr>
                        <tr>
                            <th>Membership Duration</th>
                            <td id="memberDuration"></td>
                        </tr>
                        <tr>
                            <th>Fees Amount</th>
                            <td id="memberFees"></td>
                        </tr>
                        <tr>
                            <th>Joining Date</th>
                            <td id="memberJoining"></td>
                        </tr>
                        <tr>
                            <th>Ending Date</th>
                            <td id="memberEnding"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const membersTable = $('#membersTable').DataTable({
            "scrollY": "500px",
            "scrollX": true,  
            "fixedHeader": true, 
            "autoWidth": false,
            "scrollCollapse": true,
            "paging": true,
            "lengthMenu": [10, 25, 50, 100],
            "responsive": true,
            "order": [['asc']] 
        });
        
        // Filter renewals by period
        $('#filterPeriod').on('change', function() {
            let value = $(this).val();
            console.log("Filter selected:", value);
            
            // Clear any existing filters first
            $.fn.dataTable.ext.search.pop();
            
            if (value === 'all') {
                // Show all records
                membersTable.search('').columns().search('').draw();
                $('#filterStatus').removeClass('active');
            } else if (value === 'today') {
                // Show records expiring today (days = 0)
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        let days = parseInt($(membersTable.row(dataIndex).node()).attr('data-days'));
                        return days === 0;
                    }
                );
                membersTable.draw();
                $('#filterStatus').addClass('active');
                $('#filterDescription').text('Members due today');
            } else if (value === 'week') {
                // Show records expiring within a week (0 ≤ days ≤ 7)
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        let days = parseInt($(membersTable.row(dataIndex).node()).attr('data-days'));
                        return days >= 0 && days <= 7;
                    }
                );
                membersTable.draw();
                $('#filterStatus').addClass('active');
                $('#filterDescription').text('Members due this week');
            } else if (value === 'month') {
                // Show records expiring within a month (0 ≤ days ≤ 30)
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        let days = parseInt($(membersTable.row(dataIndex).node()).attr('data-days'));
                        return days >= 0 && days <= 30;
                    }
                );
                membersTable.draw();
                $('#filterStatus').addClass('active');
                $('#filterDescription').text('Members due this month');
            } else if (value === 'expired') {
                // Show expired memberships (days < 0)
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        let days = parseInt($(membersTable.row(dataIndex).node()).attr('data-days'));
                        return days < 0;
                    }
                );
                membersTable.draw();
                $('#filterStatus').addClass('active');
                $('#filterDescription').text('Expired memberships');
            } else if (value === 'active') {
                // Show active memberships (days > 0)
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        let days = parseInt($(membersTable.row(dataIndex).node()).attr('data-days'));
                        return days > 0;
                    }
                );
                membersTable.draw();
                $('#filterStatus').addClass('active');
                $('#filterDescription').text('Active memberships');
            }
            
            // Apply highlight to filtered rows
            $('tr').removeClass('filtered-highlight');
            if (value !== 'all') {
                $('tr:visible').not('thead tr').addClass('filtered-highlight');
            }
        });
        
        // Member details modal
        $('.viewMember').click(function () {
            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
            }

            $('#memberName').text(capitalizeFirstLetter($(this).data('name')));
            $('#memberContact').text($(this).data('contact'));
            $('#memberDepartment').text(capitalizeFirstLetter($(this).data('department')));
            $('#memberSemester').text($(this).data('semester'));
            $('#memberPayment').text($(this).data('payment'));
            $('#memberDuration').text($(this).data('duration'));
            $('#memberFees').text($(this).data('fees'));
            $('#memberJoining').text($(this).data('joining'));
            $('#memberEnding').text($(this).data('ending'));

            let imageUrl = $(this).data('image');

            if (imageUrl && imageUrl !== 'N/A') {
                $('#memberImage').attr('src', imageUrl).show();
            } else {
                $('#memberImage').hide();
            }

            $('#memberDetailsModal').modal('show');
        });
    });
    
    function sendWhatsAppMessage(contactNo, name, endDate) {
        // Construct the WhatsApp message
        const message = `Hello ${name}, Your gym membership expires on ${endDate}. Please renew your membership to continue using our facility. Thank you!`;
        
        // URL encode the message and create the WhatsApp link
        const encodedMessage = encodeURIComponent(message);
        const whatsappLink = `https://api.whatsapp.com/send?phone=${contactNo}&text=${encodedMessage}`;
        
        // Open WhatsApp with the generated link
        window.open(whatsappLink, '_blank');
    }
</script>
@endsection