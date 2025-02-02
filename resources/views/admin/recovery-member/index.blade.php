@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <title>Atmiya Wellness | {{$title}}</title>

    <div class="container-fluid mt-5">
        <div class="card shadow-lg">
            <div class="card-header">
                <span class="m-0">View Members</span>
            </div>
            <div class="card-body">
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
                            <th>End Date</th>
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
                                <td>{{ ucwords($member->category) }}</td>
                                <td>{{ $member->fees }}</td>
                                <td style="white-space: nowrap;">{{ date('d-m-Y', strtotime($member->joining_date)) }}</td>
                                <td style="white-space: nowrap;">{{ date('d-m-Y', strtotime($member->end_date)) }}</td>
                                <td>
                                    <form action="{{ route('recover.member', $member->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn btn-dark">Recover</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#membersTable').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                lengthChange: true,
                autoWidth: false,
            });
        });
    </script>
@endpush
@endsection