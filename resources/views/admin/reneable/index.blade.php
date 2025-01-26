@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <title>Atmiya Wellness | {{$title}}</title>
    <div class="content-header">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-3">
                <div class="col-sm-6">
                    <span class="text-secondary">Upcoming Renewable </span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="text-secondary" href="{{ route('admin.dashboard') }}">home</a>
                        </li>
                        <li class="breadcrumb-item active">upcoming-reneable</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="card shadow-lg">
            <div class="card-header">
                <span class="m-0">Upcoming Renewable Members</span>
            </div>
            <div class="card-body">
                <div class="table-responsive"> <!-- Added responsive wrapper for table -->
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
                                            <img class="img-rounded" style="border-radius: 5px;padding:10px;margin-top: -10px;"
                                                src="{{ asset('storage/' . $member->image) }}" alt="Image" width="100"
                                                height="auto">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ ucwords($member->name) }}</td>
                                    <td>{{ $member->contact_no }}</td>
                                    <td>{{ ucwords($member->department) }}</td>
                                    <td>{{ $member->semester }}</td>
                                    <td>{{ $member->payment_mode }}</td>
                                    <td>{{ ucwords($member->membership_duration) }}</td>
                                    <td>{{ $member->fees }}</td>
                                    <td style=" white-space: nowrap;">{{ date('d-m-Y', strtotime($member->joining_date)) }}
                                    </td>
                                    <td style=" white-space: nowrap;">{{ date('d-m-Y', strtotime($member->end_date)) }}</td>
                                    <td>
                                        <!-- <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark "
                                                        onclick="return confirm('Are you sure you want to delete this member?')">Delete</button>
                                                </form> -->
                                        <!-- Buttons Container (Flexbox) -->
                                        <div class="d-flex justify-content-center">
                                            <!-- Edit Button -->
                                            <a href="{{ route('members.edit', $member->id) }}"
                                                class="btn btn-dark btn-sm">Edit</a>

                                            <!-- Renew Button -->
                                            <a href="{{ route('members.edit', $member->id) }}"
                                                class="btn btn-success btn-sm" style="margin-left: 5px;">Renew</a>
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
<script>
    $(document).ready(function () {
        $('#membersTable').DataTable({
            "scrollY": "400px",  // Set the fixed height for vertical scrolling
            "scrollX": true,     // Enable horizontal scrolling for wide tables
            "scrollCollapse": true,  // Allow the table to collapse if there are fewer rows
            "paging": true,      // Enable pagination
            "lengthMenu": [10, 25, 50, 100],  // Set options for how many rows to show at once
            "responsive": true,  // Make the table responsive
        });
    });
</script>
@endsection