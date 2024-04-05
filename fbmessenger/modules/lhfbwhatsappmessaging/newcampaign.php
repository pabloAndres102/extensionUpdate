<?php

$tpl = erLhcoreClassTemplate::getInstance('lhfbwhatsappmessaging/newcampaign.tpl.php');

$item = new LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaign();

if (isset($_POST['Cancel_page'])) {
    erLhcoreClassModule::redirect('fbwhatsappmessaging/campaign');
    exit;
}

$instance = LiveHelperChatExtension\fbmessenger\providers\FBMessengerWhatsAppLiveHelperChat::getInstance();

if (isset($_POST['business_account_id']) && $_POST['business_account_id'] > 0) {
    $item->business_account_id = $Params['user_parameters_unordered']['business_account_id'] = (int)$_POST['business_account_id'];
}

if ($item->business_account_id > 0) {
    $account = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppAccount::fetch($item->business_account_id);
    $instance->setAccessToken($account->access_token);
    $instance->setBusinessAccountID($account->business_account_id);
    $tpl->set('business_account_id', $account->id);
}

$templates = $instance->getTemplates();
$phones = $instance->getPhones();

if (ezcInputForm::hasPostData()) {

    if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
        erLhcoreClassModule::redirect('mailing/campaign');
        exit;
    }

    $items = array();

    $Errors = LiveHelperChatExtension\fbmessenger\providers\FBMessengerWhatsAppMailingValidator::validateCampaign($item);

    if (count($Errors) == 0) {
        try {
            $item->user_id = $currentUser->getUserID();
            $item->saveThis();


            $definition = array(
                'ml' => new ezcInputFormDefinitionElement(
                    ezcInputFormDefinitionElement::OPTIONAL,
                    'int',
                    array('min_range' => 1),
                    FILTER_REQUIRE_ARRAY
                ),
            );

            $form = new ezcInputForm(INPUT_POST, $definition);
            $Errors = array();

            $statistic = ['skipped' => 0, 'already_exists' => 0, 'imported' => 0, 'unassigned' => 0];

            $listPrivate = erLhcoreClassUser::instance()->hasAccessTo('lhfbwhatsappmessaging', 'all_contact_list');

            if ($form->hasValidData('ml') && !empty($form->ml)) {
                foreach ($form->ml as $ml) {
                    foreach (\LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContactListContact::getList(['limit' => false, 'filter' => ['contact_list_id' => $ml]]) as $mailingRecipient) {

                        // Skip private contact in public list
                        if ($listPrivate === false && $mailingRecipient->private == 1 && $mailingRecipient->user_id != (int)\erLhcoreClassUser::instance()->getUserID()) {
                            $statistic['skipped']++;
                            continue;
                        }

                        if (isset($_POST['export_action']) && $_POST['export_action'] == 'unassign') {
                            if ($mailingRecipient->mailing_recipient instanceof \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContact) {
                                foreach (\LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getList(['filter' => ['campaign_id' => $campaign->id, 'phone' => $mailingRecipient->mailing_recipient->phone]]) as $campaignRecipient) {
                                    $campaignRecipient->removeThis();
                                    $statistic['unassigned']++;
                                }
                            }
                            continue;
                        }

                        if (!($mailingRecipient->mailing_recipient instanceof \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContact) || $mailingRecipient->mailing_recipient->disabled == 1) {
                            $statistic['skipped']++;
                            continue;
                        }

                        if (\LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getCount(['filter' => ['campaign_id' => $campaign->id, 'phone' => $mailingRecipient->mailing_recipient->phone]]) == 1) {
                            $statistic['already_exists']++;
                            continue;
                        }

                        $campaignRecipient = new \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient();
                        $campaignRecipient->campaign_id = $item->id;
                        $campaignRecipient->recipient_id = $mailingRecipient->contact_id;
                        $campaignRecipient->email = $mailingRecipient->mailing_recipient->email;
                        $campaignRecipient->phone = $mailingRecipient->mailing_recipient->phone;
                        $campaignRecipient->saveThis();
                        $statistic['imported']++;
                    }
                }

                $tpl->set('statistic', $statistic);
                $tpl->set('updated', true);
            } else {
                $tpl->set('errors', ['Please choose at-least one mailing list']);
            }

            if (isset($_POST['Save_continue'])) {
                erLhcoreClassModule::redirect('fbwhatsappmessaging/campaign');
                $_SESSION['create'] = 'Su campaña se creo con exito.';
                $_SESSION['remember'] = 'Recuerde activar su campaña';
            }

            exit;
        } catch (Exception $e) {
            $tpl->set('errors', array($e->getMessage()));
        }
    } else {
        $tpl->set('errors', $Errors);
    }
}

$tpl->setArray(array(
    'item' => $item,
    'templates' => $templates,
    'phones' => $phones
));

$Result['content'] = $tpl->fetch();
$Result['additional_footer_js'] = '<script type="text/javascript" src="' . erLhcoreClassDesign::designJS('js/extension.fbwhatsapp.js') . '"></script>';

$Result['path'] = array(
    array(
        'url' => erLhcoreClassDesign::baseurl('fbmessenger/index'),
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Facebook chat'),
    ),
    array(
        'url' => erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaign'),
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Campaigns')
    ),
    array(
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'New')
    )
);
