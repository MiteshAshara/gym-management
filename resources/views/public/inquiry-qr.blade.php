<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Form QR Code - Fitness Gym</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" class="bg-white" sizes="64x64" type="image/png" href="https://static.vecteezy.com/system/resources/thumbnails/017/504/043/small_2x/bodybuilding-emblem-and-gym-logo-design-template-vector.jpg">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a1a1a, #333333);
            color: #fff;
            padding: 30px 15px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            z-index: -1;
        }
        
        .qr-container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
            z-index: 10;
        }
        
        .page-title {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 15px;
            color: #fff;
            text-shadow: 0 3px 10px rgba(0,0,0,0.5);
        }
        
        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, #ff1a1a, #ff5e3a);
            border-radius: 2px;
        }
        
        .card {
            border-radius: 20px;
            border: none;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
            padding: 30px;
            margin-bottom: 30px;
            background: linear-gradient(145deg, #2d2d2d, #222222);
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(to right, #ff1a1a, #ff5e3a);
        }
        
        .card h2 {
            font-weight: 700;
            margin-bottom: 20px;
            color: #ff5e3a;
        }
        
        .qr-code {
            margin: 25px auto;
            padding: 15px;
            background-color: white;
            border-radius: 15px;
            display: inline-block;
            position: relative;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            border: 5px solid #fff;
        }
        
        .qr-code::before {
            content: '';
            position: absolute;
            top: -7px;
            left: -7px;
            right: -7px;
            bottom: -7px;
            border: 2px dashed #ff5e3a;
            border-radius: 15px;
            animation: pulse 2s infinite;
            z-index: -1;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.5;
            }
            100% {
                transform: scale(1);
                opacity: 0.8;
            }
        }
        
        .url-display {
            word-break: break-all;
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            font-size: 1rem;
            background: rgba(255,255,255,0.1);
            border-left: 4px solid #ff5e3a;
        }
        
        .btn-group {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .btn {
            margin: 8px;
            border-radius: 50px;
            padding: 12px 25px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: all 0.6s;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #4a90e2, #063a77);
            border: none;
        }
        
        .btn-success {
            background: linear-gradient(45deg, #43a047, #1b5e20);
            border: none;
        }
        
        .fitness-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: -1;
        }
        
        .fitness-icon {
            position: absolute;
            font-size: 20px;
            color: rgba(255,255,255,0.1);
        }
        
        @media (max-width: 576px) {
            .qr-code {
                padding: 10px;
                margin: 15px auto;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                margin: 5px 0;
            }
        }
        
        /* Added gym elements */
        .gym-element {
            position: absolute;
            color: rgba(255,255,255,0.07);
            z-index: -1;
        }
        
        .dumbbell1 {
            top: 15%;
            right: 10%;
            font-size: 70px;
            transform: rotate(-20deg);
        }
        
        .dumbbell2 {
            bottom: 12%;
            left: 8%;
            font-size: 60px;
            transform: rotate(15deg);
        }
        
        .runner {
            top: 75%;
            right: 12%;
            font-size: 50px;
        }
        
        .bicycle {
            top: 20%;
            left: 12%;
            font-size: 55px;
        }
        
        .heartbeat {
            bottom: 20%;
            right: 15%;
            font-size: 45px;
        }
    </style>
    <!-- Include QR Code library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
<body>
    <!-- Gym background elements -->
    <div class="gym-element dumbbell1"><i class="fas fa-dumbbell"></i></div>
    <div class="gym-element dumbbell2"><i class="fas fa-dumbbell"></i></div>
    <div class="gym-element runner"><i class="fas fa-running"></i></div>
    <div class="gym-element bicycle"><i class="fas fa-biking"></i></div>
    <div class="gym-element heartbeat"><i class="fas fa-heartbeat"></i></div>

    <div class="qr-container">
        <h1 class="page-title">Fitness Gym Inquiry</h1>
        
        <div class="card">
            <div class="d-flex justify-content-center align-items-center mb-4">
                <i class="fas fa-qrcode mr-3" style="font-size: 28px; color: #ff5e3a;"></i>
                <h2 class="mb-0">SCAN ME</h2>
            </div>
            
            <p>Scan this QR code to fill out our gym membership inquiry form</p>
            
            <div class="qr-code">
                <div id="qrcode"></div>
            </div>
            
            <div class="url-display">
                <strong>URL:</strong> {{ $url }}
            </div>
            
            <div class="btn-group">
                <button class="btn btn-primary" onclick="printQrCode()">
                    <i class="fas fa-print mr-2"></i> Print QR Code
                </button>
                <button class="btn btn-success" id="downloadBtn">
                    <i class="fas fa-download mr-2"></i> Download QR Code
                </button>
            </div>
        </div>
    </div>
    
    <script>
        // Generate QR Code
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "{{ $url }}",
            width: 200,
            height: 200,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
        
        // Print QR Code function
        function printQrCode() {
            window.print();
        }
        
        // Download QR Code
        document.getElementById('downloadBtn').addEventListener('click', function() {
            // Get the canvas element from the QR code
            var canvas = document.querySelector('#qrcode canvas');
            
            // Create a temporary link element
            var link = document.createElement('a');
            
            // Set download attributes
            link.download = 'fitness-gym-inquiry-qr-code.png';
            link.href = canvas.toDataURL('image/png').replace('image/png', 'image/octet-stream');
            
            // Click the link to trigger download
            link.click();
        });
    </script>
</body>
</html>
