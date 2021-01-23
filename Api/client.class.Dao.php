<?php
    require_once 'conexao.class.php';
	include '../Modell/client.class.php';
	
	class ClientDAO{
		
		private $conexao;
		
		public function __construct(){
			$this->conexao = new Conexao();
				 if($this->conexao->conectar() == false){
				 	 echo "Não conectou!" . mysql_error();	
				 }
		}	

        public function insertClient($client){
            $clientName = $client->getClientName();
            $clientContact = $client->getClientContact();
            $clientEndereco = $client->getClientEndereco();

            $sql = "INSERT INTO tb_clientes (clientName, clientContact, clientEndereco)VALUES('$clientName', '$clientContact', '$clientEndereco')";
            $this->conexao->query($sql);
        }
        public function listClients(){
            $consulta = $this->conexao->query("SELECT * FROM tb_clientes");
			    $arrayClients = array();
			    while ($linha = mysqli_fetch_array($consulta)) {
            $client = new Client($linha['clientId'], $linha['clientName'], $linha['clientContact'], $linha['clientEndereco']);
				array_push($arrayClients, $client);
			}
			return $arrayClients;
        }
        public function searchClient($clientId){
            $linha = $this->conexao->buscarRegistro("SELECT * FROM tb_clientes WHERE clientId = '$clientId'"); 
            $client = new Client($linha['clientId'], $linha['clientName'], $linha['clientContact'], $linha['clientEndereco']);
            return $client;
        }
        public function updateClient($client){
            
            $clientId = $client->getClientId();
            $clientName = $client->getClientName();
            $clientContact = $client->getClientContact();
            $clientEndereco = $client->getClientEndereco();

            $sql = "UPDATE tb_clientes SET clientName='$clientName', clientContact='$clientContact', clientEndereco='$clientEndereco' WHERE clientId='$clientId'";
            $this->conexao->query($sql);
        }
        public function deleteClient($clientId){
            $sql = "DELETE FROM tb_clientes WHERE clientId = '$clientId'";
            $this->conexao->query($sql);
        }
    }
?>