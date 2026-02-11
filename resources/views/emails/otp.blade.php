<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f4f4; padding:20px;">

    <div style="max-width:600px; margin:auto; background:white; padding:30px; border-radius:8px;">
        
        <h2>Hello {{ $name }},</h2>

        <p>Thank you for registering.</p>

        <p>Your One Time Password (OTP) is:</p>

        <h1 style="letter-spacing:5px; text-align:center; color:#2563eb;">
            {{ $otp }}
        </h1>

        <p>This OTP will expire in 5 minutes.</p>

        <p>If you did not create this account, please ignore this email.</p>

        <br>

        <p>Thanks,<br>{{ config('app.name') }}</p>

    </div>

</body>
</html>
