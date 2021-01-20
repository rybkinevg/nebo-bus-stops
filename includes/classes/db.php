<?php

//include('../declofnum.php');

class db
{
    private $connection;
    private $dbname;

    public function __construct($host, $user, $pass, $dbname)
    {
        $connection = new mysqli($host, $user, $pass, $dbname);

        if ($connection->connect_error) {

            die("Ошибка подключения: " . $connection->connect_error);
        } else {

            $this->notice("Подключение успешно создано");
        }

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

            //$cols = declOfNum($result->field_count, $titles);
            $cols = $result->field_count;

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
}
