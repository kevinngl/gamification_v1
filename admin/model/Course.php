<?php

require "../../config/database.php";

class Course extends Database {
        protected function setCourse($name,$description,$image,$link,$material,$coin,$challenge){
            
            $sql = $this->connect()->prepare("INSERT  INTO course(name,description,image,link,material,coin,challenge) VALUES (?,?,?,?,?,?,?)");
            if($sql->execute([$name,$description,$image,$link,$material,$coin,$challenge])){
                return true;
            }else{
        
                throw new Exception ("User can not be created");
            }

        }
        protected function updateCourse($id,$name,$description,$image,$link,$material,$coin,$challenge){
            
            $sql = $this->connect()->prepare("UPDATE `course` SET `name`= ?,`description`= ?,`image`= ? ,`link`= ?,`material`= ?,`coin`= ?,`challenge`= ? WHERE `course_id`= ?");
            if($sql->execute([$name,$description,$image,$link,$material,$coin,$challenge,$id])){
                return true;
            }else{
        
                throw new Exception ("User can not be created");
            }

        }
        public function getCourse(){
            $sql= $this->connect()->prepare('SELECT * FROM course');
             $sql->execute();

             return $sql;
            
           
        }

        public function Mcourse(){
           
                $sql= $this->connect()->prepare('SELECT `course`.*, COUNT(`module`.`course_id`) AS num 
                FROM `course`
                LEFT JOIN `module` ON `course`.`course_id` = `module`.`course_id`
                GROUP BY `course`.`course_id`');
               if($sql->execute()){
                return $sql;
               }else{
                throw new Exception("Error Processing Request",1);
               }
   
                
        }

        public function deletecourse($courseId) {
            
            $sql = "DELETE FROM course WHERE course_id = ?";
            $stmt = $this->connect()->prepare($sql);
           
    
            if ($stmt->execute([$courseId])) {
                
                $this->deleteRefModule($courseId);
                $this->deleteRefQuiz($courseId);
                $this->deleteRefTrack($courseId);
                return true;
            } else {
                
                return false;
            }
        }

        private function deleteRefModule($courseId) {
           
            $deleteReferencesSql = "DELETE FROM module WHERE course_id = ?";
            $stmtReferences = $this->connect()->prepare($deleteReferencesSql);
           
            $stmtReferences->execute([$courseId]);
            
      
        }

        
        private function deleteRefQuiz($courseId) {
        
            $deleteReferencesSql = "DELETE FROM quiz WHERE course_id = ?";
            $stmtReferences = $this->connect()->prepare($deleteReferencesSql);

            $stmtReferences->execute([$courseId]);
    
         
        }
        
        private function deleteRefTrack($courseId) {
         
            $deleteReferencesSql = "DELETE FROM track WHERE track_id = ?";
            $stmtReferences = $this->connect()->prepare($deleteReferencesSql);
            $stmtReferences->execute([$courseId]);
     
        }
}


?>