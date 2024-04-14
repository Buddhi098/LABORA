<?php
    class RefundConfirm extends Controller{
        private $md_appointment;
        public function __construct(){
            $this->md_appointment = $this->model('M_appointment');
        }


        public function confirmRefund($refund_key , $confirmed='no'){
            if($confirmed == 'yes'){
                $appointment = $this->md_appointment->completeRefundByRefundKey($refund_key);
            }else{
                $data['key'] = $refund_key;
                $isCorrectRefundKey = $this->md_appointment->isExistRefundKey($refund_key);
                if($isCorrectRefundKey){
                    $this->view('receptionist/refund_confirm' , $data);
                }else{
                    echo "Not a correct link";
                    die();
                }
            }
        }
    }

?>