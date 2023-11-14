<style>
    .loader {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 20px auto;
        /* Ajusta el margen según sea necesario */
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .recuadro {
        display: inline-block;
        width: 200px;
        height: 130px;
        margin-right: 20px;
        background-color: #f0f0f0;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
        border: 1px solid #000;
        padding: 10px;
    }

    .recuadro2 {
        display: inline-block;
        width: 200px;
        height: 130px;
        margin-right: 20px;
        background-color: #f0f0f0;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
        border: 1px solid #000;
        padding: 10px;
    }

    .recuadro3 {
        display: inline-block;
        width: 200px;
        height: 130px;
        margin-right: 20px;
        background-color: #f0f0f0;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
        border: 1px solid #000;
        padding: 10px;
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
<small> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Summary of the last 30 days'); ?> </small>
<br>
<div>
    <div class="recuadro">
        <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Sent conversations'); ?></strong></p>
        <?php if (isset($totalSent)) : ?>
            <h1> <?php echo $totalSent; ?></h1>
        <?php else : ?>
            <!-- Mostrar círculo de carga en movimiento -->
            <div class="loader"></div>
        <?php endif; ?>
    </div>
    <div class="recuadro2">
        <p><strong> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Incoming conversations'); ?> </strong></p>
        <?php if (isset($msg_services)) : ?>
            <h1> <?php echo $msg_services; ?></h1>
        <?php else : ?>
            <!-- Mostrar círculo de carga en movimiento -->
            <div class="loader"></div>
        <?php endif; ?>
    </div>
    <div class="recuadro3">
        <p><strong> % Engagement </strong></p>
        <?php if (isset($engagement)) : ?>
            <h1> <?php echo $engagement; ?></h1>
        <?php else : ?>
            <!-- Mostrar círculo de carga en movimiento -->
            <div class="loader"></div>
        <?php endif; ?>
    </div>
</div>
<br><br>
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
                <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/flows') ?>"><span class="material-icons">account_tree</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/adminchat', 'Flows'); ?></a></li>
                <li><a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/analytics') ?>"><span class="material-icons">trending_up</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Cost'); ?></a></li>
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

<script>
    var AT = <?php echo json_encode($accessToken); ?>;
    const templateIds = <?php echo json_encode($array_id); ?>;
    const listUsers = () => {

        const chunkSize = 10;
        let totalSent = 0;
        let totalRead = 0;

        function processChunk(i) {
            if (i < templateIds.length) {
                const templateIdsChunk = templateIds.slice(i, i + chunkSize);
                const templateIdsStr = JSON.stringify(templateIdsChunk);
                const end = Math.floor(Date.now() / 1000);
                const start = end - (32 * 24 * 60 * 60);
                $.ajax({
                    type: 'GET',
                    url: `https://graph.facebook.com/v18.0/105209658989864/template_analytics?start=${start}&end=${end}&granularity=DAILY&metric_types=[%22SENT%22%2C%22DELIVERED%22%2C%22READ%22%2C%22CLICKED%22]&template_ids=${templateIdsStr}&limit=1000`,
                    async: true,
                    headers: {
                        'Authorization': 'Bearer ' + AT
                    },
                    success: function(data) {
                        data.data[0].data_points.forEach(point => {
                            totalSent += point.sent;
                            totalRead = totalRead + point.read;
                        }, );

                        processChunk(i + chunkSize);
                    },
                    error: function(error) {
                        console.log(error);
                        // Puedes manejar el error según tus necesidades
                    }
                });
            } else {
                // Una vez que se ha procesado todo, actualiza el contenido del div
                $('.recuadro').html('<p><strong> Plantillas enviadas </strong></p><h1>' + totalSent + '</h1>');
                const percentageRead = (totalRead / totalSent) * 100;
                $('.recuadro3').html(`
                    <p><strong> % Engagement </strong></p>
                    <h1>${percentageRead.toFixed(2)}%</h1>
                    <p>Lectura total: ${totalRead}</p>
                `);
            }
        }

        processChunk(0);
    };

    $(document).ready(function($) {
        listUsers();
    });
</script>