<?php

$tpl = erLhcoreClassTemplate::getInstance('lhfbwhatsapp/template_table.tpl.php');
$instance = \LiveHelperChatExtension\fbmessenger\providers\FBMessengerWhatsAppLiveHelperChat::getInstance();
$item = new \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppMessage();

$parametros = [ $Params['user_parameters']['texto'],
                $Params['user_parameters']['texto2'],
                $Params['user_parameters']['texto3'],
                $Params['user_parameters']['texto4'],
                $Params['user_parameters']['texto5']];



                

$item->message_variables = $parametros;
$messageVariables = $item->message_variables;

if(isset($_GET['header'])){
    $textHeader = $_GET['header'];
}






if (isset($Params['user_parameters']['template'])) {
    $templates = $instance->getTemplates();
    foreach ($templates as $template) {
        if ($Params['user_parameters']['template'] == $template['name']) {
            $templatePresent = $template;
            $bodyTextHeader = '';
            $bodyText = '';
            foreach ($templatePresent as $tp) {
                foreach ($tp as $text) {
                    if ($text['type'] === 'BODY') {
                        $bodyText = $text['text'];
                        foreach ($messageVariables as $key => $value) {
                            $bodyText = str_replace('{{' . ($key + 1) . '}}', $value, $bodyText);
                            
                        }
                        break; 
                    }
                    if ($text['type'] == 'HEADER'){
                        $bodyTextHeader = $text['text'];
                        $bodyTextHeader = str_replace('{{1}}', $textHeader, $bodyTextHeader);
                        $tpl->set('prueba', $bodyTextHeader);
                        
                    }
                }
            }
        $tpl->set('templateName', $template['name']);
        }
    }
}


$tpl->set('bodyText', $bodyText);





echo $tpl->fetch();
exit;
