<?php

namespace App\Models;

use App\Core\SQL;

class Category extends SQL{

    private $db;
    private Int $id = 0;
    protected String $name;

    public function __construct()
    {
        $this->db = SQL::getInstance(); 
    }

        /**
     * @return Int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Int $id
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAll()
    {
        $queryPrepared = $this->pdo->prepare("SELECT * FROM ".$this->table);
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $queryPrepared->execute();
        return $queryPrepared->fetchAll();
    }
}