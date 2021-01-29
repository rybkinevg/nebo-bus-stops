<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/declofnum.php');

class db
{
    private $connection;
    private $dbname;

    public function __construct($host, $user, $pass, $dbname = "")
    {
        $connection = new mysqli($host, $user, $pass, $dbname);

        if ($connection->connect_error) die("Ошибка подключения: " . $connection->connect_error);

        $this->connection = $connection;
        $this->dbname     = $dbname;
    }

    public function close()
    {

        $this->connection->close();
    }

    public function create_db($dbname)
    {

        $sql_create = "CREATE DATABASE IF NOT EXISTS `{$dbname}` CHARACTER SET utf8 COLLATE utf8_general_ci";

        if ($this->connection->query($sql_create) === TRUE) {

            return true;
        } else {

            die("Ошибка при создании базы: " . $this->connection->error);
        }
    }

    private function notice($text)
    {
        echo $text, "<br/>";
    }

    public function create($tablename, $cols, $print = false)
    {
        $sql_check = "SHOW TABLES LIKE '{$tablename}'";
        $sql_create = "CREATE TABLE IF NOT EXISTS `{$tablename}` ({$cols})";

        if ($this->connection->query($sql_check)->num_rows == 1) {

            die("Невозможно создать таблицу: таблица {$tablename} уже существует");
        }

        if ($this->connection->query($sql_create) === TRUE) {

            if ($print) $this->notice("Таблица {$tablename} успешно создана");
        } else {

            die("Ошибка при создании таблицы: " . $this->connection->error);
        }
    }

    public function check_cols($tablename, $check = true)
    {
        $sql_check = "SELECT * FROM `{$tablename}` ORDER BY ID LIMIT 1";
        $result    = $this->connection->query($sql_check);

        if ($result) {

            return ($check) ? true : $result->field_count;

            $result->close();
        } else {

            return false;
        }
    }

    public function insert($tablename, $data, $print = false)
    {
        $sql_insert = "INSERT INTO `{$tablename}` VALUES({$data})";

        if ($this->connection->query($sql_insert) === TRUE) {

            if ($print) $this->notice("Данные в таблицу {$tablename} успешно добавлены");
        } else {

            die("Ошибка при добавлении данных в таблицу {$tablename}: " . $this->connection->error);
        }
    }

    public function select($tablename, $print = false, $what = '*', $where = false)
    {
        if ($where) {

            $where = " WHERE $where";
        }

        if ($result = $this->connection->query("SELECT {$what} FROM `{$tablename}`{$where}")) {

            if ($print) {

                while ($row = $result->fetch_assoc()) {

                    $this->notice($row['ID']);
                }

                $result->free();
            } else {

                if ($what != '*') {
                    for ($set = array(); $row = $result->fetch_assoc(); $set[] = $row[$what]);

                    $result->free();

                    return $set;
                } else {

                    for ($set = array(); $row = $result->fetch_assoc(); $set[] = $row);

                    $result->free();

                    return $set;
                }
            }

            $this->connection->close();
        } else {

            return false;
        }
    }

    public function count($tablename, $what = '*', $where = '')
    {
        if ($where) {

            $where = " WHERE $where";
        }

        if ($result = $this->connection->query("SELECT COUNT({$what}) as total FROM `{$tablename}`{$where}")) {

            if ($what != '*') {
                for ($set = array(); $row = $result->fetch_assoc(); $set[] = $row[$what]);

                $result->free();

                return $set[0]['total'];
            } else {

                for ($set = array(); $row = $result->fetch_assoc(); $set[] = $row);

                $result->free();

                return $set[0]['total'];
            }
        } else {

            die("Ошибка: выбрана неверная таблица");
        }
    }

    public function get_last_update($dbname, $tablename)
    {
        $sql_last_update = "SELECT OBJECT_NAME(OBJECT_ID) AS DatabaseName, last_user_update,*
        FROM sys.dm_db_index_usage_stats
        WHERE database_id = DB_ID('{$dbname}')
        AND OBJECT_ID=OBJECT_ID('{$tablename}'})";
    }

    public function drop($tablename)
    {

        $sql_drop = "DROP TABLE IF EXISTS `{$tablename}`";

        if ($this->connection->query($sql_drop) === TRUE) {

            return true;
        } else {

            die("Ошибка при добавлении данных в таблицу {$tablename}: " . $this->connection->error);
        }
    }

    public function delete($tablename, $where = false)
    {
        if ($where) {

            $where = " WHERE $where";
        }

        $sql_delete = "DELETE FROM `{$tablename}`{$where}";

        if ($this->connection->query($sql_delete) === TRUE) {

            return true;
        } else {

            die("Ошибка при добавлении данных в таблицу {$tablename}: " . $this->connection->error);
        }
    }
}
