  <style>

  </style>
          <!--[if lt IE 8]>
              <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
          <![endif]-->
      <link rel="stylesheet" type="text/css" href="<?=assetUrl()?>plugins/chosen_v1.8.2/chosen.css"/>

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron" style="overflow: scroll; height: 63vh;">
          <div class ="col-sm-2">
            
               <div class="container" style="display: block;overflow:scroll;float:right;margin-top:1em;height: 50vh">
                
                <ul class="customBar">
                 <li><a href="" id="productsLink">Products</a></li>
                 <li><a href="<?=base_url()?>index.php/Users" id="usersLink">Users</a></li>
                 <li><a href="" id="reportsLink">Reports</a></li>
                 <li><a href="" id="accountsLink">My Account</a></li>
                 <li><a href="" id="invoicesLink">Invoices</a></li>
                </ul>
                
              </div>
          </div>
          <div class="col-md-10" id="content-section" style="overflow: scroll;">
          
          </div>
         
       </div>

        <hr>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
          <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

          <script src="<?=assetUrl()?>js/vendor/bootstrap.min.js"></script>

          <script src="<?=assetUrl()?>js/main.js"></script>
          <script src="<?=assetUrl()?>plugins/chosen_v1.8.2/chosen.jquery.js"></script>
          <script src="<?=assetUrl()?>plugins/blockUI/jquery.blockUI.js"></script>

          <script>
             $(document).ready(function(){
              //
                $("#productsLink").click(function(event){
                  event.preventDefault();
                  $.get("<?=base_url()?>index.php/Products",
                  function (data)
                  {
                    $("#content-section").html(data);
                  });
                });
                $("#invoicesLink").click(function(event){
                  event.preventDefault();
                  $.get("<?=base_url()?>index.php/Invoices/getNoTemplate",
                  function (data)
                  {
                    $("#content-section").html(data);
                  });
                });
               


              //  
              });


        </script>

      </body>
  </html>
