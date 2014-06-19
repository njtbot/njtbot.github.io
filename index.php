<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>njt</title>

    <!-- Google Analytics -->
    <script src="./js/tracking.js"></script>

    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

    <!-- Bootstrap -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/pygment_trac.css">
    <link rel="stylesheet" href="css/styles.css"> 

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>

    <?php $page = $_GET['p']; ?>

      <header>
        <h1><a href="./" class="sidebar"><strike>njt</strike></a></h1>
        <p><br>
          <a href="?p=projects" class="sidebar">Projects</a><br>
          <br><a href="./blog" class="sidebar">Blog</a><br>
        </p>
      </header>

    <div class="wrapper">

      <section>
      
      <?php
        if(strcmp($page,"projects")==0) { include "projects.html"; }
        elseif(strcmp($page,"gpg")==0) { include "njt.html"; }
        else{ include "home.html"; }
      ?>
      </section>

      <footer>
        <div class="row">
          <div class="col-md-1">
            <a href="http://github.com/njtbot">
            <i class="fa fa-github-square"></i></a>
          </div>
          <div class="col-md-1">
            <a href="http://bitbucket.org/ntrimble">
            <i class="fa fa-bitbucket-square"></i></a>
          </div>
          <div class="col-md-1">
            <a href="http://uk.linkedin.com/in/nicktrimble">
            <i class="fa fa-linkedin-square"></i></a>
          </div>
          <div class="col-md-1">
            <a href="http://twitter.com/trimboone">
            <i class="fa fa-twitter-square"></i></a>
          </div>
          <div class="col-md-1">
            <a href="mailto:nick.trimble@gmail.com">
            <i class="fa fa-envelope"></i></a>
          </div>
        </div>

        <!--<p class="small">&copy; 2014</p>-->
      </footer>
    </div>
    <script src="js/scale.fix.js"></script> 
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  </body>
</html>
