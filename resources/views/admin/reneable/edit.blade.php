@extends('admin.includes.master')

@section('admin.content')
<style>
    .form-check-input {
        border: 2px solid black;

    }

    .form-check-input:checked {
        border: 2px solid black;
    }
    
    /* Fix for default option display */
    select option.default-option {
        display: block !important;
    }
</style>    
<main class="main">
<title>Fitness Gym | {{$title}}</title>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <span class="text-secondary">Renew Members</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="text-secondary" href="{{ route('admin.dashboard') }}">home</a>
                        </li>
                        <li class="breadcrumb-item active">renew-members</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow-lg">
            <div class="card-header">
                <h5>Renew Member</h5>
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
                                        value="atmiya_student" 
                                        {{ old('category', $member->category ?? 'atmiya_student') == 'atmiya_student' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="atmiya_student">General Membership</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" id="atmiya_staff"
                                        value="atmiya_staff" {{ old('category', $member->category ?? '') == 'atmiya_staff' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="atmiya_staff">General Membership + Aerobic / Zomba</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" id="non_atmiya_staff"
                                        value="non_atmiya_staff" {{ old('category', $member->category ?? '') == 'non_atmiya_staff' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="non_atmiya_staff">Personal Training</label>
                                </div>
                            </div>
                            @error('category')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="membership_duration" class="form-label">Membership Duration</label>
                            <select name="membership_duration" id="membership_duration" class="form-control" required>
                                <option value="" class="default-option" style="display: block !important;">Select Duration</option>
                                <!-- Category-specific duration options -->
                                <optgroup label="General Membership" id="optgroup_atmiya_student">
                                    @foreach($fees as $fee)
                                        <option value="{{ $fee->membership_duration }}" data-category="atmiya_student"
                                            {{ old('membership_duration', $member->membership_duration ?? '') == $fee->membership_duration ? 'selected' : '' }} 
                                            class="category-option atmiya_student-option">
                                            {{ $fee->membership_duration }}
                                        </option>
                                    @endforeach
                                </optgroup>

                                <optgroup label="General Membership + Aerobic / Zomba" id="optgroup_atmiya_staff" style="display:none;">
                                    @foreach($atmiyaStaffFees as $atmiyaStaffFee)
                                        <option value="{{ $atmiyaStaffFee->membership_duration }}" data-category="atmiya_staff"
                                            {{ old('membership_duration', $member->membership_duration ?? '') == $atmiyaStaffFee->membership_duration ? 'selected' : '' }} 
                                            class="category-option atmiya_staff-option">
                                            {{ $atmiyaStaffFee->membership_duration }}
                                        </option>
                                    @endforeach
                                </optgroup>

                                <optgroup label="Personal Training" id="optgroup_non_atmiya_staff" style="display:none;">
                                    @foreach($nonAtmiyaStaffFees as $nonAtmiyaStaffFee)
                                        <option value="{{ $nonAtmiyaStaffFee->membership_duration }}" data-category="non_atmiya_staff"
                                            {{ old('membership_duration', $member->membership_duration ?? '') == $nonAtmiyaStaffFee->membership_duration ? 'selected' : '' }} 
                                            class="category-option non_atmiya_staff-option">
                                            {{ $nonAtmiyaStaffFee->membership_duration }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="fees" class="form-label">Fees Amount</label>
                            <input type="text" name="fees" id="fees" class="form-control"
                                placeholder="Select Membership Duration" readonly
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

                        <div class="row mb-3">
                            <div class="col-md-4 mb-3">
                                <label for="joining_date" class="form-label">Joining Date</label>
                                <input type="date" name="joining_date" id="joining_date" class="form-control"
                                    value="{{ old('joining_date', $member->joining_date) }}">
                                @error('joining_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="end_date" class="form-label">Current End Date</label>
                                <input type="date" id="current_end_date" class="form-control"
                                    value="{{ $member->end_date }}" readonly>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="renewal_date" class="form-label">Renewal End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    value="{{ old('end_date') }}" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark rounded-pill d-grid gap-2 col-6 mx-auto">
                            Renew Member
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
    const membershipDuration = document.getElementById("membership_duration");
    const joiningDateInput = document.getElementById("joining_date");
    const endDateInput = document.getElementById("end_date");
    const feesInput = document.getElementById("fees");
    
    var oldCategory = "{{ old('category', $member->category ?? '') }}";
    var oldMembershipDuration = "{{ old('membership_duration', $member->membership_duration ?? '') }}";
    var oldFees = "{{ old('fees', $member->fees ?? '') }}";

    // Function to handle default category selection and dropdown text
    function setDefaultCategory() {
        // Always default to atmiya_student if no selection exists
        if (!document.querySelector('input[name="category"]:checked')) {
            document.querySelector('input[name="category"][value="atmiya_student"]').checked = true;
        }
        
        // Set default dropdown text for General Membership
        const defaultOption = membershipDuration.querySelector('.default-option');
        if (defaultOption) {
            defaultOption.text = 'Select General Membership Duration';
        }
    }
    
    // Fix for blank dropdown: ensure the default option always exists and is visible
    function ensureDefaultOption() {
        // Check if default option exists
        let defaultOption = membershipDuration.querySelector('.default-option');
        if (!defaultOption) {
            // If it doesn't exist, create it
            defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.className = 'default-option';
            defaultOption.style.display = 'block';
            membershipDuration.insertBefore(defaultOption, membershipDuration.firstChild);
        }
        
        // Always make sure it's visible
        defaultOption.style.display = 'block';
        defaultOption.hidden = false;
        
        // Update text based on selected category
        const selectedCategory = document.querySelector('input[name="category"]:checked')?.value || 'atmiya_student';
        let categoryLabel = "General Membership"; // Default
        
        if (selectedCategory === 'atmiya_staff') {
            categoryLabel = "General Membership + Aerobic / Zomba";
        } else if (selectedCategory === 'non_atmiya_staff') {
            categoryLabel = "Personal Training";
        }
        
        defaultOption.text = `Select ${categoryLabel} Duration`;
        
        // Select it if no other option is selected
        if (!membershipDuration.value) {
            defaultOption.selected = true;
        }
    }

    // Function to filter dropdown options based on selected category
    function filterMembershipOptions() {
        const selectedCategory = document.querySelector('input[name="category"]:checked')?.value || 'atmiya_student';
        
        // Get category label for display
        let categoryLabel = "";
        if (selectedCategory === 'atmiya_student') {
            categoryLabel = "General Membership";
        } else if (selectedCategory === 'atmiya_staff') {
            categoryLabel = "General Membership + Aerobic / Zomba";
        } else if (selectedCategory === 'non_atmiya_staff') {
            categoryLabel = "Personal Training";
        }
        
        // Fix for blank dropdown: ensure the default option always exists and is visible
        ensureDefaultOption();
        
        // Hide all optgroups then show only the relevant one
        document.getElementById('optgroup_atmiya_student').style.display = 'none';
        document.getElementById('optgroup_atmiya_staff').style.display = 'none';
        document.getElementById('optgroup_non_atmiya_staff').style.display = 'none';
        document.getElementById('optgroup_' + selectedCategory).style.display = '';
        
        // Reset selection if it doesn't match the current category
        const currentSelected = membershipDuration.options[membershipDuration.selectedIndex];
        if (currentSelected && currentSelected.getAttribute('data-category') !== selectedCategory 
            && !currentSelected.classList.contains('default-option')) {
            membershipDuration.selectedIndex = 0;
            feesInput.value = '';
        }
    }

    // Initial setup - ensure there's always a default selection
    if (!oldCategory || oldCategory.trim() === '') {
        oldCategory = 'atmiya_student';
        document.querySelector('input[name="category"][value="atmiya_student"]').checked = true;
    } else {
        const categoryInput = document.querySelector(`input[name="category"][value="${oldCategory}"]`);
        if (categoryInput) { // Fixed syntax error here
            categoryInput.checked = true;
        } else {
            // Fallback to default if somehow the value is invalid
            document.querySelector('input[name="category"][value="atmiya_student"]').checked = true;
        }
    }
    
    // Apply default settings immediately on page load
    setDefaultCategory();
    ensureDefaultOption();
    
    // Apply filtering immediately
    filterMembershipOptions();
    
    // Update when category changes
    categoryRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            filterMembershipOptions();
            // Reset fees when category changes
            feesInput.value = '';
            feesInput.placeholder = "Select Membership Duration";
        });
    });

    // Original functions for fees calculation
    var feesData = @json($fees);
    var atmiyaStaffFeesData = @json($atmiyaStaffFees);
    var nonAtmiyaStaffFeesData = @json($nonAtmiyaStaffFees);
    var allFees = [...feesData, ...atmiyaStaffFeesData, ...nonAtmiyaStaffFeesData];

    function updateFees() {
        let selectedDuration = membershipDuration.value;
        if (selectedDuration) {
            let feesAmount = allFees.find(fee => fee.membership_duration === selectedDuration)?.fees_amount || '';
            feesInput.value = feesAmount;
            if (!feesAmount) {
                alert('No fee found for the selected membership duration.');
            }
        } else {
            feesInput.value = '';
            feesInput.placeholder = "Select Membership Duration";
        }
    }

    function calculateEndDate() {
        let selectedDuration = membershipDuration.value;
        let joiningValue = joiningDateInput.value;
        
        if (joiningValue && selectedDuration) {
            let newEndDate = calculateDate(joiningValue, selectedDuration);
            endDateInput.value = newEndDate;
        }
    }

    function calculateDate(startDate, duration) {
        let date = new Date(startDate);
        let match = duration.match(/^([0-9]+)\s*(month|year)s?/i);

        if (match) {
            let value = parseInt(match[1], 10);
            let unit = match[2].toLowerCase();

            if (unit === "month") {
                date.setMonth(date.getMonth() + value);
            } else if (unit === "year") {
                date.setFullYear(date.getFullYear() + value);
            }
        }
        return date.toISOString().split('T')[0];
    }

    // Update end date when membership duration or joining date changes
    membershipDuration.addEventListener("change", function () {
        updateFees();
        calculateEndDate();
    });

    joiningDateInput.addEventListener("change", function () {
        calculateEndDate();
    });

    // Ensure default option shows "Select Duration" text
    function ensureDefaultOption() {
        // Check if default option exists
        let defaultOption = membershipDuration.querySelector('.default-option');
        if (!defaultOption) {
            // If it doesn't exist, create it
            defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.className = 'default-option';
            defaultOption.style.display = 'block';
            membershipDuration.insertBefore(defaultOption, membershipDuration.firstChild);
        }
        
        // Always make sure it's visible
        defaultOption.style.display = 'block';
        defaultOption.hidden = false;
        
        // Update text based on selected category
        const selectedCategory = document.querySelector('input[name="category"]:checked')?.value || 'atmiya_student';
        let categoryLabel = "General Membership"; // Default
        
        if (selectedCategory === 'atmiya_staff') {
            categoryLabel = "General Membership + Aerobic / Zomba";
        } else if (selectedCategory === 'non_atmiya_staff') {
            categoryLabel = "Personal Training";
        }
        
        defaultOption.text = `Select ${categoryLabel} Duration`;
        
        // Select it if no other option is selected
        if (!membershipDuration.value) {
            defaultOption.selected = true;
        }
    }

    // Run necessary setup when the page loads
    window.addEventListener('load', function() {
        setDefaultCategory();
        ensureDefaultOption();
        
        // Force clear fees if no duration selected
        if (!membershipDuration.value || membershipDuration.selectedIndex === 0) {
            feesInput.value = '';
            feesInput.placeholder = "Select Membership Duration";
        }
        
        // Calculate end date if we have joining date and membership duration
        if (joiningDateInput.value && membershipDuration.value) {
            calculateEndDate();
        }
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
    });
});
</script>
@endsection