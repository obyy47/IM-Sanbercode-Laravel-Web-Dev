<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Register</title>
</head>
<body>
    <h1>Register New Account</h1>
    <form action="/welcome" method="POST">
        @csrf
        <label>First Name:</label> <br>
        <input type="text" name="firstname"> <br> <br>
        <label>Last Name:</label> <br>
        <input type="text" name="lastname"> <br> <br>

        <label>Address:</label> <br>
        <textarea name="address" cols="30" rows="10"></textarea> <br> <br>

        <input type="submit" value="Daftar"> <br> <br>
    </form>
    <a href="/">< Back</a>
</body>
</html>