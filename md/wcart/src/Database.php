<?php

use Illuminate\Database\DatabaseManager;

class Database{
    public function connection(){
        return app(DatabaseManager::class)->connection();
    }
}