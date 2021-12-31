<h1>LOGIN</h1>
    <form action="processToLogin.php" method="POST">
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
            <label for="password">Password:</label>
        </li>
        <li>
            <input type="password" id="pwd">
        </li>
        <li>
            <img type="button" src="./img/eye.png" id="showHidePwd"/><br>
        </li>
    </ul>
    <button type="submit" name="login" id="login" onclick="login()">LOGIN</button>
    </form>