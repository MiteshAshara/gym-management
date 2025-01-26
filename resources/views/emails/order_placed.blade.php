<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 300px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        .order-status {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            color: black;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }

        .footer a {
            color: gray;
            font-weight: 600;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Hi {{ $userName }},</h1>

        <p>Thank you for your order!</p>
        <p>Your order number is: <strong>{{ $orderNumber }}</strong></p>

        <p
            @if($orderStatus=='pending' ) pending
            @elseif($orderStatus=='processing' ) processing
            @elseif($orderStatus=='completed' ) completed
            @elseif($orderStatus=='rejected' ) rejected
            @endif>
            Your order hasbeen : {{ ucfirst($orderStatus) }}.
        </p>

        <p>We appreciate your business and will notify you once your order is processed.</p>

        <p>If you have any questions or need assistance, please contact our support team.</p>

        <div class="footer">
            <p>Best Regards, <br>Furni.in</p>
            <p><a href="{{ url('/') }}">Visit our website</a> for more information.</p>
        </div>

    </div>
</body>

</html>