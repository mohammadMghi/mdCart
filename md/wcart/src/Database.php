<?php
namespace Md\Wcart;
use Illuminate\Database\DatabaseManager;

class Database{
    private $connectionName;
 
    function __construct($connectionName){
        $this->connectionName = $connectionName;
    }

    public function connection(){
        return app(DatabaseManager::class)->connection($this->connectionName);
    }
}