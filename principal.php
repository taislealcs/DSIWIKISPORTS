<!-- Programação em PHP para dinamizar a página principal -->
<?php session_start();
?>
<!-- Programação em HTML para interface da página principal -->
<!DOCTYPE html>
<html>
    
  <head>
    <title>WikiSports</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css" type="text/css" media="all">
  </head>
  
  <body>

    <!-- Cabeçalho e Menu-->
    <header>
        <a href="index.html" style="align-text: left;">
            <img id="logo" src="img\logo_wikisports.png" alt="WikiSports">
        </a>
    </header>

    <!-- Conteúdo --> 
    <div id="textoprincipal2" class="fundo">
        Olá, <?php if(isset($_SESSION['usuario'])){ echo $_SESSION['usuario']; }else{ echo 'Nome Usuário';}?>! Seja bem-vindo(a)! Hoje, é <?php echo date('d/m/Y'); ?>
    </div>

    <!-- Menu-->
    <div id="menu">
        <nav>
            <ul>
            <li><a href="principal.php"><img width="35%" src="img/casa.png" alt="Principal"><br>Principal</a></li>      
            <li><a href="cad_esportes.php"><img width="35%" src="img/esporte.png" alt="Esportes"><br>Esportes</a></li>      
            <li><a href="cad_usuarios.php"><img width="35%" src="img/user.png" alt="Usuários"><br>Usuários</a></li>
            <li><a href="sair.php"><img width="35%" src="img/exit.png" alt="sair"><br>Sair</a></li>         
            </ul>
        </nav>
    </div>

    <div id="textoprincipal" class="fundo">
         WikiSports é um site de esportes desenvolvido pelos alunos do Instituto Federal de Educação, Ciência e Tecnologia - Campus Cubatão.
    </div>

    <footer> 
    <p>
        Copyright &copy; 2022 - All Rights Reserved - <a href="index.html">WikiSports</a><br>
        Portal desenvolvido pelos alunos da disciplina DSW do curso CTII no IFSP - <a href="faleconosco.html">Fale Conosco</a><br>
        Instituto Federal de Educação Ciência e Tecnologia de São Paulo - Campus Cubatão
    </p>
    </footer>

  </body>
  
</html>