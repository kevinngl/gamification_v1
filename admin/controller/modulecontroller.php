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
       
        if(str_word_count($this->content) < 10){
            
            $this->result = false;
        }else{
            $this->result = true;
        }

        return $this->result;
    }

   
    
    

    //insert

    public function Create(){
        $this->clean();
        if(!$this->emptyInput()|| !$this->invalidContent() ){
            return json_encode(["message" => "incorrect field input"]);
        }
       else{
             
        $this->setModule($this->course_id,$this->title,$this->content);
        return json_encode(["message"=>"successful","status"=>200]);

               
        
    }
}
    
    

} 


?>