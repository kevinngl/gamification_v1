<?php

require_once "../../config/database.php";

class Module extends Database
{
    // Insert new module
    protected function setModule($course_id, $title, $content)
    {
        $sql = $this->connect()->prepare("
            INSERT INTO module (course_id, name, description) 
            VALUES (?, ?, ?)
        ");

        if ($sql->execute([$course_id, $title, $content])) {
            return true;
        } else {
            throw new Exception("Module cannot be created");
        }
    }

    // Get modules for a course + course details
    public function CModule($courseId)
    {
        $sql = $this->connect()->prepare("
            SELECT 
                m.module_id,
                m.course_id,
                m.name AS module_name,
                m.description AS module_description,
                c.name AS course_name,
                c.description AS course_description,
                c.image AS poster,
                c.created_at AS posted,
                c.link,
                c.material
            FROM module m
            LEFT JOIN course c ON m.course_id = c.course_id
            WHERE m.course_id = ?
            ORDER BY m.module_id ASC
        ");

        if ($sql->execute([$courseId])) {
            return $sql;
        } else {
            error_log("SQL Error in CModule: " . implode(" ", $sql->errorInfo()));
            throw new Exception("Error Processing Request: SQL execution failed. Check server logs.", 1);
        }
    }

    // Get all modules
    public function getModule()
    {
        $sql = $this->connect()->prepare('SELECT * FROM module');
        $sql->execute();
        return $sql;
    }

    // Delete a module
    public function deletemodule($moduleId)
    {
        $sql = "DELETE FROM module WHERE module_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $moduleId);

        return $stmt->execute();
    }
}
