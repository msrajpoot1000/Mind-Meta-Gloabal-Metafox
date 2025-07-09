<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Password Reset OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .email-header h2 {
            margin: 0;
            font-size: 24px;
        }

        .email-body {
            padding: 30px 25px;
            color: #333333;
            line-height: 1.6;
        }

        .otp-code {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            background-color: #f0f8ff;
            border: 1px dashed #007bff;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            color: #007bff;
        }

        .company-name {
            font-weight: bold;
            color: #007bff;
        }

        .email-footer {
            text-align: center;
            font-size: 13px;
            padding: 20px;
            color: #999999;
            background-color: #f1f1f1;
        }

        @media screen and (max-width: 600px) {
            .email-wrapper {
                width: 100%;
                margin: 0;
            }

            .email-body {
                padding: 20px 15px;
            }

            .otp-code {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-header">
            <h2>Password Reset Request</h2>
        </div>

        <div class="email-body">
            <p>Hello,</p>
            <p>We received a request to reset the password associated with this email:</p>
            <p><strong>Email:</strong> {{ $details['email'] }}</p>

            <p>Please use the following One-Time Password (OTP) to reset your password:</p>
            <div class="otp-code">
                <h1><b>{{ $details['otp'] }}</b></h1>
            </div>

            <p>This OTP is valid for 10 minutes. If you did not request this, you can ignore this email.</p>

            <p>Thanks,<br>
                <span class="company-name">{{ $details['company-name'] }}</span>
            </p>
        </div>

        <div class="email-footer">
            &copy; {{ date('Y') }} {{ $details['company-name'] }}. All rights reserved.
        </div>
    </div>
</body>

</html>
