<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oops.. maintenance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 100px 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: 0 auto;
        }

        .maintenance-image {
            max-width: 500px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ asset('img/errors/503.svg') }}" alt="Maintenance Image" class="maintenance-image">
        <h1>Sorry, the website is undergoing maintenance.</h1>
        <p>Please contact the admin for important matters.</p>
        <p>
            Instagram: <a href="https://www.instagram.com/balai_diklat_kkb_banyumas">UPT Balai Diklat KKB Banyumas</a><br>
            Facebook: <a href="https://facebook.com/bdkkbbanyumas">UPT Balai Diklat KKB Banyumas</a><br>
            Phone: (0281) 6445887
        </p>
    </div>
</body>

</html>
