<?php

require_once "../../model/Quiz.php";
class QuizController extends Quiz{
    public $question;
    public $course_id;
    public $optionA;
    public $optionB;
    public $optionC;

    public $optionD;
    public $answer;
    

    public $result;

    private function emptyInput(){
        
        if(empty($this->question) || empty ($this->course_id) || empty ($this->optionA) || empty ($this->optionB) || empty ($this->optionC) || empty ($this->optionD) || empty ($this->answer)){

            $this->result = false;
        }else{
            $this->result = true;
        }

        return $this->result;
    }

    private function getModuleByIdCourse($course_id){
        $con = $this->connect();
        $query = "SELECT module_id FROM module WHERE course_id = ?";
        $stmt = $con->prepare($query);
        $stmt->execute([$course_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int) $result['module_id'] : 0;
    }

    public function Create(){
        if(!$this->emptyInput()){ 
            return json_encode(["message"=>"empty fields","status"=>400]); 
        }

        $foundModuleId = $this->getModuleByIdCourse($this->course_id);

        if ($foundModuleId === 0) {
            return json_encode(["message"=>"Module not found for the selected course.","status"=>400]);
        }

        if($this->setQuiz($foundModuleId, $this->course_id, $this->question, $this->optionA, $this->optionB, $this->optionC, $this->optionD, $this->answer)){
            return json_encode(["message"=>"successful","status"=>201]);
        }else{
            return json_encode(["message"=>"error","status"=>401]);
        }
    }
}
?>