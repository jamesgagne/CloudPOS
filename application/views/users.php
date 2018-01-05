
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
    <div class="jumbotron" style="overflow: hidden; min-height: 63vh;">
      <div class="container">
        <div id="addnew" style="display: none;">
 <div class="row" >
<div class="col-md-6" id="formRow">
        
        <?php $attributes = array('enctype' => 'multipart/form-data', 'id'=>'mainForm'); ?>
<?= form_open('Users/formSubmit', $attributes) ?>
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
    <?= form_label('User Type', 'type'); ?> <br>
<?= form_input(array('type'=>'radio','name' => 'type','value'=> 1, 'id'=>'Customer')); ?> 
Manager<br>
<?= form_input(array('type'=>'radio','name' => 'type', 'value'=> 2, 'id'=>'Vendor')); ?> Cashier<br>
</div>
<?= form_submit(array('name'=>'submit', 'value'=>'Submit', 'class'=>"btn btn-success", 'id'=>'formButton')); ?>
<?= form_submit(array('name'=>'cancel', 'value'=>'Cancel', 'class'=>"btn btn-warning", 'id'=>'cancelButton')); ?>


</div>
<div class="col-md-6" id="formRow">


<div class="form-group">
    <?= form_error('pay_rate'); ?>
      <?= form_input(array('name' => 'pay_rate', 'type'=>'text',
 'id' => 'pay_rate', 'value'=> set_value('pay_rate'), 'class'=>'form-control', 'placeholder'=>'
 Pay Rate')); ?> 
</div>
<div class="form-group">
    <?= form_error('address'); ?>
      <?= form_input(array('name' => 'sin',
 'id' => 'sin', 'value'=> set_value('sin'), 'class'=>'form-control', 'placeholder'=>'
 SIN')); ?> 
</div>

<div class="form-group">
    <?= form_error('password'); ?>
<?= form_label('Password', 'password'); ?> 
      <?= form_password(array('name' => 'password', 'id' => 'password', 'value'=> set_value('password'), 'class'=>'form-control'
 )); ?> 
</div>
<div class="form-group">
    <?= form_error('confpassword'); ?>
<?= form_label('Confirm Password', 'confpassword'); ?> 
      <?= form_password(array('name' => 'confpassword', 'id' => 'confpassword', 'value'=> set_value('confpassword'), 'class'=>'form-control'
 )); ?> 
</div>



<div class="form-group">
<?= form_input(array('type'=>'hidden','name' => 'formSubmit',
 'id' => 'formSubmit', 'value'=> set_value(true))); ?> 

<?= form_input(array('type'=>'hidden','name' => 'isEditing',
 'id' => 'isEditing', 'value'=> false)); ?> 

<?= form_input(array('type'=>'hidden','name' => 'user_ID',
 'id' => 'user_ID', 'value'=> "")); ?> 

  


    
    
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
   $('#pay_rate').val('');
   $('#sin').val('');
   $('#password').val('');
   $('#confpassword').val('');
   $('#password').prop('disabled',false);
   $('#confpassword').prop('disabled',false);

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
    $.get("<?=base_url()?>index.php/Users/getAll/",
  function (data)
  {
  $("#contacts").html("<tr><th style=\"text-align: center;\">Delete</th><th style=\"text-align: center;\">Edit</span></th><th style=\"text-align: center;\"><?= $headerid ?></th><th style=\"text-align: center;\"><?= $headerfname ?></th><th style=\"text-align: center;\"><?= $headerlname ?></th><th style=\"text-align: center;\"><?= $headeremail ?></th><th style=\"text-align: center;\"><?= $headerphone ?></th><th style=\"text-align: center;\"><?= $headertype ?></th><th style=\"text-align: center;\"><?= $headerwebsite ?></th></tr>");
  var obj = JSON.parse(data);
   $.each(obj, function(key, value){
  
  $("#contacts").append("  <tr id="+value['user_ID']+"><td><a id='delete"+value['user_ID']+"'><span class='glyphicon glyphicon-remove'></a></span></td><td><a id='edit"+value['user_ID']+"'> <span class='glyphicon glyphicon-pencil'></span></a></td><td>"+value['user_ID']+"</td><td>"+value['first_name']+"</td><td>"+value['last_name']+"</td><td>"+ value['email']+"</td><td>"+value['phone']+"</td><td></td><td>"+ value['pay_rate']+"</td></tr>");
  $("#delete"+value['user_ID']).click(function(event){
    if (value['is_primary']){
      alert("This is the primary Account user and cannot be deleted");
    }
    else{
    if (confirm("are you sure you want to delete this record?") == true) 
    {
      $.get("<?=base_url()?>index.php/Users/deleteContact/"+ value['user_ID'],
      function (data)
      {
        window.location.href = "<?=base_url()?>/index.php/Users";
        
      });
    }
    else 
    {
      alert('no changes made');
    }
  }
 });
$("#edit"+value['user_ID']).click(function(event){
    event.preventDefault();
     document.getElementById("addnew").style.display = "block"; 
    document.getElementById("addnewButton").style.display = "none";
  
  $("#isEditing").val(true);
  $("#password").prop('disabled',true);
  $("#confpassword").prop('disabled', true);
  $.get("<?=base_url()?>index.php/Users/getContact/"+value['user_ID'],
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
    $.get("<?=base_url()?>index.php/Users/getFiltered/" + $("#search").val(),
  function (data)
  {
    $("#contacts").html("<tr><th style=\"text-align: center;\">Delete</th><th style=\"text-align: center;\">Edit</span></th><th style=\"text-align: center;\"><?= $headerid ?></th><th style=\"text-align: center;\"><?= $headerfname ?></th><th style=\"text-align: center;\"><?= $headerlname ?></th><th style=\"text-align: center;\"><?= $headeremail ?></th><th style=\"text-align: center;\"><?= $headerphone ?></th><th style=\"text-align: center;\"><?= $headertype ?></th><th style=\"text-align: center;\"><?= $headerwebsite ?></th></tr>");
  var obj = JSON.parse(data);
  $.each(obj, function(key, value){
  
    $("#contacts").append("  <tr id="+value['user_ID']+"><td><a id='delete"+value['user_ID']+"'><span class='glyphicon glyphicon-remove'></a></span></td><td><a id='edit"+value['user_ID']+"'> <span class='glyphicon glyphicon-pencil'></span></a></td><td>"+value['user_ID']+"</td><td>"+value['first_name']+"</td><td>"+value['last_name']+"</td><td>"+ value['email']+"</td><td>"+value['phone']+"</td><td></td><td>"+ value['pay_rate']+"</td></tr>");

$("#delete"+value['user_ID']).click(function(event){
   if (value['is_primary']){
    
      alert("This is the primary Account user and cannot be deleted");
   }
   else{ 
    if (confirm("are you sure you want to delete this record?") == true) 
    {
      $.get("<?=base_url()?>index.php/Users/deleteContact/"+ value['user_ID'],
      function (data)
      {
        window.location.href = "<?=base_url()?>/index.php/Users";
      });
    }
    else 
    {
      alert('no changes made');
    }
  }
 });
$("#edit"+value['user_ID']).click(function(event){
    event.preventDefault();
     document.getElementById("addnew").style.display = "block"; 
    document.getElementById("addnewButton").style.display = "none";
  
  $("#isEditing").val(true);
  $("#password").prop('disabled',true);
  $("#confpassword").prop('disabled', true);
  
  $.get("<?=base_url()?>index.php/Users/getContact/"+value['user_ID'],
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
