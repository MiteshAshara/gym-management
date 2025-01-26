@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <title>Atmiya Wellness | {{$title}}</title>
    <div class="content-header">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-3">
                <div class="col-sm-6">
                    <span class="text-secondary">Fees Management</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="text-secondary" href="{{ route('admin.dashboard') }}">home</a>
                        </li>
                        <li class="breadcrumb-item active">fees-management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow-lg">
            <div class="card-header">
                <span class="m-0">Manage Fees</span>
            </div>
            <div class="card-body">
                <form action="{{ route('fees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Membership Duration -->
                        <div class="col-md-12 mb-3">
                            <label for="membership_duration" class="form-label font-weight-bold">Membership
                                Duration</label>
                            <input type="text" name="membership_duration" id="membership_duration"
                                class="form-control shadow-sm" placeholder="Enter Membership Duration"
                                value="{{ old('membership_duration') }}" required>
                            @error('membership_duration')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fees Amount -->
                        <div class="col-md-12 mb-3">
                            <label for="fees_amount" class="form-label font-weight-bold">Fees Amount</label>
                            <input type="text" name="fees_amount" id="fees_amount" class="form-control shadow-sm"
                                placeholder="Enter Fees Amount" pattern="^\d+(\.\d{1,2})?$"
                                title="Please enter a valid amount"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                value="{{ old('fees_amount') }}" required>
                            @error('fees_amount')
                                <span class="text-dark">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark rounded-pill d-grid gap-2 col-6 mx-auto">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Fees Section -->
    <div class="container-fluid">
        <div class="card shadow-lg">
            <div class="card-header">
                <span class="m-0">View Fees</span>
            </div>
            <div class="card-body">
                <!-- Add table-responsive class here for mobile responsiveness -->
                <div class="table-responsive">
                    <table id="feesTable" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Membership Duration</th>
                                <th>Fees Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fee as $f)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $f->membership_duration }}</td>
                                    <td>{{ $f->fees_amount }}</td>
                                    <td>
                                        <!-- Buttons Container (Flexbox) -->
                                        <div class="d-flex justify-content-center">
                                            <!-- Edit Button -->
                                            <a href="{{ route('fees.edit', $f->id) }}" class="btn btn-dark btn-sm">Edit</a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('fees.delete', $f->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-dark btn-sm" style="margin-left: 5px;"
                                                    onclick="return confirm('Are you sure you want to delete this fee?')">Delete</button>
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
@endsection