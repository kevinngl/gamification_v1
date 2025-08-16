<?php
require_once "../../config/database.php";

class Quiz extends Database {
    protected function setQuiz($module_id, $course_id, $question, $option_a, $option_b, $option_c, $option_d, $answer) {
        $query = "INSERT INTO quiz (module_id, course_id, question, option_a, option_b, option_c, option_d, answer) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($query);

        if ($stmt->execute([$module_id, $course_id, $question, $option_a, $option_b, $option_c, $option_d, $answer])) {
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

    public function countQuizByCourseId($courseId) {
        $query = "SELECT COUNT(*) AS total FROM quiz WHERE course_id = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$courseId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function deletequiz($quizId) {
        try {
            $sql = "DELETE FROM quiz WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(1, $quizId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Delete quiz failed: " . $e->getMessage());
            return false;
        }
    }

}
?>