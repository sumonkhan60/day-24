<?php
namespace App\classes;
use App\classes\Database;
class Category
{
    public function saveAllCategoryInfo($data) {
        $sql = "INSERT INTO categories (category_name, category_description, status) VALUES ('$data[category_name]', '$data[category_description]', '$data[status]') ";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            $message = "Category Info Saved Successfully";
            return $message;
        }else {
            die("Query Problem".mysqli_error(Database::dbConnection()));
        }
    }
    public function getAllCategoryInfo() {
        $sql = "SELECT * FROM categories";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        } else {
            die("Query Problem".mysqli_error(Database::dbConnection()));
        }
    }
    public function getCategoryInfoById($id) {
        $sql = "SELECT * FROM categories WHERE id = '$id' ";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        } else {
            die("Query Problem".mysqli_error(Database::dbConnection()));
        }
    }
    public function updateCategoryInfoById($data) {
        $sql = "UPDATE categories SET category_name = '$data[category_name]', category_description = '$data[category_description]', status = '$data[status]' WHERE id = '$data[category_id]' ";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            header('Location: manage-category.php');
        }else {
            die('Query problem'.mysqli_error(Database::dbConnection()));
        }
    }
    public function deleteCategoryInfoById($id) {
        $sql = "DELETE FROM categories WHERE id = '$id' ";
        if(mysqli_query(Database::dbConnection(), $sql)) {
            $message = "Category Info delete Successfully";
            return $message;
        }else {
            die("Query Problem".mysqli_error(Database::dbConnection()));
        }
    }
}