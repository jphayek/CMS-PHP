<?php

namespace App\datatable;




class userTable 
{
  
    protected array $config = [];
    private  $users;

    public function __construct($users)
    {
        $this->users = $users;
    }
    
    public function getConfig($users): array
    {

        $this->config = [

            "config" => [
                "id" => "article-table",
                "class" => "table",
            ],
            "headers" => [
                
                "firstName" => "First Name",
                "LastName" => "Last Name",
                "email" => "Email",
                "role" => "Role",
            ],
            "body" =>[
                "firsname" => "firstname",
                "lastname" => "lastname",
                "email" => "email",
                "role" => "role",
            ],
            "data" => $this->users,
            "actions" => [
                "update" => "/user/update?id=",
                "delete" => "/user/delete?id=",
            ],
              
        ];
    

        return $this->config;
    }
}
