<?php

function handle_msg($name, $email, $msg, $subject) { 
    require_once('../config.php');
    $tg_token = $config['bot_token']; 
    $tg_chat_id = $config['user_id']; 
    $tg_base_url = 'https://api.telegram.org/bot' . $tg_token . '/sendMessage'; 
    $msg = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage: $msg"; 
    $query = 'chat_id=' . $tg_chat_id . '&text=' . urlencode($msg) . '&parse_mode=Markdown'; 
    $tg_url = $tg_base_url . '?' . $query; 
    $response = file_get_contents($tg_url); 
    $data = json_decode($response); 
    if ($data->ok) { 
        return ['ok' => true, 'msg' => 'Message sent successfully!']; 
    } else { 
        return ['ok' => false, 'msg' => 'Server error!'];
    }
}


if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    
    $result = handle_msg($name, $email, $message, $subject);
    print_r(json_encode($result));
}