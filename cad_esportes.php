<!-- Programação em PHP para dinamizar a página principal -->
<?php 
  session_start(); //inicia a sessão de usuário

  // Cria a conexão com o Banco de Dados
  $conexao = '';
  $server = "localhost";    //nome do host/computador onde está o banco de dados
  $user = "root";           //nome do usuário que tem permissão de acesso ao banco
  $pass = "";               //senha para entrar (no caso está sem senha)
  $db = "wikisports";       //nome do banco de dados a ser consultado
  $conexao = mysqli_connect($server,$user,$pass,$db); //a biblioteca mysqli nativa do php junta os dados e estabelece a conexão
  
  mysqli_set_charset($conexao,"utf8"); //configura que todas as buscas no banco com esta conexão serão neste padrão que aceita acentuação nas palavras

  // READ - ler ou consultar
  $sql_tabela = "SELECT cod_esporte, nome_esporte, descricao_esporte 
                 FROM esportes ";
  $resultado_tabela = mysqli_query($conexao, $sql_tabela); //executa a SQL no banco por meio da conexão

    // READ - consultar um único código
    if(isset($_GET['editar']) && $_GET['editar'] != 'esporte'){

      $codigo = $_GET['editar'];
      $sql = "SELECT cod_esporte, nome_esporte, descricao_esporte FROM esportes WHERE cod_esporte = '".$codigo."' ";
      $resultado = mysqli_query($conexao, $sql); //executa a SQL no banco por meio da conexão
      $regE = mysqli_fetch_assoc($resultado);
    }


     // UPDATE - atualizar registro do banco
  // é necessário um código de identificação único para realizar a alteração, assim somente um registro da tabela será alterado

  if(isset($_GET['editar']) && $_GET['editar'] == 'esporte'){ //Significa que o formulário de edição foi preenchido

    // pega valores do formulário enviados via POST
    $codigo = $_POST['codigo'];
    $nome = $_POST['esporte'];
    $descricao = $_POST['descricao'];

    // SQL para alterar novo registro:
    $sql = "UPDATE esportes SET nome_esporte = '".$nome."', descricao_esporte = '".$descricao."' WHERE cod_esporte = '".$codigo."' ";
    $resultado = mysqli_query($conexao, $sql); //executa a SQL no banco por meio da conexão
    if($resultado){
      header('Location: cad_esportes.php?ed=ok'); 
    }else{
      header('Location: cad_esportes.php?ed=erro'); 
    }

  }


    // READ - consultar um único código
    if(isset($_GET['excluir']) && $_GET['excluir'] != 'esporte'){

      $codigo = $_GET['excluir'];
      $sql = "SELECT cod_esporte, nome_esporte, descricao_esporte FROM esportes WHERE cod_esporte = '".$codigo."' ";
      $resultado = mysqli_query($conexao, $sql); //executa a SQL no banco por meio da conexão
      $regE = mysqli_fetch_assoc($resultado);
    }

      // DELETE - apagar registro do banco
  // é necessário um código de identificação único para realizar a exclusão, assim somente um registro da tabela será apagado

  if(isset($_GET['excluir']) && $_GET['excluir'] == 'esporte'){ //Significa que o formulário de exclusão foi preenchido

    // Pega valores do formulário enviados via POST
    $codigo = $_POST['codigo'];
    $nome = $_POST['esporte'];
    $descricao = $_POST['descricao'];

    // SQL para alterar novo registro:
    $sql = "DELETE FROM esportes WHERE cod_esporte = '".$codigo."' ";
    $resultado = mysqli_query($conexao, $sql); //executa a SQL no banco por meio da conexão

    if($resultado){
      header('Location: cad_esportes.php?ex=ok'); 
    }else{
      header('Location: cad_esportes.php?ex=erro'); 
    }

  }

    // Verifica se o formulário de novo registro foi preenchido
    if(isset($_GET['novo']) && $_GET['novo'] = 'esporte'){ 

      // Pega valores do formulário enviados via POST
      $nome = $_POST['esporte'];
      $descricao = $_POST['descricao'];
  
      // SQL para inserir novo registro:
      $sql = "INSERT INTO esportes ( nome_esporte, descricao_esporte ) 
              VALUES ( '".$nome."', '".$descricao."' ) ";
      $resultado = mysqli_query($conexao, $sql); //executa a SQL no banco por meio da conexão
      if($resultado){
        header('Location: cad_esportes.php?cad=ok'); 
      }else{
        header('Location: cad_esportes.php?cad=erro'); 
      }

    }
?>

