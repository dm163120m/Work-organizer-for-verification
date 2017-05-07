<!DOCTYPE html>
<html>
    <head>
        <title>WorkOrganizer</title>
        <link  href="<?php echo asset('css/global.css')?>" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="naslov"><img width="50px" height="50px" src="<?php echo asset('images/logo.png')?>" /><b>Work Organizer</b></div>
                <div class="login_wrapper">
                    <form class="loginForm">
                        <label class="labela" for="username">Username</label>
                        <input class="polja" id="username" name="username" value="" /><br/>
                        <label class="labela" for="password">Password</label>
                        <input class="polja" id="password" name="password" value="" type="password"/><br/>
                        <button class="loginButton">Log in</button>
                    </form>
                </div>
                <a href="/register" >Click here to create an account </a>
            </div>
        </div>
    </body>
</html>
