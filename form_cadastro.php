<?php ?>
<main
style="flex: content"
>
    <h1>NKN Bank</h1>
    <p>
        Preencha seus dados para criar uma conta.
    </p>
    <form method="post" action="" enctype="multipart/form-data">
        <div id="inputName">
            <label>Nome</label>
            <input type="text" name="nome" placeholder="Nome Sobrenome" required/>
        </div>
        <div id="inputDataNascimento">
            <label>Data de nascimento</label>
            <input type="date" name="dataNascimento" required/>
        </div>
        <div id="inputWhatsapp">
            <label>Whatsapp</label>
            <input type="tel" name="whatsapp" />
        </div>
        <div id="inputEmail">
            <label>E-mail</label>
            <input type="email" name="email" placeholder="exemplo@email.com" required/>
        </div>
        <div id="inputSenha">
            <label>Senha</label>
            <input type="password" name="senha" required/>
        </div>
        <button>Enviar</button>
    </form>
</main>