<?php
/**
 * The input page provides html input fields for the provider payment server.
 * The server gets the fields through a http call.
 * To create custom page with payment input fields.
 */

class IntrafacePublic_OnlinePayment_Controller_Input extends k_Controller
{
    public function GET()
    {
        $input = $this->registry->get('onlinepayment:payment_html')->getInput();
        $template = $input->getInputTemplatePath();
        $data['request_get'] = $this->GET->getArrayCopy();
        $data['request_post'] = $this->POST->getArrayCopy();
        $data['merchant'] = $input->getMerchant();
        $data['verification_key'] = $input->getVerificationKey();
        $data['ok_url'] = $this->context->context->getOkUrl();
        $data['error_url'] = $this->url('../', array('error' => 1));
        $data['postprocess_url'] = $this->url('../postprocess');
        $data['secure_tunnel_url'] = $input->getSecureTunnelUrl();
        $data['creditcard_logos'] = array(
                array('url' => $this->url('/images/creditcard-logo/dan-xs.gif'), 'width' => '32', 'height' => '18'),
                array('url' => $this->url('/images/creditcard-logo/visa-xs.gif'), 'width' => '32', 'height' => '20'),
                array('url' => $this->url('/images/creditcard-logo/elec-xs.gif'), 'width' => '32', 'height' => '20'),
                array('url' => $this->url('/images/creditcard-logo/mc-xs.gif'), 'width' => '32', 'height' => '22'),
                array('url' => $this->url('/images/creditcard-logo/maestro-xs.gif'), 'width' => '32', 'height' => '20'),
                array('url' => $this->url('/images/creditcard-logo/jcb-xs.gif'), 'width' => '19', 'height' => '24'));

        $response = $this->render('IntrafacePublic/OnlinePayment/templates/payment-input-container-tpl.php', array('content' => $this->render($template, $data)));

        throw new k_http_Response(200, $response);
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
        return $data['postalcode'] . ' ' . $data['city'];
    }

    function getCompanyVatNumber()
    {
        $data = $this->getCompanyInformation();
        return $data['cvr'];
    }
}