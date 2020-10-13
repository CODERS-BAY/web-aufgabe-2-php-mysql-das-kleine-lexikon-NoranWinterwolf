<?php define('ROOTPATH', '/web-aufgabe-2-php-mysql-das-kleine-lexikon-NoranWinterwolf/');
session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#loginContent" aria-controls="loginContent" aria-expanded="false" aria-label="Toggle navigation"></button>

    <div class="collapse navbar-collapse" id="loginContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="../index.php">Home</a>
            </li>
            <?php if (!isset($_SESSION["username"])) { ?>
                <li class="nav-item">
                    <button type="button" class="btn btn-link text-light" data-toggle="modal" data-target="#registry">Registration</button>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link text-light" href="<?php echo ROOTPATH; ?>/auth/editLexikon.php">Einträge bearbeiten</a>
                </li>
            <?php } ?>
        </ul>
        <?php if (!isset($_SESSION["username"])) { ?>
            <?php if (isset($_SESSION["login"])) {
                if (!$_SESSION['login']) {
            ?>
                    <div class="nav-item py-1 px-2 mt-0 bg-danger font-weight-bold rounded">Falsche Login-Daten!</div>
            <?php
                    $_SESSION['login'] = null;
                }
            }
            ?>
            <div class="nav-item dropdown dropdown-menu-right">
                <a class="nav-link text-light dropdown-toggle" href="#" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Login
                </a>
                <div class="dropdown-menu dropdown-menu-right bg-dark" style="min-width: 20rem;" aria-labelledby="loginDropdown">
                    <form action="auth/login.php?login=1" method="post" class="px-4 py-3">
                        <div class="form-group">
                            <label for="username" class="text-light">Username:</label>
                            <input type="text" name="username" class="form-control" value="" required="required" size="30" id="username" maxlength="250" require>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-light">Password:</label>
                            <input type="password" name="password" class="form-control" required="required" size="30" maxlength="250" id="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <a class="nav-link text-light" href="<?php echo ROOTPATH; ?>/auth/logout.php">Logout (<?php echo $_SESSION["username"]; ?>)</a>
        <?php } ?>
        <form class="form-inline my-2 my-lg-0 search-box">
            <input class="form-control mr-sm-2" type="text" autocomplete="off" placeholder="Search" area-label="Search">
            <div class="result bg-white fixed-top col-12 mt-5 card"></div>
        </form>

    </div>
</nav>