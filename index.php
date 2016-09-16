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

    if (!isset($_SESSION['simple-login_user'])) {
        page("Login needed", "danger");
            ?>
            <h2>You need to log in before you can continue.</h2>
            <form action="login.php" method="POST">
                <button type="submit" value="log-in" name="action" class="btn btn-primary">Login using an existing account</button>
                <button type="submit" value="register" name="action" class="btn btn-success">Register a new account</button>
            </form>
        <?php
         endPage();
        
    /** Für einfachen Redirect
       ?> <meta http-equiv="refresh" content="0;URL=login.php"> <?php
     **/
    } else {
        page("Welcome user #" . $_SESSION['simple-login_user'], "default", true, "<a href='logout.php' style='float: right'>Logout</a>");?>
            <p>This page has some content in it, which you can only access when you're logged in.</p>
        <?php
        endPage();
    }
