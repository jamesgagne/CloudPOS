<style type="text/css" >
  .error{
    color:red;
  }

</style>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
         <div class="jumbotron">
      <div class="container">
        <div class="row">
        <div class="col-md-6" id="formRow">
        <h2>Organization Details</h2>
        <?php $attributes = array('enctype' => 'multipart/form-data'); ?>
<?= form_open('Register/newentry', $attributes) ?>
<div class="form-group">
<?= form_error('organization_name'); ?>
<?= form_input(array('name' => 'organization_name',
 'id' => 'organization_name', 'value'=> set_value('organization_name'), 'class'=>'form-control', 'placeholder'=>'Organization Name')); ?> 
</div>
<div class="form-group">
<?= form_error('website'); ?> 
<?= form_input(array('type'=>'url' ,'name' => 'website', 
 'id' => 'website', 'value'=> set_value('website'), 'class'=>'form-control', 'placeholder'=>'Website')); ?> 
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
<?= form_error('subscriptionType'); ?>
<?= form_label('Please choose a Subscription level', 'subscriptionType'); ?> <br>
<?= form_input(array('type'=>'radio','name' => 'subscriptionType','value'=> 1)); ?> Basic<br>
<?= form_input(array('type'=>'radio','name' => 'subscriptionType', 'value'=> 2)); ?> Professional<br>
<?= form_input(array('type'=>'radio','name' => 'subscriptionType', 'value'=> 3)); ?> Enterprise<br>
</div>
<div class="form-group">

<?= form_error('company_img'); ?>
<?= form_label('Please Upload Your Company Logo:', 'company_img'); ?> 
<?= form_input(array('type'=>'file','name' => 'company_img',
 'id' => 'company_img', 'value'=> set_value('company_img'))); ?> 
</div>
<div class="form-group">


<?= form_input(array('type'=>'color','name' => 'company_color',
 'id' => 'company_img', 'value'=> '#2965a7', 'style'=>'visibility:hidden')); ?> <br />
</div>
 <div class="form-group">
  <h3>CloudPOS uses Bambora Payment Services <br />
    Please register <a href="https://www.bambora.com" target="_blank">here</a></h3><br />
    <?= form_error('merchant_id'); ?>
      <?= form_input(array('name' => 'merchant_id',
 'id' => 'merchant_id', 'value'=> set_value('merchant_id'), 'class'=>'form-control', 'placeholder'=>'
 Bambora Merchant ID')); ?> 
    <?= form_error('access_code'); ?>
      <?= form_input(array('name' => 'access_code',
 'id' => 'access_code', 'value'=> set_value('access_code'), 'class'=>'form-control', 'placeholder'=>'
 Bambora API Access Key')); ?> 
</div>
<div class="form-group">
</div>
<div class="form-group">
<?= form_input(array('type'=>'hidden','name' => 'formSubmit',
 'id' => 'formSubmit', 'value'=> set_value(true))); ?> 

<?= form_submit(array('name'=>'submit', 'value'=>'Submit', 'class'=>"btn btn-success")); ?>
</div>
</div>
<div class="col-md-6" id="formRow">
  <h2>First User Information</h2>
    <div class="form-group">
    <?= form_error('firstName'); ?>
      <?= form_input(array('name' => 'firstName',
 'id' => 'firstName', 'value'=> set_value('firstName'), 'class'=>'form-control', 'placeholder'=>'First Name')); ?> 
    </div>
    <div class="form-group">
    <?= form_error('lastName'); ?>
      <?= form_input(array('name' => 'lastName',
 'id' => 'lastName', 'value'=> set_value('lastName'), 'class'=>'form-control', 'placeholder'=>'
 Last Name')); ?> 
    </div> 
    <div class="form-group">
    <?= form_error('phone'); ?>
      <?= form_input(array('name' => 'phone',
 'id' => 'phone', 'value'=> set_value('phone'), 'class'=>'form-control', 'placeholder'=>'
 Contact Phone Number')); ?> 
    </div>

  <div class="form-group">
    <?= form_error('cont_address'); ?>
      <?= form_input(array('name' => 'cont_address',
 'id' => 'address', 'value'=> set_value('cont_address'), 'class'=>'form-control', 'placeholder'=>'
 Street Address')); ?> 
</div>
<div class="form-group">

    <?= form_error('cont_city'); ?>
<?= form_label('City', 'cont_city'); ?> 
      <?= form_dropdown(array('name' => 'cont_city', 'options'=>$cityOptions,
 'id' => 'cont_city', 'value'=> set_value('cont_city'), 'class'=>'form-control', 'placeholder'=>'
 City')); ?> 
</div>
<div class="form-group">
    <?= form_error('cont_country'); ?>
<?= form_label('Country', 'cont_country'); ?> 
      <?= form_dropdown(array('name' => 'cont_country', 'options'=>$countryOptions, 
 'id' => 'cont_country', 'value'=> set_value('cont_country'), 'class'=>'form-control', 'default'=>'Please Select'
 )); ?> 
</div>
    
    <fieldset>
      <legend>Login Credentials</legend>
      <div class="form-group">
    <?= form_error('email'); ?>
      <?= form_input(array('type'=>'email','name' => 'email',
 'id' => 'email', 'value'=> set_value('email'), 'class'=>'form-control', 'placeholder'=>'
 Email')); ?> 
    </div>
<div class="form-group">
    <?= form_error('password'); ?>
      <?= form_input(array('type'=>'password','name' => 'password',
 'id' => 'password', 'value'=> set_value('password'), 'class'=>'form-control', 'placeholder'=>'
 Password')); ?> 
</div><div class="form-group">
    <?= form_error('pass_conf'); ?>
      <?= form_input(array('type'=>'password','name' => 'pass_conf',
 'id' => 'pass_conf', 'value'=> set_value('pass_conf'), 'class'=>'form-control', 'placeholder'=>'
 Confirm Password')); ?> 
</div>
</fieldset>
<?= form_close() ?>
</div>

        </div>


        
        
    

      </div>
      </div>
  </div><!--end jumbotron-->
      <hr>
          <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=assetUrl()?>js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?=assetUrl()?>js/vendor/bootstrap.min.js"></script>

        <script src="<?=assetUrl()?>js/main.js"></script>


        

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?=assetUrl()?>js/vendor/jquery-1.12.0.min.js"><\/script>')</script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
        <script>


</script>
    </body>