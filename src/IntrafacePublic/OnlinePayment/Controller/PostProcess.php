<?php
/**
 * The provider payment server makes an http post call to the postprocess page.
 * This page then adds the payment to intraface.
 */

class IntrafacePublic_OnlinePayment_Controller_PostProcess extends k_Controller
{
    
    
    public function POST() {
        
        $onlinepayment = $this->registry->get('onlinepayment');
        
        try {
            $payment_target = $onlinepayment->getPaymentTarget($this->context->name);
        }
        catch (Exception $e) {
            
            throw new Exception('Invalid payment target. Wrong url');
        }
        
        $postprocess = $this->registry->get('onlinepayment:payment_html')->getPostProcess();
        
        if($postprocess->setPaymentResponse($this->POST->getArrayCopy())) {
            try {
                $onlinepayment->saveOnlinePayment(
                    $this->context->name, 
                    $postprocess->getTransactionNumber(),
                    $postprocess->getTransactionStatus(),
                    $postprocess->getAmount());
            }
            catch(Exception $e) {
                
            }
        }
        else {
            
            // We will probably not be able to see this, but if error handler logs the exception i guess we can find it.        
            throw new Exception('Error in payment!');
        }
        
    }
}