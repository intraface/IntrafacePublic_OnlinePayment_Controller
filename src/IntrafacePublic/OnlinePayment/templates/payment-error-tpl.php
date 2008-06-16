

<div id="payment-error">
    <p>Betalingen kunne ikke gennemføres.</p>
    <?php if(!empty($error)): ?>
        <p>Du fik følgende fejlbesked:</p>
        <ul class="error"><li><?php e($error); ?></li></ul>
    <?php endif; ?>
        
    <p>Prøv at foretage betalingen igen. Bliver fejlen ved, er du velkommen til at kontakte os.</p>
    <p>Forsøg igen at betale din <?php echo $target_type ?> på <strong><?php echo $total_price; ?></strong> kr.</p>

    <form method="POST" action="<?php echo $post_action; ?>">
    
    <?php echo $input_fields; ?>
    
    <p><input type="submit" name="pay" value="Forsøg igen..." /></p>
    
    </form>
    <p>Betaling foregår via sikker betalingserver hos <?php echo $payment_provider; ?></p>
    
</div>