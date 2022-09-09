<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>PomoManager | Registre-se</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
            href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;700&display=swap"
            rel="stylesheet"
    />
    <link rel="icon" href="assets/img/pomomanager_icon.png"/>
    <link rel="stylesheet" href="css/base/base.css"/>
    <link rel="stylesheet" href="css/components/cabecalho.css"/>
    <link rel="stylesheet" href="css/components/formulario.css"/>
    <link rel="stylesheet" href="css/components/label.css"/>
    <link rel="stylesheet" href="css/components/input.css"/>
    <link rel="stylesheet" href="css/components/botao.css"/>
    <link rel="stylesheet" href="css/components/notificacao.css"/>

    <link rel="script" href="js/checkForm.js"/>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
<div class="container--centro">
    <header class="cabecalho container">
        <h1 class="titulo--destaque logo">
            <img class="icone" src="assets/img/pomomanager_icon.png" alt="Ícone do PomoManager"/>
            PomoManager
        </h1>
    </header>

    <main>
        <?php
        session_start();
        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
        endif;
        session_unset();
        ?>
        <div class="formulario">
            <section class="formulario--tamanho container">
                <h2 class="titulo titulo--secundario">Registre-se</h2>
                <form action="/register-user" method="POST" id="formRegister" enctype="multipart/form-data">
                    <div class="input__avatar">
                        <label for="avatar">
                            <img class="input--image" id="avatarPrev" src="assets/img/default-profile.png"
                                 alt="Avatar Preview">
                        </label>
                        <input id="avatar" type="file" name="avatar"
                               onchange="document.getElementById('avatarPrev').src = window.URL.createObjectURL(this.files[0]);"
                               accept="image/png, image/jpeg">
                    </div>
                    <label class="label" for="name">Nome</label>
                    <input type="text" id="name" name="name" placeholder="Nome" class="input"/>
                    <label class="label" for="email">E-mail</label>
                    <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="E-mail"
                            class="input"
                    />
                    <label class="label" for="password">Senha</label>
                    <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Senha"
                            class="input"
                    />
                    <label class="label" for="checkPassword">Confirme sua senha</label>
                    <input
                            type="password"
                            id="checkPassword"
                            name="checkPassword"
                            placeholder="Confirme sua senha"
                            class="input"
                    />
                    <ul class="formulario--senha">
                        <li id="pass6chars">A senha possui no mínimo 6 caracteres.</li>
                        <li id="checked">A senha está confirmada.</li>
                    </ul>
                    <div class="botao">
                        <button type="submit" class="botao botao--estilo" id="buttonRegister" disabled="disabled">
                            Confirmar
                        </button>
                    </div>
                </form>
                <a href="/" class="botao__link"><i data-feather="arrow-left" aria-hidden="true"></i> Voltar</a>
            </section>
        </div>
    </main>
</div>

<script src="js/jQuery/jquery-3.6.0.js"></script>
<script src="js/checkForm.js"></script>
<script>feather.replace()</script>
</body>
</html>