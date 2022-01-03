const formLogin = document.getElementById('form-login')
const formCadastro = document.getElementById('form-cadastro')

formLogin.addEventListener('submit', (e)=>{
    e.preventDefault()
    let data = new FormData(formLogin)
    Ajax("POST", "controles/usuario/login.php", data, logar)
})


formCadastro.addEventListener('submit', function(e){
    e.preventDefault()
    let data = new FormData(formCadastro);
    Ajax("POST", "controles/usuario/cadastrar.php", data, cadastrar);
})

logar = function(retorno){
    if(retorno.status == 1){
        location.href= "chat.php"
    } else { 
        alert(retorno.mensagem)
    }
}

cadastrar = function(retorno){
    if(retorno.status == 1){
        location.href= "chat.php"
    } else { 
        alert(retorno.mensagem)
    }
}