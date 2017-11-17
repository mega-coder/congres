
<html>
    <head>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/login.css">
    </head>
    <body>
        <div id="form_content">
            <form class="form_group" id="form" name="form" action="POST">  
                    <div id="error_message">  
                    </div>
                    <label>Login</label>
                    <input type="email" name="email" <?php if(isset($_GET['user'])){?> value="<?php echo $_GET['user'] ;}?>" style="margin-bottom:1%" placeholder="login" required class="form-control"> 
                    <label>Password</label>
                    <input type="password" name="password" <?php if(isset($_GET["password"])){?> value="<?php echo $_GET['password'];}?>" placeholder="password" class="form-control" required>
                    <div id="oublier">
                    <input type="submit"  value="Se connecter"/> 
                    <a href="">mot de passe oublié ?</a>
                    </div>             
            </form>
        </div>   
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/login.js"></script>
    </body>
</html>