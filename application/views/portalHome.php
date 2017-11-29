  <style>

  </style>
          <!--[if lt IE 8]>
              <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
          <![endif]-->
      <link rel="stylesheet" type="text/css" href="<?=assetUrl()?>plugins/chosen_v1.8.2/chosen.css"/>

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron" style="overflow: hidden; height: 63vh;">
          <div class ="col-lg-7">
            <div style="display: block;float:right;">
            <select class="select" data-placeholder="Select a Contact..."  name="contacts" id="contacts-select" style="width:150%;">
                
                <option></option>
                <?php foreach ($contacts as $key => $value) :?>
                <option value="<?=$value['contact_ID']?>"> <?=$value['first_name']?> <?=$value['last_name']?></option>
                <?php endforeach?>
               
              </select>
              </div>
               <div class="container" style="border:1px solid black;display: block;float:right;margin-top:1em;height: 50vh">
                
                
              </div>
          </div>
          <div class="col-lg-5" onclick="on()" id="item-section">
            <div style="display: block;float:right;">
            <select class="select" data-placeholder="Search for Products"  name="products" id="products-select" style="width:150%;">
                
                <option></option>
                <?php foreach ($products as $key => $value) :?>
                <option value="<?=$value['product_ID']?>"> <?=$value['name']?> - <?=$value['sku']?></option>
                <?php endforeach?>
               
              </select>
              </div>
              <div class="container" style="display: block;float:right;margin-top:1em">
                <table class="table">
                  <tr>
                <?php foreach ($products as $key => $value) :?>
                  <?php if (($key%4)==0):?>
                  </tr><tr>
                  <?php endif ?>
                  <td style="border: 1px solid lightgrey;">
                  <figure style="display:inline-block" width="100px">
                  <img src="<?=assetUrl()?>img/<?=$org_details['name']?>/<?=$value['image']?>" height="100em" >
                  <figcaption style="text-align: center;"><?=$value['name']?></figcaption>
                  </figure>
                </td>
                <?php endforeach ?>
              </tr>
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
             $(document).ready(function(){$("#contacts-select").chosen(); 
                $("#products-select").chosen();
                $('#item-section').block({ 
                message: 'Please select a Contact',
                cursor: 'not-allowed', 
                css: { border: '3px solid black',
                cursor: 'not-allowed'
              } 
            });

            $('#contacts-select').change(function() {
              $('#item-section').unblock(); 
                });
        });

  function off() {
  
  }

          </script>

      </body>
  </html>
