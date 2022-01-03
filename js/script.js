document.getElementById('alterFormCad').onclick = ()=>{
    document.getElementById('container').classList.add('active')
}

document.getElementById('alterFormLogin').onclick = ()=>{
    document.getElementById('container').classList.remove('active')
}

var btnBlock = document.querySelector('.pswd')
btnBlock.onclick = ()=>{
    if(btnBlock.classList.contains('fa-eye')){
        btnBlock.classList.remove('fa-eye')
        btnBlock.classList.add('fa-eye-slash')
        document.getElementById('senha').type = "text"
    } else {
        btnBlock.classList.add('fa-eye')
        btnBlock.classList.remove('fa-eye-slash')
        document.getElementById('senha').type = "password"
    }
}

var btnBlock2 = document.querySelector('.cpswd')
btnBlock2.onclick = ()=>{
    if(btnBlock2.classList.contains('fa-eye')){
        btnBlock2.classList.remove('fa-eye')
        btnBlock2.classList.add('fa-eye-slash')
        document.getElementById('csenha').type = "text"
    } else {
        btnBlock2.classList.add('fa-eye')
        btnBlock2.classList.remove('fa-eye-slash')
        document.getElementById('csenha').type = "password"
    }
}

