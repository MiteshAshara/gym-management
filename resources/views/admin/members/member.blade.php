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
    <title>Atmiya Wellness | {{$title}}</title>
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
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

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


                        <div class="col-md-6 mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" name="department" id="department" class="form-control"
                                placeholder="Enter Department" value="{{ old('department') }}">
                            @error('department')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="text" name="semester" id="semester" class="form-control"
                                placeholder="Enter Semester" maxlength="3" pattern="^[0-9]{1,3}$"
                                oninput="this.value = this.value.replace(/[^\d]/g, '')" value="{{ old('semester') }}">
                            @error('semester')
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
                                    <label class="form-check-label" for="atmiya_student">Atmiya Student</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" id="atmiya_staff"
                                        value="atmiya_staff" {{ old('category') == 'atmiya_staff' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="atmiya_staff">Atmiya Staff</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" id="non_atmiya_staff"
                                        value="non_atmiya_staff" {{ old('category') == 'non_atmiya_staff' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="non_atmiya_staff">Non Atmiya Staff</label>
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


                                <optgroup label="Atmiya Student" class="category-group" id="atmiya_student_options">
                                    @foreach($fees as $fee)
                                        <option value="{{ $fee->membership_duration }}">{{ $fee->membership_duration }}
                                        </option>
                                    @endforeach
                                </optgroup>


                                <optgroup label="Atmiya Staff" class="category-group d-none" id="atmiya_staff_options">
                                    @foreach($atmiyaStaffFees as $atmiyaStaffFee)
                                        <option value="{{ $atmiyaStaffFee->membership_duration }}">
                                            {{ $atmiyaStaffFee->membership_duration }}
                                        </option>
                                    @endforeach
                                </optgroup>


                                <optgroup label="Non Atmiya Staff" class="category-group d-none"
                                    id="non_atmiya_staff_options">
                                    @foreach($nonAtmiyaStaffFees as $nonAtmiyaStaffFee)
                                        <option value="{{ $nonAtmiyaStaffFee->membership_duration }}">
                                            {{ $nonAtmiyaStaffFee->membership_duration }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="fees" class="form-label">Fees Amount</label>
                            <input type="text" name="fees" id="fees" class="form-control" placeholder="Membership Fees"
                                readonly>
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
                                    <label for="payment_online" class="form-check-label">Online
                                        Payment</label>
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
                            class="btn btn-dark rounded-pill d-grid gap-2 col-6 mx-auto">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container-fluid mt-5">
        <div class="card shadow-lg">
            <div class="card-header">
                <span class="m-0">View Members</span>
            </div>
            <div class="container-fluid mt-3">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <span class="m-0">View Members</span>
                        <a href="{{ route('members.pdf') }}" class="btn btn-dark float-right">Download PDF</a>
                    </div>
                    <div class="card-body">

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
                                        <th>Member Category</th>
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
                                            <!-- <td>
                                                                                                <a href="https://api.whatsapp.com/send?phone={{ $member->contact_no }}&text=Hello%20{{ ucfirst($member->name) }}%2C%20Your%20subscription%20ends%20on%20{{ date('d-m-Y', strtotime($member->end_date)) }}.%20You%20are%20renewable."
                                                                                                    class="hover-link" style="font-weight: 600; color: black;">
                                                                                                    {{ $member->contact_no }}
                                                                                                </a>
                                                                                            </td> -->
                                            <td>{{ ucwords($member->department) }}</td>
                                            <td>{{ $member->semester }}</td>
                                            <td>{{ $member->payment_mode }}</td>
                                            <td>
                                                {{ ucwords(explode(' ', $member->membership_duration)[0]) }}
                                                {{ (explode(' ', $member->membership_duration)[0] == 1) ? 'Month' : 'Months' }}
                                            </td>

                                            <td>{{ ucwords(str_replace(['_'], [' '], $member->category)) }}</td>

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
    document.addEventListener("DOMContentLoaded", function () {
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

            endDateInput.value = '';
        }
        categoryRadios.forEach(radio => {
            radio.addEventListener("change", function () {
                updateOptions(this.value);
                selectBox.selectedIndex = 0;
            });
        });

        updateOptions("atmiya_student");
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
    });
</script>

@endsection