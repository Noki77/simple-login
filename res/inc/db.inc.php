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
final class Database {
    private $dbData;
    public $dbHandle;
    
    public function __construct($dbData_) {
        $this->dbData = $dbData_;
    }
    
    public function query($data) {
        return mysqli_query($this->dbHandle, $data);
    }
    
    public function connect() {
        $this->dbHandle = mysqli_connect($this->dbData['host'], $this->dbData['user'], $this->dbData['pwd'], $this->dbData['db'], $this->dbData['port']);
        return !$this->dbHandle ? $this->dbHandle->connect_error : null;
    }
    
    public function initSchema() {
        if (isset($this->dbHandle) && $this->query("SELECT 1 FROM `sl-data` LIMIT 1") === false) {
            $this->query("CREATE TABLE `sl-data` (id INT AUTO_INCREMENT UNIQUE, user_name VARCHAR(32) NOT NULL UNIQUE, user_pwd VARCHAR(32) NOT NULL) ENGINE=InnoDB;");
        }
    }
    
    public function addUser($username, $pwd) {
        $this->query("INSERT INTO `sl-data` (`user_name`, `user_pwd`) VALUES ('${username}', '${pwd}')");
    }
    
    public function lastError() {
        return mysqli_error($this->dbHandle);
    }
    
    public function checkCredentials($username, $password) {
        $result = $this->query("SELECT * FROM `sl-data` WHERE user_name LIKE '%${username}%' AND user_pwd='${password}'");
        if ($result->num_rows != 1) {
            return null;
        } else {
            return $result->fetch_assoc();
        }
    }
    
    public function userExists($username) {
        return $this->query("SELECT * FROM `sl-data` WHERE user_name LIKE '%${username}%'")->num_rows > 0;
    }
    
    public function escape($string) {
        return mysqli_real_escape_string($this->dbHandle, $string);
    }
}
