<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Wed Oct 16 2019 23:46:02 GMT+0000 (UTC)  -->
<html data-wf-page="5da786dd00b10d79c698bf04" data-wf-site="5da766d32783b3459dfbc795">
<head>
  <meta charset="utf-8">
  <title>Publicações</title>
  <meta content="Publicações" property="og:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/app.css" rel="stylesheet" type="text/css">
  <link href="css/js-snackbar.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="iconfinder-icon.svg" type="image/x-icon">
  <style>
    body {
      background-color: #FFFFFF;
    }
    .ui.menu .item img.logo {
      margin-right: 1.5em;
    }
    .main.container {
      margin-top: 7em;
    }
    .wireframe {
      margin-top: 2em;
    }
    .ui.footer.segment {
      margin: 5em 0em 0em;
      padding: 5em 0em;
    }
  </style>
</head>
<body>
  <div class="ui fixed blue inverted menu">
    <div class="ui container">
      <a href="{{route("home")}}" class="header item">
        <img class="logo" src="iconfinder-icon.svg">
        Neex Twitter
      </a>
      <a href="#" class="item">Home</a>
      <div class="right menu">
        <form action="{{route('logout')}}" method="POST">
          @csrf
          <a href="javascript:;" class="ui item logout" style="height:100%;">
            Sair
          </a>
        </form>
      </div>
    </div>
  </div>


  <div id="app">
    @yield('content')
  </div>
  <script src="{{asset('js/js-snackbar.js')}}"></script>
  <script src="{{asset("js/app.js")}}"></script>
  <script src="{{asset("js/semantic.min.js")}}"></script>
  <script>
    $(document).ready(function() {
      $(".logout").on("click", function () {
        $(this).closest("form").submit();
      })
    })
  </script>
</body>
</html>