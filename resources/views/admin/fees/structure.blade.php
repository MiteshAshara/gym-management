@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <title>Atmiya Wellness</title>
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

    <div class="container-fluid">
        <div class="d-flex flex-wrap gap-3">
            <div class="card shadow-lg flex-fill card-hover" style="min-width: 300px;">
                <div class="card-header">
                    <span>Atmiya Student Fees</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Membership Duration</th>
                                <th>Fees Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student as $fee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $fee->membership_duration }}</td>
                                    <td>{{ $fee->fees_amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow-lg flex-fill card-hover" style="min-width: 300px;">
                <div class="card-header">
                    <span>Atmiya Staff Fees</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Membership Duration</th>
                                <th>Fees Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($atmiyaStaffFees as $fee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $fee->membership_duration }}</td>
                                    <td>{{ $fee->fees_amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow-lg flex-fill card-hover" style="min-width: 300px;">
                <div class="card-header">
                    <span>Non-Atmiya Fees</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Membership Duration</th>
                                <th>Fees Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nonAtmiyaStaffFees as $fee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $fee->membership_duration }}</td>
                                    <td>{{ $fee->fees_amount }}</td>
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
