<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Gym - Inquiry Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .inquiry-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px 0;
        }
        .logo {
            max-width: 120px;
            margin-bottom: 15px;
        }
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .card-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
            padding: 20px;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px;
            height: auto;
        }
        .btn-submit {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            border-radius: 8px;
            padding: 12px 0;
            font-weight: 600;
        }
        .error-text {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        
        /* Add styling for new elements */
        .textarea-container {
            position: relative;
        }
        
        textarea.form-control {
            min-height: 100px;
        }
        
        .char-count {
            position: absolute;
            right: 10px;
            bottom: 10px;
            font-size: 0.8rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="inquiry-container">
        <div class="header">
            <h1>Fitness Gym Center</h1>
            <p class="text-muted">Fill out this form to inquire about our gym membership</p>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h3 class="m-0">Membership Inquiry Form</h3>
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('public.inquiry.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Full Name *</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email Id" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">Contact Number *</label>
                                <input 
                                    type="tel" 
                                    name="mobile" 
                                    id="mobile" 
                                    class="form-control" 
                                    value="{{ old('mobile') }}" 
                                    placeholder="10-digit mobile number" 
                                    pattern="[0-9]{10}" 
                                    maxlength="10"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    title="Please enter exactly 10 digits"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Gender *</label>
                                <select name="gender" id="gender" class="form-control" required onchange="updateStatusOptions()">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birth_date">Birth Date *</label>
                                <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="age">Age *</label>
                                <input type="number" name="age" id="age" class="form-control" value="{{ old('age') }}" min="10" max="99" placeholder="Enter Age" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="height_value">Height *</label>
                                <div class="input-group">
                                    <input 
                                        type="number" 
                                        name="height_value" 
                                        id="height_value" 
                                        class="form-control" 
                                        value="{{ old('height_value', old('height_in_inches')) }}" 
                                        step="0.01"
                                        min="1" 
                                        placeholder="Enter Height" 
                                        required>
                                    <div class="input-group-append">
                                        <select class="form-control" id="height_unit" onchange="convertHeight()">
                                            <option value="in">inches</option>
                                            <option value="cm">cm</option>
                                        </select>
                                    </div>
                                    <!-- Hidden field to store height in inches for database -->
                                    <input type="hidden" name="height_in_inches" id="height_in_inches" value="{{ old('height_in_inches') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="weight">Weight (kg) *</label>
                                <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight') }}" placeholder="Enter Weight" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="current_status">Current Status *</label>
                                <select name="current_status" id="current_status" class="form-control" required>
                                    <option value="">Select Status</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reference">How did you hear about us?</label>
                                <input type="text" name="reference" id="reference" class="form-control" value="{{ old('reference') }}" placeholder="Friend, Social Media, etc.">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="medical_conditions">Medical Conditions</label>
                        <div class="textarea-container">
                            <textarea name="medical_conditions" id="medical_conditions" class="form-control" maxlength="500" placeholder="Please list any medical conditions (e.g., BP, diabetes, injuries) that we should be aware of">{{ old('medical_conditions') }}</textarea>
                            <span class="char-count">0/500</span>
                        </div>
                        <small class="text-muted">This information helps us tailor your fitness program appropriately.</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-submit btn-block mt-4">Submit Inquiry</button>
                </form>
            </div>
        </div>
        
        <p class="text-center mt-4 text-muted">&copy; {{ date('Y') }} Fitness Gym Center. All Rights Reserved.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
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
                    opt.selected = "{{ old('current_status') }}".toLowerCase() === option.toLowerCase();
                    statusSelect.add(opt);
                });
            } else if (gender === 'female') {
                const femaleOptions = ['Student', 'Housewife', 'Service/Job', 'Business', 'Self-employed', 'Retired', 'Other'];
                femaleOptions.forEach(option => {
                    const opt = document.createElement('option');
                    opt.value = option.toLowerCase();
                    opt.textContent = option;
                    opt.selected = "{{ old('current_status') }}".toLowerCase() === option.toLowerCase();
                    statusSelect.add(opt);
                });
            }
        }
        
        // Character counter for textarea
        document.getElementById('medical_conditions').addEventListener('input', function() {
            const maxLength = 500;
            const currentLength = this.value.length;
            this.nextElementSibling.textContent = `${currentLength}/${maxLength}`;
            
            if (currentLength >= maxLength) {
                this.nextElementSibling.style.color = '#dc3545';
            } else {
                this.nextElementSibling.style.color = '#6c757d';
            }
        });
        
        // Handle height conversion between inches and centimeters
        function convertHeight() {
            const heightValue = parseFloat(document.getElementById('height_value').value) || 0;
            const heightUnit = document.getElementById('height_unit').value;
            let heightInInches;
            
            if (heightUnit === 'cm') {
                // Convert cm to inches (1 inch = 2.54 cm) and round to nearest integer
                heightInInches = Math.round(heightValue / 2.54);
            } else {
                // Already in inches - ensure it's an integer
                heightInInches = Math.round(heightValue);
            }
            
            // Update the hidden field with the value in inches (as integer)
            document.getElementById('height_in_inches').value = heightInInches;
        }
        
        // Initialize height fields and add event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the status options on page load
            updateStatusOptions();
            
            // Initialize character count
            const medicalConditions = document.getElementById('medical_conditions');
            if (medicalConditions.value) {
                const currentLength = medicalConditions.value.length;
                medicalConditions.nextElementSibling.textContent = `${currentLength}/500`;
            }
            
            // Set up height conversion
            const heightValue = document.getElementById('height_value');
            heightValue.addEventListener('input', convertHeight);
            
            // Initial conversion to set the hidden field
            convertHeight();
        });
    </script>
</body>
</html>
