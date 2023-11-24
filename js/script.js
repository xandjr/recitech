function validarSenha(){
    var senha = document.getElementById("senha").value;
    var senha2 = document.getElementById("senha2").value;

    if (senha !== senha2){
        alert("Senhas diferentes. Por favor, digite as mesmas senhas nos campos.")
        return false;
    }

    return true;
}

jQuery(function($){
    $("#telefone").mask("(99) 99999-9999");
    $('#email').mask('A', {
        translation: {
          'A': {pattern: /[\w@\-.+]/, recursive: true}
        }});
});

function toggleMenu() {
    var menuMobile = document.querySelector('.menu-mobile');
    menuMobile.style.display = (menuMobile.style.display === 'block') ? 'none' : 'block';
}

function toggleSubmenu() {
    var pontosColeta = document.getElementById('pontos-coleta');
    var submenuUl = document.querySelector('.submenu ul');
  
    if (submenuUl.style.display === 'block') {
      pontosColeta.style.marginTop = submenuUl.clientHeight + 'px';
    } else {
      pontosColeta.style.marginTop = '0';
    }
  }
