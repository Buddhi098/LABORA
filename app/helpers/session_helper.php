<?php
    session_start();

    function flashmsg($name='' , $message='' , $class = 'msg-flash'){
        if(!empty(($name))){
            if(!empty($message) && empty($_SESSION[$name])){
                $_SESSION[$name] = $message;
                $_SESSION[$name.'__class'] = $class;
            }else if(empty($message) && !empty($_SESSION[$name])){
                $class = !empty($_SESSION[$name.'__class']) ? $_SESSION[$name.'__class'] : 'msg-flash';
                echo '<div class="'.$class.'" >'.$_SESSION[$name].'</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name.'__class']);
            }
        }
    }


    function stopResubmission(){
        echo
            "<script>
            if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
            }
            </script>";
    }
?>