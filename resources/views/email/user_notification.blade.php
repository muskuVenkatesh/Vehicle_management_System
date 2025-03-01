<!DOCTYPE html>
<html>
<head>
    <title>Notification</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .header { background: #007bff; padding: 10px; color: #fff; text-align: center; font-size: 20px; }
        .content { padding: 20px; font-size: 16px; color: #333; }
        .footer { text-align: center; font-size: 14px; color: #666; padding-top: 10px; }
        .button { background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            Admin Notification
        </div>
        <div class="content">
            <p>Hello <strong>{{ $user->name }}</strong>,</p>
            <p>{{ $message }}</p>
            <p>
                <a href="{{ url('/') }}" class="button">Go to Dashboard</a>
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Your Company. All rights reserved.
        </div>
    </div>

</body>
</html>
