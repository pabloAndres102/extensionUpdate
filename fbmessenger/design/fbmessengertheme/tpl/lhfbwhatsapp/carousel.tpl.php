<form action=<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/carousel') ?> enctype="multipart/form-data" method="post">
    <div class="mb-3">
        <label for="edad" class="form-label"><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('abstract/widgettheme', 'Name'); ?> <?php echo htmlspecialchars($template['name']) ?></strong></label>
        <input type="text" class="form-control" id="templateName" name="templateName" placeholder=<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('abstract/widgettheme', 'Name'); ?> required>
    </div>

    <div class="mb-3">
        <label for="language" class="form-label"> <strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/cannedmsg', 'Language'); ?></strong></label>
        <select class="form-select" id="language" name="language" aria-label="Default select example" required>
            <option selected value="es">Español</option>
            <option value="af">Afrikáans</option>
            <option value="sq">Albanés</option>
            <option value="ar">Árabe</option>
            <option value="az">Azerí</option>
            <option value="bn">Bengalí</option>
            <option value="bg">Búlgaro</option>
            <option value="ca">Catalán</option>
            <option value="zh_CN">Chino (China)</option>
            <option value="zh_HK">Chino (Hong Kong)</option>
            <option value="zh_TW">Chino (Tailandia)</option>
            <option value="cs">Checo</option>
            <option value="nl">Holandés</option>
            <option value="en">Inglés</option>
            <option value="en_GB">Inglés (Reino Unido)</option>
            <option value="es_LA">Inglés (EE. UU.)</option>
            <option value="et">Estonio</option>
            <option value="fil">Filipino</option>
            <option value="fi">Finlandés</option>
            <option value="fr">Francés</option>
            <option value="de">Alemán</option>
            <option value="el">Griego</option>
            <option value="gu">Guyaratí</option>
            <option value="he">Hebreo</option>
            <option value="hi">Hindi</option>
            <option value="hu">Húngaro</option>
            <option value="id">Indonesio</option>
            <option value="ga">Irlandés</option>
            <option value="it">Italiano</option>
            <option value="ja">Japonés</option>
            <option value="kn">Canarés</option>
            <option value="kk">Kazajo</option>
            <option value="ko">Coreano</option>
            <option value="lo">Lao</option>
            <option value="lv">Letón</option>
            <option value="lt">Lituano</option>
            <option value="mk">Macedonio</option>
            <option value="ms">Malayo</option>
            <option value="mr">Maratí</option>
            <option value="nb">Noruego</option>
            <option value="fa">Persa</option>
            <option value="pl">Polaco</option>
            <option value="pt_BR">Portugués (Brasil)</option>
            <option value="pt_PT">Portugués (Portugal)</option>
            <option value="pa">Punyabí</option>
            <option value="ro">Rumano</option>
            <option value="ru">Ruso</option>
            <option value="sr">Serbio</option>
            <option value="sk">Eslovaco</option>
            <option value="sl">Esloveno</option>
            <option value="es_AR">Español (Argentina)</option>
            <option value="es_ES">Español (España)</option>
            <option value="es_MX">Español (México)</option>
            <option value="sw">Suajili</option>
            <option value="sv">Sueco</option>
            <option value="ta">Tamil</option>
            <option value="te">Telugu</option>
            <option value="th">Tailandés</option>
            <option value="tr">Turco</option>
            <option value="uk">Ucraniano</option>
            <option value="ur">Urdu</option>
            <option value="uz">Uzbeko</option>
            <option value="vi">Vietnamita</option>
        </select>
    </div>

    <input type="hidden" name="templateCat" value="MARKETING">

    <div class="mb-3">
        <label for="header" class="form-label"> <strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Header type'); ?></strong></label>
        <select class="form-select" id="header" name="header" aria-label="Default select example" required>
            <option value=""><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Without header'); ?></option>
            <option value="VIDEO"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Video'); ?></option>
            <option value="IMAGE"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Image'); ?></option>
        </select>

        <input type="file" name="archivo" id="archivo" class="form-control" required>
        <div>
            <label for="cardBody"><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Body'); ?></strong></label>
            <textarea id="cardBody" name="cardBody" class="form-control z-depth-1" rows="3" maxlength="1024" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Remember that you can load a maximum of 5 variables'); ?>"></textarea>
        </div>

        <br><br>
        <h3>Cards</h3>
        <div>
            <label for="textAreacard"><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Card body'); ?></strong></label>
            <textarea id="textAreacard" name="textAreacard" class="form-control z-depth-1" rows="3" maxlength="1024"></textarea required>
        </div>

        <label for="buttonquickcard"><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Button quick card'); ?></strong></label>
        <input class="form-control" type="text" id="buttonquickcard" name="buttonquickcard" maxlength="25" required>

        <label for="urlButton"><strong><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Button URL card'); ?></strong></label>
        <input class="form-control" type="url" id="urlButton" name="urlButton" maxlength="500" required>

    </div>

    <button type="submit" class="btn btn-success"><span class="material-icons">send</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons', 'Send'); ?></button>









</form>