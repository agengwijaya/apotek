<html lang="en">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
  <meta name="description" content="The login page allows a user to gain access to an application by entering their username and password or by authenticating using a social media login.">
  <title>Login </title>
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&amp;family=Ubuntu:wght@400;500;700&amp;display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ url('css/bootstrap.min.75a07e3a3100a6fed983b15ad1b297c127a8c2335854b0efc3363731475cbed6.css') }}">
  <link rel="stylesheet" href="{{ url('css/nifty.min.4d1ebee0c2ac4ed3c2df72b5178fb60181cfff43375388fee0f4af67ecf44050.css') }}">

</head>

<body class="" style="background-image: url();">
  <div id="bg-overlay" class="bg-img"></div>
  <!-- PAGE CONTAINER -->
  <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <div id="root" class="root front-container">

    <!-- CONTENTS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <section id="content" class="content">
      <div class="content__boxed w-100 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="content__wrap">
          <div class="card shadow-lg">
            <div class="card-body">
              <center>
                <h3>APOTEK</h3>
              </center>
              <div class="text-center mt-3">
                <h1 class="h3">Masuk</h1>
              </div>

              <form class="mt-4" method="POST" action="{{ url('login') }}">
                @csrf
                <div class="mb-3">
                  <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
                </div>

                <div class="mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                </div>

                <div class="d-grid mt-5">
                  <button class="btn btn-primary btn-lg" type="submit">Masuk</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - CONTENTS -->
  </div>

  <!-- Bootstrap JS [ OPTIONAL ] -->
  <script src="{{ url('js/bootstrap.min.bdf649e4bf3fa0261445f7c2ed3517c3f300c9bb44cb991c504bdc130a6ead19.js') }}" defer=""></script>

  <!-- Nifty JS [ OPTIONAL ] -->
  <script src="{{ url('js/nifty.min.b53472f123acc27ffd0c586e4ca3dc5d83c0670a3a5e120f766f88a92240f57b.js') }}" defer=""></script>

</body><!-- Mirrored from themeon.net/nifty/v3.0.1/front-pages/login/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Aug 2022 09:00:58 GMT -->

</html>
