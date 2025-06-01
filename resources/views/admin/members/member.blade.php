@extends('admin.includes.master')

@section('admin.content')
<style>
    .form-check-input {
        border: 2px solid black;
    }

    .form-check-input:checked {
        border: 2px solid black;
    }
</style>
<main class="main">
    <title>Fitness Gym | {{$title}}</title>
    <div class="content-header">
        <div class="container-fluid">
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

    <div class="container-fluid">
        <div class="card shadow-lg">
            <div class="card-header">
                <span class="m-0">Add Member</span>
            </div>
            <div class="card-body">
                <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name"
                                value="{{ old('name', $inquiry->name ?? '') }}" required>
                            @error('name')
                            <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contact_no" class="form-label">Contact Number</label>
                            <input type="tel" name="contact_no" id="contact_no" class="form-control"
                                placeholder="Enter Contact Number" maxlength="10" pattern="\d{10}"
                                title="Please enter a valid 10-digit contact number"
                                oninput="this.value = this.value.replace(/[^\d]/g, '')"
                                value="{{ old('contact_no', $inquiry->mobile ?? '') }}" required>
                            @error('contact_no')
                            <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" id="age" class="form-control" placeholder="Enter Age"
                                value="{{ old('age', $inquiry->age ?? '') }}" min="1" max="100">
                            @error('age')
                            <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="height_in_inches" class="form-label">Height (in inches)</label>
                            <input type="number" name="height_in_inches" id="height_in_inches" class="form-control"
                                placeholder="Enter Height"
                                value="{{ old('height_in_inches', $inquiry->height_in_inches ?? '') }}">
                            @error('height_in_inches')
                            <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="number" name="weight" id="weight" class="form-control" placeholder="Enter Weight"
                                value="{{ old('weight', $inquiry->weight ?? '') }}">
                            @error('weight')
                            <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control"
                                value="{{ old('birth_date', $inquiry->birth_date ?? '') }}">
                            @error('birth_date')
                            <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="current_status" class="form-label">Current Status</label>
                            <input type="text" name="current_status" id="current_status" class="form-control"
                                placeholder="Member's current status" value="{{ old('current_status', $inquiry->current_status ?? '') }}">
                            @error('current_status')
                            <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="reference" class="form-label">Reference</label>
                            <input type="text" name="reference" id="reference" class="form-control"
                                placeholder="Reference information" value="{{ old('reference', $inquiry->reference ?? '') }}">
                            @error('reference')
                            <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="medical_conditions" class="form-label">Medical Conditions</label>
                            <textarea name="medical_conditions" id="medical_conditions" class="form-control"
                                placeholder="Any medical conditions">{{ old('medical_conditions', $inquiry->medical_conditions ?? '') }}</textarea>
                            @error('medical_conditions')
                            <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Member Category</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" id="atmiya_student"
                                        value="atmiya_student" checked {{ old('category') == 'atmiya_student' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="atmiya_student">General Membership</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" id="atmiya_staff"
                                        value="atmiya_staff" {{ old('category') == 'atmiya_staff' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="atmiya_staff">General Membership + Aerobic / Zumba</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" id="non_atmiya_staff"
                                        value="non_atmiya_staff" {{ old('category') == 'non_atmiya_staff' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="non_atmiya_staff">Personal Training</label>
                                </div>
                            </div>
                            @error('category')
                            <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="membership_duration" class="form-label">Membership Duration</label>
                            <select name="membership_duration" id="membership_duration" class="form-control">
                                <option value="" disabled selected required>Select Duration</option>

                                <optgroup label="Male" class="category-group" id="atmiya_student_options">
                                    @foreach($fees as $fee)
                                    <option value="{{ $fee->membership_duration }}">{{ $fee->membership_duration }}</option>
                                    @endforeach
                                </optgroup>

                                <optgroup label="Female" class="category-group d-none" id="atmiya_staff_options">
                                    @foreach($atmiyaStaffFees as $atmiyaStaffFee)
                                    <option value="{{ $atmiyaStaffFee->membership_duration }}">{{ $atmiyaStaffFee->membership_duration }}</option>
                                    @endforeach
                                </optgroup>

                                <optgroup label="Other" class="category-group d-none" id="non_atmiya_staff_options">
                                    @foreach($nonAtmiyaStaffFees as $nonAtmiyaStaffFee)
                                    <option value="{{ $nonAtmiyaStaffFee->membership_duration }}">{{ $nonAtmiyaStaffFee->membership_duration }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="fees" class="form-label">Fees Amount</label>
                            <input type="text" name="fees" id="fees" class="form-control" placeholder="Select Membership Duration" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Payment Mode</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="payment_mode" id="payment_cash" value="Cash Payment"
                                        class="form-check-input custom-dark-radio" {{ old('payment_mode') == 'Cash Payment' ? 'checked' : '' }} required>
                                    <label for="payment_cash" class="form-check-label">Cash Payment</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="radio" name="payment_mode" id="payment_online" value="Online Payment"
                                        class="form-check-input custom-dark-radio" {{ old('payment_mode') == 'Online Payment' ? 'checked' : '' }} required>
                                    <label for="payment_online" class="form-check-label">Online Payment</label>
                                </div>
                            </div>
                            @error('payment_mode')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Member Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @error('image')
                            <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3 d-flex flex-row gap-3">
                            <div class="mb-3 w-50">
                                <label for="joining_date" class="form-label">Joining Date</label>
                                <input type="date" name="joining_date" id="joining_date" class="form-control"
                                    value="{{ old('joining_date') }}">
                                @error('joining_date')
                                <span class="text-dark">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 w-50">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    value="{{ old('end_date') }}" required readonly>
                                @error('end_date')
                                <span class="text-dark">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit"
                            class="btn btn-dark rounded-pill d-grid gap-2 col-6 mx-auto">Confirm Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="card shadow-lg">
            <div class="card-header d-flex align-items-center">
                <span class="m-0">View Members</span>
                <div class="ms-auto">
                    <a href="{{ route('members.pdf') }}" class="btn btn-dark mx-2">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="membersTable" class="table table-bordered table-hover text-center table-hover" style="font-weight: bold; width: 100%;">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Member Image</th>
                                <th>Member Name</th>
                                <th>Contact Number</th>
                                <th>Age</th>
                                <th>Birth Date</th>
                                <th>Current Status</th>
                                <th>Payment Mode</th>
                                <th>Membership Duration</th>
                                <th>Member Category</th>
                                <th>Fees Amount</th>
                                <th>Medical information</th>
                                <th>Joining Date</th>
                                <th>Ending Date</th>
                                <th>Required Actions</th>
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
                                        src="{{ asset($member->image) }}" alt="Image" width="100"
                                        height="auto">
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>{{ ucwords($member->name) }}</td>
                                <td>{{ $member->contact_no }}</td>
                                <td>{{ $member->age ?? 'N/A' }}</td>
                                <td style="white-space: nowrap;">
                                    {{ $member->birth_date ? date('d-m-Y', strtotime($member->birth_date)) : 'N/A' }}
                                </td>
                                <td>{{ $member->current_status ?? 'N/A' }}</td>
                                <td>{{ $member->payment_mode }}</td>
                                <td>
                                    {{ ucwords(explode(' ', $member->membership_duration)[0]) }}
                                    {{ (explode(' ', $member->membership_duration)[0] == 1) ? 'Month' : 'Months' }}
                                </td>
                                <td>{{ $member->category == 'atmiya_student' ? 'Male' : ($member->category == 'atmiya_staff' ? 'Female' : 'Other') }}</td>
                                <td>{{ $member->fees }}</td>
                                <td>
                                    @if($member->medical_conditions)
                                    <span title="{{ $member->medical_conditions }}">
                                        {{ Str::limit($member->medical_conditions, 50) }}
                                    </span>
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td style="white-space: nowrap;">
                                    {{ date('d-m-Y', strtotime($member->joining_date)) }}
                                </td>
                                <td style="white-space: nowrap;">
                                    {{ date('d-m-Y', strtotime($member->end_date)) }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Actions">
                                        <a href="{{ route('members.edit', $member->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                                            style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                style="margin-left: 5px;"
                                                onclick="return confirm('Are you sure you want to delete this member?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
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
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const categoryRadios = document.querySelectorAll('input[name="category"]');
        const selectBox = document.getElementById("membership_duration");
        const feesInput = document.getElementById("fees");
        const endDateInput = document.getElementById("end_date");
        const categoryGroups = {
            atmiya_student: document.getElementById("atmiya_student_options"),
            atmiya_staff: document.getElementById("atmiya_staff_options"),
            non_atmiya_staff: document.getElementById("non_atmiya_staff_options")
        };

        function updateOptions(selectedCategory) {
            Object.keys(categoryGroups).forEach(category => {
                categoryGroups[category].classList.toggle("d-none", category !== selectedCategory);
            });

            const activeOptions = categoryGroups[selectedCategory].querySelectorAll("option");
            selectBox.innerHTML = '<option value="" disabled selected>Select Duration</option>';
            activeOptions.forEach(option => selectBox.appendChild(option.cloneNode(true)));
            feesInput.value = '';
            feesInput.placeholder = "Select Membership Duration";
            endDateInput.value = '';
        }

        categoryRadios.forEach(radio => {
            radio.addEventListener("change", function() {
                updateOptions(this.value);
                selectBox.selectedIndex = 0;
            });
        });

        updateOptions("atmiya_student");
    });

    $(document).ready(function() {
        $('#membersTable').DataTable({
            "scrollY": "400px",
            "scrollX": true,
            "scrollCollapse": true,
            "paging": true,
            "lengthMenu": [10, 25, 50, 100],
            "responsive": true,
        });

        var feesData = @json($fees);
        var atmiyaStaffFeesData = @json($atmiyaStaffFees);
        var nonAtmiyaStaffFeesData = @json($nonAtmiyaStaffFees);
        var allFees = [...feesData, ...atmiyaStaffFeesData, ...nonAtmiyaStaffFeesData];

        $('#membership_duration').change(function() {
            var selectedDuration = $(this).val();
            var feesAmount = '';

            allFees.forEach(function(fee) {
                if (fee.membership_duration === selectedDuration) {
                    feesAmount = fee.fees_amount;
                }
            });

            if (feesAmount) {
                $('#fees').val(feesAmount);
            } else {
                $('#fees').val('');
                alert('No fee found for the selected membership duration.');
            }
        });

        var currentDate = new Date().toISOString().split('T')[0];
        $('#joining_date').val(currentDate);

        $('#membership_duration, #joining_date').change(function() {
            var joiningDate = $('#joining_date').val();
            var selectedDuration = $('#membership_duration').val();

            if (joiningDate && selectedDuration) {
                var endDate = calculateEndDate(joiningDate, selectedDuration);
                $('#end_date').val(endDate);
            }
        });

        function calculateEndDate(joiningDate, duration) {
            var date = new Date(joiningDate);
            var match = duration.match(/^(\d+)\s*(month|year)s?\s*for\s*(\w+)/i);

            if (match) {
                var value = parseInt(match[1], 10);
                var unit = match[2].toLowerCase();

                if (unit === "month") {
                    date.setMonth(date.getMonth() + value);
                } else if (unit === "year") {
                    date.setFullYear(date.getFullYear() + value);
                }
            } else {
                console.error("Invalid duration: " + duration);
                return null;
            }

            return date.toISOString().split('T')[0];
        }
    });
</script>

@endsection