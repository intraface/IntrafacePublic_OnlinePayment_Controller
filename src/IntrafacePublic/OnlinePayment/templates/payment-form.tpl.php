<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php e(t('Payment')); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
@charset "utf-8";
/* CSS Document */
#outer {
	margin: auto;
}
#step4 #outer{width:585px}
/*
#step4 h1,#step4 h1 a{
    width:121px;
    height:66px;
    overflow:hidden;
    position:relative;
    display:block;
}
*/
#step4 h1{margin:10px 0}
#step4 h1 em{
    position:absolute;
    width:121px;
    height:66px;
    left:0;
    top:0;
}
#step4 ul.steps{margin:7px auto 21px auto}
.s4top{
    float:left;
    width:283px;
    margin:0 19px 17px 0;
    font-size:12px;
}
.s4toplast{margin:0 0 17px}
#step4 fieldset{
    margin:0;
    border:1px solid #959595;
    padding:0 0 10px;
}
.s4-inner{min-height:130px}
#step4 legend{
    color:#315fd7;
    font-size:12px;
    font-weight:bold;
    margin:0 0 0px 8px;
    padding:0 5px;
}
#step4 input,#step4 select{font-size:11px;}
#step4 select{margin:0 0 5px}
.s4top div{
    width:100%;
    overflow:hidden;
    clear:both;
    padding:5px 0 0 0;
}
input.inp115,input.inp27{
    width:112px;
    padding:2px 5px 1px;
    background:#fff;
    border:1px solid #cdcdcd;
    border-top:1px solid #8e8e8e;
    border-bottom:1px solid #e3e3e3;
    margin:0 0 6px;
    font-size:10px;
}
input.inp27{width:27px}
input.godkend{
    background:#4e8db8 url(<?php e($secure_tunnel.url('/images/but-tilb-god.gif')); ?>) no-repeat 0 0;
    width:78px;
    height:19px;
    overflow:visible;
    text-align:center;
    color:#fff;
    margin-left:113px;
    padding:0 0 1px;
    border:none;
}
.s4top label{
    width:88px;
    margin:0 0 10px 15px;
    float:left;
    display:inline;
    padding:0 10px 0 0;
    font-size:11px;
    position:relative;
    top:4px;
}
#step4 div.stop{padding:10px 0 0 0;}
.s4toplast p{
    width:100%;
    overflow:hidden;
    clear:both;
    padding:5px 0 0;
    margin:0;
    line-height:1.2;
}
.s4toplast p span{
    float:left;
    margin:0 0 5px 15px;
    float:left;
    width:88px;
    padding:0 10px 0 0;
    font-size:11px;
}
.s4toplast p b{
    display:block;
    overflow:hidden;
    font-weight:normal;
}
.s4base{
    clear:both;
    width:100%;
    margin:0;
    font-size:11px;
    line-height:1.2;
}
#step4 h3{margin:33px 23px 0;font-size:11px}
.s4base p{margin:0 23px 25px}
.s4base p.security{margin:0 23px;padding:0 0 8px}

div.errormesssage {color: red;margin: 20px 0px 20px 0px; }
</style>

</head>
<body id="step4">


<div id="outer">
    <?php if (!empty($context->document()->company_name)): ?>
        <h1><a href="#"><?php e($context->document()->company_name); ?><em></em></a></h1>
    <?php else: ?>
        <h1><?php e(t('Online payment')); ?></h1>
    <?php endif; ?>
        <div class="errormesssage"><?php if('' != ($errormessage = $form->getErrorMessage())) echo t($errormessage); ?></div>
        <form action="<?php $url = $form->getAction(); if(substr($url, 0, 7) != 'http://' && substr($url, 0, 8) != 'https://') $url = url('../'.$url); echo $url; ?>" method="post" autocomplete="off" id="payment_details">
            <?php echo $form->getHiddenFields(); ?>


            <div class="s4top">
            <fieldset class="clearfix">
            <legend><span><?php e(t('Card information')); ?></span></legend>
            <div class="s4-inner">
                <div class="stop">
                    <label for="cardnum"><?php e(t('Card number')); ?></label>
                    <input type="text" maxlength="16" size="19" name="<?php echo $form->getCardNumberFieldName(); ?>" id="cardnum" />
                </div>
                <div>
                    <label for="month"><?php e(t('Expire date')); ?></label>
                    <span>
                <select name="<?php echo $form->getExpireMonthFieldName(); ?>" class="s4-select" id="month">
                    <?php
                    $month_array = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
                    foreach($month_array as $month) {
                        echo '<option value="'.$month.'">'.$month.'</option>';
                    }
                    ?>
                </select>
                <strong class="slash">/</strong>
                <select name="<?php echo $form->getExpireYearFieldName(); ?>" class="s4-select" id="year">
                    <?php
                    $current_year = date('Y');
                    for($i = $current_year; $i < $current_year + 16; $i++) {
                        echo '<option value="'.substr($i, -2).'">'.substr($i, -2).'</option>';
                    }
                    ?>
                </select>
                    </span>
                </div>
                <div>
                    <label for="cvd"><?php e(t('Security no.')); ?></label>
                    <input type="text" maxlength="3" size="3" name="<?php echo $form->getSecurityNumberFieldName(); ?>" id="cvd" />
                </div>
                <div>
                    <input class="godkend" name="submit" type="submit" id="submit" value="<?php e(t('Pay')); ?>" />
                </div>
            </div>
            </fieldset>
        </div>
        <div class="s4top s4toplast">
            <fieldset class="clearfix">



            <legend><span><?php e(t('Company')); ?></span></legend>
            <div class="s4-inner">
                <p class="stop"><strong><span><?php e(t('Total amount')); ?></span></strong>
                <?php e($form->getCurrency().' '.$form->getAmount()->getAsLocale($context->document()->locale(), 2)); ?></p>
                <!--
                <p><strong><span><?php e(t('Order')); ?></span>xxx</strong></p>
                -->
                <p><span><?php e(t('Company')); ?></span> <b><?php e($context->getCompanyName()); ?><br />
                    <?php e($context->getCompanyAddress()); ?><br />
                    <?php e($context->getCompanyZip()); ?></b></p>
                <p><span><?php e(t('Vat no.')); ?></span><?php e($context->getCompanyVatNumber()); ?></p>
            </div>
            </fieldset>
        </div>
       </form>
        <div class="s4base">
            <fieldset class="clearfix">
            <legend><span><?php e(t('Available cards')); ?></span></legend>
                <?php
                if(isset($creditcard_logos) && is_array($creditcard_logos)) {
                    foreach($creditcard_logos as $logo) {
                        echo '<img src="'.$secure_tunnel.$logo['url'].'" class="creditcard-logo" width="'.$logo['width'].'" height="'.$logo['height'].'" style="margin: 4px;" />';
                    }
                }
                ?>
            </fieldset>
        </div>
        <br />
        <div class="s4base">
            <fieldset class="clearfix">
            <legend><span><?php e(t('Information on the card')); ?></span></legend>
            <h3><?php e(t('Where can I find the security number?')); ?></h3>
            <p><?php e(t('The security number can be found on the back of your card. The numbers can be placed in different places on different card types. The illustration below shows some different examples. The security number gives increased security when shopping online.')); ?></p>
            <p class="security"><img src="<?php e($secure_tunnel.url('/images/security-num.jpg')); ?>" alt="<?php e(t('Security number')); ?>" width="450" height="108" /></p>
            </fieldset>
        </div>
</div>
</body>
</html>