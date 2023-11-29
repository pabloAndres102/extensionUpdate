<style>
    /* Estilo para los inputs de fecha */
    input[type="datetime-local"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    /* Estilo para el botón de enviar */
    .btn-success {
        padding: 10px 15px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Estilo para la clase row */
    .row {
        display: flex;
    }

    /* Estilo para las columnas dentro de la clase row */
    .col-6 {
        flex: 1;
        padding: 0 15px;
    }

    /* Estilo para la clase recuadro-container */
    .recuadro-container {
        display: flex;
        margin-bottom: 20px;
    }

    /* Estilo para la clase recuadro */
    .recuadro {
        flex: 1;
        width: 100%;
        height: 100px;
        background-color: #f0f0f0;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
        margin-right: 20px;
    }
</style>
<?php if (erLhcoreClassUser::instance()->hasAccessTo('lhfbmessenger', 'use_fb_messenger') && !(isset(erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionFbmessenger')->settings['fb_disabled']) && erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionFbmessenger')->settings['fb_disabled'] === true)) : ?>

    <h4><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Facebook chat'); ?></h4>
    <?php
    $user = erLhcoreClassModelFBMessengerUser::findOne(array('filter' => array('user_id' => erLhcoreClassUser::instance()->getUserID())));

    if (!($user instanceof erLhcoreClassModelFBMessengerUser)) {

        $fb = erLhcoreClassModelFBMessengerUser::getFBAppInstance();

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email', 'pages_show_list', 'pages_messaging', 'pages_messaging_subscriptions']; // Optional permissions

        if (erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionFbmessenger')->settings['standalone']['enabled'] == true) {
            $time = time();
            $hash = sha1(erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionFbmessenger')->settings['standalone']['secret_hash'] . '_' . erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionFbmessenger')->settings['standalone']['address'] . '_' .  $_SERVER['HTTP_HOST'] . '_' . erLhcoreClassUser::instance()->getUserID() . $time);
            $loginUrl = erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionFbmessenger')->settings['standalone']['address'] . erLhcoreClassDesign::baseurl('fbmessenger/fbloginstandalone') . '/' . $_SERVER['HTTP_HOST'] . '/' . erLhcoreClassUser::instance()->getUserID() . '/' . $time . '/' . $hash;
        } else if (!class_exists('erLhcoreClassInstance')) {
            $loginUrl = $helper->getReRequestUrl('https://' . $_SERVER['HTTP_HOST'] . erLhcoreClassDesign::baseurl('fbmessenger/fbcallback'), $permissions);
        } else {
            $time = time();
            $hash = sha1(erConfigClassLhConfig::getInstance()->getSetting('site', 'seller_secret_hash', false) . '_' . erConfigClassLhConfig::getInstance()->getSetting('site', 'seller_subdomain', false) . '_' .  erLhcoreClassInstance::getInstance()->id . '_' . erLhcoreClassUser::instance()->getUserID() . $time);
            $loginUrl = 'https://' .  erConfigClassLhConfig::getInstance()->getSetting('site', 'seller_subdomain', false) . '.' . erConfigClassLhConfig::getInstance()->getSetting('site', 'seller_domain', false) . erLhcoreClassDesign::baseurl('fbmessenger/fblogininstance') . '/' . erLhcoreClassInstance::getInstance()->id . '/' . erLhcoreClassUser::instance()->getUserID() . '/' . $time . '/' . $hash;
        }

        echo '<a title="Log in with Facebook!" href="' . htmlspecialchars($loginUrl) . '"><img height="40" src="' . erLhcoreClassDesign::design('images/login-fb.png') . '" title="Log in with Facebook!" alt="Log in with Facebook!" /></a>';
    } else {
        $logoutFB = true;
    }
    ?>
    <ul>
        <?php if (isset($logoutFB)) : ?>
            <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/myfbpages'); ?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'My pages'); ?></a></li>
            <li><a class="csfr-required" href="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/fblogout'); ?>" class=""><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Logout'); ?></a></li>
        <?php endif; ?>
    </ul>

    <?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?>

    <hr>
    <ul>
        <?php if (erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionFbmessenger')->settings['standalone']['enabled'] == false) : ?>
            <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/list') ?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Facebook pages'); ?></a></li>
        <?php endif; ?>
        <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/bbcode') ?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'BBCode'); ?></a></li>
        <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/leads') ?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Leads'); ?></a></li>
        <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/notifications') ?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Notifications'); ?></a></li>
    </ul>

