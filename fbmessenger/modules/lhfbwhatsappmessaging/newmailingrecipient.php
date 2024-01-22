<?php

$tpl = erLhcoreClassTemplate::getInstance('lhfbwhatsappmessaging/newmailingrecipient.tpl.php');

$item = new LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContact();

print_r('<br>');
print_r('<br>');
print_r('<br>');
if (is_array($Params['user_parameters_unordered']['ml'])) {
    $item->ml_ids_front = $Params['user_parameters_unordered']['ml'];
}


if (ezcInputForm::hasPostData() && !(!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token']))) {

    $items = array();


    $Errors = \LiveHelperChatExtension\fbmessenger\providers\FBMessengerWhatsAppMailingValidator::validateMailingRecipient($item);
    

    $contactClass = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContact::getList(['filter' => ['phone' => $item->phone]]);
    $contactidarray = [];
    foreach ($contactClass as $contact) {
        $contact_id = $contact->id;
        $contactidarray[] = $contact->id;
    }



    $listClass = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContactListContact::getList(['filter' => ['contact_id' => $contact_id]]);
    foreach ($listClass as $list) {
        $list_id = $list->contact_list_id;
    }

    if (count($Errors) == 0) {
        try {
            $item->user_id = $currentUser->getUserID();

            $item->saveThis();

            if ($item->isAllPrivateListMember() === true) {
                $item->private = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContact::LIST_PRIVATE;
                $item->saveThis(['update' => ['private']]);
            }

            $tpl->set('updated', true);
        } catch (Exception $e) {
            $tpl->set('errors', array($e->getMessage()));
        }
    } else {
        $tpl->set('errors', $Errors);
    }
}

$tpl->set('item', $item);
$Result['content'] = $tpl->fetch();

echo $tpl->fetch();
exit;
