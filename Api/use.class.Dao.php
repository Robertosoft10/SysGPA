<?php
    require_once 'conexao.class.php';
	include '../Modell/use.class.php';
	
	class UserDAO{
		
		private $conexao;
		
		public function __construct(){
			$this->conexao = new Conexao();
				 if($this->conexao->conectar() == false){
				 	 echo "Não conectou!" . mysql_error();	
				 }
		}	

        public function insertUser($user){
            $useName = $user->getUseName();
            $useEmail = $user->getUseEmail();
            $useNivel = $user->getUseNivel();
            $password = $user->getPassword();
            $useFoto = $user->getUseFoto();

            if(isset($_FILES['useFoto'])){
                $extensao = strtolower(substr($_FILES['usefato']['name'], -4));
                $novoNome = sha1(time()) . $extensao;
                $diretorio = "../Components/img/";
                move_uploaded_file($_FILES['useFoto']['tmp_name'], $diretorio.$novoNome);

            $sql = "INSERT INTO tb_usuarios (useName, useEmail, useNivel, password, useFoto)VALUES('$useName', '$useEmail', '$useNivel', '$password', '$novoNome')";
            $this->conexao->query($sql);
        }
    }
        public function listUsers(){
            $consulta = $this->conexao->query("SELECT * FROM tb_usuarios");
			    $arrayUsers = array();
			    while ($linha = mysqli_fetch_array($consulta)) {
            $user = new User($linha['useId'], $linha['useName'], $linha['useEmail'], $linha['useNivel'], $linha['password'], $linha['useFoto']);
				array_push($arrayUsers, $user);
			}
			return $arrayUsers;
        }
        public function searchUser($useId){
            $linha = $this->conexao->buscarRegistro("SELECT * FROM tb_usuarios WHERE useId = '$useId'"); 
           $user = new User($linha['useId'], $linha['useName'], $linha['useEmail'], $linha['useNivel'], $linha['password'], $linha['useFoto']);
            return $user;
        }
        public function updateUser($user){
            
            $useId = $user->getUseId();
            $useName = $user->getUseName();
            $useEmail = $user->getUseEmail();
            $useNivel = $user->getUseNivel();
            $password = $user->getPassword();

            $sql = "UPDATE tb_usuarios SET useName='$useName', useEmail='$useEmail', useNivel='$useNivel', password='$password' WHERE useId='$useId'";
            $this->conexao->query($sql);
        }
        public function deleteUser($useId){
            $sql = "DELETE FROM tb_usuarios WHERE useId = '$useId'";
            $this->conexao->query($sql);
        }
    }
?>