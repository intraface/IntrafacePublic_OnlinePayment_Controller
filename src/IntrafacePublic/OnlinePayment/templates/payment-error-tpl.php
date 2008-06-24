

<div id="payment-error">
    <p><?php e(__('The payment could not be proccessed')); ?></p>
    <?php if(!empty($error)): ?>
        <p><?php e(__('You have got the followin error message')); ?></p>
        <ul class="error"><li><?php e($error); ?></li></ul>
    <?php endif; ?>
        
    <p><?php e(__('You can try again to see if the error keeps appearing, or you can contact us.')); ?></p>
    <p><?php e(__('Try again to pay your'.$target_type.' of')); ?> <strong><?php echo $total_price; ?></strong> kr.</p>

    <form method="POST" action="<?php echo $post_action; ?>">
    
    <?php echo $input_fields; ?>
    
    <p><input type="submit" name="pay" value="<?php e(__('Try again...')); ?>" /></p>
    
    </form>
    <p><?php e(__('The payment is made through a secure payment server provided by')); ?> <?php echo $payment_provider; ?></p>
    
</div>