<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>GGT Login</title>
  <meta name="description" content="Flat UI Kit Free is a Twitter Bootstrap Framework design and Theme, this responsive framework includes a PSD and HTML version."/>

  <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">

  <!-- Loading Bootstrap -->
  <link href="dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Loading Flat UI -->
  <link href="dist/css/flat-ui.css" rel="stylesheet">
  <link href="docs/assets/css/demo.css" rel="stylesheet">

  <link rel="shortcut icon" href="img/favicon.ico">
</head>
<body>
  <div class="login-screen" style="height: 100vh;">
    <div class="login-icon">
      <img src="img/login/icon.png" alt="Welcome to Mail App">
      <h4>Welcome to <small>Mail App</small></h4>
    </div>

    <div class="login-form">
      <div class="form-group">
        <input type="text" class="form-control login-field" value="" placeholder="Enter your name" id="login-name">
        <label class="login-field-icon fui-user" for="login-name"></label>
      </div>

      <div class="form-group">
        <input type="password" class="form-control login-field" value="" placeholder="Password" id="login-pass">
        <label class="login-field-icon fui-lock" for="login-pass"></label>
      </div>

      <a class="btn btn-primary btn-lg btn-block" href="#">Log in</a>
      <a class="login-link" href="#">Lost your password?</a>
    </div>
  </div>
  <script src="dist/js/vendor/jquery.min.js"></script>
  <script src="dist/js/vendor/video.js"></script>
  <script src="dist/js/flat-ui.min.js"></script>
  <script src="docs/assets/js/application.js"></script>
</body>
</html>
