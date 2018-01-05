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
             <?php if ($activate) :?>
             
            <a id="newOrder" class="glyphicon glyphicon-plus"></a>
            <?php endif?> 
                        <select class="select" data-placeholder="Select a Contact..."  name="contacts" id="contacts-select" style="width:100%;">
                <option value='' disabled selected>Select</option>
                <?php foreach ($contacts as $key => $value) :?>
                <option value="<?=$value['contact_ID']?>"> <?=$value['first_name']?> <?=$value['last_name']?>

                </option>
                <?php endforeach?>
               
              </select>
              </div>
               <div class="container" style="border:1px solid black;display: block;overflow:scroll;float:right;margin-top:1em;height: 50vh">
                <table id="items">
                  <thead><th style="text-align: center;">Delete</th><th style="text-align: center;">Edit</span></th><th colspan="3" style="text-align: center;"><?= $headerItem ?></th><th></th><th></th><th style="text-align: center;"><?= $headerQuantity ?></th><th style="text-align: center;"><?= $headerSubtotal ?></th></thead>
                  <tbody id="itemstbody"></tbody>
                  <tfoot id="itemsfoot"></tfoot>
                </table>
                
                
              </div>
          </div>
          <div class="col-lg-5" id="item-section">
            <div style="display: block;float:right;">
            <select class="select" data-placeholder="Search for Products"  name="products" id="products-select" style="width:50%;">
                
                <option></option>
                <?php foreach ($products as $key => $value) :?>
                <option value="<?=$value['product_ID']?>"> <?=$value['name']?> - <?=$value['sku']?></option>
                <?php endforeach?>
               
              </select>

              <label for="quantity" style="width:10%;text-align: right;"> Qty&nbsp;</label><input id="quantity" type="number" name="quantity" min="1" style="width:15%" />&nbsp;&nbsp;<a id="add" class="glyphicon glyphicon-plus"></a>
              <input type="hidden" name="updateID" id="updateID"/>
              </div>
              <div class="container" style="display: block;float:right;margin-top:1em;overflow: scroll;">
                <table class="table">
                  <tr>
                <?php foreach ($products as $key => $value) :?>
                  <?php if (($key%3)==0):?>
                  </tr><tr>
                  <?php endif ?>
                  <td style="border: 1px solid lightgrey;">
                  <figure id="button<?=$value['product_ID']?>" style="display:inline-block" width="100px">
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
             $(document).ready(function(){
              <?php if ($forbidden) :?>
              alert("You do not have sufficient prevlidges to access the Admin Page");
              <? endif ?>
              $("#contacts-select").chosen(); 
              $("#products-select").chosen();
                 $('#contacts-select').val(<?= $current_order[0]['contact_ID']?>);
                 $('#contacts-select').trigger("chosen:updated");
              var previous;
                $("#contacts-select").on('change', function () {
                  window.location.href = "<?=base_url()?>index.php/PortalHome/getContactCurrentOrder/"+$("#contacts-select").val();


                });
                <?php if ($activate):?>
                getItems(<?=$current_order[0]['order_ID']?>);
                $("#newOrder").click(function(e){
                  window.location.href = "<?=base_url()?>index.php/PortalHome/newOrder/<?=$current_order[0]['contact_ID']?>";

                });
                <?php endif ?>
                
                $('#item-section').block({ 
                message: 'Please select a Contact',
                cursor: 'not-allowed', 
                css: { border: '3px solid black',
                cursor: 'not-allowed'
              } 
            });
                <?php if ($activate):?>
             <?php foreach ($products as $key => $value): ?>
               $("#button<?=$value['product_ID']?>").click(function(e){
                e.preventDefault();
                $.post("<?=base_url()?>index.php/PortalHome/buttonClick/<?=$value['product_ID']?>/<?=$current_order[0]['order_ID']?>",
                function (data)
                {
                  getItems(<?=$current_order[0]['order_ID']?>);
                });

               });
             <?php endforeach?>
             <?php endif ?>
             
            <?php if ($activate):?>
              $('#item-section').unblock();
            <? endif ?>
            $("#add").click(function(e){
              e.preventDefault();
              var prod = $("#products-select").val();
              var qty = $("#quantity").val();
              var updateID = $("#updateID").val();
              if (prod==""){
              alert("Please select a product to add");
              }
              else if ((qty==null)||(qty<1)){
                alert("Please input a quantity to add greater than 0");
              }
              else{
                if ((updateID =="") || (updateID==null)){ 
                  addItemToOrder(prod,qty);
                }
                else{
                  updateLine(updateID,prod,qty);
                }
                
              }
            });
        });

  function off() {
  
  }
function getItems(order_id){
   $.get("<?=base_url()?>index.php/PortalHome/getLineItems/"+order_id,
  function (data)
  {
    var obj = JSON.parse(data);
    console.log(obj.success);
    $("#itemstbody").html("");
   $.each(obj['lines'], function(key, value){
    $("#itemstbody").append("  <tr id="+value['line_item_ID']+"><td><a id='delete"+value['line_item_ID']+"'><span class='glyphicon glyphicon-remove'></a></span></td><td><a id='edit"+value['line_item_ID']+"'> <span class='glyphicon glyphicon-pencil'></span></a></td><td colspan=\"3\">"+value['NameDesc']+"</td><td></td><td></td><td>"+value['quantity']+"</td><td>"+value['line_sub_total']+"</td></tr>");
    $("#edit"+value['line_item_ID']).click(function(event){
                $('#products-select').val(value["product_ID"]);
                 $('#products-select').trigger("chosen:updated");
                 $("#updateID").val(value["line_item_ID"]);
                 $("#quantity").val(value["quantity"]);

    });
    $("#delete"+value['line_item_ID']).click(function(event){
    if (confirm("are you sure you want to delete this record?") == true) 
    {
      $.get("<?=base_url()?>index.php/PortalHome/deleteLine/"+ value['line_item_ID'],
      function (data)
      {
        resp = JSON.parse(data);
        if (resp['success']==true){
          getItems(<?=$current_order[0]['order_ID']?>);
        }
        else{
          alert(resp['error']);
        }
      });
    }
    else 
    {
      alert('no changes made');
    }
 });
    });
   $("#itemsfoot").html("");
   $("#itemsfoot").append("<tr><td><td></td></td><td></td><td></td><td></td><td></td><td></td><th id=\"subtotal\" >SubTotal:</th><td>"+obj.subtotal+"</td></tr></tfoot>");
  });
}
function addItemToOrder(prod,qty){
  <?php if ($activate) :?>
  $.post("<?=base_url()?>index.php/PortalHome/addLine/"+<?=$current_order[0]['order_ID']?>+"/"+prod+"/"+qty,
  function (data)
  {
    getItems(<?=$current_order[0]['order_ID']?>);
  });
  <?php endif ?>
}
function updateLine(updateID,prod,qty){
  $.post("<?=base_url()?>index.php/PortalHome/updateLine/"+updateID+"/"+prod+"/"+qty,
  function (data)
  {
    resp = JSON.parse(data);
        if (resp['success']==true){
          getItems(<?=$current_order[0]['order_ID']?>);
        }
        else{
          alert(resp['error']);
        }
    getItems(<?=$current_order[0]['order_ID']?>);
  });  
}


        </script>

      </body>
  </html>
