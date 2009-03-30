<?php
/**
 * The payment process page process' the payment on test servers.
 */

class IntrafacePublic_OnlinePayment_Controller_PaymentProcess extends k_Controller
{
    public function POST()
    {
        
        $payment_authorize = $this->getOnlinePaymentAuthorize();
        if(!is_callable(array($payment_authorize, 'getPaymentProcess'))) {
            throw new Exception('There is no payment process in the payment provider');
        }
        
        $payment_process = $payment_authorize->getPaymentProcess();
        $session =& $this->registry->get('k_http_Session')->get();
        
        $url = $payment_process->process(
            $this->POST->getArrayCopy(),
            $session
        );
        
        throw new k_Http_Redirect($url);
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
}