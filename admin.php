<!-- Programação em PHP para dinamizar a página admin -->
<?php 
    if(isset($_POST) && !empty($_POST)){  //se existir algum dado enviado pelo formulário de autenticação e ele não estiver vazio, executar este script
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        //Para trazer informações do banco de dados, precisamos de uma conexão
        $conexao = '';
        $server = "localhost";    //nome do host/computador onde está o banco de dados
        $user = "root";           //nome do usuário que tem permissão de acesso ao banco
        $pass = "";               //senha para entrar (no caso está sem senha)
        $db = "wikisports";       //nome do banco de dados a ser consultado
        $conexao = mysqli_connect($server,$user,$pass,$db); //a biblioteca mysqli nativa do php junta os dados e estabelece a conexão
        
        mysqli_set_charset($conexao,"utf8"); //configura que todas as buscas no banco com esta conexão serão neste padrão que aceita acentuação nas palavras

        $sql="SELECT nome_usuario FROM usuarios 
        WHERE nome_usuario = '".$usuario."' AND senha_usuario = '".$senha."' ";
        $resultado = mysqli_query($conexao, $sql);
        $reg = mysqli_fetch_assoc($resultado);

        if($usuario == $reg['nome_usuario']){
            session_start();
            $_SESSION['usuario'] = $usuario;
            header('Location: principal.php');
        }else{            
            header('Location: admin.php?usuario=invalido');
        }
    
    }else{ //se não existir dados enviados mostrar a tela do formulário
?>

<!-- Programação em HTML para interface da página admin -->
<!DOCTYPE html>
<html>
    
  <head>
    <title>WikiSports</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css" type="text/css" media="all">
  </head>
  
  <body>
    <!-- Cabeçalho-->
    <header>
        <a href="index.html">
            <img id="logo" src="img\logo_wikisports.png" alt="WikiSports">
        </a>
    </header>

    <!-- Conteúdo Formulário para entrar na área administrativa -->
    <div id="login">
        <h4>ACESSO ADMINISTRATIVO</h4>
        <form id="autenticacao"  method="POST" action="admin.php">
            <div>
                <label>Usuário:</label>
                <input id="usuario" name="usuario" type="text" /> <!-- usuario admin -->
            </div>
            <div>
                <label>Senha:</label>
                <input id="senha" name="senha" type="password" /> <!-- senha 123456 -->
            </div>
            <button id="entrar" name="entrar" type="submit">Entrar</button>
        </form>
    </div>
    <?php if(isset($_GET['sessao']) && $_GET['sessao'] == 'encerrada'){ ?>
        <div id="sessao">
            <p>Sessão encerrada com sucesso!</p>
        </div>
    <?php } ?>
    <?php if(isset($_GET['usuario']) && $_GET['usuario'] == 'invalido'){ ?>
        <div id="sessaoErro">
            <p>Usuário inválido!</p>
        </div>
    <?php } ?>
    <footer> 
        <p>
          Copyright &copy; 2022 - All Rights Reserved - <a href="index.html">WikiSports</a><br>
          Portal desenvolvido pelos alunos da disciplina DSW do curso CTII no IFSP - <a href="faleconosco.html">Fale Conosco</a><br>
          Instituto Federal de Educação Ciência e Tecnologia de São Paulo - Campus Cubatão
        </p>
      </footer>

  </body>
  
</html>
<?php } ?>