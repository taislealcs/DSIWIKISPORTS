function dataHora() {
    var hoje = new Date();

    var dia = hoje.getDate();
    var mes = hoje.getMonth();
    var ano = hoje.getFullYear();
    var hora = hoje.getHours();
    var minuto = hoje.getMinutes();
    var segundo = hoje.getSeconds();

    if (hora < 12) {
        var saudacao = 'Bom dia!';
    } else if (hora >= 18) {
        var saudacao = 'Boa noite!';
    } else {
        var saudacao = 'Boa tarde!';
    }

   
    document.faleconosco.hoje.value = dia + '/' + mes + '/' + 
                                      ano + ' ' 
                                    + hora + ':' + minuto + 
                                    ':' + segundo; 

}

function dataHoraCompleta() {

    var hoje = new Date();
    var dia = hoje.getDate();
    var mes = hoje.getMonth();
    var ano = hoje.getFullYear();
    var hora = hoje.getHours();
    var minuto = hoje.getMinutes();
    var segundo = hoje.getSeconds();
   
    // Define o m�s por extenso
    var meses = new Array('janeiro',
                          'fevereiro',
                          'mar�o',
                          'abril',
                          'maio',
                          'junho',
                          'julho',
                          'agosto',
                          'setembro',
                          'outubro',
                          'novembro',
                          'dezembro');

    var nomemes = meses[mes];
    
    // Define o dia da semana
    var diasemana = hoje.getDay();
    switch (diasemana) {
        case 0: {
             var diasemanaextenso = "Domingo, ";
             break;
        }
        case 1: {
             var diasemanaextenso = "Segunda-feira, ";
             break;
        }
        case 2: {
             var diasemanaextenso = "Ter�a-feira, ";
             break;
        }
        case 3: {
             var diasemanaextenso = "Quarta-feira, ";
             break;
        }
        case 4: {
             var diasemanaextenso = "Quinta-feira, ";
             break;
        }
        case 5: {
             var diasemanaextenso = "Sexta-feira, ";
             break;
        }
        case 6: {
             var diasemanaextenso = "S�bado, ";
             break;
        }
    }
    
    // Corrige minutos e segundos (com zero � frente) 
    if (minuto <= 9) {
        minuto = '0' + minuto;
    } 
    if (segundo <= 9) {
        segundo = '0' + segundo;
    }
    
    // Define a sauda��o
    if (hora < 12) {
        var saudacao = 'Bom dia!';
    } else if (hora >= 18) {
        var saudacao = 'Boa noite!';
    } else {
        var saudacao = 'Boa tarde!';
    }
    
    document.faleconosco.hoje.value = diasemanaextenso + dia + ' de ' + 
            nomemes + ' de ' + ano + ' ' + hora + ':' + minuto + ':' + 
            segundo + ' ' + saudacao;
    
}    
    
    
function atualizaHora() {
    window.setInterval("dataHoraCompleta()",1000)
}

function medidor() {
    var range = document.querySelector("#agradou");

    var medidor1 = document.getElementById("medidor1");
    medidor1.value = range.value;

    var medidor2 = document.getElementById("medidor2");
    medidor2.value = range.value / 10;

    var bProgresso = document.getElementById("barraProgresso");
    bProgresso.value = range.value * range.max;
}



function consisteNome(){
  if (document.faleconosco.nome.value.length<=5){
    document.faleconosco.nome.style.backgroundColor = "yellow";
    alert("Digite um nome valido!");
    document.faleconosco.nome.focus();
  }
}

function consisteEmail(){
  if (document.faleconosco.email.value.length<=10){
    document.faleconosco.email.style.backgroundColor = "yellow";
    alert("Digite um email valido!");
    document.faleconosco.email.focus();
  }
}

function limpaFundo() {
    document.faleconosco.nome.style.backgroundColor = "white";
    document.faleconosco.email.style.backgroundColor = "white";
}


function preencheBarra() {
  document.getElementById("medidor1").value = document.getElementById("quantidade").value;
//  document.getElementById("medidor2").value = document.getElementById("quantidade").value / 10;
//  document.getElementById("barraProgresso").value = document.getElementById("quantidade").value * 10;
}

