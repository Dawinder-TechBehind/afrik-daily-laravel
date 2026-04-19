<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>
<body style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; background-color: #f4f7f6; margin: 0; padding: 0; color: #374151;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f7f6; padding: 40px 20px; width: 100%;">
        <tr>
            <td align="center">
                <!-- Main Container -->
                <table cellpadding="0" cellspacing="0" border="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); border: 1px solid #eef0f2;">
                    
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color: #0FA64B; padding: 30px 20px;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 26px; font-weight: 700; letter-spacing: 1px;">
                                {{ config('app.name', 'Afrik Daily') }}
                            </h1>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td align="center" style="padding: 40px 30px;">
                            <h2 style="font-size: 22px; color: #111827; margin: 0 0 20px 0; text-align: center;">Hello {{ $name }},</h2>
                            
                            <p style="font-size: 16px; line-height: 1.6; color: #4b5563; margin: 0 0 25px 0; text-align: center;">
                                Thank you for registering with us. To complete your account verification, please use the following One-Time Password (OTP).
                            </p>
                            
                            <!-- OTP Box -->
                            <div style="background-color: #f0fdf4; border: 2px dashed #0FA64B; border-radius: 8px; padding: 25px; margin: 30px auto; max-width: 300px; text-align: center;">
                                <h1 style="font-size: 38px; font-weight: 700; color: #0FA64B; letter-spacing: 10px; margin: 0;">
                                    {{ $otp }}
                                </h1>
                            </div>
                            
                            <p style="font-size: 15px; color: #6b7280; text-align: center; margin: 0 0 35px 0;">
                                This OTP is valid for the next <strong style="color: #111827;">5 minutes</strong>.
                            </p>
                            
                            <!-- Warning Box -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-radius: 6px; overflow: hidden; margin-bottom: 25px;">
                                <tr>
                                    <td style="background-color: #fffbeb; border-left: 4px solid #F59E0B; padding: 16px; font-size: 14px; color: #92400e; line-height: 1.5; text-align: left;">
                                        <strong style="color: #b45309;">⚠️ Security Notice:</strong> Do not share this OTP with anyone. Our team will never ask for your password or OTP.
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 14px; color: #6c6d70; text-align: center; margin: 0;">
                                If you did not request this verification, please ignore this email or contact support.
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color: #f9fafb; padding: 25px 30px; border-top: 1px solid #eef0f2;">
                            <p style="font-size: 14px; color: #4b5563; margin: 0 0 8px 0; text-align: center;">Regards,</p>
                            <p style="font-size: 16px; font-weight: 600; color: #111827; margin: 0 0 20px 0; text-align: center;">The {{ config('app.name') }} Team</p>
                            <p style="font-size: 12px; color: #9ca3af; margin: 0; text-align: center;">
                                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
