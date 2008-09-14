<div id="payment-error">
    <p><?php e(__('The payment could not be proccessed.')); ?></p>
    <?php if(!empty($error)): ?>
        <p><?php e(__('You have got the following error message')); ?></p>
        <ul class="error">
            <li><?php e($error); ?></li>
        </ul>
    <?php endif; ?>
        
    <p><?php e(__('Try again, or contact us.')); ?></p>
    <p><?php e(__('Try again to pay your')); ?> <?php e($target_type); ?> <strong>DKK <?php e($total_price); ?></strong>.</p>

    <form method="POST" action="<?php e($post_action); ?>">
    
    <?php echo $input_fields; ?>
    
    <p><input type="submit" name="pay" value="<?php e(__('Try again...')); ?>" /></p>
    
    </form>
    
    <p><?php e(__('The payment is made through a secure payment server provided by')); ?> <?php e($payment_provider); ?></p>
    
</div>