
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
   <link rel="stylesheet" href='<?=assetUrl()?>css/customMain.css' type="text/css"/>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style type="text/css">
   .products {
      width: 100%;
   }

  </style>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <div id="addnew" style="display: none;">
 <div class="row" >
<div class="col-md-6" id="formRow">
        
        <?php $attributes = array('enctype' => 'multipart/form-data', 'id'=>'mainForm'); ?>
<?= form_open('Contacts/formSubmit', $attributes) ?>
<div class="form-group">
<?= form_error('first_name'); ?> 
<?= form_input(array('name' => 'first_name',
 'id' => 'first_name', 'value'=> set_value('first_name'), 'class'=>'form-control', 'placeholder'=>'First Name')); ?> 
</div>
<div class="form-group">
<?= form_error('last_name'); ?> 
<?= form_input(array('type'=>'text' ,'name' => 'last_name', 
 'id' => 'last_name', 'value'=> set_value('last_name'), 'class'=>'form-control', 'placeholder'=>'Last Name')); ?> 
</div>

<div class="form-group">
    <?= form_error('email'); ?>
      <?= form_input(array('name' => 'email', 'type'=>'email',
 'id' => 'email', 'value'=> set_value('email'), 'class'=>'form-control', 'placeholder'=>'
 Email')); ?> 
</div>
<div class="form-group">
    <?= form_error('phone'); ?>
      <?= form_input(array('name' => 'phone',
 'id' => 'phone', 'value'=> set_value('phone'), 'class'=>'form-control', 'placeholder'=>'
 Phone')); ?> 

</div>
   <div class="form-group">
    <?= form_error('type'); ?>
    <?= form_label('Contact Type', 'type'); ?> <br>
<?= form_input(array('type'=>'radio','name' => 'type','value'=> 'Customer', 'id'=>'Customer')); ?> 
Customer<br>
<?= form_input(array('type'=>'radio','name' => 'type', 'value'=> 'Vendor', 'id'=>'Customer')); ?> Vendor<br>
</div>
<?= form_submit(array('name'=>'submit', 'value'=>'Submit', 'class'=>"btn btn-success", 'id'=>'formButton')); ?>
<?= form_submit(array('name'=>'cancel', 'value'=>'Cancel', 'class'=>"btn btn-warning", 'id'=>'cancelButton')); ?>


</div>
<div class="col-md-6" id="formRow">
  <div class="form-group">
    <?= form_error('company'); ?>
      <?= form_input(array('name' => 'company',
 'id' => 'company', 'value'=> set_value('company'), 'class'=>'form-control', 'placeholder'=>'
 Company')); ?> 
</div>

<div class="form-group">
    <?= form_error('website'); ?>
      <?= form_input(array('name' => 'website', 'type'=>'url',
 'id' => 'website', 'value'=> set_value('website'), 'class'=>'form-control', 'placeholder'=>'
 Website')); ?> 
</div>
<div class="form-group">
    <?= form_error('address'); ?>
      <?= form_input(array('name' => 'address',
 'id' => 'address', 'value'=> set_value('address'), 'class'=>'form-control', 'placeholder'=>'
 Street Address')); ?> 
</div>
<div class="form-group">

    <?= form_error('city'); ?>
<?= form_label('City', 'city'); ?> 
      <?= form_dropdown(array('name' => 'city', 'options'=>$cityOptions,
 'id' => 'city', 'value'=> set_value('city'), 'class'=>'form-control', 'placeholder'=>'
 City')); ?> 
</div>
<div class="form-group">
    <?= form_error('country'); ?>
<?= form_label('Country', 'country'); ?> 
      <?= form_dropdown(array('name' => 'country', 'options'=>$countryOptions, 
 'id' => 'country', 'value'=> set_value('country'), 'class'=>'form-control', 'default'=>'Please Select'
 )); ?> 
</div>



<div class="form-group">
<?= form_input(array('type'=>'hidden','name' => 'formSubmit',
 'id' => 'formSubmit', 'value'=> set_value(true))); ?> 

<?= form_input(array('type'=>'hidden','name' => 'isEditing',
 'id' => 'isEditing', 'value'=> false)); ?> 

<?= form_input(array('type'=>'hidden','name' => 'contact_ID',
 'id' => 'contact_ID', 'value'=> "")); ?> 

  


    
    
<?= form_close() ?>
</div>
</div>

        </div>
        </div>
        <div class="form-group">
        <div id ="thisDiv">
        <a id="addnewButton" href = "#"><span style="font-size: 25px;display: inline;float: right;" class="glyphicon glyphicon-plus">new</span></a></br>
        </div>
      </div>
        <div class="form-group"><?= form_input(array('name' => 'search',
 'id' => 'search' , 'class'=>'form-control', 'placeholder'=>'Type to search')); ?> </div>
      <TABLE id = "contacts">
 
</TABLE>
       </div>
     </div>
      <hr>
          

<script>


$(document).ready(function() {  
$('#search').trigger('keyup');
$("#addnewButton").click(function(event){
    event.preventDefault();
   $("#isEditing").val(false);
   $('.error').html('');
   $('#mainForm')[0].reset();
   $('#first_name').val('');
   $('#last_name').val('');
   $('#email').val('');
   $('#phone').val('');
   $('#company').val('');
   $('#website').val('');
   $('#address').val('');
   $('#city').val(0);
   $('#country').val(0);
   $('#contact_ID').val('');

  document.getElementById("addnew").style.display = "block"; 
  document.getElementById("addnewButton").style.display = "none";
  
  

 });
$("#cancelButton").click(function(event){
    event.preventDefault();

   $('.error').html('');
  document.getElementById("addnew").style.display = "none";
  document.getElementById("addnewButton").style.display = "block";
 

 });

<?php if ($showForm):?>
     document.getElementById("addnew").style.display = "block"; 
    document.getElementById("addnewButton").style.display = "none";
<? endif ?>
$("#search").keyup(function(){
   if ($("#search").val() ==""){
    $.get("<?=base_url()?>index.php/Contacts/getAll/",
  function (data)
  {
  $("#contacts").html("<tr><th style=\"text-align: center;\">Delete</th><th style=\"text-align: center;\">Edit</span></th><th style=\"text-align: center;\"><?= $headerid ?></th><th style=\"text-align: center;\"><?= $headerfname ?></th><th style=\"text-align: center;\"><?= $headerlname ?></th><th style=\"text-align: center;\"><?= $headeremail ?></th><th style=\"text-align: center;\"><?= $headerphone ?></th><th style=\"text-align: center;\"><?= $headertype ?></th><th style=\"text-align: center;\"><?= $headerwebsite ?></th><th style=\"text-align: center;\"><?= $headercompany ?></th></tr>");
  var obj = JSON.parse(data);
   $.each(obj, function(key, value){
  
  $("#contacts").append("  <tr id="+value['contact_ID']+"><td><a id='delete"+value['contact_ID']+"'><span class='glyphicon glyphicon-remove'></a></span></td><td><a id='edit"+value['contact_ID']+"'> <span class='glyphicon glyphicon-pencil'></span></a></td><td>"+value['contact_ID']+"</td><td>"+value['first_name']+"</td><td>"+value['last_name']+"</td><td>"+ value['email']+"</td><td>"+value['phone']+"</td><td>"+value['type']+"</td><td>"+ value['website']+"</td><td>"+value['company']+"</td></tr>");
  $("#delete"+value['contact_ID']).click(function(event){
    if (confirm("are you sure you want to delete this record?") == true) 
    {
      $.get("<?=base_url()?>index.php/Contacts/deleteContact/"+ value['contact_ID'],
      function (data)
      {
        resp = JSON.parse(data);
        if (resp['success']==true){
          $('#'+value['contact_ID']).html('');
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
$("#edit"+value['contact_ID']).click(function(event){
    event.preventDefault();
     document.getElementById("addnew").style.display = "block"; 
    document.getElementById("addnewButton").style.display = "none";
  
  $("#isEditing").val(true);
  
  $.get("<?=base_url()?>index.php/Contacts/getContact/"+value['contact_ID'],
   function (data)
  {
   cont = JSON.parse(data);
   $.each(cont, function( index, value ) {
   if (index=='type'){
     $("#"+value).prop("checked", true);
    }
    else if (index=='city'){
      $('#city').val(value);
   }
    else{
    $("#"+index).val(value);
   }

    });
  });


});

  });
  
  });

   }
   else{
    $.get("<?=base_url()?>index.php/Contacts/getFiltered/" + $("#search").val(),
  function (data)
  {
   $("#contacts").html("<tr><th style=\"text-align: center;\">Delete</th><th style=\"text-align: center;\">Edit</span></th><th style=\"text-align: center;\"><?= $headerid ?></th><th style=\"text-align: center;\"><?= $headerfname ?></th><th style=\"text-align: center;\"><?= $headerlname ?></th><th style=\"text-align: center;\"><?= $headeremail ?></th><th style=\"text-align: center;\"><?= $headerphone ?></th><th style=\"text-align: center;\"><?= $headertype ?></th><th style=\"text-align: center;\"><?= $headerwebsite ?></th><th style=\"text-align: center;\"><?= $headercompany ?></th></tr>");
  var obj = JSON.parse(data);
  $.each(obj, function(key, value){
  
  $("#contacts").append("  <tr id="+value['contact_ID']+"><td><a id='delete"+value['contact_ID']+"'><span class='glyphicon glyphicon-remove'></a></span></td><td><a id='edit"+value['contact_ID']+"'> <span class='glyphicon glyphicon-pencil'></span></a></td><td>"+value['contact_ID']+"</td><td>"+value['first_name']+"</td><td>"+value['last_name']+"</td><td>"+ value['email']+"</td><td>"+value['phone']+"</td><td>"+value['type']+"</td><td>"+ value['website']+"</td><td>"+value['company']+"</td></tr>");
$("#delete"+value['contact_ID']).click(function(event){
    if (confirm("are you sure you want to delete this record?") == true) 
    {
      $.get("<?=base_url()?>index.php/Contacts/deleteContact/"+ value['contact_ID'],
      function (data)
      {
        resp = JSON.parse(data);
        if (resp['success']==true){
          $('#'+value['contact_ID']).html('');
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
$("#edit"+value['contact_ID']).click(function(event){
    event.preventDefault();
     document.getElementById("addnew").style.display = "block"; 
    document.getElementById("addnewButton").style.display = "none";
  
  $("#isEditing").val(true);
  
  $.get("<?=base_url()?>index.php/Contacts/getContact/"+value['contact_ID'],
   function (data)
  {
   cont = JSON.parse(data);
   $.each(cont, function( index, value ) {
   if (index=='type'){
     $("#"+value).prop("checked", true);
    }
    else if (index=='city'){
      $('#city').val(value);
   }
    else{
    $("#"+index).val(value);
   }

    });
  });


});
  });
   
  
  });
}
  return false;
  });
$('#search').trigger('keyup');
});

</script>

    </body>
</html>
