<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members List</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #007BFF;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }

        td {
            background-color: #fff;
        }

        img {
            width: auto;
            height: 80px;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        .heading {
            color: #007BFF;
            text-decoration: underline;
        }

        .table-container {
            margin: 0 auto;
            width: 100%;
        }

        .header {
            text-align: center;
            font-size: 16px;
            color: #444;
            margin-bottom: 10px;
        }

        @media print {
            body {
                margin: 0;
                padding: 20px;
                font-size: 12px;
            }

            h2 {
                font-size: 20px;
                color: #007BFF;
            }

            .table-container {
                width: 100%;
                margin: 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 6px;
                font-size: 10px;
            }

            img {
                height: 60px;
                width: auto;
            }

            .header {
                font-size: 14px;
                margin-bottom: 10px;
            }

            table {
                page-break-inside: avoid;
            }

            table,
            .header {
                page-break-after: always;
            }

            img {
                max-width: 100px;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Members List</h2>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Photo</th>
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
                </tr>
            </thead>
            <tbody>
                @foreach($members as $index => $member)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($member->image)
                                <img src="{{ storage_path('app/public/' . $member->image) }}" alt="Member Image">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ ucwords($member->name) }}</td>
                        <td>{{ $member->contact_no }}</td>
                        <td>{{ ucwords($member->department) }}</td>
                        <td>{{ $member->semester }}</td>
                        <td>{{ $member->payment_mode }}</td>
                        <td>
                            {{ ucwords(explode(' ', $member->membership_duration)[0]) }}
                            {{ (explode(' ', $member->membership_duration)[0] == 1) ? 'Month' : 'Months' }}
                        </td>

                        <td>{{ ucwords(str_replace(['_', 'staff'], [' ', ''], $member->category)) }}</td>
                        <td>{{ number_format($member->fees, 2) }}</td>
                        <td style="white-space: nowrap;">{{ date('d-m-Y', strtotime($member->joining_date)) }}</td>
                        <td style="white-space: nowrap;">{{ date('d-m-Y', strtotime($member->end_date)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>