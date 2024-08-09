<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

<title>{{$page ?? 'Todo'}}</title>
    <link rel="stylesheet" href="/assets/css/style.css"/>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <img src="/assets/images/logo.png" alt="Logo"/>
        </div>
        <div clss="content">
            <nav>
                {{$btn ?? null}}
            </nav>
            <main>
                {{$slot}}
            </main>
        </div>
    </div>
</body>
</html>
