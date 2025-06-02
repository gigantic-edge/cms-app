<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
</head>
<body>
    <h1>Hello {{ $user->name }},</h1>
    <p>Your OTP for email verification is:</p>
    <h2>{{ $user->email_otp }}</h2>
    <p>This OTP will expire in 10 minutes.</p>
</body>
</html>
