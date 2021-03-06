<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>INV#-<?=$order['order_ID']?></title>
    
    <style>
    .invoice-box {
        background: white;
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?= assetUrl() ?>img/<?= $org_details['name'] ?>/<?= $org_details['image'] ?>" style="width:100%; max-width:150px;">
                            </td>
                            
                            <td>
                                Invoice #: <?=$order['order_ID']?><br>
                                Created: <?=$order['date']?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>
                                <?= $org_details['name'] ?><br>
                                <?=$org_address['address']?><br>
                                <?=$org_address['city']?>, <?=$org_address['country']?>
                            </td>
                            
                            <td>
                                <?=$cont['company']?>.<br>
                                <?=$cont['first_name']." ".$cont['last_name']?><br>
                                <?=$cont['email']?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php if ($order['status']=="paid"):?>
            <tr class="heading">
                  
                <td colspan="3"><img src="<?= assetUrl() ?>img/paid.jpg" style="width:100%; max-width:100px;"/></td>

            </tr>

            <?php endif ?>
            <tr class="heading">
                <td>
                    Item
                </td>
                
                <td>
                    Quantity
                </td>
                <td>
                    Price
                </td>
            </tr>
            <?php foreach ($items as $key => $value) : ?>
                
            <tr class="item">
                <td>
                    <?= $value['NameDesc'] ?>
                </td>
                <td>
                    <?= $value['quantity'] ?>
                </td>
                <td>
                    <?= $value['line_sub_total'] ?>
                </td>
            </tr>
            <?php endforeach ?>
           
            
            <tr class="total">
                <td></td>
                <td></td>
                <td>
                   Total: $<?=$order['total']?>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>