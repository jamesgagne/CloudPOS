
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src='<?=assetUrl()?>plugins/poshytip/src/jquery.poshytip.js'></script>
<script type="text/javascript" src='<?=assetUrl()?>plugins/xedit/jquery-editable/js/jquery-editable-poshytip.js'></script>

  <link rel="stylesheet" href='<?=assetUrl()?>plugins/poshytip/src/tip-yellow/tip-yellow.css' type="text/css?" />
  <link rel="stylesheet" href='<?=assetUrl()?>plugins/poshytip/src/tip-violet/tip-violet.css' type="text/css" />
  <link rel="stylesheet" href='<?=assetUrl()?>plugins/poshytip/src/tip-darkgray/tip-darkgray.css' type="text/css" />
  <link rel="stylesheet" href='<?=assetUrl()?>plugins/poshytip/src/tip-skyblue/tip-skyblue.css' type="text/css" />
  <link rel="stylesheet" href='<?=assetUrl()?>plugins/poshytip/src/tip-yellowsimple/tip-yellowsimple.css' type="text/css" />
  <link rel="stylesheet" href='<?=assetUrl()?>plugins/poshytip/src/tip-twitter/tip-twitter.css' type="text/css" />
  <link rel="stylesheet" href='<?=assetUrl()?>plugins/xedit/jquery-editable/css/jquery-editable.css' type="text/css"/>
   <link rel="stylesheet" href='<?=assetUrl()?>css/customMain.css' type="text/css"/>
  <style type="text/css">
   .products {
      width: 100%;
   }

  </style>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <div id="addnew">
        </div>
        <div id ="thisDiv">
        <div class="form-group"><a id="addnewButton" href = "#"><span style="font-size: 25px;display: inline;float: right;" class="glyphicon glyphicon-plus">new</span></a>
          <br />
        </div>
        </div>
        <div class="form-group"><?= form_input(array('name' => 'search',
 'id' => 'search' , 'class'=>'form-control', 'placeholder'=>'Type to search')); ?> </div>
      <TABLE id = "products">
  <tr><th style="text-align: center;"><?= $headerid ?></th>
    <th style="text-align: center;"><?= $headerfname ?></th>
    <th style="text-align: center;"><?= $headerlname ?></th>
    <th style="text-align: center;"><?= $headerphone ?></th>
    <th style="text-align: center;"><?= $headeremail ?></th>
    <th style="text-align: center;"><?= $headerstock ?></th>
    <th style="text-align: center;"><?= $headersku ?></th>
    <th style="text-align: center;"><?= $headermpn ?></th>
    <th style="text-align: center;"><?= $headerupc ?></th>
  <?php foreach ($listing as $key => $value): ?>
  <tr>
    <td><?= $value['product_ID']?></td>
    <td class=""><a class="editable editable-click" id='<?=$value['product_ID']?>name' data-type="text" data-pk='<?=$value['product_ID']?>' data-url='<?=$base_url?>index.php/Products/update/name' data-title="Enter Name" href="#"><?= $value['name']?></a></td>


    <td><a class="editable editable-click" id='<?=$value['product_ID']?>description' data-type="text" data-pk='<?=$value['product_ID']?>' data-url='<?=$base_url?>index.php/Products/update/description' data-title="Enter Description" href="#"><?= $value['description']?></a></td>

    <td><a class="editable editable-click" id='<?=$value['product_ID']?>purchase_rate' data-type="text" data-pk='<?=$value['product_ID']?>' data-url='<?=$base_url?>index.php/Products/update/purchase_rate' data-title="Enter Phone Number" href="#"><?= $value['purchase_rate']?></a></td>

    <td><a class="editable editable-click" id='<?=$value['product_ID']?>selling_rate' data-type="text" data-pk='<?=$value['product_ID']?>' data-url='<?=$base_url?>index.php/Products/update/selling_rate' data-title="Enter Email" href="#"><?= $value['selling_rate']?></a></td>
    <td><a class="editable editable-click" id='<?=$value['product_ID']?>stock' data-type="text" data-pk='<?=$value['product_ID']?>' data-url='<?=$base_url?>index.php/Products/update/stock' data-title="Enter stock" href="#"><?= $value['stock']?></a></td>

    <td><a class="editable editable-click" id='<?=$value['product_ID']?>sku' data-type="text" data-pk='<?=$value['product_ID']?>' data-url='<?=$base_url?>index.php/Products/update/sku' data-title="Enter stock" href="#"><?= $value['sku']?></a></td>

    <td><a class="editable editable-click" id='<?=$value['product_ID']?>mpn' data-type="text" data-pk='<?=$value['product_ID']?>' data-url='<?=$base_url?>index.php/Products/update/mpn' data-title="Enter stock" href="#"><?= $value['mpn']?></a></td>

    <td><a class="editable editable-click" id='<?=$value['product_ID']?>upc' data-type="text" data-pk='<?=$value['product_ID']?>' data-url='<?=$base_url?>index.php/Products/update/upc' data-title="Enter stock" href="#"><?= $value['upc']?></a></td>
  </tr> 
<?php endforeach ?>
</TABLE>
       </div>
     </div>

      <hr>
          <script>
  
$(document).ready(function() {  

<?php foreach ($listing as $key => $value): ?>
  
$('#<?=$value['product_ID']?>description').editable({success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
     }
    });
$('#<?=$value['product_ID']?>name').editable({success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
     }
    });
$('#<?=$value['product_ID']?>purchase_rate').editable({success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
     }
    });
$('#<?=$value['product_ID']?>selling_rate').editable({success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
     }
    });
$('#<?=$value['product_ID']?>stock').editable({success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
     }
    });
$('#<?=$value['product_ID']?>sku').editable({success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
     }
    });
$('#<?=$value['product_ID']?>upc').editable({success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
     }
    });
$('#<?=$value['product_ID']?>mpn').editable({success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
     }
    });

<?php endforeach ?>



});

$(document).ready(function() {  

$("#addnewButton").click(function(event){
    event.preventDefault();
    $.get("<?=base_url()?>index.php/ProductForm/",
  function (data)
  {
  $("#addnew").html(data);
  $("#thisDiv").html("");
 
  
  });
 });




});    
</script>

    </body>
</html>
