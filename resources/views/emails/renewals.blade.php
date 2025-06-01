<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Membership Renewals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f7;
            /* Light background */
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .email-header {
            background: #f1f1f1;
            color: black;
            padding: 20px;
            font-size: 24px;
            border-radius: 8px 8px 0 0;
        }

        .email-body {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
            text-align: justify;
            padding: 20px;
        }

        .alert-box {
            background: #ffc107;
            padding: 15px;
            border-radius: 5px;
            font-weight: bold;
            color: #333;
            margin: 20px 0;
        }

        .email-footer {
            background: #f1f1f1;
            padding: 15px;
            font-size: 14px;
            color: #555;
            border-top: 1px solid #ddd;
            border-radius: 0 0 8px 8px;
            margin-top: 20px;
            font-weight: bold;
            text-align: center;
        }

        .email-footer a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            Membership Renewal Reminder
        </div>
        <div class="email-body">
            <p>Dear Admin,</p>
            <p>We want to let you know that <strong style="color: black;font-weight:bolder">{{ $count }}</strong>
                membership is up for renewal in the next 7 days.</p>
            <p>To guarantee a smooth renewal procedure and ongoing support for our esteemed members, kindly take the
                required steps.</p>
            <a href="{{ url('http://127.0.0.1:8000/login') }}" style="text-decoration:none;font-weight:bold;color: black">View the
                Renewable Members List</a>
            <p class="mt-3">Thank you for your dedication to our members. Should you require any assistance, please feel
                free to contact our support team.</p>
        </div>
        <div class="email-footer">
            <p class="fw-bold">Fitness Gym Center</p>
        </div>
    </div>
</body>

</html>