<?php endif; ?>

<?php if (erLhcoreClassUser::instance()->hasAccessTo('lhfbmessenger', 'use_options')) : ?>
    <hr>
    <h4><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Options'); ?></h4>
    <ul>
        <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/options') ?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Options'); ?></a></li>
    </ul>
<?php endif; ?>


<form method="POST" action="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/index') ?>">
    <input type="datetime-local" name="start">&nbsp;&nbsp;
    <input type="datetime-local" name="end"> &nbsp;&nbsp;
    <button class="btn btn-primary" type="submit"><span class="material-icons">search</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons', 'Search'); ?></button>
</form>

<div class="recuadro-container">
    <div class="recuadro"> <!-- Recuadro 1 -->
        <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Sent conversations'); ?></strong></p>
        <?php if (isset($totalSent)) : ?>
            <h1><?php echo $totalSent; ?></h1>
        <?php endif; ?>
    </div>

    <div class="recuadro"> <!-- Recuadro 4 -->
        <p><strong>Total Read</strong></p>
        <?php if (isset($totalRead)) : ?>
            <h1><?php print_r($totalRead); ?></h1>
        <?php endif; ?>
    </div>

    <div class="recuadro"> <!-- Recuadro 3 -->
        <p><strong>% Engagement</strong></p>
        <?php if (isset($engagement)) : ?>
            <h1><?php echo $engagement; ?></h1>
        <?php endif; ?>
    </div>

    <div class="recuadro"> <!-- Recuadro 2 -->
        <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Incoming conversations'); ?></strong></p>
        <?php if (isset($msg_services)) : ?>
            <h1><?php echo $msg_services; ?></h1>
        <?php endif; ?>
    </div>

    <div class="recuadro"> <!-- Recuadro 3 -->
        <p><strong>Conversaciones generadas</strong></p>
        <?php if (isset($generatedConversations)) : ?>
            <h1><?php echo $generatedConversations; ?></h1>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <?php if (erLhcoreClassUser::instance()->hasAccessTo('lhfbwhatsapp', 'use_admin')) : ?>
            <h4><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'WhatsApp'); ?></h4>
            <ul>
                <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/templates') ?>"><span class="material-icons">description</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Templates'); ?></a></li>
                <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/send') ?>"><span class="material-icons">send</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Send a single message'); ?></a></li>
                <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/massmessage') ?>"><span class="material-icons">forum</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Send a mass message'); ?></a></li>
                <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/messages') ?>"><span class="material-icons">chat</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Messages'); ?></a></li>
                <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/account') ?>"><span class="material-icons">manage_accounts</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Business Accounts'); ?></a></li>
                <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/profilebusiness') ?>"><span class="material-icons">security_update</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Profile business'); ?></a></li>
                <br> <br>
            </ul>

        <?php endif; ?>
    </div>
    <div class="col-6">
        <?php if (erLhcoreClassUser::instance()->hasAccessTo('lhfbwhatsappmessaging', 'use_admin')) : ?>
            <h4><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'WhatsApp Messaging'); ?></h4>
            <ul>
                <li><a title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Recipients lists') ?>" href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/mailinglist') ?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Recipients lists'); ?></a></li>
                <li><a title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Recipients') ?>" href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/mailingrecipient') ?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Recipients'); ?></a></li>
                <li><a title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Campaigns') ?>" href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaign') ?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Campaigns'); ?></a></li>
            </ul>
        <?php endif; ?>
    </div>
</div>