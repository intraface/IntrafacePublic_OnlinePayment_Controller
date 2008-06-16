

<div id="payment-error">
    <p>Betalingen kunne ikke gennemf�res.</p>
    <?php if(!empty($error)): ?>
        <p>Du fik f�lgende fejlbesked:</p>
        <ul class="error"><li><?php e($error); ?></li></ul>
    <?php endif; ?>
        
    <p>Pr�v at foretage betalingen igen. Bliver fejlen ved, er du velkommen til at kontakte os.</p>
    <p>Fors�g igen at betale din <?php echo $target_type ?> p� <strong><?php echo $total_price; ?></strong> kr.</p>

    <form method="POST" action="<?php echo $post_action; ?>">
    
    <?php echo $input_fields; ?>
    
    <p><input type="submit" name="pay" value="Fors�g igen..." /></p>
    
    </form>
    <p>Betaling foreg�r via sikker betalingserver hos <?php echo $payment_provider; ?></p>
    
</div>