<?php
/**
 * The provider payment server makes an http post call to the postprocess page.
 * This page then adds the payment to intraface.
 */
class IntrafacePublic_OnlinePayment_Controller_PostProcess extends k_Controller
{
    public function GET() 
    {
        return $this->POST();
    }
    
    public function POST() 
    {
        $onlinepayment = $this->getOnlinepayment();
        
        try {
            $payment_target = $onlinepayment->getPaymentTarget($this->context->name);
        } catch (Exception $e) {
            throw new Exception('Invalid payment target. Wrong url');
        }
        
        $postprocess = $this->getOnlinePaymentAuthorize()->getPostProcess(
            $this->POST->getArrayCopy(), 
            $this->GET->getArrayCopy(), 
            $this->registry->get("k_http_Session")->get(), 
            $payment_target
        );
        try {
            $onlinepayment->saveOnlinePayment(
                $this->context->name, 
                $postprocess->getTransactionNumber(),
                $postprocess->getTransactionStatus(),
                $postprocess->getPbsStatus(),
                $postprocess->getAmount(),
                $postprocess->getCurrency());
        } catch(Exception $e) {
            throw $e;
        }
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
    
}