<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team | Login</title>
</head>
<body>
    <h1>Login</h1> 

    <form action="{{ route('logging_in') }}" method="post">
        @csrf
        Username:<input type="text" name="username">
        <br>Password:<input type="password" name="password">  
        
        <br><input type="submit" name="login" value="Login">
    </form>

    <h1>Add Team Account</h1> 
    <form action="{{ route('superadmin.add_teamaccount') }}" method="post">
        @csrf
        Username:<input type="text" name="username">
        <br>Password:<input type="password" name="password">  
        
        <br><input type="submit" name="add" value="Add">
    </form>

</body>
</html>
