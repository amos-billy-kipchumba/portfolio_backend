<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dineN'Stay</title>
</head>

<body>
    {{ $name }}<br />
    {{ $email }}<br />
    {!! html_entity_decode($msg) !!}<br />
</body>

</html>
