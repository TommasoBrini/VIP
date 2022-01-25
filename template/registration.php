<form action="processToRegistration.php" method="POST">
    <h1>REGISTRATION</h1>
    <ul>
        <li>
            <label for="email">Email: </label><input type="text" id="email" name="email" placeholder="Email"/><br>
        </li>
    </ul>
    <ul>
        <li>
            <label for="password">Password:</label>
        </li>
        <li>
            <input type="password" id="password" name="password" placeholder="Password"/>
            <img type="button" alt="show or hide password" src="./img/eye.png" id="showHidePwd"/><br>
        </li>
    </ul>
    <ul>
        <li>
            <label for="confirmPassword">Confirm:</label>
        </li>
        <li>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Password"/>
        </li>
    </ul>
    <?php if($templateParams["checkSellerExist"]==1): ?>
    <br>
    <?php else: ?>
    <label for="seller" id="seller">Seller:</label><input type="checkbox" name="seller"/><br>
    <?php endif; ?>
    <button type="submit" name="register" id="signIn" name="signIn">SIGN IN</button>
</form>