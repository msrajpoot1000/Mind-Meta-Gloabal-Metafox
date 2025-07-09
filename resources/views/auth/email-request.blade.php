<!DOCTYPE html>
<html>

<head>
    <title>Email Verification</title>
</head>

<body>
    <h2>Request Email Verification</h2>

    @if (session('message'))
        <p style="color:green">{{ session('message') }}</p>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" id="targetDiv" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" onclick="hideDiv()" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif  

    <form method="POST" action="{{ route('email.request.send') }}">
        @csrf
        <label for="email">Enter your email:</label><br>
        <input type="email" name="email" id="email" required>
        <br><br>
        <button type="submit">Send Verification Email</button>
    </form>
</body>

</html>
