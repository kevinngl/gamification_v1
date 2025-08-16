


<?php

require_once "../../config/database.php";

class Module extends Database {

    //Inserting new data into the database
        protected function setModule($course_id,$title,$content){
            
            $sql = $this->connect()->prepare("INSERT  INTO module(course_id,name,description) VALUES (?,?,?)");
            if($sql->execute([$course_id,$title,$content])){
                return true;
            }else{
        
                throw new Exception ("Module can not be created");
            }

        }

        //joining the module and course table together and select required data from database 
        public function CModule($courseId){ // Tambahkan $courseId sebagai parameter
    $sql= $this->connect()->prepare("SELECT 
                                        `module`.*,
                                        `course`.`name`,
                                        `course`.`description`,
                                        `course`.`image` AS poster,
                                        `course`.`created_at` AS posted, -- Sesuaikan dengan nama kolom di tabel course
                                        `course`.`link`,
                                        `course`.`material` 
                                        FROM `module` 
                                        LEFT JOIN `course` ON `module`.`course_id` = `course`.`course_id`
                                        WHERE `module`.`course_id` = ? -- <--- TAMBAHKAN BARIS INI
                                        ORDER BY `module`.`module_id` ASC"); 

    // Perhatikan ini: binding parameter untuk WHERE clause
    if($sql->execute([$courseId])){ // <-- Passing $courseId ke execute()
        return $sql;
    }else{
        error_log("SQL Error in CModule: " . implode(" ", $sql->errorInfo()));
        throw new Exception("Error Processing Request: SQL execution failed. Check server logs.",1);
    }
}


        //get all data from modules table
        public function getModule(){
            $sql= $this->connect()->prepare('SELECT * FROM module');
             $sql->execute();

             return $sql;
            
           
        }


//delete data from the module table
        public function deletemodule($courseId) {
            
            $sql = "DELETE FROM module WHERE module_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(1, $courseId);
            if($stmt->execute()){
                return true;
                }
                else
                {
                    return false;
                 }
    
           
    
            
        }



}


?>