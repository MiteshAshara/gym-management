@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <title>Atmiya Wellness | {{$title}}</title>
    <div class="content-header">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-3">
                <div class="col-sm-6">
                    <span class="text-secondary">Members</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="text-secondary" href="{{ route('admin.dashboard') }}">home</a>
                        </li>
                        <li class="breadcrumb-item active">members</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Member Form -->
    <div class="container-fluid">
        <div class="card shadow-lg">
            <div class="card-header">
                <span class="m-0">Add Member</span>
            </div>
            <div class="card-body">
                <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name"
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Contact Number -->
                        <div class="col-md-6 mb-3">
                            <label for="contact_no" class="form-label">Contact Number</label>
                            <input type="tel" name="contact_no" id="contact_no" class="form-control"
                                placeholder="Enter Contact Number" maxlength="10" pattern="\d{10}"
                                title="Please enter a valid 10-digit contact number"
                                oninput="this.value = this.value.replace(/[^\d]/g, '')" value="{{ old('contact_no') }}">
                            @error('contact_no')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Department -->
                        <div class="col-md-6 mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" name="department" id="department" class="form-control"
                                placeholder="Enter Department" value="{{ old('department') }}">
                            @error('department')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Semester -->
                        <div class="col-md-6 mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="text" name="semester" id="semester" class="form-control"
                                placeholder="Enter Semester" maxlength="3" pattern="^[0-9]{1,3}$"
                                oninput="this.value = this.value.replace(/[^\d]/g, '')" value="{{ old('semester') }}">
                            @error('semester')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Membership Duration -->
                        <div class="col-md-6 mb-3">
                            <label for="membership_duration" class="form-label">Membership Duration</label>
                            <select name="membership_duration" id="membership_duration" class="form-control">
                                <option value="" disabled selected>Select Duration</option>
                                @foreach($fees as $fee)
                                    <option value="{{ $fee->membership_duration }}">{{ $fee->membership_duration }}</option>
                                @endforeach
                            </select>
                            @error('membership_duration')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fees -->
                        <div class="col-md-6 mb-3">
                            <label for="fees" class="form-label">Fees</label>
                            <input type="text" name="fees" id="fees" class="form-control"
                                placeholder="Select Membership Duration For fees" readonly>
                        </div>


                        <!-- Payment Mode -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Payment Mode</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="payment_mode" id="payment_cash" value="Cash Payment"
                                        class="form-check-input" checked {{ old('payment_mode') == 'Cash' ? 'checked' : '' }}>
                                    <label for="payment_cash" class="form-check-label">Cash Payment</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="radio" name="payment_mode" id="payment_online" value="Online Payment"
                                        class="form-check-input" {{ old('payment_mode') == 'Online' ? 'checked' : '' }}>
                                    <label for="payment_online" class="form-check-label">Online Payment</label>
                                </div>
                            </div>
                            @error('payment_mode')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Profile Image -->
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @error('image')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Joining Date -->
                        <div class="col-md-6 mb-3">
                            <label for="joining_date" class="form-label">Joining Date</label>
                            <input type="date" name="joining_date" id="joining_date" class="form-control"
                                value="{{ old('joining_date') }}">
                            @error('joining_date')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control"
                                value="{{ old('end_date') }}" required readonly>
                            @error('end_date')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-center">
                        <button type="submit"
                            class="btn btn-dark rounded-pill d-grid gap-2 col-6 mx-auto">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Members Table -->
    <div class="container-fluid mt-5">
        <div class="card shadow-lg">
            <div class="card-header">
                <span class="m-0">View Members</span>
            </div>
            <div class="container-fluid mt-5">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <span class="m-0">View Members</span>
                    </div>
                    <div class="card-body">
                        <!-- Responsive Table Wrapper -->
                        <div class="table-responsive">
                            <table id="membersTable" class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Member Image</th>
                                        <th>Member Name</th>
                                        <th>Contact Number</th>
                                        <th>University Department</th>
                                        <th>Study Semester</th>
                                        <th>Payment Mode</th>
                                        <th>Membership Duration</th>
                                        <th>Fees Amount</th>
                                        <th>Joining Date</th>
                                        <th>Ending Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $member)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($member->image)
                                                    <img class="img-rounded"
                                                        style="border-radius: 5px;padding:10px;margin-top: -10px;"
                                                        src="{{ asset('storage/' . $member->image) }}" alt="Image" width="100"
                                                        height="auto">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ ucwords($member->name) }}</td>
                                            <td>{{ $member->contact_no }}</td>
                                            <td>{{ ucwords($member->department) }}</td>
                                            <td>{{ $member->semester }}</td>
                                            <td>{{ $member->payment_mode }}</td>
                                            <td>{{ ucwords($member->membership_duration) }}</td>
                                            <td>{{ $member->fees }}</td>
                                            <td style=" white-space: nowrap;">
                                                {{ date('d-m-Y', strtotime($member->joining_date)) }}
                                            </td>
                                            <td style=" white-space: nowrap;">
                                                {{ date('d-m-Y', strtotime($member->end_date)) }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Actions">
                                                    <a href="{{ route('members.edit', $member->id) }}"
                                                        class="btn btn-dark btn-sm">Edit</a>
                                                    <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                                                        style="margin: 0;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark btn-sm"
                                                            style="margin-left: 5px;"
                                                            onclick="return confirm('Are you sure you want to delete this member?')">Delete</button>
                                                    </form>
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
        </div>
    </div>
</main>

<script>
    $(document).ready(function () {
        $('#membersTable').DataTable({
            "scrollY": "400px",  // Set the fixed height for vertical scrolling
            "scrollX": true, // Enable horizontal scrolling for wide tables
            "scrollCollapse": true,  // Allow the table to collapse if there are fewer rows
            "paging": true,      // Enable pagination
            "lengthMenu": [10, 25, 50, 100],  // Set options for how many rows to show at once
            "responsive": true,  // Make the table responsive
        });
    });
    $(document).ready(function () {
        var feeData = @json($fees); // Pass fees data to JavaScript

        $('#membership_duration').change(function () {
            var selectedDuration = $(this).val();
            var feesAmount = '';

            // Find the fee that matches the selected duration
            feeData.forEach(function (fee) {
                if (fee.membership_duration === selectedDuration) {
                    feesAmount = fee.fees_amount;
                }
            });

            // Update the fees field
            $('#fees').val(feesAmount);
        });
    });

    $(document).ready(function () {
        // Set the current date as the default value for Joining Date
        var currentDate = new Date().toISOString().split('T')[0];
        $('#joining_date').val(currentDate);

        // When the membership duration changes
        $('#membership_duration').change(function () {
            var selectedDuration = $(this).val();
            var joiningDate = $('#joining_date').val();

            if (selectedDuration) {
                var endDate = calculateEndDate(joiningDate, selectedDuration);
                $('#end_date').val(endDate);
            }
        });
    });

    // Function to calculate the end date based on membership duration
    function calculateEndDate(joiningDate, duration) {
        var date = new Date(joiningDate);
        var match = duration.match(/^(\d+)\s*(month|year)s?$/i); // Match patterns like "1 month", "3 years"

        if (match) {
            var value = parseInt(match[1], 10); // Extract the numeric value
            var unit = match[2].toLowerCase(); // Extract the unit (month/year)

            if (unit === "month") {
                date.setMonth(date.getMonth() + value); // Add months
            } else if (unit === "year") {
                date.setFullYear(date.getFullYear() + value); // Add years
            }
        } else {
            console.error("Invalid duration: " + duration);
            return null;
        }

        return date.toISOString().split('T')[0]; // Return date in YYYY-MM-DD format
    }


    // Event listener to update the end date when the joining date is changed
    $('#joining_date').change(function () {
        var joiningDate = $(this).val();
        var selectedDuration = $('#membership_duration').val();

        if (joiningDate && selectedDuration) {
            var endDate = calculateEndDate(joiningDate, selectedDuration);
            $('#end_date').val(endDate);
        }
    });


</script>
@endsection