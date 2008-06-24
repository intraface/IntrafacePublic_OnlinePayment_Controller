

<div id="payment-forward">
    <p><?php e(__('You are now ready to pay your '.$target_type.' of')); ?> <strong><?php echo $total_price; ?></strong> kr.</p>

    <p><?php e(__('The payment is made through a secure payment server provided by')); ?> <?php echo $payment_provider; ?></p>
    
    <form method="POST" action="<?php echo $post_action; ?>">
    
    <?php echo $input_fields; ?>
    
    <p><input type="submit" name="pay" value="<?php e(__('Continue to payment...')); ?>" /></p>
    
    </form>
    
</div>