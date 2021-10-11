<?php

ob_start();
$action = $_GET['action'];

include 'admin_class.php';
$crud = new Action();
$output = "";
$litmit = 10;
$start = 0;
$page;
if(!empty($_GET['page'])){
    $start = $start + ($_GET['page'] * $litmit) - $litmit;
}

if($action == 'list-category'){
    $lists = $crud->listCate($start,$litmit);
    $output.= lists_category($lists,$start);
    echo $_GET['page'];
    echo $output;
}

if($action == 'add-edit-category'){
    $activity = $crud->addEditCate();
    echo $activity;
}

if($action == "delete"){
    $activity = $crud->deleteCate();
    echo $activity;
}

if($action == "detail"){
    $detail = $crud->detailCate();
    $output .= '<div> '. $detail["name"] . ' </div>';
    if($detail['parent_id'] != 0){
        $output .= '<div>Parent Category :</div>';
        $detailParent = $crud->detailParent($detail['parent_id']);
        $output .= '<div>" '. $detailParent["name"] . ' "</div>';
    }
    echo $output;
}

if($action=='show_edit'){
    $cate = $crud->showEdit();
    $output = $cate['id'] . '/' . $cate['name'] . '/' . $cate['parent_id'] ;
    print_r($output);
}

if($action == 'pagination'){
    $page = $_GET['page'];
    $pagination = $crud->getAllPage();
    if($page == 1){
        $output .= '<li class="page-item disabled">';
        $output .= ' <a class="page-link" >Previous</a>';
    }else {
        $output .= '<li class="page-item">';
        $output .= ' <a class="page-link" onclick="show_list('. $page - 1 . ')">Previous</a>';
    }
    $output .= '</li>';
    for($i=1 ; $i < $pagination + 1  ; $i ++){
        if($i == $page){
            $output .= '<li class="page-item active"><a class="page-link btn" >'. $i .'</a></li>';
        }
        else {
            $output .= '
            <li class="page-item"><a class="page-link btn " onclick="show_list('. $i . ')">'. $i .'</a></li>
            ';
        }
    }
    if($page >= $pagination){
        $output .= '<li class="page-item disabled">';
        $output .= ' <a class="page-link" >Previous</a>';
    }else {
        $output .= '<li class="page-item">';
        $output .= ' <a class="page-link" onclick="show_list('. $page + 1 . ')">Previous</a>';
    }
    echo $output;
}

if($action == "search-category"){
    $lists = $crud->searchCategory();
    if($lists != ""){
        $output.= lists_category($lists,0);
        echo $output;
    }
}

if($action == "show-parent"){
    $parent_id = $_GET['parent-id'];
    $cate_id = $_GET['cate-id'];
    if($parent_id == 0){
        $output .= '<option value="0" selected >None</option>';
    }
    $lists = $crud->showAllParent();
    foreach($lists as $value){
        if($value['id'] == $parent_id){
            $output .= '<option value="'. $value['id'] .'" selected>'. $value['name'] .'</option>';
        }
        else if($value['id']== $cate_id){
            continue;
        }
        else {
            $output .= '<option value="'. $value['id'] .'" >'. $value['name'] .'</option>';
        }
    }
    echo $output;
}

function lists_category($lists,$start){
    $output = "";
    $start++;
    $node = 0 ;
    foreach($lists as $value){
        if($value['parent_id'] == 0){
            $output .= '<tr>
            <th scope="row">'. $start .'</th>
            <td>'. $value['name'] .'</td>
            ';
        }else if($value['parent_id'] == $node){ // nếu parent_id = id cha 
            $output .= '<tr>
            <th scope="row">'. $start .'</th>
            <td class="pl-5">|___'. $value['name'] .'</td>
            ';
        }
        else{// trường hợp 1 child
            $output .= '<tr>
            <th scope="row">'. $start .'</th>
            <td class="pl-4">|___'. $value['name'] .'</td>
            ';
            $node = $value['id'];
        }
        $output.= '<td>
        <button class="btn btn-primary" onclick="return editCate('. $value['id'] . ')" data-toggle="modal" data-target="#add">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        </button>
        <button class="btn btn-success" onclick=[copyCate('. $value['id'].',"' .$value['name'] . '")]><i class="fa fa-files-o" aria-hidden="true"></i></button>
        <button class="btn btn-danger btn-delete" onclick="return deleteCate('. $value['id'] . ')" ><i class="fa fa-trash-o" aria-hidden="true"></i></button>
        <button class="btn btn-info btn-detail" onclick="return detailCate('. $value['id'] . ')" ><i class="fa fa-info-circle" aria-hidden="true"></i></button>
        </td>
        </tr>' ;
        $start++;
    }
    return $output;
}