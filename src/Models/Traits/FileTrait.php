<?php

namespace Models\Traits;
require_once '../vendor/autoload.php';


// This trait is used to handle files uploading to the server. 

trait FileTrait{

    protected $base_doc_path = "../images"; // This is the directory, where the images directories will be located.
    protected  $mid_doc_path; // This is a folder, where the files of each category will be located.
    protected  $all_doc_path =""; // This is the full filepath.

    public function setMid($mid){
    	$this->mid_doc_path = $mid;
    }

    public function getMid(){
    	return $this->mid_doc_path;
    }


    public function file_handling($personId){

        // The received file extension will be set to PNG. 

        if (isset($_FILES['image'])) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $uploadFileDir = $this->base_doc_path . "/" . $this->mid_doc_path;
            $newFileName = $uploadFileDir . "/" . $personId . ".png"; // Assuming PNG format
    
            // The uploaded file will be moved to the matching directory
            if(move_uploaded_file($fileTmpPath, $newFileName)) {
                // Resize the image
                $this->resizing($newFileName);
    
                return $newFileName; // If the function works as expected, the new filename will be returned.
            } else {
                return false; // If not, false will be returned.
            }
        } else {
            echo "No file uploaded.";
            return false; // If a file isn't uploaded, false will be returned.
        }
    }
    public function resizing($file){
        try {

            // The MIME type of the file is received.

            $image_info = getimagesize($file);
            $mime_type = $image_info['mime'];
    
            // If the type is image/jpeg, it will be loaded as JPEG.

            if ($mime_type == "image/jpeg" && function_exists('imagecreatefromjpeg')) {
                $sourceImage = imagecreatefromjpeg($file);
            }

            // If not, it will be loaded as PNG.

            elseif ($mime_type == "image/png" && function_exists('imagecreatefrompng')) {
                $sourceImage = imagecreatefrompng($file);
            }
            else {
                echo "Unsupported image format or GD library not available.";
                return; // If the format isn't supported or GD library isn't available, exit the function.
            }
    
            // Get data about the width and height of the image
            $sourceWidth = imagesx($sourceImage);
            $sourceHeight = imagesy($sourceImage);
            
            // Set width and height to new values.
            $targetWidth = 512;
            $targetHeight = 512;
            
            // Create a new image of the mentioned dimensions.
            $resizedImage = imagecreatetruecolor($targetWidth, $targetHeight);
            
            // Resize the original image to match these new dimensions.
            imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $sourceWidth, $sourceHeight);
    
            // Save the resized image to the mentioned path.
            if ($mime_type == "image/jpeg" && function_exists('imagejpeg')) {
                imagejpeg($resizedImage, $file);
            } elseif ($mime_type == "image/png" && function_exists('imagepng')) {
                imagepng($resizedImage, $file); // Save as PNG if the original image was PNG
            }
            
            // Destroy the images.
            imagedestroy($sourceImage);
            imagedestroy($resizedImage);
            
            echo "Image resized successfully.";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }    

}
?>
