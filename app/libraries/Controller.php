<?php
    class Controller{
        //TO load the model
        public function model($model){
            if(file_exists('../app/models/'.$model.'.php')){
                require_once '../app/models/'.$model.'.php';

                // Instentiat the model and pass it to the controller member variable
                return new $model();
            }
            
        }

        public function view($view , $data=[]){
            if(file_exists("../app/views/".$view.'.php')){
                require_once '../app/views/'.$view.'.php';
            }else{
                die("Corresponding view does not exist");
            }
        }
    }

?>