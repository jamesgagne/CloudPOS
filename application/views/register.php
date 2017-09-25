
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
         <div class="jumbotron">
      <div class="container">
        <div class="row">
        <div class="col-md-6" id="formRow">
        <h2>Contact Us</h2>
         <form class="form-left" role="form" action="<?=base_url()?>index.php?/Contact" method="post">
            <div class="form-group">
              <input id="email" name="Email" type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input id="name" type="text" name="Name" placeholder="Name" class="form-control">
            </div>
            <div class="form-group">
              <textarea id="msg" name="Message" placeholder="Message" class="form-control" rows="10"></textarea>
              <input type="hidden" name="formSubmit" value="true">
            </div>
            <button id="submit" type="submit" class="btn btn-success">Submit</button>
            <a href="<?=base_url()?>index.php/Contact/reset" class="btn btn-warning">Reset</a>
          </form>

        </div>
        
    
      
 <div class="col-md-6"> 
  <br />
  <br />
  <br />
  <p id="contacts">Please allow for 2-3 business days for response. We will try to get back to you as soon as possible however, it could take up to 3 business days for us to reach your request. Thanks for your patience in advance from our team here at CloudPOS</p>
 </div>
 </div>
         </div>
      </div><!--end jumbotron-->
      <hr>
          <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=assetUrl()?>js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?=assetUrl()?>js/vendor/bootstrap.min.js"></script>

        <script src="<?=assetUrl()?>js/main.js"></script>


        

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=assetUrl()?>js/vendor/jquery-1.12.0.min.js"><\/script>')</script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
        <script>
$(document).ready(function() {  
  $("#submit").click(function(event){
    event.preventDefault();
    name = $("#name").val();
    email = $("#email").val();
    msg = $("#msg").val();
    $.post("<?=base_url()?>index.php/Contact/submit/"+encodeURIComponent(name)+"/"+encodeURIComponent(email)+"/"+encodeURIComponent(msg),
  function (data)
  {
  var obj = JSON.parse(data);
  $("#formRow").append(obj);
  $('.form-left').trigger("reset");
  });

   
   
  return false;
  });
});

</script>
    </body>