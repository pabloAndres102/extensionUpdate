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

$end = time();
$start = $end - (30 * 24 * 60 * 60);
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://graph.facebook.com/v18.0/' . $data['whatsapp_business_account_id'] . '?fields=conversation_analytics.start(' . $start . ').end(' . $end . ').conversation_categories(SERVICE).granularity(DAILY).dimensions(CONVERSATION_CATEGORY)',
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

    if (isset($json_response['conversation_analytics']['data'][0]['data_points'])) {
        $data_points = $json_response['conversation_analytics']['data'][0]['data_points'];
        $msg_services = 0;
        foreach ($data_points as $data_point) {
            if (isset($data_point['conversation_category'])) {
                $msg_services = $msg_services + $data_point['conversation'];    
            }
        }
    }

$tpl->set('msg_services',$msg_services); 
$tpl->set('array_id',$array_ids); 
$tpl->set('accessToken',$token); 
$tpl->set('wbai',$wbai); 


$Result['content'] = $tpl->fetch();
// $Result['additional_footer_js'] = '<script type="text/javascript" src="'.erLhcoreClassDesign::designJS('js/ajax_get.js').'"></script>';

$Result['path'] = array(
    array(
        'url' => erLhcoreClassDesign::baseurl('fbmessenger/index'),
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Facebook chat')
    )
);
