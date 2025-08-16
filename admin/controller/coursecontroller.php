<?php

require "../../model/Course.php";

class CourseController extends Course {
    public $name;
    public $description;
    public $image;
    public $link;
    public $material;
    public $coin;
    public $challenge;
    public $uniqimage;
    public $uniqmaterial;
    public $id;

    private function invalidDesc() {
        return strlen(trim($this->description)) >= 30; // at least 30 characters
    }

    private function emptyInput() {
        return !(empty($this->name) || empty($this->description));
    }

    public function img($image) {
        if (empty($image['name'])) {
            return null; // No new image provided
        }

        $uploadDir = '../../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir,0777,true);
        }

        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Validate type
        $allowedTypes = ['jpeg', 'jpg', 'png','webp'];
        if (!in_array($imageType, $allowedTypes)) {
            return ["error" => "Only JPEG, JPG, PNG, and WEBP files are allowed."];
        }

        // Validate size (8MB)
        if ($image['size'] > 8 * 1024 * 1024) {
            return ["error" => "Image too large! Max size is 8 MB."];
        }

        // Generate unique filename
        $this->uniqimage = bin2hex(random_bytes(8)) . '.' . $imageType;
        $targetPath = $uploadDir . $this->uniqimage;

        if (move_uploaded_file($imageTmpName, $targetPath)) {
            return true;
        }
        return ["error" => "Failed to upload image."];
    }

    public function uploadMaterial($file) {
        if (empty($file['name'])) {
            return null; // No new material provided
        }

        $uploadDir = '../../Material/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir,0777,true);
        }

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedTypes = ['pdf', 'docx', 'doc', 'txt', 'zip', 'rar', 'md', 'ppt', 'pptx', 'odp'];
        if (!in_array($fileType, $allowedTypes)) {
            return ["error" => "Invalid material file type."];
        }

        if ($file['size'] > 8 * 1024 * 1024) {
            return ["error" => "Material file too large! Max size is 8 MB."];
        }

        $this->uniqmaterial = bin2hex(random_bytes(8)) . '.' . $fileType;
        $targetPath = $uploadDir . $this->uniqmaterial;

        if (move_uploaded_file($fileTmpName, $targetPath)) {
            return true;
        }
        return ["error" => "Failed to upload material."];
    }

    public function Create() {
        if (!$this->emptyInput()) {
            return json_encode(["message" => "Name and description are required", "status"=>400]);
        }
        if (!$this->invalidDesc()) {
            return json_encode(["message" => "Description is too short (min 30 characters)", "status"=>400]);
        }

        $imgResult = $this->img($this->image);
        if (is_array($imgResult) && isset($imgResult['error'])) {
            return json_encode(["message"=>$imgResult['error'], "status"=>400]);
        }

        $matResult = $this->uploadMaterial($this->material);
        if (is_array($matResult) && isset($matResult['error'])) {
            return json_encode(["message"=>$matResult['error'], "status"=>400]);
        }

        $this->setCourse(
            $this->name,
            $this->description,
            $this->uniqimage ?? null,
            $this->link,
            $this->uniqmaterial ?? null,
            $this->coin,
            $this->challenge
        );

        return json_encode(["message"=>"successful","status"=>200]);
    }

    public function Update() {
        if (!$this->emptyInput()) {
            return json_encode(["message" => "Name and description are required", "status"=>400]);
        }
        if (!$this->invalidDesc()) {
            return json_encode(["message" => "Description is too short (min 30 characters)", "status"=>400]);
        }

        $imgResult = $this->img($this->image);
        if (is_array($imgResult) && isset($imgResult['error'])) {
            return json_encode(["message"=>$imgResult['error'], "status"=>400]);
        }

        $matResult = $this->uploadMaterial($this->material);
        if (is_array($matResult) && isset($matResult['error'])) {
            return json_encode(["message"=>$matResult['error'], "status"=>400]);
        }

        $this->updateCourse(
            $this->id,
            $this->name,
            $this->description,
            $this->uniqimage ?? null,
            $this->link,
            $this->uniqmaterial ?? null,
            $this->coin,
            $this->challenge
        );

        return json_encode(["message"=>"successful","status"=>200]);
    }

    public function Course() {
        return $this->getCourse();
    }
}
?>
