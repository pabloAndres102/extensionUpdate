<style>
    /* Estilos para los inputs de fecha */
    input[type="datetime-local"] {
        padding: 8px 12px;
        /* Ajustar el relleno */
        border: 1px solid #ced4da;
        /* Borde */
        border-radius: 4px;
        /* Bordes redondeados */
        box-sizing: border-box;
        /* Incluir el borde en el tamaño total */
        font-size: 14px;
        /* Tamaño de fuente */
        outline: none;
        /* Eliminar el resplandor al enfocar */
    }

    /* Estilos para los botones */
    button.btn {
        padding: 8px 16px;
        /* Ajustar el relleno */
        border: none;
        /* Sin borde */
        border-radius: 4px;
        /* Bordes redondeados */
        cursor: pointer;
        /* Cursor de puntero */
        background-color: #007bff;
        /* Color de fondo */
        color: #fff;
        /* Color de texto */
        font-size: 14px;
        /* Tamaño de fuente */
    }

    /* Estilos para el botón de búsqueda */
    button.btn-primary {
        background-color: #007bff;
        /* Color de fondo */
    }

    /* Estilos para el icono de búsqueda */
    span.material-icons {
        vertical-align: middle;
        /* Alinear verticalmente */
        margin-right: 5px;
        /* Margen derecho */
    }

    /* Estilos para los recuadros */
    .recuadro {
        background-color: #f8f9fa;
        /* Color de fondo */
        border: 1px solid #dee2e6;
        /* Borde */
        padding: 20px;
        /* Espaciado interno */
        margin-bottom: 20px;
        /* Espaciado inferior */
        transition: all 0.3s ease;
        /* Transición suave para el efecto hover */
    }

    /* Estilos para el texto dentro del recuadro */
    .recuadro p,
    .recuadro h1 {
        margin: 0;
        /* Eliminar márgenes para el texto */
    }

    /* Efecto hover */
    .recuadro:hover {
        background-color: #e9ecef;
        /* Cambiar el color de fondo al hacer hover */
        transform: translateY(-5px);
        /* Elevar ligeramente el recuadro */
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        /* Sombra suave */
        border-color: #ced4da;
        /* Cambiar el color del borde */
        cursor: pointer;
        /* Cambiar el cursor al hacer hover */
    }

    /* Estilos para los números */
    .recuadro h1 {
        font-size: 32px;
        /* Tamaño de fuente grande para los números */
        color: #007bff;
        /* Color azul para los números */
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

<div class="container">
    <form method="POST" action="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/index') ?>">
        <!-- Establecer por defecto el primer día del mes actual a las 00:00 para la primera fecha -->
        <input type="datetime-local" name="start" value="<?php echo (isset($startTimestamp) ? date('Y-m-01\T00:00', $startTimestamp) : date('Y-m-01\T00:00')); ?>">&nbsp;&nbsp;

        <!-- Establecer por defecto la fecha y hora actuales para la segunda fecha -->
        <input type="datetime-local" name="end" value="<?php echo (isset($endTimestamp) ? date('Y-m-d\TH:i', $endTimestamp) : date('Y-m-d\TH:i')); ?>"> &nbsp;&nbsp;

        <button class="btn btn-primary" type="submit"><span class="material-icons">search</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons', 'Search'); ?></button>
    </form>
    <br>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 1 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Sent conversations'); ?></strong></p>
                <?php if (isset($totalSent)) : ?>
                    <h1><?php echo $totalSent; ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Total read'); ?></strong></p>
                <?php if (isset($totalRead)) : ?>
                    <h1><?php print_r($totalRead); ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 3 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Engagement'); ?></strong></p>
                <?php if (isset($engagement)) : ?>
                    <h1><?php print_r($engagement . '%'); ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 2 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Incoming conversations'); ?></strong></p>
                <?php if (isset($msg_services)) : ?>
                    <h1><?php echo $msg_services; ?></h1><small>(api)</small>

                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 3 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Generated conversations'); ?></strong></p>
                <?php if (isset($chatid)) : ?>
                    <h1><?php echo $chatid; ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Promedio de lectura'); ?></strong></p>
                <?php if (isset($averageTime)) : ?>
                    <h1><?php echo $averageTime; ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Lectura más rápida'); ?></strong></p>
                <?php if (isset($fastestTime)) : ?>
                    <h1><?php echo $fastestTime; ?></h1>
                <?php else : ?>
                    <h1>Sin datos</h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Lectura más lenta'); ?></strong></p>
                <?php if (isset($slowestTime)) : ?>
                    <h1><?php echo $slowestTime; ?></h1>
                <?php else : ?>
                    <h1>Sin datos</h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Estado de entregados'); ?></strong></p>
                <?php if (isset($deliveredCount)) : ?>
                    <h1><?php echo $deliveredCount; ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Estado de fallidos'); ?></strong></p>
                <?php if (isset($failedCount)) : ?>
                    <h1><?php echo $failedCount; ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Estado Rechazado'); ?></strong></p>
                <?php if (isset($rejectedCount)) : ?>
                    <h1><?php echo $rejectedCount; ?></h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Plantilla más enviada'); ?></strong></p>
                <?php if (isset($mostRepeatedTemplate)) : ?>
                    <h1 style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $mostRepeatedTemplate; ?></h1>
                    <p>(<?php echo $maxFrequency; ?>)</p>
                <?php else : ?>
                    <h1>Sin datos</h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Día que se envió más plantillas'); ?></strong></p>
                <?php if (isset($dayWithMostMessages)) : ?>
                    <h1><?php echo $dayWithMostMessages; ?></h1>
                    <p>(<?php echo $maxMessages; ?>)</p>
                <?php else : ?>
                    <h1>Sin datos</h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'día mayor engagement'); ?></strong></p>
                <?php if (isset($dayWithMaxEngagement)) : ?>
                    <h1><?php echo $dayWithMaxEngagement; ?></h1>
                <?php else : ?>
                    <h1>Sin datos</h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="recuadro"> <!-- Recuadro 4 -->
                <p><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'día menor engagement'); ?></strong></p>
                <?php if (isset($dayWithMinEngagement)) : ?>
                    <h1><?php echo $dayWithMinEngagement; ?></h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>