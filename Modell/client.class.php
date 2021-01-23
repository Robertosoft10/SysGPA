<?php 
class Client{
    private $clientId;
    private $clientName;
    private $clientContact;
    private $clientEndereco;

    public function __construct($clientId=0, $clientName="", $clientContact="", $clientEndereco=""){
        $this->clientId = $clientId;
        $this->clientName = $clientName;
        $this->clientContact = $clientContact;
        $this->clientEndereco = $clientEndereco;
    }
    public function setClientId($clientId){
       $this->clientId = $clientId;
    }
    public function getClientId(){
        return $this->clientId;
    }
    public function setClientName($clientName){
        $this->clientName = $clientName;
     }
     public function getClientName(){
         return $this->clientName;
     }
     public function setClientContact($clientContact){
        $this->clientContact = $clientContact;
     }
     public function getClientContact(){
         return $this->clientContact;
     }
     public function setClientEndereco($clientEndereco){
        $this->clientEndereco = $clientEndereco;
     }
     public function getClientEndereco(){
         return $this->clientEndereco;
     }
}
?>