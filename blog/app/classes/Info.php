<?php
namespace App\classes;
use App\classes\Database;
class Info
{
    public function saveAllBlogInfo($data) {

        $fileName = $_FILES['blog_image']['name'];
        $directory = '../assets/images/';
        $imageUrl = $directory.$fileName;

        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $check = getimagesize($_FILES['blog_image']['tmp_name']);

        if($check) {
            if(file_exists($imageUrl)) {
                die('This file already exist.Please select another one.Thanks');
            }else {
                if($_FILES['blog_image']['size'] > 90000000) {
                    die('Your file size is too large. Please select within 90kb');
                }else {
                    if($fileType !='JPG' && $fileType !='jpg' && $fileType != 'png') {
                        die('Image type is not supported. Please select jpg or png. Thanks !');
                    }else {
                        move_uploaded_file($_FILES['blog_image']['tmp_name'], $imageUrl);

                        $sql = "INSERT INTO blog_infos (category_id, blog_title, short_description, long_description, blog_image, status) VALUES ('$data[category_id]', '$data[blog_title]', '$data[short_description]', '$data[long_description]', '$imageUrl', '$data[status]') ";
                        if(mysqli_query(Database::dbConnection(), $sql)) {
                            $message = "Blog Info Saved Successfully";
                            return $message;
                        }else {
                            die('Query Problem'.mysqli_error(Database::dbConnection()));
                        }

                    }
                }
            }
        }else {
            die('Please choose an image file. Thanks !');
        }
    }
    public function getAllBlogInfo() {
        $sql = "SELECT * FROM blog_infos";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        }else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }
    public function getBlogInfoById($id) {
        $sql = "SELECT * FROM blog_infos WHERE id = '$id' ";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        }else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function updateBlogInfoBy($data) {
        $sql = "UPDATE blog_infos SET category_name = '$data[category_name]', blog_title = '$data[blog_title]', short_description = '$data[short_description]', long_description = '$data[long_description]', blog_image = '$data[blog_image]', status = '$data[status]' WHERE id = '$data[id]' ";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            header('Location: manage-blog.php');
        }else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }
    public function deleteBlogInfoById($id) {
        $sql = "DELETE FROM blog_infos WHERE id = '$id' ";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            $message = "Blog Info Deleted Successfully";
            return $message;
        }else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }

    public function getAllPublishedCategoryInfo() {
        $sql = "SELECT * FROM categories WHERE status = 'Published' ";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        }else {
            die('Query Problem'.mysqli_error(Database::dbConnection()));
        }
    }
}