<!--
    This file is part of the project simple-login, licensed under the
    Creative Commons Attribution-NoDerivatives 4.0 International license.

    Copyright (c) 2016 Justin Vogel <dernoki77@gmail.com>
    Copyright (c) contributors

    You should have received a copy of the license along with this
    work. If not, see <http://creativecommons.org/licenses/by-nd/4.0/>.

    THIS SOFTWARE IS PROVIDED UNDER THE TERMS
    OF THIS CREATIVE COMMONS PUBLIC LICENSE ("CCPL" OR "LICENSE").
    THE SOFTWARE IS PROTECTED BY COPYRIGHT AND/OR OTHER APPLICABLE LAW.
    ANY USE OF THE WORK OTHER THAN AS AUTHORIZED UNDER THIS LICENSE
    OR COPYRIGHT LAW IS PROHIBITED.

    BY EXERCISING ANY RIGHTS TO THE SOFTWARE PROVIDED HERE,
    YOU ACCEPT AND AGREE TO BE BOUND BY THE TERMS OF THIS LICENSE.
    TO THE EXTENT THIS LICENSE MAY BE CONSIDERED TO BE A CONTRACT,
    THE LICENSOR GRANTS YOU THE RIGHTS CONTAINED HERE IN CONSIDERATION
    OF YOUR ACCEPTANCE OF SUCH TERMS AND CONDITIONS.
-->
<?php
    include "res/inc/head.inc.php";
    if (isset($_SESSION['simple-login_user'])) {
        ?>
        <meta http-equiv="refresh" content="0;URL=index.php">
        <?php
    } else {
        include "res/inc/db.inc.php";
        
        if (isset($_POST['user']) && isset($_POST['type'])) {
            $db = new Database(Config::SQL);
            $err = $db->connect();
            $db->initSchema();
            if ($err !== null) {
                page("Aww snap, an error occurred!", "", false);
                ?>
                    <div class="alert alert-danger">
                        <b>Could not establish database connection: <?php echo $err; ?></b>
                    </div>
                <?php
                endPage();
            }
        
            $username = $db->escape(strip_tags($_POST['user']));
            $password = md5($db->escape(strip_tags($_POST['pwd'])));
            if ($_POST['type'] === "login") {
                $user = $db->checkCredentials($username, $password);
                if ($user === null) {
                    ?>
                    
                    <form name="redirectForm" action="" method="POST">
                        <input type="hidden" name="user" value="<?php echo $username; ?>">
                        <input type="hidden" name="alert-type" value="danger">
                        <input type="hidden" name="alert-msg" value="Invalid username or password.">
                    </form>
                    
                    <script language="JavaScript">
                        document.redirectForm.submit();
                    </script>
                    <?php
                } else {
                    $_SESSION['simple-login_user'] = $user->id;
                    echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
                }
                
                $db->dbHandle->close();
            } else {
                $db = new Database(Config::SQL);
                $err = $db->connect();
                $db->initSchema();
                if ($err !== null) {
                    page("Aww snap, an error occurred!", "", false);
                    ?>
                        <div class="alert alert-danger">
                            <b>Could not establish database connection: <?php echo $err; ?></b>
                        </div>
                    <?php
                    endPage();
                } else {
                    if ($db->userExists($username)) {
                            page("Could not create user", "", false);
                            ?>
                                <div class="alert alert-warning">
                                    <b>Could not create user!</b> This username is already registered.
                                </div>
                            <?php
                            endPage();
                    } else {
                        $db->addUser($username, $password);
                        
                        if (($err = $db->lastError()) === "") {
                            page("User created", "", false);
                            ?>
                                <div class="alert alert-success">
                                    <b>User created!</b> You can now <a href="login.php">log in</a> using these login credentials.
                                </div>
                            <?php
                            endPage();
                        } else {    
                            page("Aww snap, an error occurred!", "", false);
                            ?>
                                <div class="alert alert-danger">
                                    <b>An unhandled error occurred:</b> <?php echo $err; ?>
                                </div>
                            <?php
                            endPage();
                        }
                    }
                }
                
                $db->dbHandle->close();
            }
        } else if (isset($_SESSION['simple-login_user'])) {
            ?><meta http-equiv="refresh" content="0;URL=index.php"><?php
        } else {
            if (isset($_POST['action']) && $_POST['action'] == "register") {
                page("Sign up", "success");
                Config::loadResource("sl-register.js", true);
                ?>
                
                    <h2>Your new account</h2>
                    <form action="" method="POST">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Username</span>
                                <input type="text" name="user" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Password</span>
                                <input type="password" id="pwd1" name="pwd" class="form-control" onkeyup="checkPwd()">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Repeat Password</span>
                                <input type="password" id="pwd2" class="form-control" onkeyup="checkPwd()">
                            </div>
                        </div>
                        <input type="hidden" name="type" value="register">
                        <input type="submit" id="btn" class="btn btn-block btn-success" value="Sign up">
                    </form>
                <?php
                endPage();
            } else {
                page("Sign in", "primary")?>
                    <h2>Please sign in.</h2>
                    <form action="" method="POST">
                        <?php
                            if (isset($_POST['alert-type'])) {
                                echo "<div class='alert alert-" . $_POST['alert-type'] . "'>" . $_POST['alert-msg'] . "</div>";
                            }
                        ?>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Username</span>
                                <input type="text" name="user" class="form-control" <?php if(isset($_POST['user'])) echo "values='" . $_POST['user'] . "'";?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Password</span>
                                <input type="password" name="pwd" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="type" value="login">
                        <input type="submit" class="btn btn-block btn-primary" value="Log in">
                    </form>
                    <form action="" method="POST">
                        <button class="btn btn-link btn-sm" type="submit" value="register" name="action">Sign up for a new account</button>
                    </form>
                <?php
                endPage();
            }
        }
    }
