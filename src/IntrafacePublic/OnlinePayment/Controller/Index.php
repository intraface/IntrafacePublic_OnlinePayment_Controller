<?php
class IntrafacePublic_OnlinePayment_Controller_Index extends k_Component
{
    protected $error = array();

    /*
    public function __construct($context, $name)
    {
        parent::__construct($context, $name);

        # We set locale to en_US as default.
        if(empty($this->document->locale)) $this->document->locale = 'en_US';
    }
    */

    public function map($name)
    {
        return 'IntrafacePublic_OnlinePayment_Controller_Show';
    }

    public function renderHtml()
    {
        throw new k_PageNotFound();
    }

    /**
     * Returns the url to go to when payment is succeded.
     * Placed here makes it possible to overwrite the method in local contexts.
     */
    public function getOkUrl()
    {
        return $this->url('./receipt');
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
