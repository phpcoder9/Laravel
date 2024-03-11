<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - Mazer Admin Dashboard</title>

  <link rel="stylesheet" href="assets/css/main/app.css" />
  <link rel="stylesheet" href="assets/css/main/app-dark.css" />
  <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon" />
  <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png" />
  <link rel="stylesheet" href="assets/css/shared/iconly.css" />
    @notifyCss
    @stack('css')
</head>

<body>
    <x-notify::notify />    
    <script src="assets/js/initTheme.js"></script>
    <div id="app">
        @include('includes.sidebar')
        <div id="main">
            <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
            </header>
            <div class="page-heading">
                <h3>{{session('page-title')}}</h3>
            </div>
            @yield('content')
            <footer>
            <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p>2021 &copy; Shubham</p>
            </div>
            <div class="float-end">
                <p>
                Crafted with
                <span class="text-danger"><i class="bi bi-heart"></i></span> by
                <a href="https://saugi.me/">Shubham</a>
                </p>
            </div>
            </div>
      </footer>
        </div>
    </div>
    @stack('script')
    @notifyJs
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
</body>
</html>