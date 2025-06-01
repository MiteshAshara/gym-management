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
                            <input type="text" name="name" id="name" class="form-control" value="{{ $inquiry->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $inquiry->email }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" name="mobile" id="mobile" class="form-control" value="{{ $inquiry->mobile }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="male" {{ $inquiry->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $inquiry->gender == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" id="age" class="form-control" value="{{ $inquiry->age }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="height_in_inches" class="form-label">Height (in inches)</label>
                            <input type="number" name="height_in_inches" id="height_in_inches" class="form-control" value="{{ $inquiry->height_in_inches }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="number" name="weight" id="weight" class="form-control" value="{{ $inquiry->weight }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="pending" {{ $inquiry->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="hot" {{ $inquiry->status == 'hot' ? 'selected' : '' }}>Hot</option>
                                <option value="cold" {{ $inquiry->status == 'cold' ? 'selected' : '' }}>Cold</option>
                            </select>
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
@endsection