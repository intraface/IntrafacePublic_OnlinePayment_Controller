<?php
class IntrafacePublic_OnlinePayment_Controller_Show extends k_Component
{
    protected $template;

    function __construct(k_TemplateFactory $template)
    {
        $this->template = $template;
    }

    public function map($name)
    {
        if ($this->isPaid()) {
            throw new k_PageNotFound(404);
        }

        // The provider payment server makes an http post call to the postprocess page.
        // This page then adds the payment to intraface.
        if ($name == 'postprocess') {
            return 'IntrafacePublic_OnlinePayment_Controller_PostProcess';
        }

        // The post form page makes the post form to post to the payment server.
        if ($name == 'postform') {
            return 'IntrafacePublic_OnlinePayment_Controller_PostForm';
        }

        // Returns a confirmation that the payment was successfull
        if ($name == 'receipt') {
            return 'IntrafacePublic_OnlinePayment_Controller_Receipt';
        }

        // A payment process'er  for testing.
        if ($name == 'paymentprocess') {
            return 'IntrafacePublic_OnlinePayment_Controller_PaymentProcess';
        }
    }


    function renderHtml()
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
            $this->query(),
            $this->body()
        );

        $data['order_number'] =  $payment_target['number'];
        $data['date']         =  $payment_target['this_date'];
        $data['target_type']  = $payment_target['type'];
        $data['total_price']  = $payment_target['arrears'][$payment_target['default_currency']];

        if ($this->isPaid()) {
            $tpl = $this->template->create('IntrafacePublic/OnlinePayment/templates/payment-alreadypaid');
            return $tpl->render($this, $data);
        }

        if ($this->query('error')) {
            $data['error_message'] = 'An error occured. Please try again';
        }

        $tpl = $this->template->create('IntrafacePublic/OnlinePayment/templates/payment-forward');
        return $tpl->render($this, $data);
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

    function getPaymentTarget()
    {
        return $this->getOnlinePayment()->getPaymentTarget($this->name);
    }

    function isPaid()
    {
        $payment_target = $this->getPaymentTarget();
        if ($payment_target['payment_online'] >= $payment_target['arrears'][$payment_target['default_currency']]) {
            return true;
        }
        return false;
    }
}
