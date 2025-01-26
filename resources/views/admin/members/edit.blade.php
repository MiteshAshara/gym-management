@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <span class="text-secondary">Edit Members</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="text-secondary" href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Members</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow-lg">
            <div class="card-header">
                <h5>Edit Member</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('member.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name"
                                value="{{ old('name', $member->name) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Contact Number -->
                        <div class="col-md-6 mb-3">
                            <label for="contact_no" class="form-label">Contact Number</label>
                            <input type="tel" name="contact_no" id="contact_no" class="form-control"
                                placeholder="Enter Contact Number" maxlength="10" pattern="\d{10}"
                                title="Please enter a valid 10-digit contact number"
                                oninput="this.value = this.value.replace(/[^\d]/g, '')"
                                value="{{ old('contact_no', $member->contact_no) }}">
                            @error('contact_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Department -->
                        <div class="col-md-6 mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" name="department" id="department" class="form-control"
                                placeholder="Enter Department" value="{{ old('department', $member->department) }}">
                            @error('department')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Semester -->
                        <div class="col-md-6 mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="text" name="semester" id="semester" class="form-control"
                                placeholder="Enter Semester" placeholder="Enter Semester" maxlength="3" pattern="^[0-9]{1,3}$"
                                oninput="this.value = this.value.replace(/[^\d]/g, '')" value="{{ old('semester', $member->semester) }}">
                            @error('semester')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Membership Duration -->
                        <div class="col-md-6 mb-3">
                            <label for="membership_duration" class="form-label">Membership Duration</label>
                            <select name="membership_duration" id="membership_duration" class="form-control">
                                <option value="" disabled>Select Duration</option>
                                @foreach($fees as $fee)
                                    <option value="{{ $fee->membership_duration }}" {{ old('membership_duration', $member->membership_duration) == $fee->membership_duration ? 'selected' : '' }}>
                                        {{ $fee->membership_duration }}
                                    </option>
                                @endforeach
                            </select>
                            @error('membership_duration')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fees -->
                        <div class="col-md-6 mb-3">
                            <label for="fees" class="form-label">Fees</label>
                            <input type="text" name="fees" id="fees" class="form-control"
                                placeholder="Select a duration to view fee" readonly
                                value="{{ old('fees', $member->fees) }}">
                        </div>

                        <!-- Payment Mode -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Payment Mode</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="payment_mode" id="payment_cash" value="Cash Payment"
                                        class="form-check-input" {{ old('payment_mode', $member->payment_mode) == 'Cash Payment' ? 'checked' : '' }}>
                                    <label for="payment_cash" class="form-check-label">Cash Payment</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="radio" name="payment_mode" id="payment_online" value="Online Payment"
                                        class="form-check-input" {{ old('payment_mode', $member->payment_mode) == 'Online Payment' ? 'checked' : '' }}>
                                    <label for="payment_online" class="form-check-label">Online Payment</label>
                                </div>
                            </div>
                            @error('payment_mode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Profile Image -->
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" alt="Profile Image"
                                    class="img-thumbnail mt-2" width="100">
                            @endif
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Joining Date -->
                        <div class="col-md-6 mb-3">
                            <label for="joining_date" class="form-label">Joining Date</label>
                            <input type="date" name="joining_date" id="joining_date" class="form-control"
                                value="{{ old('joining_date', $member->joining_date) }}">
                            @error('joining_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control"
                                value="{{ old('end_date', $member->end_date) }}" readonly>
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark rounded-pill d-grid gap-2 col-6 mx-auto">
                            Update Member
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function () {
        var feeData = @json($fees); // Pass fees data to JavaScript

        function updateFeesAndEndDate() {
            var selectedDuration = $('#membership_duration').val();
            var joiningDate = $('#joining_date').val();
            var feesAmount = '';

            // Find the fees amount for the selected duration
            feeData.forEach(function (fee) {
                if (fee.membership_duration === selectedDuration) {
                    feesAmount = fee.fees_amount;
                }
            });

            // Update fees input field
            $('#fees').val(feesAmount);

            // Update end date based on joining date and membership duration
            if (joiningDate && selectedDuration) {
                var endDate = calculateEndDate(joiningDate, selectedDuration);
                $('#end_date').val(endDate);
            }
        }

        function calculateEndDate(joiningDate, duration) {
            var date = new Date(joiningDate);
            var match = duration.match(/^(\d+)\s*(month|year)s?$/i);

            if (match) {
                var value = parseInt(match[1], 10);
                var unit = match[2].toLowerCase();

                if (unit === 'month') date.setMonth(date.getMonth() + value);
                else if (unit === 'year') date.setFullYear(date.getFullYear() + value);
            } else {
                console.error("Invalid duration: " + duration);
                return null;
            }

            return date.toISOString().split('T')[0];
        }

        // Initialize on page load to pre-fill old data
        updateFeesAndEndDate();

        // Update fees and end date on changes
        $('#membership_duration').change(updateFeesAndEndDate);
        $('#joining_date').change(updateFeesAndEndDate);
    });
</script>

@endsection