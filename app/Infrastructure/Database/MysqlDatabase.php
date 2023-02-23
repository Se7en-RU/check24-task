<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use App\Infrastructure\Database\Exception\MysqlException;
use PDO;
use PDOException;
use stdClass;

class MysqlDatabase implements DatabaseInterface
{
    private PDO $pdo;

    /** @throws MysqlException */
    public function __construct(string $host, string $database, string $username, string $password)
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s;', $host, $database);
        $this->pdo = new PDO($dsn, $username, $password);
    }

    public function query(string $query, array $params = [], $class = stdClass::class): array
    {
        try {
            $sth = $this->pdo->prepare($query);
            $sth->execute($params);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, $class);
        } catch (PDOException $e) {
            throw new MysqlException($e->getMessage());
        }

        return $result;
    }
}