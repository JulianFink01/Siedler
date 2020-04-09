<?php


class Controller{

  private $context = array();



  public function run($aktion){
    $this->$aktion();
    $this->generatePage($aktion);
  }

  public function login(){
    if (isset ($_REQUEST['username']) && isset($_REQUEST['password'])){
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $user = User::findeNachUsernameUndPassword($username, $password);
        $user->__toString();
        if($user!=NULL){
              echo "Login CHECK Name: ".$user->getUsername();
        }else{
            $this->addContext("template", "login");
        }
      }
  }

  private function generatePage($template){
    extract($this->context);
    require_once 'views/'.$template.".tpl.html";
  }
  private function addContext($key, $value){
    $this->context[$key] = $value;
  }

}


 ?>
