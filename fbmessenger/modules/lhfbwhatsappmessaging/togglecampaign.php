<?php
$currentUser = erLhcoreClassUser::instance();
$currentUser->getUserID();

if (isset($_POST['campaign_id']) && isset($_POST['action'])) {
    $campaignID = (int)$_POST['campaign_id'];
    $action = $_POST['action'];

    $campaign = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaign::fetch($campaignID);

    if ($campaign instanceof \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaign) {
        if ($action === 'activate') {
            $campaign->enabled = 1;
        } elseif ($action === 'deactivate') {
            $campaign->enabled = 0;
        }

        $campaign->saveThis();
    }
}

header('Location: ' . erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaign                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    '));
?>
