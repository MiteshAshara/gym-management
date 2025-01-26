@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <!-- View Members Table -->
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Contact Number</th>
                            <th>Department</th>
                            <th>Semester</th>
                            <th>Payment Mode</th>
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
                                        <img class="img-thumbnail" src="{{ asset('storage/' . $member->image) }}" alt="Image" width="100" height="auto">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ ucwords($member->name) }}</td>
                                <td>{{ $member->contact_no }}</td>
                                <td>{{ ucwords($member->department) }}</td>
                                <td>{{ $member->semester }}</td>
                                <td>{{ $member->payment_mode }}</td>
                                <td>{{ date('d-m-Y', strtotime($member->joining_date)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($member->end_date)) }}</td>
                                <td>
                                    <a href="{{ route('member') }}" class="btn btn-dark">Recover</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Include DataTables Script -->
@push('scripts')
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
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
