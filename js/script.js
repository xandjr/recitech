// Verifica se a senha digitada bate com o campo senha2
function validarSenha(){
  var senha = document.getElementById("senha").value;
  var senha2 = document.getElementById("senha2").value;

  if (senha !== senha2){
      alert("Senhas diferentes. Por favor, digite as mesmas senhas nos campos.")
      return false;
  }

  return true;
}

// Mascara para campo do telefone
jQuery(function($){
  $("#telefone").mask("(99) 99999-9999");
  $('#email').mask('A', {
    translation: {
      'A': {pattern: /[\w@\-.+]/, recursive: true}
    }});
});

// Menu hambúrguer
function toggleMenu() {
  var menuMobile = document.querySelector('.menu-mobile');
  menuMobile.style.display = (menuMobile.style.display === 'block') ? 'none' : 'block';
}

// Sub menu
function toggleSubmenu() {
  var pontosColeta = document.getElementById('pontos-coleta');
  var submenuUl = document.querySelector('.submenu ul');
  
  if (submenuUl.style.display === 'block' || submenuUl.style.display === '') {
    submenuUl.style.display = 'none';
    pontosColeta.style.marginTop = '0';
  } else {
    submenuUl.style.display = 'block';
    pontosColeta.style.marginTop = submenuUl.clientHeight + 'px';
  }
}


// function mostrarFormulario() {
//   var formulario = document.getElementById("formulario");
//   formulario.style.display = "block";
// }

// Abrir modal
function mostrarModal() {
  var modal = document.getElementById("modal");
  modal.style.display = "block";
}

// Fechar modal
function fecharModal() {
  var modal = document.getElementById("modal");
  modal.style.display = "none";
}

// Fecha o modal se o usuário clicar fora
window.onclick = function(event) {
  var modal = document.getElementById("modal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
}