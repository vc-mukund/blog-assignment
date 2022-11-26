<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Verify Email</title>
</head>
<body>

    <body>
        <h2>Welcome to the assignment {{$user['fname']}}</h2>
        
        <h5>Your registered email-id is <b>{{ $user['email'] }}</b> , Please click on the below link to verify your email account</h5>
        
        <a href="{{ route('verify', $user->verifyUser->token) }}" > Verify Email</a>
        </body>

</body>
</html>