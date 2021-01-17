<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// This assumes that you have placed the Firebase credentials in the same directory
// as this PHP file.


class FBconnect{
    public function __construct($root)
    {
        $this->database = null;
        $this->root = $root;

        $serviceAccount = ServiceAccount::fromJsonFile($this->root.'lamlam-3818d-firebase-adminsdk-60nlf-69752d6888.json');

        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://lamlam-3818d.firebaseio.com/')
            ->create();

        $this->database = $firebase->getDatabase();

    }


    //$ref = reference to DB | $data = array of data
    public function insertData($ref, $data){
        $this->database->getReference($ref)->getChild($data['type'])->push();
    }


    public function deleteData($ref, $key){
        try{
            $this->database->getReference($ref)->getChild($key)->remove();
            echo "deleted successfully";
        }catch (Exception $e){
            echo $e;
        }
    }

    public function showData($ref){
        $postData = $this->database->getReference($ref)->getValue();

        foreach($postData as $key => $row){
            echo $key.'<br/>';
        }
    }

    public function checkNode($ref, $child){
        return $this->database->getReference("$ref")->getSnapshot()->getChild($child)->exists();
    }

    public function check2Node($ref, $child, $child2){
        return $this->database->getReference("$ref")->getSnapshot()->getChild($child)->getChild($child2)->exists();
    }
}






