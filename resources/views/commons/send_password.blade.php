<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <a href="{{request()->getHttpHost()}}/auth/change-password/token={{$token}}">{{request()->getHttpHost()}}/auth/change-password/token={{$token}}</a>
</body>
</html>
