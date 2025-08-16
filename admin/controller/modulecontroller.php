<?php
include "../../model/Module.php";
class ModuleController extends Module{
    public $course_id;
    public $title;
    public $content;
    public $image;
    public $link;
    public $material;

    public $uniqimage;

    public $uniqFName;

    public $result;

    private function clean(){
        $this->course_id = (int)trim($this->course_id);
        $this->title = htmlspecialchars(strip_tags(trim($this->title)));
        $this->content = htmlspecialchars(strip_tags(trim($this->content)));
        return true;
    }

    private function emptyInput(){
       
        if(empty($this->course_id) || empty ($this->title) || empty ($this->content)){

            $this->result = false;
        }else{
            $this->result = true;
        }

        return $this->result;
    }

    private function invalidContent(){

        return str_word_count($this->content) < 10;

    }

   
    
    

    //insert

    public function Create() {
        $this->clean();

        // If any input is empty
        if (!$this->emptyInput()) {
            return json_encode([
                "status" => "error",
                "message" => "All fields are required"
            ]);
        }

        // If content is invalid
        if ($this->invalidContent()) {
            return json_encode([
                "status" => "error",
                "message" => "Content must be at least 10 words long"
            ]);
        }

        // If all validations passed, insert into DB
        if ($this->setModule($this->course_id, $this->title, $this->content)) {
            return json_encode([
                "status" => "success",
                "message" => "Module created successfully"
            ]);
        } else {
            return json_encode([
                "status" => "error",
                "message" => "Database error: could not create module"
            ]);
        }
    }


} 


?>