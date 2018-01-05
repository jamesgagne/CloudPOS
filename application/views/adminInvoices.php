  <style>

  </style>
          <!--[if lt IE 8]>
              <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
          <![endif]-->
      <link rel="stylesheet" type="text/css" href="<?=assetUrl()?>plugins/chosen_v1.8.2/chosen.css"/>

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron" style="overflow: scroll; height: 63vh;">
          <div >
           
               <div class="container" style="display: block;overflow:scroll;float:right;margin-top:1em;height: 50vh">
                <table id="items">
                  <thead><th style="text-align: center;">Delete</th><th style="text-align: center;">Edit</span></th><th colspan="3" style="text-align: center;">Order ID</th><th style="text-align: center;">Date</th><th style="text-align: center;">Status</th><th style="text-align: center;">SubTotal</th></thead>
                  <tbody id="itemstbody">
                    <?php foreach ($orders as $key1 => $value1) : ?>
                      <?php foreach ($value1 as $key => $value) :?>
                      <tr id="<?=$value['order_ID']?>"><td><a id='delete<?=$value['order_ID']?>'><span class='glyphicon glyphicon-remove'></a></span></td><td><a id='edit<?=$value['order_ID']?>'> <span class='glyphicon glyphicon-pencil'></span></a></td><td colspan='3'><?=$value['order_ID']?></td><td><?=$value['date']?></td><td><?=$value['status']?></td><td><?=$value['total']?></td></tr>
                    <?php endforeach ?>
                    <?php endforeach ?>

                  </tbody>
                  <tfoot id="itemsfoot"></tfoot>
                </table>
                
                
              </div>
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
              
            
        });





        </script>

      </body>
  </html>
