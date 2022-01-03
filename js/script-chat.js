const inputSearchMsg = document.querySelector('.header-user-chat .icons-function input');
const listaUsuarios = document.getElementById('users-list')
const search_bar = document.getElementById('search-bar')
var headerChat = document.getElementById('header-user-chat')
var listagemInicial = 0;
var listagemMensagensInicial = 0;
const loading = document.querySelector('.loading')
const formMsg = document.getElementById('form-msg')
var inputMsg = document.getElementById('msg-para-id')
var idcontatoatual
var chatUser = document.getElementById('chat-user') 

window.addEventListener('load', ()=>{
    setTimeout(()=>{
        loading.classList.add('hide')
    }, 1000)
    setTimeout(()=>{
        loading.style.transform = "translateY(-200vh)"
    }, 2000)
    
})

chatUser.onmouseenter = ()=>{
    chatUser.classList.add('active')
}
chatUser.onmouseleave = ()=>{
    chatUser.classList.remove('active')
}

document.getElementById('search-msg').addEventListener('click', ()=>{
    inputSearchMsg.classList.toggle('show')
    if(inputSearchMsg.classList.contains('show')) inputSearchMsg.focus()
})

search_bar.addEventListener('keyup', ()=>{
    let data = new FormData()
    data.append('filtro', '%'+search_bar.value+'%')
    Ajax('POST', "controles/mensagem/listaContatos.php", data, listaContatos);
    clearInterval(listaContatosAuto)
    if(search_bar.value.length == 0){
        listaContatosAuto = setInterval(executaListagem, 500)
    }
})

listaContatosAuto = setInterval(executaListagem, 500)

function executaListagem(filtro = ""){
    let data = new FormData()
    data.append('filtro', '%%')
    Ajax('POST', "controles/mensagem/listaContatos.php", data, listaContatos);
}

function pegaId(id){
    let data = new FormData()
    data.append('idcontato', id)
    Ajax('POST', 'controles/mensagem/abreChat.php', data, abreChat)
}

abreChat = function(retorno){
    chatUser.innerHTML = "";
    headerChat.innerHTML = `
        <img loading="lazy" src="img/users/${retorno.dadoContato.img}" class="img-user-chat">
        <div class="info-user-chat">
            <h2>${retorno.dadoContato.nome}</h2>
            <p>${retorno.dadoContato.status}</p>
        </div>
        <div class="icons-function">
            <input type="text" placeholder="Digite a mensagem...">
            <i class="fas fa-search" id="search-msg"></i>
        </div>
    `
    scrollToBottom()
    idcontatoatual = retorno.dadoContato.idunico
    executaChat("listarMensagens", "")
}

formMsg.addEventListener('submit', (e)=>{
    e.preventDefault()
    executaChat("cadastrar", formMsg[0].value)
    formMsg[0].value = ""
})

listaMensagensAuto()

function listaMensagensAuto(){
    setInterval(()=>{
        executaChat("listarMensagens", "")
    }, 500) 
}

function executaChat(tipo, mensagem = ""){
    let data = new FormData()
    data.append('tipo', tipo)
    data.append('mensagem', mensagem)
    data.append('msg_para_id', idcontatoatual)
    Ajax('POST', 'controles/mensagem/chat.php', data, listaMensagens)
}

listaMensagens = function(retorno){
    let cont = 0;
    retorno.mensagens.forEach(msg => {
        if(typeof chatUser.children[cont] === "undefined" || (chatUser.children[cont].id != msg.idmensagem)){
            if(msg.msg_de_id == retorno.usuarioAtual){
                chatUser.innerHTML += `
                    <div class="msg-de message" id="${msg.idmensagem}">
                        <p>${msg.mensagem}</p>
                    </div>
                ` 
            } else {
                if(msg.msg_para_id == retorno.usuarioAtual){
                    chatUser.innerHTML += `
                        <div class="msg-para message" id="${msg.idmensagem}">
                            <img src="img/users/${retorno.msg_para.img}" class="img-msg-para"></img>
                            <p>${msg.mensagem}</p>
                        </div>
                    ` 
                }
            }
        }
        if(!chatUser.classList.contains('active')){
            scrollToBottom()
        }
        cont++
    });
}

function scrollToBottom(){
    chatUser.scrollTop = chatUser.scrollHeight
}

listaContatos = function(retorno){
    listaUsuarios.innerHTML = ""
    if(retorno.status == 1){
        let cont = 0
        retorno.dados.forEach(dado =>{
            cont++

            if(cont == 1 && listagemInicial == 0){
                pegaId(dado.idunico)
                listagemInicial = 1
            }
            let status
            (dado.status == "Online") ? status = "online" : status = ""
            listaUsuarios.innerHTML += `
                <a href="javascript: pegaId(${dado.idunico})" class="user-box" id="user-box">
                    <img loading="lazy" src="img/users/${dado.img}" class="photo-user"></img>
                    <div class="info-user">
                        <h3>${dado.nome}</h3>
                        <p></p>
                    </div>
                    <i class="fas fa-circle ${status}"></i>
                </a> 
            `
        })

    } else {
        // document.getElementById('not-contacts').style.display = "block"
    }
}