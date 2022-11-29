<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>PomoManager | Login</title>
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
    <link rel="stylesheet" href="css/components/rodape.css"/>
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
    <?php
    session_start();
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
    endif;
    session_unset();
    ?>
    <main>
        <div class="formulario">
            <section class="formulario--tamanho container">
                <h2 class="titulo titulo--secundario">Login</h2>

                <form action="/realize-login" method="POST" id="formLogin">
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
                    <div class="botao">
                        <button type="submit" class="botao botao--estilo" id="buttonLogin" disabled="disabled">Entrar
                        </button>
                    </div>
                </form>
                <a href="/register" class="botao__link">Não possui uma conta? Registre-se agora!</a>
            </section>
        </div>
    </main>
</div>
<footer class="rodape">
    <h1>Created by: Giovanni Fushimi and Gabriel Falcão</h1>
</footer>
<script>feather.replace()</script>
<script src="js/jQuery/jquery-3.6.0.js"></script>
<script src="js/checkForm.js"></script>
</body>
</html>