@extends('admin.includes.master')

@section('admin.content')
<style>
    .fees-card {
        transition: all 0.3s ease;
        border-radius: 15px !important;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08) !important;
        border: none;
    }
    
    .fees-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12) !important;
    }
    
    .fees-card .card-header {
        padding: 1.25rem;
        border: none;
        position: relative;
        overflow: hidden;
        text-align: center;
    }
    
    .fees-card .card-header::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(45deg);
        z-index: 0;
    }
    
    .fees-card .card-header h3 {
        position: relative;
        z-index: 1;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .fees-card .card-header i {
        font-size: 1.5rem;
        margin-right: 10px;
        vertical-align: middle;
    }
    .fees-card .card-body {
        padding: 1.5rem;
    }
    .fees-table {
        width: 100%;
        margin-bottom: 0;
    }
    .fees-table th {
        font-weight: 600;
        background: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 12px 15px;
        color: #495057;
    }
    .fees-table td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f1f1;
    }
    .fees-table tr:last-child td {
        border-bottom: none;
    }
    .fees-table tr:hover {
        background-color: #f9f9f9;
    }
    .fees-amount {
        font-weight: 700;
        font-size: 1.1rem;
        color: #343a40;
    }
    .duration-badge {
        font-size: 0.85rem;
        padding: 8px 15px;
        border-radius: 20px;
        display: inline-block;
        min-width: 100px;
        text-align: center;
        font-weight: 500;
        transition: all 0.2s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.04);
    }
    .badge-level {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .badge-level-1 {
        background-color: #e3f2fd;
        color: #1976d2;
    }
    .badge-level-2 {
        background-color: #e8f5e9;
        color: #388e3c;
    }
    .badge-level-3 {
        background-color: #fff8e1;
        color: #ff8f00;
    }
    .badge-platinum {
        background: linear-gradient(45deg, #f6d365, #fda085);
        color: white;
    }
    .section-title {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 30px;
        color: #343a40;
    }
    .section-title::after {
        content: ''; 
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: #007bff;
    }
    @media (max-width: 767px) {
        .fees-card {
            margin-bottom: 30px;
        }
        .fees-card .card-header h3 {
            font-size: 1.25rem;
        }
    }
        
    /* Additional styles for PT packages */
    .packages-container {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
        position: relative;
        overflow-x: auto;
        padding-bottom: 10px;
    }
    /* Additional styles for PT packages */
    .package-level {
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 10px;
    }
    .package-level-title {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eee;
    }
    .package-level-title .level-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }
    .package-cards {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
    }
    .package-card {
        min-width: 220px;
        flex: 0 0 auto;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        background: white;
        border: none;
    }
    .package-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.12);
    }
    .package-header {
        padding: 15px;
        text-align: center;
        color: white;
    }
    .package-duration {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }
    .package-body {
        padding: 15px;
        text-align: center;
    }
    .package-price {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .package-features {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: left;
    }
    .package-features li {
        margin-bottom: 8px;
        padding-left: 22px;
        position: relative;
        font-size: 14px;
    }
    .package-features li::before {
        content: "✓";
        position: absolute;
        left: 0;
        font-weight: bold;
    }
    /* Level specific colors */
    .level-1 .level-icon, .level-1 .package-header {
        background: linear-gradient(135deg, #4dabf7 0%, #1976d2 100%);
    }
    .level-1 .package-price {
        color: #1976d2;
    }
    
    .level-1 .package-features li::before {
        color: #1976d2;
    }
    .level-2 .level-icon, .level-2 .package-header {
        background: linear-gradient(135deg, #4caf50 0%, #388e3c 100%);
    }
    .level-2 .package-price {
        color: #388e3c;
    }
    .level-2 .package-features li::before {
        color: #388e3c;
    }
    .level-3 .level-icon, .level-3 .package-header {
        background: linear-gradient(135deg, #ffa726 0%, #f57c00 100%);
    }
    .level-3 .package-price {
        color: #f57c00;
    }
    .level-3 .package-features li::before {
        color: #f57c00;
    }
    .level-platinum .level-icon, .level-platinum .package-header {
        background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
    }
    .level-platinum .package-price {
        color: #ff9800;
    }
    .level-platinum .package-features li::before {
        color: #ff9800;
    }
    .scroll-hint {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        background-color: rgba(255,255,255,0.8);
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        animation: pulse 1.5s infinite;
        z-index: 2;
    }
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(0,0,0,0.2); }
        70% { box-shadow: 0 0 0 10px rgba(0,0,0,0); }
        100% { box-shadow: 0 0 0 0 rgba(0,0,0,0); }
    }
    /* New styles for animated rows */
    .animated-row {
        transition: all 0.3s ease;
    }
    
    .animated-row:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
    }
    .duration-badge {
        font-size: 0.85rem;
        padding: 8px 15px;
        border-radius: 20px;
        display: inline-block;
        min-width: 100px;
        text-align: center;
        font-weight: 500;
        transition: all 0.2s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.04);
    }
    .animated-row:hover .duration-badge {
        background-color: #e9ecef !important;
    }
    .animated-item {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .animated-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        border: 1px solid rgba(0,123,255,0.2);
    }
    .duration-pill {
        transition: all 0.3s ease;
        min-width: 120px;
        text-align: center;
        font-weight: 500;
    }
    .fees-pill {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,123,255,0.2);
    }
    
    .animated-item:hover .duration-pill {
        transform: scale(1.05);
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }
    
    .animated-item:hover .fees-pill {
        background-color: #e9ecef !important;
        transform: scale(1.05);
    }
