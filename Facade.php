/* *
* O Facade é um padrão de projeto estrutural que fornece uma interface simplificada para uma biblioteca, um framework, ou qualquer 
* conjunto complexo de classes.
*/

<?php

namespace App\Facade;

use App\Singleton\DB;
use PDOStatement;

class DBFacade
{
    public static function query(string $sql, array $params = []): PDOStatement
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function fetchAll(string $sql, array $params = []): array
    {
        return self::query($sql, $params)->fetchAll();
    }

    public static function fetchOne(string $sql, array $params = []): mixed
    {
        return self::query($sql, $params)->fetch();
    }

    public static function execute(string $sql, array $params = []): bool
    {
        return self::query($sql, $params)->rowCount() > 0;
    }
}