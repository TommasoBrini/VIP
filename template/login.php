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
            <input type="password" id="password" name="password"/>
            <img type="button" src="./img/eye.png" id="showHidePwd"/>
        </li>
    </ul>
    <button type="submit" name="login" id="login">LOGIN</button>
</form>