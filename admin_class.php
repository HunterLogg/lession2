<?php
session_start();
ini_set('display_errors', 1);

class Action
{
    private $db_handle; 
    private $page;
    private $count = 0;

    public function __construct() {
		ob_start();
        
    include "DBController.php";
    $this->db_handle = new DBController;
	}

    function __destruct() {
	    $this->db_handle->close();
	    ob_end_flush();
	}
    
  function addEditCate(){
    if(!empty($_POST['cate_id'])){
      $cate_id = $_POST['cate_id'];
    }
    $name = $_POST['name'];
    $parent = $_POST['parent'];
    $action = $_POST['action'];
    $check = $this->db_handle->numRows("SELECT * FROM category WHERE name = '$name'");
    if($action == 'add'){
      if($check > 0){
        return "Insert fail! Please change name.";
      }else 
      $this->db_handle->insert("Insert into category (name,parent_id) values('$name',$parent)");
    }else {
      $same_name = $this->db_handle->numRows("SELECT * FROM category WHERE id != $cate_id and name = '$name'");
      if($same_name > 0 ){
        return "Edit fail! Please change name.";
      }else {
        $this->db_handle->update("UPDATE category SET name ='$name', parent_id = $parent WHERE id = $cate_id");
      }
    }
  }

  function deleteCate(){
    extract($_POST);
    $this->db_handle->update("DELETE FROM category WHERE id= $cate_id or parent_id = $cate_id");
    return $cate_id;
  }

  function detailCate(){
    extract($_POST);
    return $this->db_handle->runQuery("SELECT * FROM category WHERE id = $cate_id")[0];
  }

  function detailParent($cate_id){
    return $this->db_handle->runQuery("SELECT * FROM category WHERE id = $cate_id")[0];
  }

  function showEdit(){
    extract($_POST);
    return $this->db_handle->runQuery("SELECT * FROM category WHERE id = $cate_id")[0];
  }

  function listCate($start,$limit){
    extract($_POST);
    $list_category = $this->db_handle->runQuery("SELECT DISTINCT(c1.id),c1.name,c1.parent_id,CASE 
    when c2.id is NULL THEN c1.id * 10 WHEN EXISTS (SELECT * FROM `category` 
    WHERE id= c2.id and parent_id != 0 )THEN c2.id/10 + c2.parent_id* 10 + 0.01 ELSE c1.id/10 + c2.id * 10 end as child_id 
    FROM `category` as c1 LEFT JOIN `category` as c2 on c1.parent_id = c2.id 
    ORDER BY child_id
    LIMIT $start, $limit");
    return $list_category;
   
  }
  
  function getAllPage(){
    $pagination = $this->db_handle->numRows("SELECT * FROM category");
    $this->page = $pagination / 10;
    return $this->page;
  }

  function searchCategory(){
    extract($_POST);
    $search = $this->db_handle->runQuery("SELECT DISTINCT(c1.id),c1.name,c1.parent_id,CASE when c2.id is NULL THEN c1.id * 10 
    WHEN EXISTS (SELECT * FROM `category` WHERE id= c2.id and parent_id != 0 )THEN c2.id/10 + c2.parent_id* 10 + 0.01 ELSE c1.id/10 + c2.id * 10 end as child_id 
    FROM `category` as c1 LEFT JOIN `category` as c2 on c1.parent_id = c2.id 
    WHERE c1.name like '%$search%'
    ORDER BY child_id
    LIMIT 0,10");
    return $search;
  }

  function showAllParent(){
    return $this->db_handle->runQuery("SELECT * FROM category");
  }

  

}