<form action="processToLogin.php" method="POST">
    <h1>LOGIN</h1>
    <ul>
        <li>
            <label for="email">Email:</label><input type="text" id="email" name="email" /><br>
        </li>
    </ul>
    <ul>
        <li>
            <label for="password">Password:</label>
        </li>
        <li>
            <input type="password" id="password" name="password" />
        </li>
        <li>
            <img type="button" src="./img/eye.png" id="showHidePwd" /><br>
        </li>
    </ul>
    <button type="submit" name="login" id="login">LOGIN</button>
</form>