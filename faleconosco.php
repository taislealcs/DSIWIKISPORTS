<!-- Programação em PHP para dinamizar a página principal -->
<?php 

  //Para trazer informações do banco de dados, precisamos de uma conexão
  $conexao = '';
  $server = "localhost";        //nome do host/computador onde está o banco de dados
  $user = "root";               //nome do usuário que tem permissão de acesso ao banco
  $pass = "";                   //senha para entrar (no caso está sem senha)
  $db = "wikisports";           //nome do banco de dados a ser consultado
  $conexao = mysqli_connect($server,$user,$pass,$db); //a biblioteca mysqli nativa do php junta os dados e estabelece a conexão
  
  mysqli_set_charset($conexao,"utf8"); //configura que todas as buscas no banco com esta conexão serão neste padrão que aceita acentuação nas palavras

  // READ - ler ou consultar
  $sql = "SELECT cod_esporte, nome_esporte, descricao_esporte FROM esportes "; // quando se quer buscar todas as colunas da tabela, pode-se substituir as colunas pelo símbolo *
  $resultado = mysqli_query($conexao, $sql); //executa a SQL no banco por meio da conexão

?>
<!-- Programação em HTML para interface da página principal -->
<!DOCTYPE html>

<html>
    <head>
        <title>WikiSports</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/estilo.css" type="text/css" media="all">
        <script src="js/jsnativo.js"></script>
    </head>
      
    <body onload="atualizaHora()">

        <!-- Cabeçalho-->
        <header>
            <a href="index.html">
                <img id="logo" src="img\logo_wikisports.png" alt="WikiSports">
            </a>
        </header>


        <form id="faleconosco" name="faleconosco" method="POST" 
              action="mailto:cesar.rago@ifsp.edu.br">
            <h2>Quer saber mais? Quer contribuir? Escreva-nos!</h2>
        
            <fieldset name="dadospessoais" form="faleconosco">
                <legend>Dados Pessoais</legend>
                <p><input type="text" id="datahora" name="hoje" size="50" disabled/></p>
                <p><label>Nome: </label> <input type="text" id="nome" name="nome" 
                                                maxlength="50" size="60" required/></p>
<!--                <p><input type="text" id="navegador" name="navegador" size="50" disabled/></p>  -->
                <p><label>e-mail: </label> <input type="email" id="email" name="email" 
                                                  maxlength="50" size="60" 
                                                  autocomplete="on" 
                                                  required/></p>
                <p><label>Telefone: </label> <input type="tel" id="telefone" 
                                                    name="telefone" 
                                                    maxlength="13" size="12"/></p>
                <p><label>Idade: </label> <input type="text" id="idade" name="idade" 
                                                 maxlength="3" size="3"/></p>
                <p>
                    <label>Gênero: </label> 
                    <label for="m">M</label> <input type="radio" id="m" name="genero" 
                                                    value="m" required/>
                    <label for="f">F</label> <input type="radio" id="f" name="genero" 
                                                    value="f" required/>
                </p>
            </fieldset>
            
            <fieldset name="comentarios" form="faleconosco">
                <legend>Comentários</legend>
                    <p>
                        <label>Indique quanto esse portal agradou: </label> 
<!--                    <input type="range" id="agradou" name="agradou"/>   -->
                        
                        <input type="number" id="quantidade" name="quantidade" 
                               min=0 max=10 size=5 onClick="preencheBarra()"/>
                               
                        <meter id="medidor1" name="medidor1" value=8 
                                min=0 max=10>8 de 10</meter>
<!--                        <meter id="medidor2" name="medidor2" value=0.8>80%</meter>  
                        <progress id="barraProgresso" name="barraProgresso" 
                                    value=80 max=100></progress>    -->
                    </p>
        
                    <p>
                        <label>Qual seu esporte preferido? </label> 
                        <select id="idEsporte" required>
                            <option value="">Escolha uma opção...</option>
                            <!--Para tornar o select dinamico, trocar opções estáticas pela busca dinâmica -->
                            <?php if(isset($resultado)){
                                    while($reg = mysqli_fetch_assoc($resultado)){ //enquanto eu tenho registros na minha lista de resultados, escreva esses registros nas opções do select
                                        $nomeEsporte = $reg['nome_esporte'];
                                        $codEsporte = $reg['cod_esporte']; ?>
                                    <option value="<?php echo $codEsporte; ?>"><?php echo $nomeEsporte; ?></option>
                                    <?php } ?>
                            <?php } ?>
                        </select> 

                   <select id="idEsporteComOptgroup">
                            <optgroup label="Verão">
                                <option value="Futebol">Futebol</option>
                                <option value="Basquete">Basquete</option>
                                <option value="Voleibol">Voleibol</option>
                            </optgroup>
                            <optgroup label="Inverno">
                                <option value="Skeleton">Skeleton</option>
                                <option value="Hóquei">Hóquei</option>
                                <option value="Bobsled">Bobsled</option>
                            </optgroup>
                        </select>
                        
                        <input list="idEsporteComDatalist">

                        <datalist id="idEsporteComDatalist">
                          <option value="Futebol">
                          <option value="Basquete">
                          <option value="Handebol">
                          <option value="Voleibol">
                          <option value="Atletismo">
                        </datalist>
                      
                    </p> 
                    
                <p>
                    <label>Deixe aqui seus comentários: </label> 
                    <textarea id="opiniao" name="comentario" cols=60 rows=10 
                             maxlength="500" spellcheck="true"></textarea>
                </p>
            </fieldset>
            
            <div id="botoes">
                <input type="submit" id="enviar" value="Enviar" onClick="consiste()"/>
                <input type="reset" id="limpar" value="Limpar"/>
            </div>
        </form>

        <footer>
            <br><br>
            <p>
                Copyright &copy; 2022 - All Rights Reserved - <a href="index.html">WikiSports</a><br>
                Página desenvolvida por ... na disciplina DSW do curso CTII no IFSP<br>
                Instituto Federal de Educação Ciência e Tecnologia de São Paulo - Campus Cubatão
            </p>
        </footer>
        
    </body>
</html>
