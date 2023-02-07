<?php
require_once 'classe-pessoa.php';
$p = new Pessoa("crud","db","root","root");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Cadastro de pessoa</title>
</head>

<body>

    <?php
    if(isset($_POST['nome'])) // CLICOU NO BOTÃO CADASTRAR OU EDITAR
    {

        //---------------------EDITAR-----------------------------------
        if(isset($_GET['id_up']) && !empty($_GET['id_up'])){

            $id_upd = addslashes($_GET['id_up']);
            $nome = addslashes($_POST['nome']);
            $idade = addslashes($_POST['idade']);
            $email = addslashes($_POST['email']);
            if(!empty($nome) && !empty($idade) && !empty($email)){
            //atualizar
                $p->atualizarDados($id_upd,$nome,$idade,$email);
                header("location: home.php");
            }else{
                ?>
                    <div class="aviso">
                        <img src="aviso.png">
                        <h4>"Preencha todos os campos!"</h4>
                    </div>
                <?php                
            }    
            
            


        //--------------------CADASTRAR----------------------------    
        }else{
            $nome = addslashes($_POST['nome']);
            $idade = addslashes($_POST['idade']);
            $email = addslashes($_POST['email']);
            if(!empty($nome) && !empty($idade) && !empty($email)){
            //cadastrar
                if(!$p->cadastrarPessoa($nome,$idade,$email)){
                    echo "Email já está cadastrado";
                 }

            }else{
                ?>
                    <div class="aviso">
                        <img src="aviso.png">
                        <h4>"Preencha todos os campos!"</h4>
                    </div>
                <?php
            }

        }

    }
    
    ?>
    <?php
        if(isset($_GET['id_up'])){ //SE A PESSOA CLICOU NO BOTÃO DE EDITAR
            $id_update = addslashes($_GET['id_up']);
            $res = $p->buscarDadosPessoa($id_update);

        }
    
    
    
    ?>

    <section id="esqueda">
        <form method="POST">
            <h2>CADASTRAR PESSOA</h2>
            <label for="nome">name</label>
            <input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];} ?>">
            <label for="idade">idade</label>
            <input type="text" name="idade" id="idade" value="<?php if(isset($res)){echo $res['idade'];} ?>">
            <label for="email">email</label>
            <input type="email" name="email" id="email" value="<?php if(isset($res)){echo $res['email'];} ?>">
            <input type="submit" value="<?php if(isset($res)){echo "Atualizar";}else{echo "Cadastrar";}?>">
        </form>

    </section>

    <section id="direita">

        <br>
        <h2>Lista de Clientes</h2>
        <table>
            <tr id="titulo">
                <td>NOME</td>
                <td>IDADE</td>
                <td colspan="2">EMAIL</td>
            </tr>
        <?php
        
            $dados = $p->buscarDados();
            if(count($dados) > 0) // SE TEM PESSOAS NO BANCO
            {
                for ($i=0; $i < count($dados); $i++){
                    echo "<tr>";
                    foreach ($dados[$i] as $k => $v){
                        if($k != "id")
                        {
                            echo "<td>".$v."</td>";

                        }
                    }
        ?>          
                    <td>
                        <a href="home.php?id_up=<?php echo $dados[$i]['id'];?>">Editar</a>
                        <a href="home.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a>
                    </td>
        <?php
                    echo "</tr>";

                }
        

            }else{ //O BANCO ESTÁ VAZIO
                
        ?>
        
        </table>
        
            <div class="aviso">
                <h4>"Ainda não há pessoas cadastradas!"</h4>
            </div>
        <?php

        }
        ?>

    </section>

</body>
</html>
<?php
if(isset($_GET['id'])){
    $id_pessoa = addslashes($_GET['id']);
    $p->excluirPessoa($id_pessoa);
    header("location: home.php");
}
?>