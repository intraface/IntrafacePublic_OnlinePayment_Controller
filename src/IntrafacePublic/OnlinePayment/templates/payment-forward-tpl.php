<div id="payment-forward">
    <p><?php e(__('You are now ready to pay the following ' . $target_type)); ?>:</p>

    <table>
        <caption><?php e(__('Order information')); ?></caption>
        <tbody>
        <tr>
            <th><?php e(__('Order number')); ?></th>
            <td><?php e($order_number); ?></td>
        </tr>
        <tr>
            <th><?php e(__('Date')); ?></th>
            <td><?php e($date); ?></td>
        </tr>
        <tr>
            <th><?php e(__('Amount')); ?></th>
            <td>DKK <?php e($total_price); ?></td>
        </tr>  
        </tbody>               
    </table>

    <p><?php e(__('The payment is made through a secure payment server provided by')); ?> <?php e($payment_provider); ?></p>
    
    <form method="POST" action="<?php e($post_action); ?>">
    
        <?php echo $input_fields; ?>
    
        <p id="purchase-continue"><input type="submit" name="pay" value="<?php e(t('Continue')); ?>" /></p>
    
    </form>
</div>