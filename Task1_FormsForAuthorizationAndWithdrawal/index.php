<?php 

session_start(); 

?>

<?php 

if (isset($_COOKIE['loggedIn']) and $_COOKIE['loggedIn']): 

?>

    <p>Добрый день, <?= $_COOKIE['login']; ?></p>
    <a href="<?= $_SERVER['PHP_SELF']; ?>?logout=true">Выйти с сайта</a>

<?php 

else: 

?>

    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Login</label> <input type="text" name="login" required />
        <br />
        <br />
        <label>Password</label> <input type="password" name="password" required />
        <br />
        <br />
        <label>Email</label> <input type="email" name="email" required />
        <br />
        <br />
        <input type="submit" name="submit" value="Войти" />
    </form>

<?php 

endif;

?>

<?php

$login = 'Pavel';
$password = 'Pavel1985';
$email = 'leonenkopavel1985@gmail.com';

if (isset($_POST['submit']) and !empty($_POST['submit'])) {
    $data['login'] = $_POST['login'] == $login ? $_POST['login'] : false;
    $data['password'] = $_POST['password'] == $password ? $_POST['password'] : false;
    $data['email'] = $_POST['email'] == $email ? $_POST['email'] : false;

    foreach ($data as $key => $value) {
        if (!$value)
            $error[] = $key;
    }

    if (empty($error)) {
        setcookie('loggedIn', true);
        setcookie('PHPSESSID', session_id());
        setcookie('login', $data['login']);
        session_start();
        header('Location: ' . $_SERVER['PHP_SELF']);
    } else {
        print_r($error);
    }
}

if (isset($_GET['logout']) and $_GET['logout'] == true) {
    setcookie("loggedIn", "false", time() - 3600);
    setcookie("PHPSESSID", "", time() - 3600);
    setcookie("login", "", time() - 3600);
    header('Location: ' . $_SERVER['PHP_SELF']);
    session_destroy();
}

?>
