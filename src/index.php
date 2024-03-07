<?php
class User {
    public $username;
    public $isAdmin;

    public function PrintUsername() {
        if ($this->isAdmin === true) {
            echo $this->username . " is an admin.<br/>";
            $this->revealFlag();
        } else {
            echo $this->username . " is not an admin.<br/>";
        }
    }

    protected function revealFlag() {
        echo "Congratulations! Here is your flag: slctf{y0u_h4ve_succ3ssfully_exploited_php_unserialization}";
    }

    public function __wakeup() {
        if ($this->username == "admin") {
            $this->isAdmin = true;
        }
    }
}

if (isset($_GET['data'])) {
    $decodedData = base64_decode($_GET['data']);
    $data = unserialize($decodedData);
    if ($data) {
        $data->PrintUsername();
    } else {
        echo "Unserialization failed.<br/>";
    }
} else {
    echo "Hello ctfer welcome to slctf<br/>";
    echo "You need administrator permission to obtain the flag<br/>";
}
?>
