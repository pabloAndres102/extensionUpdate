<?php
$response = erLhcoreClassChatEventDispatcher::getInstance()->dispatch('fbwhatsapp.analytics', array());
$fbOptions = erLhcoreClassModelChatConfig::fetch('fbmessenger_options');
$data = (array)$fbOptions->data;
$tpl = erLhcoreClassTemplate::getInstance('lhfbwhatsapp/analytics.tpl.php');


$instance = \LiveHelperChatExtension\fbmessenger\providers\FBMessengerWhatsAppLiveHelperChat::getInstance();
$phones = $instance->getPhones();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {



$curl = curl_init();

$start = $_POST['start'];
$end = $_POST['end'];
$start = strtotime($start);
$end = strtotime($end);
$phone_number = $_POST['phone_number'];
$granularity = $_POST['granularity'];
$phone_number = str_replace([' ', '+'], '', $phone_number);

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://graph.facebook.com/v18.0/'.$data['whatsapp_business_account_id'].'?fields=conversation_analytics.start('.$start.').end('.$end.').granularity('.$granularity.').phone_numbers(['.$phone_number.']).dimensions([%22CONVERSATION_CATEGORY%22%2C%22CONVERSATION_TYPE%22%2C%22COUNTRY%22%2C%22PHONE%22])%0A',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$data['whatsapp_access_token']
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$json_response = json_decode($response,true);

$tpl->set('data',$json_response);

}

$tpl->set('phones',$phones);

$Result['content'] = $tpl->fetch();
$Result['path'] = array(
    array(
        'url' => erLhcoreClassDesign::baseurl('fbmessenger/index'),
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Facebook chat')
    ),
    array(
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Analytics')
    ),
);
