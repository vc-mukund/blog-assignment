<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Create</title>
</head>
<body>
        <h4>
            Hi {{ $user['fname'] }} {{ $user['lname'] }},
        </h4>
      
      <h5>
        Welcome to Laravel-Assignment. Please find your login details below.
      </h5>
      
      <p><b>Email Id:</b> {{ $user['email'] }}</p>
      <p><b>Password:</b> {{ $user['password'] }}</p>
      
      <p>
        <b>Click here: </b><a href="{{ route('login') }}">To Login in Laravel-Assignment</a>
      </p>
      
      <p>
        Thank You,<br/>
        {{-- <a hr">Formyoula</a><br/> --}}
      </p>
      
      
</body>
</html>