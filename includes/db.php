<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/declofnum.php');

class db
{
    private $connection;
    private $dbname;

    public function __construct($host, $user, $pass, $dbname)
    {
        $connection = new mysqli($host, $user, $pass, $dbname);

        if ($connection->connect_error)  die("Ошибка подключения: " . $connection->connect_error);

        $this->connection = $connection;
        $this->dbname     = $dbname;
    }

    private function notice($text)
    {
        echo $text, "<br/>";
    }

    public function create($tablename, $cols)
    {
        $sql_check = "SHOW TABLES LIKE '{$tablename}'";
        $sql_create = "CREATE TABLE IF NOT EXISTS `{$tablename}` ({$cols})";

        if ($this->connection->query($sql_check)->num_rows == 1) {

            die("Невозможно создать таблицу: таблица {$this->dbname} уже существует");
        }

        if ($this->connection->query($sql_create) === TRUE) {

            $this->notice("Таблица {$tablename} успешно создана");
        } else {

            die("Ошибка при создании таблицы: " . $this->connection->error);
        }
    }

    public function check_cols($tablename)
    {
        $sql_check = "SELECT * FROM `{$tablename}` ORDER BY ID LIMIT 1";
        $result    = $this->connection->query($sql_check);

        if ($result) {

            $titles = [
                '%d поле',
                '%d поля',
                '%d полей',
            ];

            $cols = declOfNum($result->field_count, $titles);

            $this->notice("Таблица содержит {$cols}");

            $result->close();
        } else {

            die("Ошибка: выбрана неверная таблица");
        }
    }

    public function insert($tablename, $data)
    {
        $sql_insert = "INSERT INTO `{$tablename}` VALUES({$data})";

        if ($this->connection->query($sql_insert) === TRUE) {

            $this->notice("Данные в таблицу {$tablename} успешно добавлены");
        } else {

            die("Ошибка при добавлении данных в таблицу {$tablename}: " . $this->connection->error);
        }
    }

    public function select($tablename, $print = false, $what = '*', $where = null)
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

            die("Ошибка: выбрана неверная таблица");
        }
    }
}
