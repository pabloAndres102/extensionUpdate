<style>
    .nav-second-level>li {
        margin-top: 10px;
        /* Ajusta este valor según desees */
    }
</style>
<?php if (erLhcoreClassUser::instance()->hasAccessTo('lhfbmessenger', 'use_admin')) : ?>
    <li class="nav-item active" id="fbChatButton">
        <a href="#" class="nav-link"><i class="material-icons">call</i><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Facebook chat'); ?><i class="material-icons arrow md-18">chevron_right</i></a>
        <ul class="nav nav-second-level collapse show">
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="material-icons">domain</span><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Envíos Rápidos'); ?></strong></li>

            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/send') ?>"><span class="material-icons">send</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Envios simples'); ?></a></li>

            <ul class="nav nav-second-level collapse show">
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="material-icons">domain</span><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Campañas'); ?></strong></li>

                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/campaign') ?>"><span class="material-icons">campaign</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Campaign'); ?></a></li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/mailinglist') ?>"><span class="material-icons">list</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Contact list'); ?></a></li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/mailingrecipient') ?>"><span class="material-icons">import_contacts</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Contacts'); ?></a></li>

                <ul class="nav nav-second-level collapse show">
                    <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="material-icons">domain</span><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Reportes'); ?></strong></li>



                    <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/messages') ?>"><span class="material-icons">chat</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Messages'); ?></a></li>



                    <li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/index') ?>"><span class="material-icons">domain</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Estadísticas'); ?></a> </li>

                    <ul class="nav nav-second-level collapse show">
                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="material-icons">domain</span><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Opciones'); ?></strong></li>


                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/templates') ?>"><span class="material-icons">description</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Templates'); ?></a></li>

                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/profilebusiness') ?>"><span class="material-icons">security_update</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Profile business'); ?></a></li>


                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/account') ?>"><span class="material-icons">manage_accounts</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Business Accounts'); ?></a></li>

                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/facebook') ?>"><span class="material-icons">group</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Facebook'); ?></a></li>


                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/options') ?>"><span class="material-icons">settings</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Configuraciones'); ?></a></li>
                    </ul>
    </li>
<?php endif; ?>