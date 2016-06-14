<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>FGT Project</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="{{URL::asset('css/flat.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js"   integrity="sha256-55Jz3pBCF8z9jBO1qQ7cIf0L+neuPTD1u7Ytzrp2dqo="   crossorigin="anonymous"></script>
<script src="{{URL::asset('js/dateformat.js')}}"></script>
<script src="{{URL::asset('js/feed.js')}}"></script>
</head>
<body>
<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Feed Tool</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/feeds">Home</a></li>
                <li><a href="/admin/sources">Sources</a></li>
                <li><a href="http://www.tutorialrepublic.com/contact-us.php" target="_blank">Managed Feeds</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="jumbotron feed-top">
    <div class="container-fluid">
        <h1>{{$title}}</h1>

    </div>
</div>
<div class="container-fluid">
  @yield('form')
</div>
</body>
</html>
