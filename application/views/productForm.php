

        <div class="row">
<div class="col-md-6" id="formRow">
        
        <?php $attributes = array('enctype' => 'multipart/form-data', 'id'=>'mainForm'); ?>
<?= form_open('Products/addnew', $attributes) ?>
<div class="form-group">
<div id="errorname" style="color:red;"></div>
<?= form_input(array('name' => 'name',
 'id' => 'name', 'value'=> set_value('name'), 'class'=>'form-control', 'placeholder'=>'Product Name')); ?> 
</div>
<div class="form-group">
<div id="errordescription" style="color:red;"></div>
<?= form_error('description'); ?> 
<?= form_input(array('type'=>'url' ,'name' => 'description', 
 'id' => 'description', 'value'=> set_value('description'), 'class'=>'form-control', 'placeholder'=>'Product description')); ?> 
</div>

<div class="form-group">
<div id="errorpurchase_rate" style="color:red;"></div>
    <?= form_error('purchase_rate'); ?>
      <?= form_input(array('name' => 'purchase_rate',
 'id' => 'purchase_rate', 'value'=> set_value('purchase_rate'), 'class'=>'form-control', 'placeholder'=>'
 Purchase Rate')); ?> 
</div>
<div class="form-group">
<div id="errorselling_rate" style="color:red;"></div>
    <?= form_error('selling_rate'); ?>
      <?= form_input(array('name' => 'selling_rate',
 'id' => 'selling_rate', 'value'=> set_value('selling_rate'), 'class'=>'form-control', 'placeholder'=>'
 Selling Rate')); ?> 
</div>

<div class="form-group">

<div id="errorimage" style="color:red;"></div>
<?= form_label('Please Upload a Photo for this Product:', 'image'); ?> 
<?= form_input(array('type'=>'file','name' => 'image',
 'id' => 'image', 'value'=> set_value('image'))); ?> 
</div>

</div>
<div class="col-md-6" id="formRow">
  <div class="form-group">
<div id="errorstock" style="color:red;"></div>
      <?= form_input(array('name' => 'stock',
 'id' => 'stock', 'value'=> set_value('stock'), 'class'=>'form-control', 'placeholder'=>'
 Initial Stock')); ?> 
</div>

<div class="form-group">
<div id="errorupc" style="color:red;"></div>
      <?= form_input(array('name' => 'upc',
 'id' => 'upc', 'value'=> set_value('upc'), 'class'=>'form-control', 'placeholder'=>'
 Universal Purchase Code (UPC)')); ?> 
</div>
   <div class="form-group">
<div id="errorsku" style="color:red;"></div>
      <?= form_input(array('name' => 'sku',
 'id' => 'sku', 'value'=> set_value('sku'), 'class'=>'form-control', 'placeholder'=>'
 Stock Keeping Unit (SKU)')); ?> 
</div>
 <div class="form-group">
<div id="errormpn" style="color:red;"></div>
      <?= form_input(array('name' => 'mpn',
 'id' => 'mpn', 'value'=> set_value('mpn'), 'class'=>'form-control', 'placeholder'=>'Manufacturer Part Number (MPN)')); ?> 
    </div>
<div class="form-group">
<?= form_input(array('type'=>'hidden','name' => 'formSubmit',
 'id' => 'formSubmit', 'value'=> set_value(true))); ?> 

<?= form_submit(array('name'=>'submit', 'value'=>'Submit', 'class'=>"btn btn-success", 'id'=>'formButton')); ?>

  


    
    
<?= form_close() ?>
</div>

        </div>
<script type="text/javascript">
  
   $("#formButton").click(function(event){
    event.preventDefault();
     var file_data = $('#image').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    form_data.append('name', $('#name').val());
    form_data.append('description', $('#description').val());
    form_data.append('purchase_rate', $('#purchase_rate').val());
    form_data.append('selling_rate', $('#selling_rate').val());
    form_data.append('stock', $('#stock').val());
    form_data.append('upc', $('#upc').val());
    form_data.append('sku', $('#sku').val());
    form_data.append('mpn', $('#mpn').val());                        
    $.ajax({
                url: 'index.php/Products/addnew', // point to server-side PHP script 
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
    if (arr['validated'] && arr['sucess']){
      alert("Added Successfully");
      location.reload();
    }
    else if(arr['validated'] && arr['sucess']){
      alert(arr['error']);
    }
    else{
     $.each(arr['errors'], function( index, value ) {
      $("#error"+index).html(value);
});
    }
    
  }
     });
 });

</script>
      
  

        

        