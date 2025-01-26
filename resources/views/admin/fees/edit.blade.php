@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <div class="container-fluid">
        <div class="card shadow-lg">
            <div class="card-header">
                <span>Edit Fee</span>
            </div>
            <div class="card-body">
                <form action="{{ route('fees.update', $fee->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Membership Duration -->
                        <div class="col-md-12 mb-3">
                            <label for="membership_duration" class="form-label font-weight-bold">Membership Duration</label>
                            <input type="text" name="membership_duration" id="membership_duration"
                                class="form-control shadow-sm"
                                placeholder="Enter Membership Duration"
                                value="{{ old('membership_duration', $fee->membership_duration) }}">
                            @error('membership_duration')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fees Amount -->
                        <div class="col-md-12 mb-3">
                            <label for="fees_amount" class="form-label font-weight-bold">Fees Amount</label>
                            <input type="text" name="fees_amount" id="fees_amount" class="form-control shadow-sm"
                                placeholder="Enter Fees Amount" pattern="^\d+(\.\d{1,2})?$"
                                title="Please enter a valid amount"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                value="{{ old('fees_amount', $fee->fees_amount) }}">
                            @error('fees_amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark rounded-pill d-grid gap-2 col-6 mx-auto">
                            Update Fees
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
