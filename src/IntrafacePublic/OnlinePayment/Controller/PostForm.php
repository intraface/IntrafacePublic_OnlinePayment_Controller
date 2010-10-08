<?php
/**
 * The post form page provides html post formfor the provider payment server.
 * The server gets the fields through a http call.
 * To create custom page with payment input fields.
 */

class IntrafacePublic_OnlinePayment_Controller_PostForm extends k_Component
{
    protected $template;

    function __construct(k_TemplateFactory $template)
    {
        $this->template = $template;
    }

    public function renderHtml()
    {
        if (false !== ($onlinepayment = $this->getOnlinePayment())) {
            try {
                $payment_target = $onlinepayment->getPaymentTarget($this->context->name());
            } catch (Exception $e) {
                throw $e;
            }
        } else {
            throw new Exception('Onlinepayment object is not present. Root controller should have method getOnlinePayment');
        }

        if ($this->query('receipturl')) {
            $receipt_url = $this->query('receipturl');
        } else {
            $receipt_url = $this->context->context->getOkUrl();
        }

        $data['form'] = $this->getOnlinePaymentAuthorize()->getForm(
            $payment_target['id'], // Order number
            $payment_target['arrears'][$payment_target['default_currency']], // amount
            $payment_target['default_currency'], // currency
            'DK', // language
            $receipt_url,  // okpage
            $this->url('../'),  // errorpage
            $this->url('../postprocess'), // resultpage
            $this->query(), // GET
            $this->body() // POST
        );
        $data['secure_tunnel'] = $data['form']->getSecureTunnel();
        $data['creditcard_logos'] = array(
                array('url' => $this->url('/images/creditcard-logo/dan-s.gif'), 'width' => '32', 'height' => '18'),
                array('url' => $this->url('/images/creditcard-logo/visa-s.gif'), 'width' => '32', 'height' => '20'),
                array('url' => $this->url('/images/creditcard-logo/elec-s.gif'), 'width' => '32', 'height' => '20'),
                array('url' => $this->url('/images/creditcard-logo/mc-s.gif'), 'width' => '32', 'height' => '22'),
                array('url' => $this->url('/images/creditcard-logo/maestro-s.gif'), 'width' => '32', 'height' => '20'),
                array('url' => $this->url('/images/creditcard-logo/jcb-s.gif'), 'width' => '19', 'height' => '24'));

        $tpl = $this->template->create('IntrafacePublic/OnlinePayment/templates/payment-form');
        $response = $tpl->render($this,  $data);

        return new k_HttpResponse(200, $response);
    }

    public function postForm()
    {
        return $this->render();
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

    function getCompanyName()
    {
        $data = $this->getCompanyInformation();
        return $data['name'];
    }

    function getCompanyAddress()
    {
        $data = $this->getCompanyInformation();
        return $data['address'];
    }

    function getCompanyZip()
    {
        $data = $this->getCompanyInformation();
        return $data['postcode'] . ' ' . $data['city'];
    }

    function getCompanyVatNumber()
    {
        $data = $this->getCompanyInformation();
        return $data['cvr'];
    }
}