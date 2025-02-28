<!DOCTYPE html>
<html>
<head>
    <title>Login Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .content {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Login Successful</div>
        <div class="content">
            <p>Hello, <strong>{{ $name }}</strong></p>
            <p>You have successfully logged in to your account.</p>
            <p><strong>Login Time:</strong> {{ $time }}</p>
            <p>If this wasn't you, please secure your account immediately.</p>

            <a href={{$verificationUrl}} class="button">Go to Dashboard</a>
        </div>
        <div class="footer">
            <p>Thanks,</p>
            <p><strong>Your Application Team</strong></p>
        </div>
    </div>
</body>
</html>
