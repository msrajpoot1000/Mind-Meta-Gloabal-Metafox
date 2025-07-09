<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
</head>

<body style="margin:0;padding:0;background-color:#f8f9fa;font-family:Arial,sans-serif;">

    <table align="center" width="100%" cellpadding="0" cellspacing="0"
        style="max-width:600px;background:#ffffff;margin:30px auto;border:1px solid #ddd;border-radius:6px;">
        <tr>
            <td
                style="padding:20px;text-align:center;background-color:#28a745;color:#ffffff;border-top-left-radius:6px;border-top-right-radius:6px;">
                <h2 style="margin:0;">Email Verification</h2>
            </td>
        </tr>

        <tr>
            <td style="padding:30px 20px 10px;">
                <p style="font-size:16px;color:#333;">Hello <strong>{{ $user['name'] }}</strong>,</p>

                <p style="font-size:15px;color:#333;margin:20px 0;">
                    Click the button below to verify your email address:
                </p>

                <p style="text-align:center;margin:30px 0;">
                    <a href="{{ $url }}"
                        style="display:inline-block;padding:12px 25px;background:#28a745;color:#fff;text-decoration:none;border-radius:5px;font-size:16px;">
                        Verify Email
                    </a>
                </p>



                <form method="GET" action="{{ route('email.request.send') }}"
                    style="text-align:center; margin:30px 0;">
                    <input type="hidden" name="page" value="page">
                    <input type="hidden" name="email" value="{{ $user['email'] }}">

                    <button type="submit"
                        style="padding:12px 25px; background:#28a745; color:#fff; text-decoration:none; border:none; border-radius:5px; font-size:16px;">
                        Resend OTP
                    </button>
                </form>


                <p style="font-size:14px;color:#555;">
                    This link will expire in <strong>60 minutes</strong>. If you did not create an account, no further
                    action is required.
                </p>
            </td>
        </tr>

        <tr>
            <td
                style="padding:20px;text-align:center;font-size:13px;color:#999;background-color:#f1f1f1;border-bottom-left-radius:6px;border-bottom-right-radius:6px;">
                &copy; {{ date('Y') }} Your Company. All rights reserved.
            </td>
        </tr>
    </table>

</body>

</html>