</style>

<main class="main">
    <title>Fitness Gym | {{$title}}</title>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <span class="text-secondary">Fees Structure</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="text-secondary" href="{{ route('admin.dashboard') }}">home</a>
                        </li>
                        <li class="breadcrumb-item active">fee-structure</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-1">
        <h2 class="section-title">Membership Fee Structure</h2>
        
        <div class="row justify-content-center">
            <!-- General Membership Fees -->
            <div class="col-md-12 mb-4">
                <div class="card fees-card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="card-title mb-0"><i class="fas fa-dumbbell"></i> General Membership</h3>
                    </div>
                    <div class="card-body">
                        <div class="package-level">
                            <div class="packages-container position-relative">
                                <div class="package-cards d-flex justify-content-center">
                                    @forelse($fees as $fee)
                                        @php
                                            preg_match('/(\d+)/', $fee->membership_duration, $matches);
                                            $monthNumber = $matches[1];
                                            $monthText = intval($monthNumber) > 1 ? 'Months' : 'Month';
                                        @endphp
                                        <div class="package-card">
                                            <div class="package-header" style="background: linear-gradient(135deg, #4dabf7 0%, #1976d2 100%);">
                                                <h5 class="package-duration">{{ $monthNumber }} {{ $monthText }}</h5>
                                            </div>
                                            <div class="package-body">
                                                <div class="package-price" style="color: #1976d2;">₹{{ number_format($fee->fees_amount, 0, '.', ',') }}</div>
                                                <ul class="package-features">
                                                    <li>Full gym access</li>
                                                    <li>Workout equipment</li>
                                                    <li>Locker facilities</li>
                                                    <li>Fitness consultation</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center">
                                            <span class="text-muted">No fees found</span>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- General Membership + Aerobics/Zumba Fees -->
            <div class="col-md-12 mb-4">
                <div class="card fees-card">
                    <div class="card-header bg-danger text-white text-center">
                        <h3 class="card-title mb-0"><i class="fas fa-running"></i> Aerobics & Zumba</h3>
                    </div>
                    <div class="card-body">
                        <div class="package-level">
                            <div class="packages-container position-relative">
                                <div class="package-cards d-flex justify-content-center">
                                    @forelse($atmiya_staff_fees as $fee)
                                        @php
                                            preg_match('/(\d+)/', $fee->membership_duration, $matches);
                                            $monthNumber = $matches[1];
                                            $monthText = intval($monthNumber) > 1 ? 'Months' : 'Month';
                                        @endphp
                                        <div class="package-card">
                                            <div class="package-header" style="background: linear-gradient(135deg, #ff4d7e, #e63757);">
                                                <h5 class="package-duration">{{ $monthNumber }} {{ $monthText }}</h5>
                                            </div>
                                            <div class="package-body">
                                                <div class="package-price" style="color: #e63757;">₹{{ number_format($fee->fees_amount, 0, '.', ',') }}</div>
                                                <ul class="package-features">
                                                    <li>Aerobics classes</li>
                                                    <li>Zumba sessions</li>
                                                    <li>Professional instructors</li>
                                                    <li>Music system access</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center">
                                            <span class="text-muted">No fees found</span>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Personal Training Fees - Redesigned to be package-based -->
            <div class="col-md-12 mb-4">
                <div class="card fees-card">
                    <div class="card-header bg-success text-white text-center">
                        <h3 class="card-title mb-0"><i class="fas fa-user-shield"></i> Personal Training Packages</h3>
                    </div>
                    <div class="card-body">
                        @php
                            // Group packages by level
                            $level1Packages = $non_atmiya_staff_fees->filter(function($fee) {
                                return strpos($fee->membership_duration, 'Level 1') !== false;
                            });
                            
                            $level2Packages = $non_atmiya_staff_fees->filter(function($fee) {
                                return strpos($fee->membership_duration, 'Level 2') !== false;
                            });
                            
                            $level3Packages = $non_atmiya_staff_fees->filter(function($fee) {
                                return strpos($fee->membership_duration, 'Level 3') !== false;
                            });
                            
                            $platinumPackages = $non_atmiya_staff_fees->filter(function($fee) {
                                return strpos($fee->membership_duration, 'Platinum') !== false;
                            });
                        @endphp
                        
                        <!-- Level 1 Packages -->
                        @if($level1Packages->count() > 0)
                        <div class="package-level level-1">
                            <div class="package-level-title">
                                <div class="level-icon">
                                   <i class="fas fa-star text-white"></i>
                                </div>
                                <h4>Basic Personal Training - Level 1</h4>
                            </div>
                            <div class="packages-container position-relative">
                                <div class="package-cards d-flex justify-content-center">
                                    @foreach($level1Packages as $fee)
                                        @php
                                            preg_match('/(\d+)/', $fee->membership_duration, $matches);
                                            $monthNumber = $matches[1];
                                            $monthText = intval($monthNumber) > 1 ? 'Months' : 'Month';
                                        @endphp
                                        <div class="package-card">
                                            <div class="package-header">
                                                <h5 class="package-duration">{{ $monthNumber }} {{ $monthText }}</h5>
                                            </div>
                                            <div class="package-body">
                                                <div class="package-price">₹{{ number_format($fee->fees_amount, 0, '.', ',') }}</div>
                                                <ul class="package-features">
                                                    <li>12 PT sessions per month</li>
                                                    <li>Basic fitness assessment</li>
                                                    <li>Equipment orientation</li>
                                                    <li>Workout tracking</li>
                                                    <li>Progress reports</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Level 2 Packages -->
                        @if($level2Packages->count() > 0)
                        <div class="package-level level-2 mt-4">
                            <div class="package-level-title">
                                <div class="level-icon">
                                    <i class="fas fa-star text-white"></i>
                                </div>
                                <h4>Advanced Personal Training - Level 2</h4>
                            </div>
                            <div class="packages-container position-relative">
                                <div class="package-cards d-flex justify-content-center">
                                    @foreach($level2Packages as $fee)
                                        @php
                                            preg_match('/(\d+)/', $fee->membership_duration, $matches);
                                            $monthNumber = $matches[1];
                                            $monthText = intval($monthNumber) > 1 ? 'Months' : 'Month';
                                        @endphp
                                        <div class="package-card">
                                            <div class="package-header">
                                                <h5 class="package-duration">{{ $monthNumber }} {{ $monthText }}</h5>
                                            </div>
                                            <div class="package-body">
                                                <div class="package-price">₹{{ number_format($fee->fees_amount, 0, '.', ',') }}</div>
                                                <ul class="package-features">
                                                    <li>16 PT sessions per month</li>
                                                    <li>Detailed assessment</li>
                                                    <li>Customized plan</li>
                                                    <li>Nutrition guidance</li>
                                                    <li>Progress reports</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Level 3 Packages -->
                        @if($level3Packages->count() > 0)
                        <div class="package-level level-3 mt-4">
                            <div class="package-level-title">
                                <div class="level-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4>Premium Personal Training - Level 3</h4>
                            </div>
                            <div class="packages-container position-relative">
                                <div class="package-cards d-flex justify-content-center">
                                    @foreach($level3Packages as $fee)
                                        @php
                                            preg_match('/(\d+)/', $fee->membership_duration, $matches);
                                            $monthNumber = $matches[1];
                                            $monthText = intval($monthNumber) > 1 ? 'Months' : 'Month';
                                        @endphp
                                        <div class="package-card">
                                            <div class="package-header">
                                                <h5 class="package-duration">{{ $monthNumber }} {{ $monthText }}</h5>
                                            </div>
                                            <div class="package-body">
                                                <div class="package-price">₹{{ number_format($fee->fees_amount, 0, '.', ',') }}</div>
                                                <ul class="package-features">
                                                    <li>20 PT sessions per month</li>
                                                    <li>Detailed assessment</li>
                                                    <li>Customized plan</li>
                                                    <li>Nutrition guidance</li>
                                                    <li>Progress reports</li>
                                                    <li>Weekly progress monitoring</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Platinum Packages -->
                        @if($platinumPackages->count() > 0)
                        <div class="package-level level-platinum mt-4">
                            <div class="package-level-title">
                                <div class="level-icon">
                                    <i class="fas fa-crown"></i>
                                </div>
                                <h4>Elite Platinum Training</h4>
                            </div>
                            <div class="packages-container position-relative">
                                <div class="package-cards d-flex justify-content-center">
                                    @foreach($platinumPackages as $fee)
                                        @php
                                            preg_match('/(\d+)/', $fee->membership_duration, $matches);
                                            $monthNumber = $matches[1];
                                            $monthText = intval($monthNumber) > 1 ? 'Months' : 'Month';
                                        @endphp
                                        <div class="package-card">
                                            <div class="package-header">
                                                <h5 class="package-duration">{{ $monthNumber }} {{ $monthText }}</h5>
                                            </div>
                                            <div class="package-body">
                                                <div class="package-price">₹{{ number_format($fee->fees_amount, 0, '.', ',') }}</div>
                                                <ul class="package-features">
                                                    <li>Unlimited PT sessions</li>
                                                    <li>Elite trainer assignment</li>
                                                    <li>Personalized attention</li>
                                                    <li>Body composition analysis</li>
                                                    <li>Complete nutrition planning</li>
                                                    <li>Personal app dashboard</li>
                                                    <li>VIP gym access times</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection