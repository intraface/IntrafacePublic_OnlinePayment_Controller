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
        $template = $this->registry->get('onlinepayment:payment_html')->getInput()->getInputTemplatePath();
        
        $response = $this->render('IntrafacePublic/OnlinePayment/templates/payment-input-container-tpl.php', array('content' => $this->render($template, array())));
        
        throw new k_http_Response(200, $response);
    }

}

?>
