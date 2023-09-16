<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Edit');?></h1>

<?php if (isset($updated)) : $msg = erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Updated'); ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success.tpl.php'));?>
<?php endif; ?>

<?php if (isset($errors)) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<form action="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/editcampaign')?>/<?php echo $item->id?>" method="post" ng-non-bindable>

    <?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

    <ul class="nav nav-tabs mb-3" role="tablist">
        <li role="presentation" class="nav-item"><a href="#settings" class="nav-link<?php if ($tab == '') : ?> active<?php endif;?>" aria-controls="settings" role="tab" data-bs-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Main');?></a></li>
        <li role="presentation" class="nav-item"><a class="nav-link<?php if ($tab == 'tab_statistic') : ?> active<?php endif;?>" href="#statistic" aria-controls="options" role="tab" data-bs-toggle="tab" ><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Statistic');?></a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane <?php if ($tab == '') : ?>active<?php endif;?>" id="settings">
            <?php include(erLhcoreClassDesign::designtpl('lhfbwhatsappmessaging/parts/form_campaign.tpl.php'));?>
        </div>
        <div role="tabpanel" class="tab-pane <?php if ($tab == 'tab_statistic') : ?>active<?php endif;?>" id="statistic">
            <p><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Owner');?> - <?php echo htmlspecialchars((string)$item->user)?></p>
            <p><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Statistic');?></p>
            <ul>
                <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Total recipients');?> - <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaignrecipient')?>/(campaign)/<?php echo $item->id?>"><?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getCount(['filter' => ['campaign_id' => $item->id]])?></a></li>
                <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Pending');?> - <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaignrecipient')?>/(campaign)/<?php echo $item->id?>/(status)/<?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_PENDING?>"><?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getCount(['filter' => ['status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_PENDING,'campaign_id' => $item->id]])?></a></li>
                <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Send');?> - <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaignrecipient')?>/(campaign)/<?php echo $item->id?>/(status)/<?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_SENT?>"><?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getCount(['filter' => ['status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_SENT,'campaign_id' => $item->id]])?></a></li>
                <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','In progress');?> - <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaignrecipient')?>/(campaign)/<?php echo $item->id?>/(status)/<?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_IN_PROCESS?>"><?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getCount(['filter' => ['status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_IN_PROCESS,'campaign_id' => $item->id]])?></a></li>
                <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Failed');?> - <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaignrecipient')?>/(campaign)/<?php echo $item->id?>/(status)/<?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_FAILED?>"><?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getCount(['filter' => ['status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_FAILED,'campaign_id' => $item->id]])?></a></li>
                <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Rejected');?> - <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaignrecipient')?>/(campaign)/<?php echo $item->id?>/(status)/<?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_REJECTED?>"><?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getCount(['filter' => ['status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_REJECTED,'campaign_id' => $item->id]])?></a></li>
                <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Read');?> - <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaignrecipient')?>/(campaign)/<?php echo $item->id?>/(status)/<?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_READ?>"><?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getCount(['filter' => ['status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_READ,'campaign_id' => $item->id]])?></a></li>
                <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Scheduled');?> - <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaignrecipient')?>/(campaign)/<?php echo $item->id?>/(status)/<?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_SCHEDULED?>"><?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getCount(['filter' => ['status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_SCHEDULED,'campaign_id' => $item->id]])?></a></li>
                <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Delivered');?> - <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaignrecipient')?>/(campaign)/<?php echo $item->id?>/(status)/<?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_DELIVERED?>"><?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getCount(['filter' => ['status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_DELIVERED,'campaign_id' => $item->id]])?></a></li>
                <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Pending process');?> - <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaignrecipient')?>/(campaign)/<?php echo $item->id?>/(status)/<?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_PENDING_PROCESS?>"><?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getCount(['filter' => ['status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_PENDING_PROCESS,'campaign_id' => $item->id]])?></a></li>
                <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Number of recipients who opened an e-mail');?> - <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaignrecipient')?>/(campaign)/<?php echo $item->id?>/(opened)/1"><?php echo \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getCount(['filter' => ['campaign_id' => $item->id], 'filtergt' => ['opened_at' => 0]])?></a></li>
            </ul>
        </div>
    </div>

    <div class="btn-group" role="group" aria-label="...">
        <input type="submit" class="btn btn-sm btn-secondary" name="Save_page" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Save');?>"/>
        <input type="submit" class="btn btn-sm btn-secondary" name="Update_page" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Update');?>"/>
        <input type="submit" class="btn btn-sm btn-secondary" name="Cancel_page" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Cancel');?>"/>
    </div>

</form>
<script>
    // Espera a que el documento esté completamente cargado
    document.addEventListener("DOMContentLoaded", function() {
        // Obtiene la URL actual
        var currentUrl = window.location.href;

        // Verifica si la URL contiene el parámetro "?tab=statistic"
        if (currentUrl.indexOf("?tab=statistic") !== -1) {
            // Selecciona la pestaña "statistic" y muestra su contenido
            var statisticTab = document.querySelector('a[href="#statistic"]');
            if (statisticTab) {
                statisticTab.click(); // Simula un clic en la pestaña "statistic"
            }
        }
    });
</script>

