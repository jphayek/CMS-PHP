<?php
namespace App\Core;


abstract class SQL{

    private $pdo;
    private $table;
    private static $instance=null;

    public function __construct()
    {
       
        try {
            $this->pdo = new \PDO("pgsql:host=database;dbname=pa-iw;port=5432", "pa-iw", "Response11");
        }catch(\Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }

        $classExploded = explode("\\", get_called_class());
        $this->table = "esgi_".end($classExploded);
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public static function populate(Int $id): object
    {
        $class = get_called_class();
        $objet = new $class();
        return $objet->getOneWhere(["id"=>$id]);
    }

    public function getOneWhere(array $where): ?object
    {
        $sqlWhere = [];
        foreach ($where as $column=>$value) {
            $sqlWhere[] = $column."=:".$column;
        }
        $queryPrepared = $this->pdo->prepare("SELECT * FROM ".$this->table." WHERE ".implode(" AND ", $sqlWhere));
        $queryPrepared->setFetchMode( \PDO::FETCH_CLASS, get_called_class());
        $queryPrepared->execute($where);
        $result = $queryPrepared->fetch();
        
        return $result !== false ? $result : null;
    }
    
    public function getAll(): array
    {
        $queryPrepared = $this->pdo->prepare("SELECT * FROM ".$this->table);
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $queryPrepared->execute();
        return $queryPrepared->fetchAll();
    }

    

    public function save(): void
    {
        $columns = get_object_vars($this);
        $columnsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $columnsToExclude);

        if(is_numeric($this->getId()) && $this->getId()>0) {
            $sqlUpdate = [];
            foreach ($columns as $column=>$value) {
                $sqlUpdate[] = $column."=:".$column;
            }
            $queryPrepared = $this->pdo->prepare("UPDATE ".$this->table.
                " SET ".implode(",", $sqlUpdate). " WHERE id=".$this->getId());
        }else{
            $queryPrepared = $this->pdo->prepare("INSERT INTO ".$this->table.
                " (".implode("," , array_keys($columns) ).") 
            VALUES
             (:".implode(",:" , array_keys($columns) ).") ");
        }

        $queryPrepared->execute($columns);

    }

    

public function delete(): void
{
    $queryPrepared = $this->pdo->prepare("DELETE FROM ".$this->table." WHERE id=:id");
    $queryPrepared->execute(['id' => $this->getId()]);
}


//article
public function getAllArticle()
{
    $queryPrepared = $this->pdo->prepare("SELECT a.*, u.firstname 
    FROM esgi_article AS a 
    LEFT JOIN esgi_user AS u ON a.author = u.id");
    $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
    $queryPrepared->execute();
    return $queryPrepared->fetchAll();
}


public function associateCategory(&$category)
{
    
    $articleId = $this->getId();

    $sql = "INSERT INTO categories (article_id, category_id) VALUES (:articleId, :categoryId)";


    $queryPrepared = $this->pdo->prepare($sql);

    // Liez les paramètres
    $queryPrepared->bindParam(':articleId', $articleId, \PDO::PARAM_INT);
    $queryPrepared->bindParam(':categoryId', $categoryId, \PDO::PARAM_INT);

    $queryPrepared->execute();
}


public function createArticle($title, $content, $categoryId)
{
    // Créez l'article
    $query = "INSERT INTO esgi_article (title, content) VALUES (:title, :content)";
    $queryPrepared = $this->pdo->prepare($query);
    $queryPrepared->bindParam(':title', $title, \PDO::PARAM_STR);
    $queryPrepared->bindParam(':content', $content, \PDO::PARAM_STR);
    $queryPrepared->execute();

    $articleId = $this->pdo->lastInsertId();

    $query = "INSERT INTO article_category (article_id, category_id) VALUES (:articleId, :categoryId)";
    $queryPrepared = $this->pdo->prepare($query);
    $queryPrepared->bindParam(':articleId', $articleId, \PDO::PARAM_INT);
    $queryPrepared->bindParam(':categoryId', $categoryId, \PDO::PARAM_INT);
    $queryPrepared->execute();

}

public function getArticlesByCategory($categoryId)
{
    $sql = "SELECT a.*, u.firstname
            FROM esgi_article a
            LEFT JOIN esgi_user u ON a.author = u.id";

    if (!empty($categoryId)) {
        
        $sql .= " WHERE category_id = :category_id";
    }

    $stmt = $this->pdo->prepare($sql);
    
    if (!empty($categoryId)) {
        $stmt->bindParam(":category_id", $categoryId, \PDO::PARAM_INT);
    }
    $stmt->execute();

    $articles = $stmt->fetchAll();
    return $articles;
}



public function Count(){
    $queryPrepared = $this->pdo->prepare("SELECT COUNT(*) FROM ".$this->table);
    $queryPrepared->execute();
    return $queryPrepared->fetchColumn();
}

public function getAllPages()
{
    $queryPrepared = $this->pdo->prepare("SELECT * FROM ".$this->table);
    $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
    $queryPrepared->execute();
    return $queryPrepared->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($pages as &$page) {
        $page['url'] = $this->generateUrl($page); // Générer l'URL
        $page['lastmod'] = $this->generateLastmod($page); // Générer la date de modification
        $page['changefreq'] = $this->generateChangefreq($page); // Générer la fréquence de changement
        $page['priority'] = $this->generatePriority($page); // Générer la priorité
    }
    return $pages;
}


public function getAllWhere(array $where): array
{
    $sqlWhere = [];
    foreach ($where as $column=>$value) {
        $sqlWhere[] = $column."=:".$column;
    }
    $queryPrepared = $this->pdo->prepare("SELECT * FROM ".$this->table." WHERE ".implode(" AND ", $sqlWhere));
    $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
    $queryPrepared->execute($where);
    return $queryPrepared->fetchAll();
}





}