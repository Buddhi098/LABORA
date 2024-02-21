<?php
    class Home extends Controller{
        private $md_testtype;
        public function __construct(){
            $this->md_testtype = $this->model('M_testtype');
        }
        public function index(){
            $this->view("Home" , []);
        }

        public function getService(){
            $result = $this->md_testtype->getRow();
            exit(json_encode($result));
        }
    }
?>