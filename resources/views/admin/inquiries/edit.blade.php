@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <title>Fitness Gym | {{$title}}</title>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <span class="text-secondary">Edit Inquiry</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="text-secondary" href="{{ route('admin.dashboard') }}">home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-secondary" href="{{ route('inquiries') }}">inquiries</a>
                        </li>
                        <li class="breadcrumb-item active">edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow-lg">
            <div class="card-header">
                <span class="m-0">Edit Inquiry</span>
            </div>
            <div class="card-body">
                <form action="{{ route('inquiries.update', $inquiry->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $inquiry->name) }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $inquiry->email) }}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile', $inquiry->mobile) }}" required>
                            @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-control" required onchange="updateStatusOptions()">
                                <option value="male" {{ old('gender', $inquiry->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $inquiry->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $inquiry->age) }}" min="1" max="120" required>
                            @error('age')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date', $inquiry->birth_date) }}" required>
                            @error('birth_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="height_in_inches" class="form-label">Height (in inches)</label>
                            <input type="number" name="height_in_inches" id="height_in_inches" class="form-control" value="{{ old('height_in_inches', $inquiry->height_in_inches) }}" required>
                            @error('height_in_inches')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight', $inquiry->weight) }}" required>
                            @error('weight')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="current_status" class="form-label">Current Status</label>
                            <select name="current_status" id="current_status" class="form-control" required>
                                <option value="">Select Status</option>
                                @if($inquiry->gender == 'male')
                                    @foreach(['Student', 'Business', 'Service/Job', 'Self-employed', 'Retired', 'Other'] as $option)
                                        <option value="{{ strtolower($option) }}" {{ old('current_status', $inquiry->current_status) == strtolower($option) ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                @else
                                    @foreach(['Student', 'Housewife', 'Service/Job', 'Business', 'Self-employed', 'Retired', 'Other'] as $option)
                                        <option value="{{ strtolower($option) }}" {{ old('current_status', $inquiry->current_status) == strtolower($option) ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('current_status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="reference" class="form-label">Reference</label>
                            <input type="text" name="reference" id="reference" class="form-control" value="{{ old('reference', $inquiry->reference) }}" placeholder="How did they hear about us?">
                            @error('reference')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Inquiry Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="pending" {{ old('status', $inquiry->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="hot" {{ old('status', $inquiry->status) == 'hot' ? 'selected' : '' }}>Hot</option>
                                <option value="cold" {{ old('status', $inquiry->status) == 'cold' ? 'selected' : '' }}>Cold</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="medical_conditions" class="form-label">Medical Conditions</label>
                            <textarea name="medical_conditions" id="medical_conditions" class="form-control" rows="3">{{ old('medical_conditions', $inquiry->medical_conditions) }}</textarea>
                            @error('medical_conditions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark rounded-pill d-grid gap-2 col-6 mx-auto">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    // Function to update status options based on gender
    function updateStatusOptions() {
        const gender = document.getElementById('gender').value;
        const statusSelect = document.getElementById('current_status');
        const currentValue = statusSelect.value;
        
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
                opt.selected = currentValue === option.toLowerCase();
                statusSelect.add(opt);
            });
        } else if (gender === 'female') {
            const femaleOptions = ['Student', 'Housewife', 'Service/Job', 'Business', 'Self-employed', 'Retired', 'Other'];
            femaleOptions.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.toLowerCase();
                opt.textContent = option;
                opt.selected = currentValue === option.toLowerCase();
                statusSelect.add(opt);
            });
        }
    }
    
    // Run on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateStatusOptions();
    });
</script>
@endsection