function validarSenha(){
    var senha = document.getElementById("senha").value;
    var senha2 = document.getElementById("senha2").value;

    if (senha !== senha2){
        alert("Senhas diferentes. Por favor, digite as mesmas senhas nos campos.")
        return false;
    }

    return true;
}

function toggleMenu() {
    var menuMobile = document.querySelector('.menu-mobile');
    menuMobile.style.display = (menuMobile.style.display === 'block') ? 'none' : 'block';
  }
