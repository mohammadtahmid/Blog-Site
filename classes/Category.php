<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/../lib/Database.php';
include_once $filepath.'/../helpers/Format.php';

class Category
{
    public $db;
    public $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function AddCategory($catName)
    {
        $catName = $this->fr->validation($catName);

        if (empty($catName)) {
            $error = "Category Name Field Must Not Be Empty";
            return $error;
        } else {

            $select_query = "SELECT * FROM tbl_category WHERE catName = '$catName'";
            $select_result = $this->db->select($select_query);

            if ($select_result) {
                $error = 'This Category Name already exists';
                return $error;
            } else {

                $insert_query = "INSERT INTO tbl_category(catName) VALUES ('$catName')";
                $insert_result = $this->db->insert($insert_query);

                if ($insert_result) {
                    $success = "Category Inserted Successfully";
                    return $success;
                } else {
                    $error = "Something went wrong. Category is not added.";
                    return $error;
                }
            }
        }
    }


    //Select all category 
    public function AllCategory()
    {
        $select_cat = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $all_cat = $this->db->select($select_cat);
        if ($all_cat != false) {
            return $all_cat;
        } else {
            return false;
        }
    }

    //Edit Cat Data
    public function getEditCat($id)
    {
        $edit_data = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $edit_result = $this->db->select($edit_data);
        return $edit_result;
    }

    //Update Category
    public function UpdateCategory($catName, $id)
    {
        $catName = $this->fr->validation($catName);

        if (empty($catName)) {
            $error = "Category Name Field Must Not Be Empty";
            return $error;
        } else {

            $select_query = "SELECT * FROM tbl_category WHERE catName = '$catName'";
            $select_result = $this->db->select($select_query);

            if ($select_result) {
                $error = 'This Category Name already exists';
                return $error;
            } else {

                $update_query = "UPDATE tbl_category SET catName= '$catName' WHERE catId= '$id'";
                $update_result = $this->db->insert($update_query);

                if ($update_result) {
                    $success = "Category Update Successfully";
                    header('location:categorylist.php');
                    return $success;

                } else {
                    $error = "Something went wrong. Category is not Update.";
                    return $error;
                }
            }
        }
    }

    public function ForUserId(){
        //$gp = "SELECT tbl_post.*, tbl_category.catName, tbl_user.userId FROM tbl_post INNER JOIN tbl_category ON tbl_post.catId = tbl_category.catId INNER JOIN tbl_user ON tbl_post.userId = tbl_user.userId WHERE tbl_user.userId = '$id'";
        $gp = "SELECT * FROM tbl_user";
        $gr = $this->db->select($gp);
        return $gr;
    }


    //Delete Category
    public function DeleteCategory($id)
    {
        $delete_query = "DELETE FROM tbl_category WHERE catId= '$id'";
        $delete_result = $this->db->delete($delete_query);

        if ($delete_result) {
            $success = "Category deleted Successfully";
            return $success;
        } else {
            $error = "Something is Wrong category is not Delete.";
            return $error;
        }
    }

    //Category name for select cat
    public function catName($id){
        $cat_id = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $c_result = $this->db->select($cat_id);
        return $c_result;
    }

    //Index page totla Categtories
    public function totalCategories(){
        $total_que = "SELECT * FROM tbl_category";
        $total_category = $this->db->select($total_que);
        return $total_category;
    }


}

?>