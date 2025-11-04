/**
* O Singleton é um padrão de projeto criacional que permite a você garantir que uma classe tenha apenas uma instância, 
* enquanto provê um * ponto de acesso global para essa instância.
*/

<?php

class DB {
    private static ?DB $instance = null;
    private ?PDO $connection = null;

    private function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host=localhost;dbname=db_name', 'root', '26154879');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die('Erro de conexão: ' . $e->getMessage());
        }
    }

    public static function getInstance(): DB
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    public function prepare(string $sql): PDOStatement
    {
        return $this->getConnection()->prepare($sql);
    }

    private function __clone() {}
    private function __wakeup() {}
}