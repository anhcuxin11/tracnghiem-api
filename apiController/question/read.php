<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/question.php');

$db = new db();
$connect = $db->connect();

$question = new Question($connect);
$read = $question->read();

$num = $read->rowCount();

if($num>0){
    $question_array =[];
    $question_array['data'] =[];

    while($row = $read->fetch(PDO:: FETCH_ASSOC)){
        extract($row);

        $question_item = array(
            'id_cauhoi' => $id,
            'title' => $title,
            'cau_a' => $a,
            'cau_b' => $b,
            'cau_c' => $c,
            'cau_d' => $d,
            'ketqua' => $result
        );
        array_push($question_array['data'],$question_item);
    }
    echo json_encode($question_array);
}

?>