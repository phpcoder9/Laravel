<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from zuramai.github.io/mazer/demo/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Oct 2022 05:22:47 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Mazer Admin Dashboard</title>
  <link rel="stylesheet" href="{{URL('assets/css/main/app.css')}}" />
  <link rel="stylesheet" href="{{URL('assets/css/pages/auth.css')}}" />
  <link rel="shortcut icon" href="{{URL('assets/images/logo/favicon.svg')}}" type="image/x-icon" />
  <link rel="shortcut icon" href="{{URL('assets/images/logo/favicon.png')}}" type="image/png" />
  @notifyCss
</head>

<body>
  <x-notify::notify />
  @yield('content')
  @stack('script')
  @notifyJs
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/app.js"></script>
</body>


</html>