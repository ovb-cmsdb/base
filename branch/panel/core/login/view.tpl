<!DOCTYPE html>
<html lang="{ LANG }">
    <head>
        <meta charset="utf-8">
        <meta name="google" content="notranslate">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{ TITLE:LT }</title>
        <link rel="icon" href="/panel/favicon.ico">
        <link rel="stylesheet" href="/panel/main.css">
        <link rel="stylesheet" href="/panel/480.css">
    </head>
    <body>
        <div id="header">
            <div class="container">
                <div class="left"><div class="logo"></div></div>
                <div class="right"><a href="/">{ SIGN_OUT-UPP:LT }</a></div>{ MULTILANG }
                <div class="clear"></div>
            </div>
        </div>
        <div class="container">
            <div id="route">
                <p><span>&#187;</span>{ ROUTE:LT }</p>
                <div class="clear"></div>
            </div>
            <form action="{ REQUEST }" method="post">
                <p class="name">{ MAIL:LT }</p>
                <div class="input"><input type="text" name="mail" placeholder="{ MAIL:PH }" value="{ MAIL }"></div>
                <p class="name">{ PASS:LT }</p>
                <div class="input"><input type="password" name="pass" placeholder="{ PASS:PH }" value=""></div>{ WARNING }
                <div class="button"><button id="button" type="submit" name="login">{ BUTTON }</button></div>
            </form>
        </div>
    </body>
</html>
