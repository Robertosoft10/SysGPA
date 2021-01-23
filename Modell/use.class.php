<?php 
class User{
    private $useId ;
    private $useName;
    private $useEmail;
    private $useNivel;
    private $password;
    private $useFoto;

    public function __construct($useId =0, $useName="", $useEmail="", $useNivel="", $password="" , $useFoto=""){
        $this->useId  = $useId ;
        $this->useName = $useName;
        $this->useEmail = $useEmail;
        $this->useNivel = $useNivel;
        $this->password = $password;
        $this->useFoto = $useFoto;
    }
    public function setUseId($useId ){
       $this->useId  = $useId ;
    }
    public function getUseId(){
        return $this->useId ;
    }
    public function setUseName($useName){
        $this->useName = $useName;
     }
     public function getUseName(){
         return $this->useName;
     }
     public function setUseEmail($useEmail){
        $this->useEmail = $useEmail;
     }
     public function getUseEmail(){
         return $this->useEmail;
     }
     public function setUseNivel($useNivel){
        $this->useNivel = $useNivel;
     }
     public function getUseNivel(){
         return $this->useNivel;
     }
     public function setPassword($password){
        $this->password = $password;
     }
     public function getPassword(){
         return $this->password;
     }
      public function setUseFoto($useFoto){
        $this->useFoto = $useFoto;
     }
     public function getUseFoto(){
         return $this->useFoto;
     }
}
?>