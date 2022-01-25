<form action="processToLogin.php" method="POST">
    <h1>LOGIN</h1>
    <ul>
        <li>
            <label for="email">Email: </label><input type="text" id="email" name="email" placeholder="Email"/><br>
        </li>
    </ul>
    <ul>
        <li>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password"/>
            <img type="button" alt="Show or hide password" src="./img/eye.png" id="showHidePwd"/>
        </li>
    </ul>
    <button type="submit" name="login" id="login">LOGIN</button>
</form>