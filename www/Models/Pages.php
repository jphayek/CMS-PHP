<?php

namespace App\Models;

use App\Memento\Memento;
use App\Models\Pages as PagesModel;
use App\Core\SQL;

class Pages extends SQL{
    private Int $id = 0;
    protected String $title;
    protected String $content;  
    protected ?String $created_at;
    protected ?String $updated_at;
    protected ?int $created_by;
    protected ?String $slug;
    protected ?int $status;

    public function __construct(){
        parent::__construct();
    }

    // Getters & Setters

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
     * Get the value of title
     * @return String
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     * @param String $title
     */
    public function setTitle(string $title): void
    {
        $this->title = ucwords(strtolower(trim($title)));
    }

    /**
     * Get the value of content
     * @return String
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     * @param String $content
     */
    public function setContent(string $content): void
    {
        $this->content = trim($content);
    }

    /**
     * Get the value of created_at
     * @return String
     */
    public function getCreated_at(): string
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     * @param String $created_at
     */
    public function setCreated_at(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * Get the value of updated_at
     * @return String
     */
    public function getUpdated_at(): string
    {
        return $this->updated_at;
    }
    
    /**
     * Set the value of updated_at
     * @param String $updated_at
     */
    public function setUpdated_at(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * Get the value of created_by
     * @return Int
     */
    public function getCreated_by(): int
    {
        return $this->created_by;
    }

    /**
     * Set the value of created_by
     * @param Int $created_by
     */

    public function setCreated_by(int $created_by): void
    {
        $this->created_by = $created_by;
    }

    /**
     * Get the value of slug
     * @return String
     */
    public function getSlug(): ?string
    {
        return $this->slug ?? '';
    }

    /**
     * Set the value of slug
     * @param String $slug
     */

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * Get the value of status
     * @return Int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Set the value of status
     * @param Int $status
     */

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

 //memento pattern
    public function createMemento(): Memento
    {
        return new Memento($this->getStatus());
    }

    public function restoreMemento(Memento $memento)
    {
        $this->setStatus($memento->getState());
    }
    


}