<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <h2>Welcome, {{ $user->name }}</h2>
    <p>Thank you for registering! Please click the button below to verify your email address:</p>
    <a href="{{ $verificationUrl }}"
       style="display: inline-block; padding: 10px 20px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">
        Verify Email
    </a>
    <p>If you did not create an account, no further action is required.</p>
</body>
</html>
