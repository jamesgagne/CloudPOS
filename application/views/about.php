
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
         <div class="jumbotron">
      <div class="container">
        <div class="row">
        <div class="col-md-6">
        <h2>About Us</h2>
       <p><?= $info ?></p>
        <img src="<?=assetUrl()?>/img/logo-mohawk-FR.png"/>
        </div>
    
      
 <div class="col-md-6"> 
          <div class="col-md-4">
            <h4 class="text-primary">Basic</h4>
            <p>This level is perfect for sole proprietorship as it includes only one user role</p>
            <p>$50.00 CAD per month (1 user)</p>  
          </div>
          <div class="col-md-4">
            <h4 class="text-primary">Professional</h4>
            <p>The pro level is designed to suite the needs of small businesses operating out of a single location</p>
            <p>$200.00 CAD per month (5 users)</p> 
          </div>
          <div class="col-md-4">
            <h4 class="text-primary">Enterprise</h4>
            <p>Enterprise subscribers have the ability to add as many users as necessary to suite their large commerce needs</p>
            <p>$1000.00 CAD per month (unlimited users)</p>  
          </div>
        </div>
        </div>
      </div>
      </div><!--end jumbotron-->
      <hr>
          <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?=assetUrl()?>js/vendor/bootstrap.min.js"></script>

        <script src="<?=assetUrl()?>js/main.js"></script>


        

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>