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
        
        
        $response = $this->render('IntrafacePublic/OnlinePayment/templates/payment-input-container-tpl.php', array('content' => $this->render($template, $data)));
        
        throw new k_http_Response(200, $response);
    }

}

?>
