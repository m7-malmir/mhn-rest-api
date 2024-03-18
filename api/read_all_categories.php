<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initialize our api
include_once('../core/initialize.php');

//instantiate 
$post=new Category($db);

//blog post query
$result =$post->read();
//get row count
$num=$result->rowCount();

if($num > 0){
    $post_arr=array();
    $post_arr['data']=array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item=array(
            'id'=>$id,
            'name'=>$name,
            'created_at'=>$created_at
        );
        array_push($post_arr['data'],$post_item);
    }
    //convert to json output
    echo json_encode($post_arr);

    }else{
        echo json_encode(array('message'=>'no category found'));
    }
