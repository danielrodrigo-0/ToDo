<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet"></link>
    <link href="{{ asset('bootstrap/dist/css/bootstrap-utilities.css') }}" rel="stylesheet"></link>
    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}" defer></script>
    <link rel="stylesheet" href="/assets/css/style.css"/>

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
            <nav class="d-flex flex-row align-items-center justify-content-end" style="height: 100px; width: calc(100vw - 100px); background-color: var(--background-light); padding-right: 10px;">
                <div class="col-8 ps-2">
                    @if(!empty(Auth::user()))
                        <b>Bem vindo</b>: {{Auth::user()->name}}
                    @endif
                </div>
                <div class="col-4 d-flex justify-content-end h-50" style="align-items: center;">
                    {{$btn ?? null}}
                </div>
            </nav>
            <main class="d-flex p-0">
                {{$slot}}
            </main>
        </div>
    </div>
</body>
</html>
