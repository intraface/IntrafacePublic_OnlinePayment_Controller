<?php
/**
 * The receipt page provides. 
 */
class IntrafacePublic_OnlinePayment_Controller_Receipt extends k_Controller
{
    public function GET() 
    {
        return $this->__('We have recieved your payment! Have a nice day');
    }
}

