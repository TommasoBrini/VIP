<form action="processToRegistration.php" method="POST">
    <h1>REGISTRATION</h1>
    <ul>
        <li>
            <label for="email">Email: </label><input type="text" id="email" name="email" /><br>
        </li>
    </ul>
    <ul>
        <li>
            <label for="password">Password:</label>
        </li>
        <li>
            <input type="password" id="password" name="password"/>
            <img type="button" src="./img/eye.png" id="showHidePwd"/><br>
        </li>
    </ul>
    <ul>
        <li>
            <label for="confirmPassword">Confirm password:</label>
        </li>
        <li>
            <input type="password" id="confirmPassword" name="confirmPassword"/>
        </li>
    </ul>
    <label for="seller" id="seller">Seller:</label><input type="checkbox" name="seller" /><br>
    <button type="submit" name="register" id="signIn" name="signIn">SIGN IN</button>
</form>