<?php if (erLhcoreClassUser::instance()->hasAccessTo('lhfbmessenger', 'use_admin')) : ?>
    <li class="nav-item">
        <a href="#" class="nav-link"><i class="material-icons">call</i><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Facebook chat'); ?><i class="material-icons arrow md-18">chevron_right</i></a>
        <ul class="nav nav-second-level">
                <li> <strong><a href="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/index') ?>"><span class="material-icons">domain</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Principal'); ?></a> </strong> </li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/templates') ?>"><span class="material-icons">description</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Templates'); ?></a></li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/send') ?>"><span class="material-icons">send</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Envios simples'); ?></a></li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/messages') ?>"><span class="material-icons">chat</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Messages'); ?></a></li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/account') ?>"><span class="material-icons">manage_accounts</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Business Accounts'); ?></a></li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/profilebusiness') ?>"><span class="material-icons">security_update</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Profile business'); ?></a></li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo erLhcoreClassDesign::baseurl('fbmessenger/options') ?>"><span class="material-icons">settings</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Configuraciones'); ?></a></li>
            </ul>
    </li>
<?php endif; ?>