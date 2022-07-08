<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=$base;?>/assets/css/login.css" />
</head>
<body>
    <header>
        <div class="container">
            <a href="<?=$base;?>"><img src="<?=$base;?>/assets/images/devsbook_logo.png" /></a>
        </div>
    </header>
    <section class="container main">
        <form method="POST" action="<?=$base;?>/singup_action.php">
        <?php if(!empty($_SESSION['flash'])):?>
            <?= $_SESSION['flash'];?>
            <?= $_SESSION['flash'] = ''; ?>
        <?php endif; ?>
            <input placeholder="Digite seu Nome Completo" class="input" type="text" name="name" />

            <input placeholder="Digite seu Email" class="input" type="email" name="email" />

            <input placeholder="Digite sua senha" class="input" type="password" name="password" />

            <input id="birthdate" placeholder="Digite sua data de Nascimento" class="input" type="text" name="birthdate" />


            <input class="button" type="submit" value="Cadastrar" />

            <a href="<?=$base;?>/login.php">Já tem conta? Faça login</a>
        </form>
    </section>
    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
            document.getElementById("birthdate"),
            {mask:'00/00/0000'}
        )
    </script>
</body>
</html>