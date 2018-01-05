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
                        <select class="select" data-placeholder="Select a Contact..."  name="contacts" id="contacts-select" style="width:40%;">
                
                <?php foreach ($contacts as $key => $value) :?>
                <option value="<?=$value['contact_ID']?>"> <?=$value['first_name']?> <?=$value['last_name']?>

                </option>
                <?php endforeach?>
               
              </select>
                          <select class="select" data-placeholder="Select an Order..."  name="orders" id="orders-select" style="width:60%;">
                
                <?php foreach ($orders as $key => $value) :?>
                <option value="<?=$value['order_ID']?>">Date: <?=$value['date']?>-Order ID: <?=$value['order_ID']?>

                </option>
                <?php endforeach?>
               
              </select>
              </div>
               <div class="container" style="border:1px solid black;display: block;overflow:scroll;float:right;margin-top:1em;height: 50vh">
                <table id="items">
                  <th colspan="3" style="text-align: center;"><?= $headerItem ?></th><th></th><th></th><th style="text-align: center;"><?= $headerQuantity ?></th><th style="text-align: center;"><?= $headerSubtotal ?></th></thead>
                  <tbody id="itemstbody"></tbody>
                  <tfoot id="itemsfoot"></tfoot>
                </table>
                
                
              </div>
          </div>
          <div class="col-lg-5" id="item-section">
            
              
              <div class="container"" id="paymentSection">
                <?= form_open('Payments/formSubmit') ?>
                <div class="form-group">
                <?= form_error('type'); ?>
                <?= form_label('Payment Method', 'type'); ?> <br>
                <?= form_input(array('type'=>'radio','name' => 'type', 'value'=> 'Visa', 'id'=>'Visa', 'onclick'=>'showCardInfo()', 'required'=>'true')); ?> Visa
                <?= form_input(array('type'=>'radio','name' => 'type', 'value'=> 'MC', 'id'=>'MC', 'onClick'=>'showCardInfo()', 'required'=>'true')); ?> MasterCard
                </div>
                <div class="form-group">
                  <label for="tax">Please Select a Tax to add</label>
                  <select required class="select" data-placeholder="Select a Tax"  name="tax" id="tax-select" >
                   <option value="" disabled selected>Select</option>
                <?php foreach ($taxes as $key => $value) :?>
                <option value="<?=$value['rate']?>">
                  <?=$value['name']?> - <?=$value['rate']?>%
                </option>
                <?php endforeach?>
               
              </select>
                </div>
                <div class="form-group">
                <?= form_error('amount'); ?>
                <label for="amount">Total:</label>
                <?= form_input(array('name' => 'amount', 'type'=>'number',
             'id' => 'amount', 'value'=> set_value('amount'), 'class'=>'form-control', 'placeholder'=>'
             Amount', 'disabled'=>'true', "step"=>"0.01" )); ?> 
            </div>
            <div class="form-group" id="card-info" style='visibility:hidden'>
                <?= form_error('card'); ?>
                <label for="Card">Card Number</label>
                  <?= form_input(array('name' => 'card', 'type'=>'text',
             'id' => 'card', 'value'=> set_value('card'), 'class'=>'form-control')); ?> 
             <?= form_error('cvd'); ?>
             <label for="cvd">CVD</label>
                  <?= form_input(array('name' => 'cvd', 'type'=>'text',
             'id' => 'cvd', 'value'=> set_value('cvd'), 'class'=>'form-control')); ?> 
             <?= form_error('exp'); ?>
             <label for="exp">Expiration Date</label>
                  <?= form_input(array('name' => 'exp', 'type'=>'month',
             'id' => 'exp', 'value'=> set_value('exp'), 'class'=>'form-control')); ?> 
            </div>
            <?= form_input(array('type'=>'hidden','name' => 'order_ID','value'=> '', 'id'=>'order_ID')); ?> 
            <?= form_input(array('type'=>'hidden','name' => 'hidAmt','value'=> '', 'id'=>'hidAmt')); ?> 
            <?= form_submit(array('name'=>'submit', 'value'=>'Submit', 'class'=>"btn btn-success", 'id'=>'formButton')); ?>
                <?= form_close() ?>
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
              <?php if ($current_order[0]['status'] == "paid"):?>
                $("#paymentSection").html("<h1>Order Paid!!!</h1>");
              <?php endif ?>


              $("#contacts-select").chosen(); 
              $("#orders-select").chosen();
                 $('#contacts-select').val(<?= $current_order[0]['contact_ID']?>);
                 $('#contacts-select').trigger("chosen:updated");
                 $('#orders-select').val(<?= $current_order[0]['order_ID']?>);

                 $("#order_ID").val(<?= $current_order[0]['order_ID']?>);
                 $('#orders-select').trigger("chosen:updated");
              var previous;
                $("#contacts-select").on('change', function () {
                  window.location.href = "<?=base_url()?>index.php/Payments/getContactCurrentOrder/"+$("#contacts-select").val();
                });
                $("#orders-select").on('change', function () {
                  window.location.href = "<?=base_url()?>index.php/Payments/makeOrderCurrent/"+$("#orders-select").val()+"/"+$("#contacts-select").val();
                });
                $("#tax-select").on('change', function () {
                  <?php if (isset($current_order[0]['total'])) : ?>
                  $("#amount").val(Math.round(100*<?= $current_order[0]['total']?> * (1 + ($("#tax-select").val()/100)))/100);
                  <?php endif ?>
                $("#hidAmt").val($("#amount").val());
                });
                $("#amount").val(<?=$current_order[0]['total']?>)
                $("#hidAmt").val($("#amount").val());
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
              $('#item-section').unblock();
            <? endif ?>

            $("form").on('submit',function(event){
              event.preventDefault();   
                var form_data = new FormData();
                var radios = document.getElementsByName('type');

                for (var i = 0, length = radios.length; i < length; i++)
                {
                 if (radios[i].checked)
                 {
                  // do whatever you want with the checked radio
                  form_data.append('type', radios[i].value);
                  // only one radio can be logically checked, don't check the rest
                  break;
                 }
                }       
                
                form_data.append('order_ID', $('#order_ID').val());
                form_data.append('hidAmt', $('#hidAmt').val());
                form_data.append('card', $('#card').val());
                form_data.append('exp', $('#exp').val());
                form_data.append('cvd', $('#cvd').val());                  
                $.ajax({
                    url: 'index.php/Payments/formSubmit', // point to server-side PHP script 
                    dataType: 'text',  // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,                         
                    type: 'post',
                    success: function (data)
                  {
                    console.log(data);
                    var arr = JSON.parse(data);
                    if (arr.message == "Approved"){
                        var form_data = new FormData();
                       form_data.append('order_ID', <?=$current_order[0]['order_ID']?>);
                       form_data.append('contact_ID', <?=$current_order[0]['contact_ID']?>);
                       form_data.append('paymentID', arr.id);
                    $.ajax({
                        url: 'index.php/Payments/updatPaid', // point to server-side PHP script 
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,                         
                        type: 'post',
                        success: function (data)
                      {
                        
                        alert (arr.message);
                        window.location.href = "<?=base_url()?>index.php/Invoice/showInvoice/<?=$current_order[0]['order_ID']?>"; 
                        
                      }
                      });
                    }
                    else{
                      alert (arr.message);
                    }

                    
                    
                  }
                 });

            });
            
        });


  function off() {
  
  }
function getItems(order_id){
   $.get("<?=base_url()?>index.php/PortalHome/getLineItems/"+order_id,
  function (data)
  {
    var obj = JSON.parse(data);
    $("#itemstbody").html("");
   $.each(obj['lines'], function(key, value){
    $("#itemstbody").append("  <tr id="+value['line_item_ID']+"><td colspan=\"3\">"+value['NameDesc']+"</td><td></td><td></td><td>"+value['quantity']+"</td><td>"+value['line_sub_total']+"</td></tr>");
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
   $("#itemsfoot").append("<tr><td></td><td></td><td></td><td></td><td></td><th id=\"subtotal\" >SubTotal:</th><td>"+obj.subtotal+"</td></tr></tfoot>");
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

function hideCardInfo(){
  $('#card-info').prop('style', 'visibility:hidden');
  $('#card').removeProp('required');
  $('#cvd').removeProp('required');
  $('#exp').removeProp('required');
}
function showCardInfo(){
  $('#card-info').prop('style', 'visibility:show');
  $('#card').prop('required', 'true');
  $('#cvd').prop('required', 'true');
  $('#exp').prop('required', 'true');
}
        </script>

      </body>
  </html>
