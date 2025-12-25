<?php

namespace parser;


class csv {
    public function __construct(){

    }
    public function readfile($filename){

        $pdo = \config\dbconfig::getInstance()->getPdo();

        $fh = fopen($filename, 'rb');
        
        while(!feof($fh)){
            $line = fgets($fh);
            $line = trim($line);
            if($line == "") continue;
            $parts = explode(",", $line);
            $Qaza_ID = (int) $parts[0];
            $Qaza_NAME = trim($parts[1], '"');
            $List_ID = (int) $parts[2];
            $list_NAME = trim($parts[3], '"');
            $list_LOGO = trim($parts[4], '"');
            $Candidate_ID = (int) $parts[5];
            $Candidate_NAME = trim($parts[6], '"');
            $Candidate_DOB = (int) $parts[7];
            $Candidate_SECT = trim($parts[8], '"');
            $Candidate_PHOTO = trim($parts[9], '"');
            
             $this->InsertRecords($pdo, $Qaza_ID, $Qaza_NAME, $List_ID, $list_NAME, $list_LOGO, $Candidate_ID, 
                               $Candidate_NAME, $Candidate_DOB, $Candidate_SECT, $Candidate_PHOTO);
        }
        
        fclose($fh);
    }

    private function InsertRecords($pdo, $Qaza_ID, $Qaza_NAME, $List_ID, $list_NAME, $list_LOGO, $Candidate_ID, 
                            $Candidate_NAME, $Candidate_DOB, $Candidate_SECT, $Candidate_PHOTO) : void{
    
    //Inserting Records Of The Qaza
    $sql = "INSERT IGNORE INTO qaza (Qaza_ID, Qaza_NAME) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);

    try{
    //Bind and execute and check if the pdo failed to insert the records
    $stmt->execute([
      $Qaza_ID,$Qaza_NAME  
        ]);
    } catch(\PDOException $e) {
         die("Insert failed: " . $e->getMessage());
    }



    //Inserting Records Of The List
    $sql = "INSERT IGNORE INTO list (List_ID, List_NAME, List_LOGO, Qaza_ID) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try{
    //Bind and execute and check if the pdo failed to insert the records
    $stmt->execute([
         $List_ID, $list_NAME, $list_LOGO, $Qaza_ID
         ]);
        } catch(\PDOException $e) {
         die("Insert failed: " . $e->getMessage());
    }



    //Inserting Records Of The Candidate
    $sql = "INSERT IGNORE INTO candidate (Candidate_ID, Candidate_NAME, Candidate_DOB, Candidate_SECT,
    Candidate_PHOTO, List_ID) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try{
    //Bind and execute and check if the pdo failed to insert the records
    $stmt->execute([
         $Candidate_ID, $Candidate_NAME, $Candidate_DOB, $Candidate_SECT, $Candidate_PHOTO, $List_ID
            ]);
    }catch(\PDOException $e) {
         die("Insert failed: " . $e->getMessage());
         }

    }


}


?>