<?php

class Pessoa{

    private $pdo;

    public function __construct($dbname, $host ,$user,$senha)
    {
        try{
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
        }catch(PDOException $e){
            echo "erro com banco".$e->getMessage();
            exit();

        }
           
    }

    public function buscarDados()
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM cliente ORDER BY nome");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
        
    }
    public function cadastrarPessoa($nome,$idade,$email)
    {
        $cmd = $this->pdo->prepare("SELECT id FROM cliente WHERE email = :e");
        $cmd->bindValue(":e",$email);
        $cmd->execute();
        if($cmd->rowCount() > 0){ //email já existe no banco
            return false;
        }else{ 
            $cmd = $this->pdo->prepare("INSERT INTO cliente (nome, idade,email) VALUES(:n,:i,:e)");
            $cmd->bindValue(":n",$nome);
            $cmd->bindValue(":i",$idade);
            $cmd->bindValue(":e",$email);
            $cmd->execute();
            return true;


        }
    }
    public function excluirPessoa($id){
        $del = $this->pdo->prepare("DELETE FROM cliente WHERE id = :id");
        $del->bindValue(":id",$id);
        $del->execute();
    }

    public function buscarDadosPessoa($id){
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM cliente WHERE id =:id");
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function atualizarDados($id,$nome,$idade,$email){
        $cmd = $this->pdo->prepare("UPDATE cliente SET nome =:n, idade=:i, email=:e WHERE id = :id");
        $cmd->bindValue(":n",$nome);
        $cmd->bindValue(":i",$idade);
        $cmd->bindValue(":e",$email);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
    }


}

?>