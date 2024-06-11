<?php
session_start();
$url = 'http://localhost/'; // Thay đường link domain của bạn (VD: htpps://domain.com/)
date_default_timezone_set('Asia/Ho_Chi_Minh');
class LINH
{
    private $connection;
    function connect()
    {
        if (!$this->connection)
        {
            $this->connection = mysqli_connect('localhost', 'root', '', 'otpgmail') or die ('Vui lòng kết nối đến DATABASE');
            mysqli_query($this->connection, "set names 'utf8'");
        }
    }
    function dis_connect()
    {
        if ($this->connection)
        {
            mysqli_close($this->connection);
        }
    }
    function query($sql)
    {
        $this->connect();
        $row = $this->connection->query($sql);
        return $row;
    }
    function site($data)
    {
        $this->connect();
        $row = $this->connection->query("SELECT * FROM `options` WHERE `key` = '$data'")->fetch_array();
        return $row['value'];
    }
    function get_list($sql)
    {
        $this->connect();
        $result = mysqli_query($this->connection, $sql);
        if (!$result)
        {
            die ('Câu truy vấn bị sai');
        }
        $return = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $return[] = $row;
        }
        mysqli_free_result($result);
        return $return;
    }
    function get_row($sql)
    {
        $this->connect();
        $result = mysqli_query($this->connection, $sql);
        if (!$result)
        {
            die ('Câu truy vấn bị sai');
        }
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($row)
        {
            return $row;
        }
        return false;
    }
    function num_rows($sql)
    {
        $this->connect();
        $result = mysqli_query($this->connection, $sql);
        if (!$result)
        {
            die ('Câu truy vấn bị sai');
        }
        $row = mysqli_num_rows($result);
        mysqli_free_result($result);
        if ($row)
        {
            return $row;
        }
        return false;
    }
    function insert($table, $data)
    {
        $this->connect();
        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value)
        {
            $field_list .= ",$key";
            $value_list .= ",'".mysqli_real_escape_string($this->connection, $value)."'";
        }
        $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
 
        return mysqli_query($this->connection, $sql);
    }
    function update($table, $data, $where)
    {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value)
        {
            $sql .= "$key = '".mysqli_real_escape_string($this->connection, $value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
        return mysqli_query($this->connection, $sql);
    }
    function update_value($table, $data, $where, $value1)
    {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value){
            $sql .= "$key = '".mysqli_real_escape_string($this->connection, $value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where.' LIMIT '.$value1;
        return mysqli_query($this->connection, $sql);
    }
    function remove($table, $where)
    {
        $this->connect();
        $sql = "DELETE FROM $table WHERE $where";
        return mysqli_query($this->connection, $sql);
    }
    function cong($table, $data, $sotien, $where)
    {
        $this->connect();
        $row = $this->connection->query("UPDATE `$table` SET `$data` = `$data` + '$sotien' WHERE $where ");
        return $row;
    }
    function tru($table, $data, $sotien, $where)
    {
        $this->connect();
        $row = $this->connection->query("UPDATE `$table` SET `$data` = `$data` - '$sotien' WHERE $where ");
        return $row;
    }
    function getUser($username)
    {
        $this->connect();
        $row = $this->connection->query("SELECT * FROM `users` WHERE `username` = '$username' ")->fetch_array();
        return $row;
    }
    function getIdUser($id)
    {
        $this->connect();
        $row = $this->connection->query("SELECT * FROM `users` WHERE `id` = '$id' ")->fetch_array();
        return $row;
    }

}
if(isset($_SESSION['username']))
{ 
    $LINH       = new LINH;
    $getUser     = $LINH->get_row(" SELECT * FROM users WHERE username = '".$_SESSION['username']."' ");
    $my_username = True;
    $my_money    = $getUser['money'];
    $my_level    = $getUser['level'];
    if(!$getUser)
    {
        session_start();
        session_destroy();
        header('location: /');
    }
    if ($getUser['banned'] > 0)
    {       
        session_start();
        session_destroy();
        echo '<script type="text/javascript">alert("Tài khoản bị khóa !");
        setTimeout(function(){ location.href = "" },1500);</script>';        
        die();
    }
}
else
{
    $my_level = NULL;
    $my_money = 0;
}


$domain_black = [
    'Tenmien',
    'duong.codes'
];
?>