<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Appointment Booking</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                    <tr>
                        <td style="background-color: #4CAF50; padding: 20px; color: #ffffff; text-align: center;">
                            <h2 style="margin: 0;">New Appointment Booking</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px;">
                            <table width="100%" cellpadding="10" cellspacing="0"
                                style="font-size: 16px; line-height: 1.6;">
                                <tr>
                                    <td width="30%" style="font-weight: bold;">Name:</td>
                                    <td>{{ $appointment['name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Email:</td>
                                    <td>{{ $appointment['email'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Country Code:</td>
                                    <td>{{ $appointment['country_code'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Phone:</td>
                                    <td>{{ $appointment['phone'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">User (Date & Time):</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment['user_date_time'])->format('d-m-Y h:i A') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Admin (Date & Time):</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment['admin_date_time'])->format('d-m-Y h:i A') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Timezone:</td>
                                    <td>{{ $appointment['timezone'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Message:</td>
                                    <td>{{ $appointment['message'] }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="background-color: #f4f4f4; padding: 15px; text-align: center; font-size: 12px; color: #888;">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
