<div id="payment-forward">
    <p><?php e(__('You are now ready to pay your '.$target_type.' of')); ?> <strong>DKK <?php e($total_price); ?></strong>.</p>

    <p><?php e(__('The payment is made through a secure payment server provided by')); ?> <?php e($payment_provider); ?></p>
    
    <form method="POST" action="<?php e($post_action); ?>">
    
        <?php echo $input_fields; ?>
    
        <p id="purchase-continue"><input type="submit" name="pay" value="<?php e(t('Continue')); ?>" /></p>
    
    </form>
</div>