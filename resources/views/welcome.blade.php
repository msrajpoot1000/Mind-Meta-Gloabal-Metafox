@if (session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif
<h2>Contact Form Message</h2>
<p><strong>Email:</strong> {{ $details['email'] }}</p>
<p><strong>OTP:</strong> <b>{{ $details['otp'] }}</b></p>
