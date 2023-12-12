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




$suma = 0;

$failedCount = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppMessage::getCount([
    'filtergte' => [
        'created_at' => $startTimestamp
    ],
    'filterlte' => [
        'created_at ' => $endTimestamp
    ],
    'filter' => [
        'status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppMessage::STATUS_FAILED,
    ]
    ]);


$sentCount = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppMessage::getCount([
        'filtergte' => [
            'created_at' => $startTimestamp
        ],
        'filterlte' => [
            'created_at ' => $endTimestamp
        ],
        'filter' => [
            'status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppMessage::STATUS_SENT,
        ]
        ]);


$readCount = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppMessage::getCount([
            'filtergte' => [
                'created_at' => $startTimestamp
            ],
            'filterlte' => [
                'created_at ' => $endTimestamp
            ],
            'filter' => [
                'status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppMessage::STATUS_READ,
            ]
            ]);

$rejectedCount = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppMessage::getCount([
                'filtergte' => [
                    'created_at' => $startTimestamp
                ],
                'filterlte' => [
                    'created_at ' => $endTimestamp
                ],
                'filter' => [
                    'status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppMessage::STATUS_REJECTED,
                ]
                ]);


$deliveredCount = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppMessage::getCount([
            'filtergte' => [
                'created_at' => $startTimestamp
            ],
            'filterlte' => [
                'created_at ' => $endTimestamp
            ],
            'filter' => [
                'status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppMessage::STATUS_DELIVERED,
            ]
            ]);

$chatid = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppMessage::getCount([
    'filtergt' => [
        'chat_id' => 0,
    ],
    'filtergte' => [
        'created_at' => $startTimestamp
    ],
    'filterlte' => [
        'created_at ' => $endTimestamp
    ],
]);


$suma = $readCount + $sentCount + $deliveredCount + $failedCount + $rejectedCount;

if ($suma > 0) {
    $engagement = round(($readCount / $suma) * 100, 2);
} else {
    $engagement = 0;
}


$tpl->set('totalSent', $suma);
$tpl->set('totalRead', $readCount);
$tpl->set('engagement', $engagement);
$tpl->set('chatid', $chatid);



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
