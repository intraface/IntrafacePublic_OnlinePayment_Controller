<?php
class IntrafacePublic_OnlinePayment_Controller_Show extends k_Controller
{
    
    function GET()
    {
        $onlinepayment = $this->getOnlinePayment();
        try {
            $payment_target = $onlinepayment->getPaymentTarget($this->name);
        } catch (Exception $e) {
            throw $e;
        }

        $data['prepare'] = $this->getOnlinePaymentAuthorize()->getPrepare(
            $this->name,
            $payment_target['id'],
            $payment_target['arrears'][$payment_target['default_currency']],
            $payment_target['default_currency'],
            'DK',
            $this->context->getOkUrl(),
            $this->url('.', array('error' => 1)),
            $this->url('./postprocess'),
            $this->url('./postform'),
            $this->GET->getArrayCopy(),
            $this->POST->getArrayCopy()
        );
        
        $data['order_number'] =  $payment_target['number'];
        $data['date'] =  $payment_target['this_date'];
        $data['target_type'] = $payment_target['type'];
        $data['total_price'] = $payment_target['arrears'][$payment_target['default_currency']];
       
        if (!empty($this->GET['error'])) {
            $data['error_message'] = $this->__('An error occured. Please try again');
        }
        
        return $this->render('IntrafacePublic/OnlinePayment/templates/payment-forward-tpl.php', $data);
        
    }

    public function forward($name)
    {
        // The provider payment server makes an http post call to the postprocess page.
        // This page then adds the payment to intraface.
        if ($name == 'postprocess') {
            $next = new IntrafacePublic_OnlinePayment_Controller_PostProcess($this, $name);
            return $next->handleRequest();
        }
        
        // The post form page makes the post form to post to the payment server.
        if ($name == 'postform') {
            $next = new IntrafacePublic_OnlinePayment_Controller_PostForm($this, $name);
            return $next->handleRequest();
        }

        // Returns a confirmation that the payment was successfull
        if ($name == 'receipt') {
            $next = new IntrafacePublic_OnlinePayment_Controller_Receipt($this, $name);
            return $next->handleRequest();
        }
        
        // A payment process'er  for testing.
        if ($name == 'paymentprocess') {
            $next = new IntrafacePublic_OnlinePayment_Controller_PaymentProcess($this, $name);
            return $next->handleRequest();
        }
    }
    
    /**
     * Return Ilib_Payment_Authorize
     * 
     * @return object Ilib_Payment_Authorize
     */
    public function getOnlinePaymentAuthorize()
    {
        return $this->context->getOnlinePaymentAuthorize();
    }
    
    /**
     * Return IntrafacePublic_Onlinepayment
     * 
     * @return object IntrafacePublic_OnlinePayment
     */
    public function getOnlinePayment()
    {
        return $this->context->getOnlinePayment();
    }

    function getCompanyInformation()
    {
        return $this->context->getCompanyInformation();
    }
}

