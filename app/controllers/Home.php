<?php
    class Home extends Controller{
        private $md_testtype;
        public function __construct(){
            $this->md_testtype = $this->model('M_testtype');
        }
        public function index(){
            $this->view("Home" , []);
        }

        public function getService($id , $table_id=0){
            if($id == 0){
                $result = $this->md_testtype->getRowNew();
                $table_id_ = $result['table_id'];
                $result = $result['result'];
            }else{
                $result = $this->md_testtype->getRowNew();
                $table_id_ = $table_id;
                $result = $result['result'];
            }
            $preparation = $this->md_testtype->getPreparationsById($table_id_);
            $data['result'] = $result;
            $data['preparation'] = $preparation;

            exit(json_encode($data));
        }
    }
?>