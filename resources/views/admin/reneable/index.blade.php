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
                <div class="table-responsive">
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
                                <th>Member Category</th>
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
                                    <!-- <td>
                                            <a href="javascript:void(0);" class="hover-link"
                                                style="font-weight: 600; color: black;"
                                                onclick="sendWhatsAppMessage('{{ $member->contact_no }}', '{{ ucfirst($member->name) }}', '{{ date('d-m-Y', strtotime($member->end_date)) }}')">
                                                {{ $member->contact_no }}
                                            </a>
                                        </td>

                                        <script>
                                            function sendWhatsAppMessage(contactNo, name, endDate) {
                                                // Construct the WhatsApp message
                                                const message = `Hello ${name}, Your subscription ends on ${endDate}. You are renewable.`;

                                                // URL encode the message and create the WhatsApp link
                                                const encodedMessage = encodeURIComponent(message);
                                                const whatsappLink = `https://api.whatsapp.com/send?phone=${contactNo}&text=${encodedMessage}`;

                                                // Open WhatsApp with the generated link
                                                window.open(whatsappLink, '_blank');
                                            }
                                        </script> -->
                                    <td>{{ ucwords($member->department) }}</td>
                                    <td>{{ $member->semester }}</td>
                                    <td>{{ $member->payment_mode }}</td>
                                    <td>
                                                {{ ucwords(explode(' ', $member->membership_duration)[0]) }}
                                                {{ (explode(' ', $member->membership_duration)[0] == 1) ? 'Month' : 'Months' }}
                                            </td>

                                            <td>{{ ucwords(str_replace(['_'], [' '], $member->category)) }}</td>

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
                                        <div class="d-flex justify-content-center">
                                            <!-- <a href="javascript:void(0);" class="btn btn-dark btn-sm viewMember"
                                                data-id="{{ $member->id }}" data-name="{{ $member->name }}"
                                                data-contact="{{ $member->contact_no }}"
                                                data-department="{{ $member->department }}"
                                                data-semester="{{ $member->semester }}"
                                                data-payment="{{ $member->payment_mode }}"
                                                data-duration="{{ $member->membership_duration }}"
                                                data-fees="{{ $member->fees }}"
                                                data-joining="{{ date('d-m-Y', strtotime($member->joining_date)) }}"
                                                data-ending="{{ date('d-m-Y', strtotime($member->end_date)) }}"
                                                data-image="{{ asset('storage/' . $member->image) }}">
                                                View
                                            </a> -->
                                            <!-- <a href="{{ route('members.edit', $member->id) }}"
                                                            class="btn btn-dark btn-sm"  style="margin-left: 5px;">Edit</a> -->

                                            <a href="{{ route('reneable.edit', $member->id) }}"
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

<div class="modal fade" id="memberDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Member Details</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td id="memberName"></td>
                        </tr>
                        <tr>
                            <th>Member Image</th>
                            <td><img id="memberImage" src="" alt="Member Image" width="100"
                                    style="display: none; border-radius: 5px;"></td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td id="memberContact"></td>
                        </tr>
                        <tr>
                            <th>University Department</th>
                            <td id="memberDepartment"></td>
                        </tr>
                        <tr>
                            <th>Study Semester</th>
                            <td id="memberSemester"></td>
                        </tr>
                        <tr>
                            <th>Payment Mode</th>
                            <td id="memberPayment"></td>
                        </tr>
                        <tr>
                            <th>Membership Duration</th>
                            <td id="memberDuration"></td>
                        </tr>
                        <tr>
                            <th>Fees Amount</th>
                            <td id="memberFees"></td>
                        </tr>
                        <tr>
                            <th>Joining Date</th>
                            <td id="memberJoining"></td>
                        </tr>
                        <tr>
                            <th>Ending Date</th>
                            <td id="memberEnding"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#membersTable').DataTable({
            "scrollY": "400px", 
            "scrollX": true,    
            "scrollCollapse": true,  
            "paging": true,     
            "lengthMenu": [10, 25, 50, 100], 
            "responsive": true, 
        });
    });
    $('.viewMember').click(function () {
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
        }

        $('#memberName').text(capitalizeFirstLetter($(this).data('name')));
        $('#memberContact').text($(this).data('contact'));
        $('#memberDepartment').text(capitalizeFirstLetter($(this).data('department')));
        $('#memberSemester').text($(this).data('semester'));
        $('#memberPayment').text($(this).data('payment'));
        $('#memberDuration').text($(this).data('duration'));
        $('#memberFees').text($(this).data('fees'));
        $('#memberJoining').text($(this).data('joining'));
        $('#memberEnding').text($(this).data('ending'));

        let imageUrl = $(this).data('image');

        if (imageUrl && imageUrl !== 'N/A') {
            $('#memberImage').attr('src', imageUrl).show();
        } else {
            $('#memberImage').hide(); 
        }

        $('#memberDetailsModal').modal('show');
    });
</script>
@endsection