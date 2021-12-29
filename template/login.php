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
    </form>
