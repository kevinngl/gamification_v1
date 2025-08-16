<?php
require_once "../../config/database.php";

class Quiz extends Database {
    protected function setQuiz($module_id, $course_id, $question, $optionA, $optionB, $optionC, $optionD, $answer) {
        $query = "INSERT INTO quiz (module_id, course_id, question, option_a, option_b, option_c, option_d, correct_answer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($query);
        
        if($stmt->execute([$module_id, $course_id, $question, $optionA, $optionB, $optionC, $optionD, $answer])) {
            return true;
        } else {
            error_log("SQL Error in setQuiz: " . implode(" ", $stmt->errorInfo()));
            throw new Exception("Quiz cannot be created. Check server logs for details.");
        }
    }

    public function getQuiz() {
        $sql = $this->connect()->prepare('SELECT * FROM quiz');
        if($sql->execute()) {
            return $sql;
        } else {
            return false;
        }
    }

    public function getQuizByCourseId($courseId) {
        $query = "SELECT * FROM quiz WHERE course_id = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletequiz($courseId) {
        $sql = "DELETE FROM quiz WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        // Parameter fungsi adalah $courseId, jadi gunakan itu
        $stmt->bindParam(1, $courseId); 
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>