<div id="errormessage"><?php if('' != ($errormessage = $prepare->getErrorMessage())) echo __('An error has occured, please try again').': '.__($errormessage); ?></div>
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
            <td><?php e($prepare->getCurrency().' '.number_format($prepare->getAmount(), 2, ',', '.')); ?></td>
        </tr>
        </tbody>
    </table>

    <p><?php e(__('The payment is made through a secure payment server provided by')); ?> <?php e($prepare->getProviderName()); ?></p>

    <form method="POST" action="<?php $url = $prepare->getAction(); if(substr($url, 0, 7) != 'http://' && substr($url, 0, 8) != 'https://') $url = url($url); echo $url; ?>">
        <?php echo $prepare->getHiddenFields(); ?>
        <p id="purchase-continue"><input type="submit" name="pay" id="submit" value="<?php e(t('Continue')); ?>" /></p>
    </form>

</div>