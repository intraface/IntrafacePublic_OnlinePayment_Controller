

<div id="payment-forward">
    <p>Du er nu klar til at betale din <?php echo $target_type ?> på <strong><?php echo $total_price; ?></strong> kr.</p>

    <p>Betaling foregår via sikker betalingserver hos <?php echo $payment_provider; ?></p>
    
    <form method="POST" action="<?php echo $post_action; ?>">
    
    <?php echo $input_fields; ?>
    
    <p><input type="submit" name="pay" value="Gå til betaling" /></p>
    
    </form>
    
</div>