<?php
class IntrafacePublic_OnlinePayment_Controller_Index extends k_Controller
{
    private $error = array();

    /**
     * Returns the url to go to when payment is succeded.
     * Placed here makes it possible to overwrite the method in local contexts.
     */
    public function getOkUrl()
    {
        return $this->url('./receipt');
    }

    public function GET()
    {
        throw new Exception('You need to specify an order to pay!');
    }

    public public function forward($name)
    {
        $next = new IntrafacePublic_OnlinePayment_Controller_Show($this, $name);
        return $next->handleRequest();
    }

    public function getCompanyInformation()
    {
    	return $this->context->getCompanyInformation();
    }
    
    /**
     * Return Ilib_Payment_Authorize
     */
    public function getOnlinePaymentAuthorize()
    {
        return $this->context->getOnlinePaymentAuthorize();
    }
    
    /**
     * Return IntrafacePublic_Onlinepayment
     */
    public function getOnlinePayment()
    {
        return $this->context->getOnlinePayment();
    }
}

