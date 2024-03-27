<?php
$response = erLhcoreClassChatEventDispatcher::getInstance()->dispatch('fbwhatsapp.carousel', array());
$fbOptions = erLhcoreClassModelChatConfig::fetch('fbmessenger_options');
$data = (array)$fbOptions->data;
$tpl = erLhcoreClassTemplate::getInstance('lhfbwhatsapp/carousel.tpl.php');
$cardComponents = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $data['whatsapp_access_token'];
    $app_id = $data['app_id'];
    $whatsapp_business_account_id = $data['whatsapp_business_account_id'];
    $templateName = strtolower($_POST['templateName']);
    $templateCat = strtolower($_POST['templateCat']);
    $language = $_POST['language'];

    $carouselHeadertext = $_POST['carouselHeadertext'];
    $headertype = isset($_POST['header']) ? $_POST['header'] : "";

    $cardBody = $_POST['cardBody'];
    $urlButton = $_POST['urlButton'];

    $textBodyCard = $_POST['textAreacard'];
    $buttonquickcard = $_POST['buttonquickcard'];

    $archivo_temporal = $_FILES['archivo']['tmp_name'];
    $nombre_archivo = $_FILES["archivo"]["name"];
    $tipo_archivo = $_FILES["archivo"]["type"];
    $tamaño_archivo = $_FILES["archivo"]["size"];


    if (!empty($archivo_temporal)) {
        $archivo_bytes = file_get_contents($archivo_temporal);
    }


    $ch = curl_init();
    $nombre_archivo = str_replace(' ', '', $nombre_archivo);

    curl_setopt_array($ch, array(
        CURLOPT_URL => 'https://graph.facebook.com/v18.0/' . $app_id . '/uploads?file_length=' . $tamaño_archivo . '&file_type=' . $tipo_archivo . '&file_name=' . $nombre_archivo . '', # Revisar en caso de que requiera la extension el nombre
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ),
    ));

    $responseid = curl_exec($ch);
    $response_data = json_decode($responseid, true);
    $session_id = $response_data['id'] ?? "";

    curl_close($ch);

    # UPLOAD

    $ch2 = curl_init();
    $post_data = isset($archivo_bytes) ? $archivo_bytes : $carouselHeadertext;

    curl_setopt_array($ch2, array(
        CURLOPT_URL => 'https://graph.facebook.com/v18.0/' . $session_id . '',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $post_data,
        CURLOPT_HTTPHEADER => array(
            'file_offset: 0',
            'Content-Type: application/json',
            'Authorization: OAuth ' . $token
        ),
    ));

    $response = curl_exec($ch2);
    $response_data2 = json_decode($response, true);

    $uploadedFileId = $response_data2['h'] ?? "";


    curl_close($ch2);

    // print_r($response_data2);

    $url = 'https://graph.facebook.com/v18.0/' . $whatsapp_business_account_id . '/message_templates';

    if (isset($templateCat)) {
        $components = [
            [
                "type" => "HEADER",
                "format" => $headertype,
                "example" => ["header_handle" => [$uploadedFileId]]
            ],
            [
                "type" => "BODY",
                "text" => $textBodyCard
            ],
            [
                "type" => "BUTTONS",
                "buttons" => [
                    [
                        "type" => "QUICK_REPLY",
                        "text" => $buttonquickcard
                    ],
                    [
                        "type" => "URL",
                        "text" => "Ir al sitio",
                        "url" => $urlButton,
                    ]
                ]
            ]
        ];


        $cardComponents[] = [
            'type' => "BODY",
            "text" => $cardBody
        ];


        $cardComponents[] = [
            "type" => "CAROUSEL",
            "cards" => [
                [
                    "components" => $components
                ],
                [
                    "components" => $components
                ]
            ]
        ];
    }

    if (isset($templateCat)) {
        $data = array(
            'allow_category_change' => true,
            'name' => $templateName,
            'category' => $templateCat,
            'language' => $language,
            'components' => $cardComponents
        );
    }

    $ch = curl_init();
    $headers = array();

    $headers[] = 'Authorization: Bearer ' . $token;
    $headers[] = 'Content-Type:application/json';
    $headers[] = 'Authorization: OAuth ' . $token;

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);

    $jsonresponse = json_decode($result, true);
    // print_r($jsonresponse);
    curl_close($ch);

    if (isset($jsonresponse['error'])) {
        $_SESSION['api_error'] = $jsonresponse;
    } else {
        $_SESSION['api_response'] = $jsonresponse;
    }
    header('Location: ' . erLhcoreClassDesign::baseurl('fbwhatsapp/templates'));
}

$Result['content'] = $tpl->fetch();
