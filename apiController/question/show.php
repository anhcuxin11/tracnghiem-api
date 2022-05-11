<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    
    include_once('../../config/db.php');
    include_once('../../model/question.php');
    
    $db = new db();
    $connect = $db->connect();
    
    $question = new Question($connect);
    $question->id = isset($_GET['id']) ? $_GET['id'] : die();
    
    $question->show();

    $question_item = array(
        'id_cauhoi' => $question->id,
        'title' => $question->title,
        'cau_a' => $question->a,
        'cau_b' => $question->b,
        'cau_c' => $question->c,
        'cau_d' => $question->d,
        'ketqua' => $question->result
    );
    print_r(json_encode($question_item));
?>