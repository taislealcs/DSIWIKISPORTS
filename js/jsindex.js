var contar = 1;
var imagem1 = 'img/slider01.jpg';
var imagem2 = 'img/slider02.jpg';
var imagem3 = 'img/slider03.jpg';
var imagem4 = 'img/slider04.jpg';
var imagem5 = 'img/slider05.jpg';

function exibeSlider0(){
    document.images["slide"].src = eval("imagem"+contar);
    if (contar < 5) {
        contar = contar+1;
    } else {
        contar = 1;
    }
    setTimeout("exibeImagens()", 3000);
}

const timer = ms => new Promise(res => setTimeout(res, ms));

async function exibeSlider1() {
  for (i=1; i<=5; i++) {
    document.images["slide"].src = eval("imagem"+i);
    await timer(3000);
    if (i==5) {
      i=0;
    }
  }
}

async function exibeSlider2() {
    
    i=5;

    while (i>=1) {

      document.images["slide"].src = eval("imagem"+i);
      await timer(3000);
      i--;
      if (i==0) {i=5};

    }
  }
  