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

final class Config {
    const BASE_URL = "//localhost/login";// "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    const SQL = array(
        host => 'localhost',
        db   => 'login-data',
        user => 'simple-login',
        pwd  => 'sldbusr1',
        port =>  3306
    );
    
    public static function loadResource($location, $isJs = false, $isExternal = false) {
        if (!$isExternal) {
            $url = Config::BASE_URL . (substr(Config::BASE_URL, -1) == '/' ? "" : "/") . "res/" . ($isJs ? "js/" : "css/") . $location;
        } else {
            $url = $location;
        }
        
        if ($isJs) {
            echo "<script src='${url}'></script>";
        } else {
            echo "<link rel='stylesheet' href='${url}'>";
        }
    }
    
    public static function connectSQL() {
        //mysqli_connect() or die return "Error: " . mysqli_error();
    }
}
