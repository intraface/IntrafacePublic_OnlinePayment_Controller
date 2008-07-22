<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="da" xml:lang="da">
<head>
    <title><?php e(__('Payment')); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php e($encoding); ?>" />
    <style type="text/css">
        body { 
            font-family: Verdana, sans-serif; 
            font-size: 0.8em; 
            background:  white; 
            color: #000; 
            margin: 0; 
            padding: 0;
            text-align: center;
        }
                
        div#container { 
            padding: 2em;
            margin: 2em auto; 
            background: white; 
            width: 40em; 
            text-align: left; 
            color: black;
        }
        
        form#payment_details {
            
            border: 10px solid #f6ed70;
            padding: 2em; 
        }
        
        div#formrow {
            padding: 0.5em; 
            background-color: #f7f4ab;
            
        }
        
        div#formrow label {
            width: 13em;
            display: block;
            float: left;
        }
        
        div#formrow:hover {
            background-color: #EEEEEE;
        }
        
        div#cards_container {
            padding: 0.5em;
        }
        
        div#cards_container img {
            padding: 0em 0.2em;
        }
        
        p.cards {
            display: inline;
            margin-left: 1em;
        }
       
    </style>
</head>

<body>
    <div id="container">
        <?php echo $content; ?>
    </div>
</body>
</html> 