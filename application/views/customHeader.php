<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>CloudPOS</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

 		<link rel="stylesheet" type="text/css" href="<?= assetUrl(); ?>css/customMain.css">
        <link rel="stylesheet" href="<?= assetUrl(); ?>bootstrap/css/bootstrap.min.css">
        <style>
        -webkit-text-stroke: 1.0px #000000;
        -webkit-text-fill-color: #FFFFFF
            body {
                padding-top: 20px;
                padding-bottom: 20px;
            }
            .customBar{
                background-color: <?=$org_details['company_color']?>;
            }
            .customFooter{
                background-color: <?=$org_details['company_color']?>;
            }

        </style>
        <link rel="stylesheet" href="<?= assetUrl(); ?>css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?= assetUrl(); ?>css/BoilerPlate.css">

        <script src="<?= assetUrl(); ?>js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>

<div id="logoDiv" >
<img id="logo"src="<?= assetUrl() ?>img/<?= $org_details['name'] ?>/<?= $org_details['image'] ?>" height="125px">
</div>

