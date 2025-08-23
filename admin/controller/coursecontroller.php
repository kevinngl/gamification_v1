<?php

require "../../model/Course.php";

class CourseController extends Course
{
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

    private function invalidDesc()
    {
        return strlen(trim($this->description)) < 30;
    }

    private function emptyInput()
    {
        return !(empty($this->name) || empty($this->description));
    }

    public function img($image)
    {
        if (empty($image['name'])) {
            return null;
        }

        $uploadDir = '../../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Validate type
        $allowedTypes = ['jpeg', 'jpg', 'png', 'webp'];
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

    public function uploadMaterial($file)
    {
        if (empty($file['name'])) {
            return null; // No new material provided
        }

        $uploadDir = '../../Material/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
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

    private function formatYoutubeLink($url)
    {
        if (!$url) {
            return null;
        }

        $url = trim($url);

        // Case: normal watch URL
        if (strpos($url, "watch?v=") !== false) {
            $url = str_replace("watch?v=", "embed/", $url);
        }

        // Case: short youtu.be link
        if (strpos($url, "youtu.be/") !== false) {
            $parts = explode("youtu.be/", $url);
            if (isset($parts[1])) {
                $videoId = strtok($parts[1], "?"); // remove extra params
                $url = "https://www.youtube.com/embed/" . $videoId;
            }
        }

        return $url;
    }


    public function Create()
    {
        if (!$this->emptyInput()) {
            return json_encode(["message" => "Name and description are required", "status" => 400]);
        }
        if ($this->invalidDesc()) {
            return json_encode(["message" => "Description is too short (min 30 characters)", "status" => 400]);
        }

        $imgResult = $this->img($this->image);
        if (is_array($imgResult) && isset($imgResult['error'])) {
            return json_encode(["message" => $imgResult['error'], "status" => 400]);
        }

        $matResult = $this->uploadMaterial($this->material);
        if (is_array($matResult) && isset($matResult['error'])) {
            return json_encode(["message" => $matResult['error'], "status" => 400]);
        }

        $this->setCourse(
            $this->name,
            $this->description,
            $this->uniqimage ?? null,
            $this->formatYoutubeLink($this->link),
            $this->uniqmaterial ?? null,
            $this->coin,
            $this->challenge
        );

        return json_encode(["message" => "successful", "status" => 200]);
    }

    public function Update()
    {
        if (!$this->emptyInput()) {
            return json_encode(["message" => "Name and description are required", "status" => 400]);
        }
        if (!$this->invalidDesc()) {
            return json_encode(["message" => "Description is too short (min 30 characters)", "status" => 400]);
        }

        $imgResult = $this->img($this->image);
        if (is_array($imgResult) && isset($imgResult['error'])) {
            return json_encode(["message" => $imgResult['error'], "status" => 400]);
        }

        $matResult = $this->uploadMaterial($this->material);
        if (is_array($matResult) && isset($matResult['error'])) {
            return json_encode(["message" => $matResult['error'], "status" => 400]);
        }
        $challenge = isset($this->challenge) && $this->challenge === 'on' ? 1 : 0;

        $this->updateCourse(
            $this->id,
            $this->name,
            $this->description,
            $this->uniqimage ?? null,
            $this->formatYoutubeLink($this->link),
            $this->uniqmaterial ?? null,
            $this->coin,
            $challenge
        );

        return json_encode(["message" => "successful", "status" => 200]);
    }

    public function Course()
    {
        return $this->getCourse();
    }
}

?>
