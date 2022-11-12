<?php

function handle_msg($name, $email, $msg, $subject) { 
    $config = json_decode(file_get_contents('../config.json'));
    $tg_token = $config->bot_token; 
    $tg_chat_id = $config->tg_user_id; 
    $tg_base_url = 'https://api.telegram.org/bot' . $tg_token . '/sendMessage'; 
    $msg = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage: $msg"; 
    $query = 'chat_id=' . $tg_chat_id . '&text=' . urlencode($msg) . '&parse_mode=Markdown'; 
    $tg_url = $tg_base_url . '?' . $query; 
    $response = file_get_contents($tg_url); 
    return json_decode($response); 
}


if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    
    $result = handle_msg($name, $email, $message, $subject);
    print_r(json_encode($result));
}