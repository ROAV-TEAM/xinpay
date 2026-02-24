<?php
$botToken = "7969107308:AAEkeeIJr5JBJQm5CtIcwho-CQ1iN7q2EZk";
$chatIds = ["8007853332", "7996892481", "8300832423"]; 

$data = json_decode(file_get_contents("php://input"), true);
$message = $data['message'] ?? '';

if ($message) {
    foreach($chatIds as $chatId) {
        $url = "https://api.telegram.org/bot$botToken/sendMessage";
        
        $postFields = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML'
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $postFields
        ]);
        
        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);
        
        
        //file_put_contents('telegram_log.txt', 
         //   "Chat ID: $chatId\nResponse: $response\nError: $curlError\n\n", 
          //  FILE_APPEND);
    }
}
?>