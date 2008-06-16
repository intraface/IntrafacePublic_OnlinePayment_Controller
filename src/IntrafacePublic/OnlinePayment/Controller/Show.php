<?php

class IntrafacePublic_OnlinePayment_Controller_Show extends k_Controller
{
    private $error = array();

    function __construct($context, $name)
    {
        parent::__construct($context, $name);

        $GLOBALS['_global_function_callback_e'] = Array($this, 'outputString');
        $GLOBALS['_global_function_callback_url'] = Array($this, 'url');
    }

    function GET()
    {
        $onlinepayment = $this->registry->get('onlinepayment');
        
        try {
            $payment_target = $onlinepayment->getPaymentTarget($this->name);
        }
        catch (Exception $e) {
            throw $e;
        }
        
        $prepare = $this->registry->get('onlinepayment:payment_html')->getPrepare();
        $prepare->setPaymentValues($payment_target['id'], 
            $payment_target['arrears'],
            'DKK',
            'DK',
            $this->context->getOkUrl(),
            $this->url('.', array('error' => 1)),
            $this->url('./postprocess'),
            $this->url('./input'));
        
        
        
        // if no slashes in destination it is local.
        if(!strpos('/', $prepare->getPostDestination())) {
            $destination = $this->url($prepare->getPostDestination());
        }
        else {
            $destination = $prepare->getPostDestination();
        }
        
        $data['input_fields'] = $prepare->getPostFields();
        $data['post_action'] =  $destination;
        $data['target_type'] = $payment_target['type'];
        $data['total_price'] = $payment_target['arrears'];
        $data['payment_provider'] = $prepare->getProviderName();
        $data['error'] = $this->error;

        if(!empty($this->GET['error'])) {
            return $forward = $this->render('IntrafacePublic/OnlinePayment/templates/payment-error-tpl.php', $data);
        }
        else {
            return $forward = $this->render('IntrafacePublic/OnlinePayment/templates/payment-forward-tpl.php', $data);
        }
    }
    
    public function forward($name) 
    {
        /**
         * The provider payment server makes an http post call to the postprocess page.
         * This page then adds the payment to intraface.
         * 
         */
        if($name == 'postprocess') {
            $next = new IntrafacePublic_OnlinePayment_Controller_PostProcess($this, $name);
            return $next->handleRequest();
        }
        
        /**
         * The input page provides html input fields for the provider payment server. 
         * The server gets the fields through a http call.
         */
        if($name == 'input') {
            $next = new IntrafacePublic_OnlinePayment_Controller_Input($this, $name);
            return $next->handleRequest();
        }
        
        /**
         * Returns a confirmation that the payment was successfull
         */
        if($name == 'receipt') {
            $next = new IntrafacePublic_OnlinePayment_Controller_Receipt($this, $name);
            return $next->handleRequest();
        }
        
        
        $prepare = $this->registry->get('onlinepayment:payment_html')->getPrepare();
        // if there is no slashes in post destination it must be a local server.
        if(!strpos('/', $prepare->getPostDestination()) && $name == $prepare->getPostDestination()) {
            $next = new Ilib_Payment_Html_Controller_Server($this, $name);
            return $next->handleRequest();
        }
    }
}

