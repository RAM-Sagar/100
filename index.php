<html>
    <body>
        <center>
        <h1>Welcome To 100BP</h1>
        <?php
	session_start();

if(isset($_SESSION['user'])){
    
    header('Location:profile.php');
}
?>
        <form action="login_process.php" method="post">
            <input name="email" />
            <input name="password" />
            <input type="submit" name="Submit" />
            <a href="newuser.php">New User</a>
        </form>
        </center>
    
    </body>
</html>