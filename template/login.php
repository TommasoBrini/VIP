<h1>LOGIN</h1>
    <form method="post" action="#">
    <?php if(isset($templateParams["errorLogin"])): ?>
    <p><?php echo $templateParams["errorLogin"]; ?></p>
    <?php endif; ?>
    <ul>
        <li>
        <label for="email">Email:</label><input type="text" id="email" name="email"/><br>
    </li>
    </ul>
        <ul>
    <li>
        <label for="password">Password:</label></li><li><input type="password" id="pwd"></li><li><img type="button" src="./img/eye.png" id="showHidePwd"/></li>
    </ul><br>
        <button type="submit" name="login" id="login">LOGIN</button>
        <script type="text/javascript">
        $(document).getElementById("login").onclick = function(){
            
            $login_result = dbh->checkLogin($_POST["email"], $_POST["password"], $_POST["idvenditore"]);
            if(count($login_result)==0) {
            //Login failed
                $templateParams["errorLogin"] = "Error! Check email or password!";
            } else {
                registerLoggedUser($login_result[0]);
            }
    

            if(!isUserLoggedIn()) {
                $templateParams["titolo"] = "Home - Auctions";
                $templateParams["nome"] = "index.php";
                var_dump($_SESSION["email"]);
                echo "aaaaa";
            } else {
                $templateParams["titolo"] = "VIP - Login";
                $templateParams["nome"] = "index_login.php";
                var_dump($_SESSION);
                echo "bbbbb";
            }
        }
    </script>
    </form>