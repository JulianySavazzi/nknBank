<?php ?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<main
class="flex flex-auto flex-col flex-auto"
>
    <div  class="justify-content justify-items-center justify-align-center items-center ml-10 mr-10 mt-5 mb-0 p-5 ">
        <h1 class="text-4xl text-center font-sans"> NKN Bank</h1>
        <p class="text-2xl text-center font-sans">
            Preencha seus dados para criar uma conta.
        </p>
    </div>
    <form class="mt-0 ml-10 mr-10 p-5" method="post" action="" enctype="multipart/form-data">
        <div id="inputName" class="pb-2 w-full">
            <label>Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Nome Sobrenome" required/>
        </div>
        <div id="inputDataNascimento" class="pb-2 w-full">
            <label>Data de nascimento</label>
            <input type="date" id="dataNascimento" name="dataNascimento" required/>
        </div>
        <div id="inputWhatsapp" class="pb-2 w-full">
            <label>Whatsapp</label>
            <input type="tel" id="whatsapp" name="whatsapp" placeholder="(00) 00000 0000" minlength="11"/>
        </div>
        <div id="inputEmail" class="pb-2 w-full">
            <label>E-mail</label>
            <input type="email" id="email" name="email" placeholder="exemplo@email.com" required/>
        </div>
        <div id="inputSenha" class="pb-2 w-full">
            <label>Senha</label>
            <input type="password" id="senha" name="senha" placeholder="******" required/>
        </div>
        <div class=" flex flex-auto flex-col pl-5 pr-5 pt-5 pb-0 w-full ">
            <button class="justify-content-center justify-items-center justify-align-center items-center
             bg-indigo-200 hover:bg-indigo-300 rounded-full text-xl p-1">
                Enviar
            </button>
        </div>
    </form>
</main>
<script>
    //mascara para whatsapp
    const whatsapp = document.getElementById("whatsapp") //salvar valor digitado no campo whatsapp
    whatsapp.addEventListener(
        'input', (event) => {
            var phone = event.target.value.replace(/\D/d, '') //Retirar caracteres nao numericos com regex
            var formattedPhone
            if(phone.length === 10) formattedPhone = phone.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3') //fixo
            else if(phone.length === 11) formattedPhone = phone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $3-$2') //celular
            else formattedPhone = phone //sem formataçao
            event.target.value = formattedPhone
        }
    )
</script>
</html>