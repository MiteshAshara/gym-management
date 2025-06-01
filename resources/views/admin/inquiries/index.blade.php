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
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter Mobile" required>
                            @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-control" required onchange="updateStatusOptions()">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            @error('gender')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" id="age" class="form-control" placeholder="Enter Age" min="1" max="120" required>
                            @error('age')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control" required>
                            @error('birth_date')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="height_in_inches" class="form-label">Height (in inches)</label>
                            <input type="number" name="height_in_inches" id="height_in_inches" class="form-control" placeholder="Enter Height" required>
                            @error('height_in_inches')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="number" name="weight" id="weight" class="form-control" placeholder="Enter Weight" required>
                            @error('weight')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="current_status" class="form-label">Current Status</label>
                            <select name="current_status" id="current_status" class="form-control" required>
                                <option value="">Select Status</option>
                                <!-- Options will be filled by JavaScript -->
                            </select>
                            @error('current_status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="reference" class="form-label">Reference</label>
                            <input type="text" name="reference" id="reference" class="form-control" placeholder="How did they hear about us?">
                            @error('reference')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="medical_conditions" class="form-label">Medical Conditions</label>
                            <textarea name="medical_conditions" id="medical_conditions" class="form-control" rows="3" placeholder="Any medical conditions or health issues"></textarea>
                            @error('medical_conditions')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status_display" class="form-label">Inquiry Status</label>
                            <input type="text" id="status_display" class="form-control" value="Pending" disabled>
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
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Birth Date</th>
                                <th>Height</th>
                                <th>Weight</th>
                                <th>Current Status</th>
                                <th>Reference</th>
                                <th>Medical Info</th>
                                <th>Status</th>
                                <th>Actions</th>
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
                                <td>{{ $inquiry->birth_date ? \Carbon\Carbon::parse($inquiry->birth_date)->format('d-m-Y') : 'N/A' }}</td>
                                <td>{{ $inquiry->height_in_inches }}</td>
                                <td>{{ $inquiry->weight }}</td>
                                <td>{{ ucfirst($inquiry->current_status ?? 'N/A') }}</td>
                                <td>{{ $inquiry->reference ?? 'N/A' }}</td>
                                <td>{{ Str::limit($inquiry->medical_conditions, 30) ?? 'N/A' }}</td>
                                <td>
                                    <!-- Replace the existing status cell content with this dropdown UI -->
                                    @php
                                        $isMember = \App\Models\Member::where('contact_no', $inquiry->mobile)->exists();
                                        
                                        // If member exists, set status to 'hot'
                                        if($isMember && $inquiry->status != 'hot') {
                                            $inquiry->status = 'hot';
                                            $inquiry->save();
                                        }
                                    @endphp
                                    
                                    <div class="status-container" data-inquiry-id="{{ $inquiry->id }}">
                                        <div class="d-flex align-items-center">
                                            <div class="status-badge me-2">
                                                @if($inquiry->status == 'hot')
                                                    <span class="badge badge-danger status-label">Hot</span>
                                                @elseif($inquiry->status == 'cold')
                                                    <span class="badge badge-success status-label">Cold</span>
                                                @else
                                                    <span class="badge badge-secondary status-label">Pending</span>
                                                @endif
                                            </div>
                                            
                                            <div class="dropdown">
                                                <div class="dropdown-menu" aria-labelledby="statusDropdown{{ $inquiry->id }}">
                                                    <a class="dropdown-item status-change" href="#" data-status="hot" data-inquiry-id="{{ $inquiry->id }}" data-inquiry-name="{{ $inquiry->name }}">
                                                        <span class="badge badge-danger">Hot</span>
                                                    </a>
                                                    <a class="dropdown-item status-change" href="#" data-status="cold" data-inquiry-id="{{ $inquiry->id }}" data-inquiry-name="{{ $inquiry->name }}">
                                                        <span class="badge badge-success">Cold</span>
                                                    </a>
                                                    <a class="dropdown-item status-change" href="#" data-status="pending" data-inquiry-id="{{ $inquiry->id }}" data-inquiry-name="{{ $inquiry->name }}">
                                                        <span class="badge badge-secondary">Pending</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
            var statusCell = form.closest('tr').find('td:nth-child(14)').find('span');
            
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
        
        // Handle status change with dropdown
        $('.status-change').on('click', function(e) {
            e.preventDefault();
            
            var statusLink = $(this);
            var inquiryId = statusLink.data('inquiry-id');
            var inquiryName = statusLink.data('inquiry-name');
            var newStatus = statusLink.data('status');
            var statusContainer = $('.status-container[data-inquiry-id="' + inquiryId + '"]');
            var statusLabel = statusContainer.find('.status-label');
            
            toastr.info('Updating ' + inquiryName + ' to ' + newStatus + ' status...');
            
            $.ajax({
                url: "{{ route('inquiries.change-status', '') }}/" + inquiryId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: newStatus
                },
                success: function(response) {
                    toastr.success(inquiryName + ' status changed to ' + newStatus + ' successfully.');
                    
                    // Update badge appearance
                    statusLabel.removeClass('badge-danger badge-success badge-secondary');
                    
                    if (newStatus === 'hot') {
                        statusLabel.addClass('badge-danger').text('Hot');
                    } else if (newStatus === 'cold') {
                        statusLabel.addClass('badge-success').text('Cold');
                    } else {
                        statusLabel.addClass('badge-secondary').text('Pending');
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
    
    // Function to update status options based on gender
    function updateStatusOptions() {
        const gender = document.getElementById('gender').value;
        const statusSelect = document.getElementById('current_status');
        
        // Clear existing options except the first one
        while (statusSelect.options.length > 1) {
            statusSelect.remove(1);
        }
        
        // Add appropriate options based on gender
        if (gender === 'male') {
            const maleOptions = ['Student', 'Business', 'Service/Job', 'Self-employed', 'Retired', 'Other'];
            maleOptions.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.toLowerCase();
                opt.textContent = option;
                statusSelect.add(opt);
            });
        } else if (gender === 'female') {
            const femaleOptions = ['Student', 'Housewife', 'Service/Job', 'Business', 'Self-employed', 'Retired', 'Other'];
            femaleOptions.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.toLowerCase();
                opt.textContent = option;
                statusSelect.add(opt);
            });
        }
    }
    
    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        const genderSelect = document.getElementById('gender');
        if (genderSelect) {
            genderSelect.addEventListener('change', updateStatusOptions);
            updateStatusOptions();
        }
    });
</script>
@endsection