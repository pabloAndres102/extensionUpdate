<?php


$tpl = erLhcoreClassTemplate::getInstance('lhfbmessenger/index.tpl.php');
$fbOptions = erLhcoreClassModelChatConfig::fetch('fbmessenger_options');
$data = (array)$fbOptions->data;
$token = $data['whatsapp_access_token'];
$wbai = $data['whatsapp_business_account_id'];


$instance = \LiveHelperChatExtension\fbmessenger\providers\FBMessengerWhatsAppLiveHelperChat::getInstance();
$templates = $instance->getTemplates();
$excludedTemplates = array(
    'sample_purchase_feedback',
    'sample_issue_resolution',
    'sample_flight_confirmation',
    'sample_shipping_confirmation',
    'sample_happy_hour_announcement',
    'sample_movie_ticket_confirmation'
);
foreach ($excludedTemplates as $excludedTemplate) {
    foreach ($templates as $key => $template) {
        if ($template['name'] === $excludedTemplate) {
            unset($templates[$key]);
        }
    }
}
$templates = array_values($templates);


$array_ids = [];

foreach ($templates as $template) {
    $array_ids[] = $template['id'];
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startTimestamp = strtotime($_POST['start']);
    $endTimestamp = strtotime($_POST['end']);
} else {
    $startTimestamp = strtotime(date('Y-m-01 00:00:00'));
    $endTimestamp = strtotime(date('Y-m-d H:i:s'));
}


$tpl->set('startTimestamp', $startTimestamp);
$tpl->set('endTimestamp', $endTimestamp);
$messages = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppMessage::getList();
$sent = 0;
$read = 0;
$generatedConversations = 0;
foreach ($messages as $key => $object) {
    // Obtener el timestamp de la fecha del mensaje (asumiendo que $object->created_at ya es un timestamp)
    $messageTimestamp = $object->created_at;

    // Verificar si la fecha del mensaje está dentro del rango seleccionado
    if ($messageTimestamp >= $startTimestamp && $messageTimestamp <= $endTimestamp) {
        $status = $object->status;

        if ($status == 0 || $status == 3 || $status == 1 || $status == 2 || $status == 7) {
            $sent = $sent + 1;
        } 
        if ($status == 3) {
            $read = $read + 1;
        }

        if ($object->chat_id > 0) {
            $generatedConversations = $generatedConversations + 1;
        }
    }
}

$engagement = ($sent > 0) ? round(($read / $sent) * 100) : 0;

$tpl->set('generatedConversations', $generatedConversations);
$tpl->set('engagement', $engagement);
$tpl->set('totalSent', $sent);
$tpl->set('totalRead', $read);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://graph.facebook.com/v18.0/' . $data['whatsapp_business_account_id'] . '?fields=conversation_analytics.start(' . $startTimestamp . ').end(' . $endTimestamp . ').conversation_categories(SERVICE).granularity(DAILY).dimensions(CONVERSATION_CATEGORY)&limit=1000',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token
    ),
));

$response = curl_exec($curl);
curl_close($curl);
$json_response = json_decode($response, true);

$msg_services = 0;

if (isset($json_response['conversation_analytics']['data'][0]['data_points'])) {
    $data_points = $json_response['conversation_analytics']['data'][0]['data_points'];

    foreach ($data_points as $data_point) {
        if (isset($data_point['conversation_category'])) {
            $msg_services = $msg_services + $data_point['conversation'];
        }
    }
}

$tpl->set('msg_services', $msg_services);


$Result['content'] = $tpl->fetch();
$Result['path'] = array(
    array(
        'url' => erLhcoreClassDesign::baseurl('fbmessenger/index'),
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Facebook chat')
    )
);
