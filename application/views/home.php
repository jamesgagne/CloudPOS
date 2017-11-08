
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <?php if (!$loggedin) : ?>
        <div class="row">
        <div class="col-md-8">
        <h1>Welcome To CloudPOS!</h1>
       <p>With our cloud based Point Of Sale software, you’ll now have everything you need for your brick and mortar store (or pop-up) to use from anywhere and on any device with internet conectivity. CloudPOS is your complete retail management software in the cloud, giving you complete control.
          </p>
          <p><a class="btn btn-default" href="<?=base_url()?>index.php/About" role="button">View details &raquo;</a></p>
      </div>
    
      
 <div class="col-md-4 bg-primary"> 
          <form class="form-right" role="form" method="post" action="<?=base_url()?>index.php/Home/loginuser">
            <h3>Sign In</h3>
            <div class="form-group">
              <input name="email" id="email" type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input name="password" id="password" type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Log in</button>
            <a href="#" class="btn btn-success">Sign up</a>
          </form>
          <br />
        </div>
        </div>
      </div>
      </div><!--end jumbotron-->
    <div class = "container">
        <div class="row">
        <div class="col-md-4">
          <img src ="<?=assetUrl()?>img/cupatea.jpg" height="200px" />
        </div>
        <div class="col-md-4">
          <img src ="<?=assetUrl()?>img/point-of-sale-hardware-system.jpg" height="200px"/>   
        </div>
        <div class="col-md-4">
          <img src ="<?=assetUrl()?>img/pos_laptop_ipad_combined_webreg.png" height="200px" width="100%"/>
        </div>
        </div>
    </div>
    <?php else :?>
    <div>
      
    </div>
  <?php endif?>
       </div>
     </div>

      <hr>
          <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?=assetUrl()?>js/vendor/bootstrap.min.js"></script>

        <script src="<?=assetUrl()?>js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>

    </body>
</html>
