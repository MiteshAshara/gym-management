@extends('admin.includes.master')

@section('admin.content')
<!-- Add Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    .toast-success { background-color: #28a745 !important; }
    .toast-error { background-color: #dc3545 !important; }
    .toast-info { background-color: #17a2b8 !important; }
</style>

<main class="main">
    <title>Fitness Gym | {{$title}}</title>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <span class="text-secondary">Inquiries Management</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="text-secondary" href="{{ route('admin.dashboard') }}">home</a>
                        </li>
                        <li class="breadcrumb-item active">inquiries</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow-lg">
            <div class="card-header">
                <span class="m-0">Add Inquiry</span>
            </div>
            <div class="card-body">
                <form id="inquiry-form" action="{{ route('inquiries.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter Mobile" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" id="age" class="form-control" placeholder="Enter Age" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="height_in_inches" class="form-label">Height (in inches)</label>
                            <input type="number" name="height_in_inches" id="height_in_inches" class="form-control" placeholder="Enter Height" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="number" name="weight" id="weight" class="form-control" placeholder="Enter Weight" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" id="status" class="form-control" value="Pending" disabled>
                            <input type="hidden" name="status" value="pending">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark rounded-pill d-grid gap-2 col-6 mx-auto">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="card shadow-lg">
            <div class="card-header">
                <span class="m-0">View Inquiries</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="inquiryTable" class="table table-bordered text-center" style="font-weight: bold; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Inquiry<br>Date</th>
                                <th>Inquire<br>Name</th>
                                <th>Inquire<br>Email</th>
                                <th>Mobile<br>Number</th>
                                <th>Inquire<br>Gender</th>
                                <th>Inquire<br>Age</th>
                                <th>Inquire<br>Height (in inches)</th>
                                <th>Inquire<br>Weight (kg)</th>
                                <th>Inquire<br>Status</th>
                                <th>Inquiry<br>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inquiries as $index => $inquiry)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($inquiry->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $inquiry->name }}</td>
                                <td>{{ $inquiry->email }}</td>
                                <td>{{ $inquiry->mobile }}</td>
                                <td>{{ ucfirst($inquiry->gender) }}</td>
                                <td>{{ $inquiry->age }}</td>
                                <td>{{ $inquiry->height_in_inches }}</td>
                                <td>{{ $inquiry->weight }}</td>
                                <td>
                                    @php
                                        $isMember = \App\Models\Member::where('contact_no', $inquiry->mobile)->exists();
                                        
                                        // If member exists, set status to 'hot'
                                        if($isMember && $inquiry->status != 'hot') {
                                            $inquiry->status = 'hot';
                                            $inquiry->save();
                                        }
                                        // If member doesn't exist and status is 'hot', set back to 'pending'
                                        elseif(!$isMember && $inquiry->status == 'hot') {
                                            $inquiry->status = 'pending';
                                            $inquiry->save();
                                        }
                                    @endphp
                                    
                                    @if($inquiry->status == 'hot')
                                        <span class="badge badge-danger">Hot</span>
                                    @elseif($inquiry->status == 'cold')
                                        <span class="badge badge-success">Cold</span>
                                    @else
                                        <span class="badge badge-secondary">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Actions">
                                        <a href="{{ route('inquiries.edit', $inquiry->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('inquiries.destroy', $inquiry->id) }}" method="POST" class="delete-inquiry-form" style="margin: 0;" data-inquiry-name="{{ $inquiry->name }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" style="margin-left: 5px;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        @if($inquiry->status != 'hot')
                                            <form action="{{ route('inquiries.toggle-cold', $inquiry->id) }}" method="POST" class="toggle-status-form" style="margin-left: 5px;" data-inquiry-name="{{ $inquiry->name }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn {{ $inquiry->status == 'cold' ? 'btn-success' : 'btn-secondary' }} btn-sm">
                                                    <i class="fas {{ $inquiry->status == 'cold' ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @php
                                            $isMember = \App\Models\Member::where('contact_no', $inquiry->mobile)->exists();
                                        @endphp
                                        @if(!$isMember)
                                            <a href="{{ route('inquiries.to-member', $inquiry->id) }}" class="btn btn-success btn-sm convert-member-btn" 
                                               style="margin-left: 5px;" title="Convert to Member" data-inquiry-name="{{ $inquiry->name }}">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        @endif
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

<!-- Add Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
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
            toastr.success('{{ session('success') }}');
        @endif
        
        @if(session('error'))
            toastr.error('{{ session('error') }}');
        @endif
        
        // Show loading toast when form is submitted
        $('#inquiry-form').on('submit', function() {
            toastr.info('Processing... Please wait.');
        });
        
        // Handle delete confirmation with toasts - AJAX version
        $('.delete-inquiry-form').on('submit', function(e) {
            e.preventDefault();
            
            var form = $(this);
            var inquiryName = form.data('inquiry-name');
            var row = form.closest('tr');
            
            if (confirm('Are you sure you want to delete the inquiry from ' + inquiryName + '?')) {
                toastr.info('Deleting inquiry from ' + inquiryName + '...');
                
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        toastr.success('Inquiry from ' + inquiryName + ' was deleted successfully.');
                        // Remove row from table
                        row.fadeOut(300, function() {
                            $(this).remove();
                        });
                    },
                    error: function(xhr) {
                        toastr.error('Error deleting inquiry: ' + xhr.responseText);
                    }
                });
            }
        });
        
        // Handle status toggle with toasts - AJAX version
        $('.toggle-status-form').on('submit', function(e) {
            e.preventDefault();
            
            var form = $(this);
            var inquiryName = form.data('inquiry-name');
            var button = form.find('button');
            var icon = button.find('i');
            var currentStatus = button.hasClass('btn-success') ? 'cold' : 'pending';
            var newStatus = currentStatus === 'cold' ? 'pending' : 'cold';
            var statusCell = form.closest('tr').find('td:nth-child(10)').find('span');
            
            toastr.info('Updating ' + inquiryName + ' to ' + newStatus + ' status...');
            
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    
                    
                    // Update button appearance
                    if (newStatus === 'pending') {
                        button.removeClass('btn-success').addClass('btn-secondary');
                        icon.removeClass('fa-eye-slash').addClass('fa-eye');
                        statusCell.removeClass('badge-success').addClass('badge-secondary').text('Pending');
                    } else {
                        button.removeClass('btn-secondary').addClass('btn-success');
                        icon.removeClass('fa-eye').addClass('fa-eye-slash');
                        statusCell.removeClass('badge-secondary').addClass('badge-success').text('Cold');
                    }
                },
                error: function(xhr) {
                    toastr.error('Error updating status: ' + xhr.responseText);
                }
            });
        });
        
        // Convert to member - Store in localStorage to show toast on member page
        $('.convert-member-btn').on('click', function() {
            var inquiryName = $(this).data('inquiry-name');
            toastr.info('Converting ' + inquiryName + ' to member.');
            localStorage.setItem('convertingInquiry', inquiryName);
        });
    });
</script>
@endsection