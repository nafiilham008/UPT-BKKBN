<!DOCTYPE html>
<html>

<head>
    <title>Verification Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 32px;
            color: #3754C1;
            margin-top: 0;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #666666;
            line-height: 1.5;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Verification Code</h1>
        <p>Thank you for registering. Your verification code is:</p>
        <h2>{{ $verificationCode }}</h2>
        <p>Please use this code to verify your account.</p>
    </div>
</body>

</html>
