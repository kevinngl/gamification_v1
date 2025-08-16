<?php 

require "../../model/Course.php";
class CourseController extends Course{
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

    public $result;


    private function title(){
       
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->name)){
            $this->result = false;
        }else{
            $this->result = true;
        }

        return $this->result;
    }
  
    
    private function invalidDesc() {
        $this->result = true; // Reset to true at the beginning
        if (str_word_count($this->description) < 10) {
            $this->result = false;
        }
        return $this->result;
    }
    
    private function emptyInput() {
        $this->result = true; // Reset to true at the beginning
        if (empty($this->name) || empty($this->description) || empty($this->image)) {
            $this->result = false;
        }
        return $this->result;
    }

    public function img($image){
        // Decode base64-encoded image data
  
       

           //upload directory
           $uploadDir = '../../uploads/'; 
           if (!file_exists($uploadDir)) {
               mkdir($uploadDir,0777);
           }else{
            $imageName = $image['name'];
                
                $imageTmpName = $image['tmp_name'];
                $imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

                // Generate a unique filename
                $this->uniqimage = uniqid('image_') . '.' . $imageType;

                // Check if the file type is allowed
                $allowedTypes = ['jpeg', 'jpg', 'png','webp'];
                if (!in_array($imageType, $allowedTypes)) {
                    die("Only JPEG, JPG, and PNG files are allowed.");
                }

                // Move the uploaded file to a server directory with the unique filename
               
                $targetPath = $uploadDir . $this->uniqimage;
                if (move_uploaded_file($imageTmpName, $targetPath)){
                    return true;
                }else{
                    return false;
                }


           }   
    }

    public function uploadMaterial($file)
{
    // Upload directory
    $uploadDir = '../../Material/';

    // Check if the directory exists, and create it if not
    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
        die("Failed to create the upload directory.");
    }

    // Get file information
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Generate a unique filename
    $this->uniqmaterial = uniqid('gam_') . '.' . $fileType;

    // Check if the file type is allowed
    $allowedTypes = ['pdf', 'docx', 'doc', 'txt', 'zip', 'rar', 'md', 'ppt', 'pptx', 'odp'];
    if (!in_array($fileType, $allowedTypes)) {
        die("Only PDF, DOCX, DOC, TXT, ZIP, RAR, MD, PPT, and PowerPoint files are allowed.");
    }

    // Move the uploaded file to the server directory with the unique filename
    $targetPath = $uploadDir . $this->uniqmaterial;

    // Check for errors during the upload
    if (move_uploaded_file($fileTmpName, $targetPath)) {
        return true; // Successful upload
    } else {
        $uploadError = $file['error'];
        switch ($uploadError) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                die("The uploaded file exceeds the maximum file size limit.");
            case UPLOAD_ERR_PARTIAL:
                die("The file was only partially uploaded.");
            case UPLOAD_ERR_NO_FILE:
                die("No file was uploaded.");
            case UPLOAD_ERR_NO_TMP_DIR:
                die("Missing temporary folder.");
            case UPLOAD_ERR_CANT_WRITE:
                die("Failed to write the file to disk.");
            case UPLOAD_ERR_EXTENSION:
                die("A PHP extension stopped the file upload.");
            default:
                die("Unknown upload error.");
        }
    }
}

    public function Create(){
        if(!$this->emptyInput()|| !$this->invalidDesc() ){
            return json_encode(["message" => "incorrect field input"]);
        }
       else{
             
                if($this->img($this->image)){
                    $this->uploadMaterial($this->material);
                    $this->setCourse($this->name,$this->description,$this->uniqimage,$this->link,$this->uniqmaterial,$this->coin,$this->challenge);
                    return json_encode(["message"=>"successful","status"=>200]);
                }else{
                    return json_encode(["message"=>"failed uploading image","status"=>503]);
                }
               
        
    }
}
public function Update(){
    if(!$this->emptyInput() || !$this->invalidDesc() ){
        return json_encode(["message" => "incorrect field input"]);
    }
   else{
         
            if($this->img($this->image)){
                $this->uploadMaterial($this->material);
                $this->updateCourse($this->id,$this->name,$this->description,$this->uniqimage,$this->link,$this->uniqmaterial,$this->coin,$this->challenge);
                return json_encode(["message"=>"successful","status"=>200]);
            }else{
                return json_encode(["message"=>"failed uploading image","status"=>503]);
            }
           
    
}
}
    public function Course(){
     return   $this->getCourse();
    }
}




?>