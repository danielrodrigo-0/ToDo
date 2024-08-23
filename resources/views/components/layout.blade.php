<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet"></link>
    <link href="{{ asset('bootstrap/dist/css/bootstrap-utilities.css') }}" rel="stylesheet"></link>
    <link rel="stylesheet" href="/assets/css/style.css"/>
    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}" defer></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

<title>{{$page ?? 'Todo'}}</title>
</head>
<body class="vw-100 vh-100">
    <div class="container-fluid d-flex p-0 w-100 h-100">
        <div class="sidebar">
            <img src="/assets/images/logo.png" alt="Logo" class="mw-100"/>
        </div>
        <div class="content">
            <nav class="d-flex align-items-center justify-content-end">
                {{$btn ?? null}}
            </nav>
            <main class="d-flex p-0">
                {{$slot}}
            </main>
        </div>
    </div>
</body>
</html>
