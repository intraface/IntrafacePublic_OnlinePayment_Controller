<?php
/**
 * The input page provides html input fields for the provider payment server. 
 * The server gets the fields through a http call. 
 * To create custom page with payment input fields.
 */

class IntrafacePublic_OnlinePayment_Controller_Receipt extends k_Controller
{
    public function GET() 
    {
        
        return $this->__('We have recieved your payment! Have a nice day');
    }

}

?>
