<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="1"> <!-- Remove this for live site you muppet -->
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title><></title>

    <link rel="stylesheet" href="stylesheets/styles.css">
    <link rel="stylesheet" href="stylesheets/pygment_trac.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php 
      /* Get selected page */
      $page = $_GET[p];
    ?>
    <div class="wrapper">
      
      <header>
        <h1><a href="?" class="sidebar">nick<br>trimble</a></h1>
        <p><br>
          <a href="?p=projects" class="sidebar">Projects</a><br>
          <br><a href="words" class="sidebar">Words</a><br>
        </p>
      </header>

      <section>
        <?php
          /* Include page content */
          if (strcmp($page,"") == 0) { 
            include("home.php");  
          } else if (strcmp($page,"projects") == 0) {
            include("projects.php");
          }
          /* TODO blog link through */ 
          
        ?>
      </section>

      <footer>  
        <p>&copy; 2014</p>
      </footer>
    </div>
    <script src="javascripts/scale.fix.js"></script>  
  </body>
</html>