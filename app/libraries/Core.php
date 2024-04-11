<?php
    class Core{
        // URL format --> /controller/method/params
        protected $currentController = 'Home';
        protected $currentMethod = 'index';
        protected $param = [];
        public function __construct(){
            $url = $this->getURL();
            if(isset($url)){
                if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
                                // If the controller exist then load it
                                $this->currentController = ucwords($url[0]);

                                // Unset the controller in the url
                                unset($url[0]);
                                require_once '../app/controllers/'.$this->currentController.'.php';

                                //Instentiate the controller
                                $this->currentController = new $this->currentController;

                            }

                            // Get method
                            if(isset($url[1])){
                                if(method_exists($this->currentController , $url[1])){
                                    $this->currentMethod = $url[1];
                                    unset($url[1]);
                                }
                            }
                            // echo $this->currentMethod;

                    // Get parameter list
                    $this->param = $url ? array_values($url) : [];
                    
            }else{
                require_once '../app/controllers/'.$this->currentController.'.php';
                $this->currentController = new $this->currentController;
            }
            

            // call method and pass the parameter list
            call_user_func_array([$this->currentController , $this->currentMethod] , $this->param);
        }

        public function getURL(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'] , '/');
                $url = filter_var($url , FILTER_SANITIZE_URL);
                $url = explode('/' , $url);
                return $url;
            }
        }
    }
?>