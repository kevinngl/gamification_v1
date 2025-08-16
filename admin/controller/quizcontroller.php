<?php

require_once "../../model/Quiz.php";
class QuizController extends Quiz{
    public $question;
    public $course_id;
    public $option_a;
    public $option_b;
    public $option_c;

    public $option_d;
    public $answer;
    

    public $result;

    private function emptyInput(){
        
        if(empty($this->question) || empty ($this->course_id) || empty ($this->option_a) || empty ($this->option_b) || empty ($this->option_c) || empty ($this->option_d) || empty ($this->answer)){

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

        // ✅ Check existing question count for this course
        $count = $this->countQuestionsByCourse($this->course_id);
        if ($count >= 10) {
            return json_encode([
                "message" => "Maximum 10 questions allowed for this course.",
                "status" => 403
            ]);
        }

        // Proceed with insert
        if($this->setQuiz($foundModuleId, $this->course_id, $this->question, $this->option_a, $this->option_b, $this->option_c, $this->option_d, $this->answer)){
            return json_encode(["message"=>"successful","status"=>201]);
        } else {
            return json_encode(["message"=>"error","status"=>401]);
        }
    }

    private function countQuestionsByCourse($course_id) {
        $sql = "SELECT COUNT(*) as total FROM quiz WHERE course_id = :course_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $result['total'];
    }



}
?>