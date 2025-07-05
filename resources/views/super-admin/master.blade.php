<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Super Admin</title>
    <link rel="stylesheet" href="../storage/css/super-admin/dashboard.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>
    <div class="">
        @include('../layouts/app-with-sidebar')
        @include('../layouts/navigation')
    </div>
    <div class="main-content">
        @yield('content')
    </div>

    <script></script>
</body>
</html>