<!-- Programação em HTML para interface da página principal -->
<!DOCTYPE html>
<html>
    
  <head>
    <title>WikiSports</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastros.css" type="text/css" media="all">
  </head>
  
  <body>

    <!-- Cabeçalho e Menu-->
    <header>
      <div>
        <a href="index.html">
            <img id="logo" src="img\logo_wikisports.png" alt="WikiSports">
        </a>

        <!-- Menu-->
        <div id="menu">
          <nav>
              <ul>
              <li><a href="principal.php"><img width="30%" src="img/casa.png" alt="Categorias"><br>Categorias</a></li>      
              <li><a href="cad_esportes.php"><img width="30%" src="img/esporte.png" alt="Esportes"><br>Esportes</a></li>      
              <li><a href="cad_usuarios.php"><img width="30%" src="img/user.png" alt="Usuários"><br>Usuários</a></li>
              <li><a href="sair.php"><img width="30%" src="img/exit.png" alt="sair"><br>Sair</a></li>         
              </ul>
          </nav>
        </div>
      </div>
    </header>

    <!-- Conteúdo --> 
    <div id="textoprincipal2" class="fundo">
        Olá, <?php if(!empty($_SESSION['usuario'])){ echo $_SESSION['usuario']; }else{ echo 'Nome Usuário';}?>! Você está em Cad. de Esportes! Hoje é <?php echo date('d/m/Y'); ?>
    </div>

    <div id="conteudo">
      <div id="formularios">

              <!--Formulário para inserir esporte  - CREATE -->
               <div id="cadastro" class="<?php if(isset($_GET['editar']) || isset($_GET['excluir'])){ echo 'esconder'; } ?>">
                  <h4>NOVO USUARIO</h4>
            <form id="cadastroForm"  method="POST" action="cad_esportes.php?novo=esporte">
            <div class="center">
              <label>Usuario:</label>
              <input id="esporte" name="esporte" type="text" style="width: 60%; margin-left: 3%;"/>
            </div>
            <div class="center">
              <label>Descrição:</label>
              <input id="descricao" name="descricao" type="text" style="width: 60%; margin-top:2%;"/>
            </div>
            <div>
              <button id="cadastrar" name="salvar" type="submit" style="margin-left: 68%; margin-top: 5%; margin-botton: 5%;">Cadastrar</button>  
            </div>
            </form>

            </div>

            <!--Formulário para atualizar esporte - UPDATE -->
             <div id="cadastro" class="<?php if(!isset($_GET['editar'])){ echo 'esconder'; } ?>" >
            <h4>EDIÇÃO DE ESPORTE</h4>
            <form id="edicaoForm"  method="POST" action="cad_esportes.php?editar=esporte">
            <div class="center">
              <label>Esporte:</label>
              <input id="esporteE" name="esporte" type="text" value="<?php if(isset($regE['nome_esporte'])){echo $regE['nome_esporte']; }?>" style="width: 60%; margin-left: 3%;"/>
            </div>
            <div class="center">
              <label>Descrição:</label>
              <input id="descricaoE" name="descricao" type="text" value="<?php if(isset($regE['descricao_esporte'])){echo $regE['descricao_esporte']; }?>" style="width: 60%; margin-top:2%;"/>
              <input id="codigo" name="codigo" type="hidden" value="<?php if(isset($regE['cod_esporte'])){echo $regE['cod_esporte']; }?>" /> <!-- o código identificador do usuário vai escondido -->
            </div>
              <button id="salvar" name="salvar" type="submit" style="margin-left: 69%; margin-top: 5%; ">Salvar</button>
            </form>
       
            </div>

                  <!--Formulário para excluir esporte - DELETE -->
        <div id="cadastro" class="center <?php if(!isset($_GET['excluir'])){ echo 'esconder'; } ?>" >
            <h4>EXCLUSÃO DE ESPORTE</h4>            
            <form id="exclusaoForm"  method="POST" action="cad_esportes.php?excluir=esporte">
            <label class="center">Tem certeza que deseja excluir o usuário? </label>
            <div class="center">
              <label>Esporte:</label>
              <input id="esporteE" name="esporte" type="text" value="<?php if(isset($regE['nome_esporte'])){echo $regE['nome_esporte']; }?>" style="width: 60%; margin-left: 3%;" readonly/>
            </div>
            <div class="center">
              <label>Descrição:</label>
              <input id="descricaoE" name="descricao" type="text" value="<?php if(isset($regE['descricao_esporte'])){echo $regE['descricao_esporte']; }?>" style="width: 60%; margin-top:2%;" readonly/>
              <input id="codigo" name="codigo" type="hidden" value="<?php if(isset($regE['cod_esporte'])){echo $regE['cod_esporte']; }?>" /> <!-- o código identificador do usuário vai escondido -->
            </div>
            
              <button id="excluir" name="excluir" type="submit" style="margin-left: 67%;">Excluir</button>
            </form>
        </div>
        

      </div>

      <!--Aqui entra a Lista de esportes cadastrados - READ -->
      <div id="cadastrados">
        <h4>ESPORTES CADASTRADOS</h4>
        <div>
          <?php if($resultado_tabela){ //se existe o resultado, mostrar a tabela ?>   
          <table>
            <thead>
              <tr>                
                <th width="20%"><label>EDITAR</label></th>
                <th width="20%"><label>EXCLUIR</label></th>
                <th width="20%"><label>ESPORTE</label></th>                
                <th width="40%"><label>DESCRIÇÃO</label></th>                
              </tr>
            </thead>
            <tbody>
              <?php while($reg = mysqli_fetch_assoc($resultado_tabela)){ //enquanto existir registros na lista de resultados, escreva as linhas da tabela
                $cod = $reg['cod_esporte'];
                $nome = $reg['nome_esporte'];
                $descricao = $reg['descricao_esporte'];
                ?>
                <tr>
                  <td class="center"><a id="ed" href="cad_esportes.php?editar=<?php echo $cod; ?>"><img width="15%" src="img/edit.png" alt="Editar"></a></td>
                  <td class="center"><a id="ex" href="cad_esportes.php?excluir=<?php echo $cod; ?>"><img width="15%" src="img/lixo.png" alt="Excluir"></a></td>
                  <td class="center"><label><strong><?php echo $nome; ?></strong></label></td>
                  <td class="justificado"><label><strong><?php echo $descricao; ?></strong></label></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <?php }else{ //se não existir resultado não mostrar ?>
            Não existem registros cadastrados.
          <?php } ?>
        </div>
      </div>
    </div>

    <!--Retornos para o usuário -->
    <?php if(isset($_GET['cad']) && $_GET['cad'] == 'ok'){ ?>
        <div id="sessao">
            <p>Registro inserido com sucesso!</p>
        </div>
    <?php } ?>
    <?php if(isset($_GET['cad']) && $_GET['cad'] == 'erro'){ ?>
        <div id="sessaoErro">
            <p>Erro ao inserir o registro!</p>
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