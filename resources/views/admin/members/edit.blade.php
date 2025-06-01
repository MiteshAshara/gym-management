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
                    <span class="text-secondary">Edit Members</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="text-secondary" href="{{ route('admin.dashboard') }}">home</a>
                        </li>
                        <li class="breadcrumb-item active">edit-members</li>
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
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name"
                                value="{{ old('name', $member->name) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

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


                        <div class="col-md-6 mb-3">
                            <label class="form-label">Member Category</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" id="atmiya_student"
                                        value="atmiya_student" checked {{ old('category') == 'atmiya_student' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="atmiya_student">Male Fees</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" id="atmiya_staff"
                                        value="atmiya_staff" {{ old('category') == 'atmiya_staff' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="atmiya_staff">Female Fees</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" id="non_atmiya_staff"
                                        value="non_atmiya_staff" {{ old('category') == 'non_atmiya_staff' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="non_atmiya_staff">Others Fees</label>
                                </div>
                            </div>
                            @error('category')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="membership_duration" class="form-label">Membership Duration</label>
                            <select name="membership_duration" id="membership_duration" class="form-control">
                                <option value="" disabled {{ old('membership_duration', isset($member) ? $member->membership_duration : '') == '' ? 'selected' : '' }}>Select Duration</option>

                                <!-- Atmiya Student Categories -->
                                <optgroup label="Atmiya Student" id="atmiya_student_options">
                                    @foreach($fees as $fee)
                                        <option value="{{ $fee->membership_duration }}"
                                            {{ old('membership_duration', isset($member) ? $member->membership_duration : '') == $fee->membership_duration ? 'selected' : '' }}>
                                            {{ $fee->membership_duration }}
                                        </option>
                                    @endforeach
                                </optgroup>

                                <optgroup label="Atmiya Staff" class="d-none" id="atmiya_staff_options">
                                    @foreach($atmiyaStaffFees as $atmiyaStaffFee)
                                        <option value="{{ $atmiyaStaffFee->membership_duration }}"
                                            {{ old('membership_duration', isset($member) ? $member->membership_duration : '') == $atmiyaStaffFee->membership_duration ? 'selected' : '' }}>
                                            {{ $atmiyaStaffFee->membership_duration }}
                                        </option>
                                    @endforeach
                                </optgroup>

                                <optgroup label="Non Atmiya Staff" class="d-none" id="non_atmiya_staff_options">
                                    @foreach($nonAtmiyaStaffFees as $nonAtmiyaStaffFee)
                                        <option value="{{ $nonAtmiyaStaffFee->membership_duration }}"
                                            {{ old('membership_duration', isset($member) ? $member->membership_duration : '') == $nonAtmiyaStaffFee->membership_duration ? 'selected' : '' }}>
                                            {{ $nonAtmiyaStaffFee->membership_duration }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="fees" class="form-label">Fees Amount</label>
                            <input type="text" name="fees" id="fees" class="form-control"
                                placeholder="Select a duration to view fee" readonly
                                value="{{ old('fees', $member->fees) }}">
                        </div>

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

                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Member Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @if($member->image)
                                <img src="{{ asset($member->image) }}" alt="Profile Image"
                                    class="img-thumbnail mt-2" width="100">
                            @endif
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3 d-flex gap-3">
                                <div class="w-50">
                                    <label for="joining_date" class="form-label">Joining Date</label>
                                    <input type="date" name="joining_date" id="joining_date" class="form-control"
                                        value="{{ old('joining_date', $member->joining_date) }}">
                                    @error('joining_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-50">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control"
                                        value="{{ old('end_date', $member->end_date) }}" readonly>
                                    @error('end_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                    </div>

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
    document.addEventListener("DOMContentLoaded", function () {
        const categoryRadios = document.querySelectorAll('input[name="category"]');
        const selectBox = document.getElementById("membership_duration");
        const feesInput = document.getElementById("fees");
        const categoryGroups = {
            atmiya_student: document.getElementById("atmiya_student_options"),
            atmiya_staff: document.getElementById("atmiya_staff_options"),
            non_atmiya_staff: document.getElementById("non_atmiya_staff_options")
        };

        var oldCategory = "{{ old('category', $member->category ?? '') }}";
        var oldMembershipDuration = "{{ old('membership_duration', $member->membership_duration ?? '') }}";
        var oldFees = "{{ old('fees', $member->fees ?? '') }}";

        function updateOptions(selectedCategory) {
            Object.keys(categoryGroups).forEach(category => {
                categoryGroups[category].classList.toggle("d-none", category !== selectedCategory);
            });

            const activeOptions = categoryGroups[selectedCategory].querySelectorAll("option");
            selectBox.innerHTML = '<option value="" disabled>Select Duration</option>';
            activeOptions.forEach(option => {
                selectBox.appendChild(option.cloneNode(true));
            });

            if (oldMembershipDuration) {
                selectBox.value = oldMembershipDuration;
            }

            feesInput.value = '';
        }
        categoryRadios.forEach(radio => {
            if (radio.value === oldCategory) {
                radio.checked = true;
                updateOptions(oldCategory);
            }

            radio.addEventListener("change", function () {
                updateOptions(this.value);
                selectBox.selectedIndex = 0;
            });
        });

        $(document).ready(function () {
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

            $('#membership_duration').change(function () {
                var selectedDuration = $(this).val();
                var feesAmount = '';

                allFees.forEach(function (fee) {
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

            $('#membership_duration, #joining_date').change(function () {
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

            if (oldFees) {
                $('#fees').val(oldFees);
            }
        });
    });
</script>


@endsection