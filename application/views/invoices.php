  <style>

  </style>
          <!--[if lt IE 8]>
              <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
          <![endif]-->
      <link rel="stylesheet" type="text/css" href="<?=assetUrl()?>plugins/chosen_v1.8.2/chosen.css"/>

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron" style="overflow: scroll; height: 63vh;">
          <div class ="col-lg-7">
            <div style="display: block;float:right;">
             <?php if ($activate) :?>
             
            
            <?php endif?> 
                        <select class="select" data-placeholder="Select a Contact..."  name="contacts" id="contacts-select" style="width:100%;">
                <option value="" disabled>Please Select </option>
                <?php foreach ($contacts as $key => $value) :?>
                <option value="<?=$value['contact_ID']?>"> <?=$value['first_name']?> <?=$value['last_name']?>

                </option>
                <?php endforeach?>
               
              </select>
              </div>
               <div class="container" style="border:1px solid black;display: block;overflow:scroll;float:right;margin-top:1em;height: 50vh">
                <table id="items">
                  <thead><th style="text-align: center;">Delete</th><th style="text-align: center;">Edit</span></th><th colspan="3" style="text-align: center;">Order ID</th><th style="text-align: center;">Date</th><th style="text-align: center;">Status</th><th style="text-align: center;">SubTotal</th><th style="text-align: center;">View</th></thead>
                  <tbody id="itemstbody"></tbody>
                  <tfoot id="itemsfoot"></tfoot>
                </table>
                
                
              </div>
          </div>
          <div class="col-lg-5" id="invoice-section">
            
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
              console.log(<?= $current_order[0]['order_ID']?>);
              $("#contacts-select").chosen(); 
                 $('#contacts-select').val(<?= $current_order[0]['contact_ID']?>);
                 $('#contacts-select').trigger("chosen:updated");
                  $("#contacts-select").on('change', function () {
                  window.location.href = "<?=base_url()?>index.php/Invoices/getContactCurrentOrder/"+$("#contacts-select").val();
                });
                <?php if ($activate):?>
                getOrders(<?=$current_order[0]['contact_ID']?>);
                <?php endif ?>
                         
            
        });

function getOrders(contact_ID){
   $.get("<?=base_url()?>index.php/Invoices/getOrders/"+contact_ID,
  function (data)
  {
    var obj = JSON.parse(data);
    $("#itemstbody").html("");
   $.each(obj, function(key, value){
    $("#itemstbody").append("  <tr id="+value['order_ID']+"><td><a id='delete"+value['order_ID']+"'><span class='glyphicon glyphicon-remove'></a></span></td><td><a id='edit"+value['order_ID']+"'> <span class='glyphicon glyphicon-pencil'></span></a></td><td colspan='3'>"+value['order_ID']+"</td><td>"+value['date']+"</td><td>"+value['status']+"</td><td>"+value['total']+"</td><td><a id='view"+value['order_ID']+"'><span class='glyphicon glyphicon-hand-right'></a></span></td></tr>");

    
    $("#delete"+value['order_ID']).click(function(event){
      if (value['status']=="paid"){
        alert('Paid orders Cannot be deleted');
      }

    });
    $("#edit"+value['order_ID']).click(function(event){
      if (value['status']=='paid'){
        alert('Paid orders Cannot be edited');
      }
      else{
        $.post( "<?=base_url()?>index.php/Invoices/makeCurrent/"+value['order_ID']+"/"+value['contact_ID'], function( data ) {
            window.location.href = "<?=base_url()?>index.php/PortalHome"
        });
      }
    });
    $("#view"+value['order_ID']).click(function(event){
        event.preventDefault();
      $.get("<?=base_url()?>index.php/Invoice/getInvoice/"+value['order_ID'],
        function (data)
        {
          $("#invoice-section").html(data);
        });
    });
    
  });
   
   
  });
}



        </script>

      </body>
  </html>
