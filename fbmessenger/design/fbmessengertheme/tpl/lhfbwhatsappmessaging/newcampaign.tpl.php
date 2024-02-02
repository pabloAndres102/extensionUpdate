<?php if (isset($errors)) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php')); ?>
<?php endif; ?>

<form action="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/newcampaign') ?>" id="form" method="post" ng-non-bindable>

    <?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php')); ?>

    <?php include(erLhcoreClassDesign::designtpl('lhfbwhatsappmessaging/parts/form_campaign.tpl.php')); ?>
    <button class="btn btn-secondary btn-sm" type="submit" value=""><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Send a test message'); ?></button>
    <div class="btn-group" role="group" aria-label="...">
        <input type="submit" class="btn btn-sm btn-secondary" name="Save_continue" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Assign recipients'); ?>" />
        <input type="submit" class="btn btn-sm btn-secondary" name="Cancel_page" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons', 'Cancel'); ?>" />
    </div> &nbsp;&nbsp;
    <button type="button" class="btn btn-warning btn-sm" onclick="return previewTemplate()">
                <i class="material-icons">visibility</i> Preview
    </button>

</form>
<script>
    function previewTemplate() {
        var selectedTemplate = document.getElementById("template-to-send").value;
        var texto = document.getElementById("field_1") ? document.getElementById("field_1").value : '';
        var texto2 = document.getElementById("field_2") ? document.getElementById("field_2").value : '';
        var texto3 = document.getElementById("field_3") ? document.getElementById("field_3").value : '';
        var texto4 = document.getElementById("field_4") ? document.getElementById("field_4").value : '';
        var texto5 = document.getElementById("field_5") ? document.getElementById("field_5").value : '';
        var texto_header = document.getElementById("field_header_1") ? document.getElementById("field_header_1").value : '';
        var parts = selectedTemplate.split("||");
        var selectedTemplateName = parts[0];
        var url = '<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/template_table') ?>/' + selectedTemplateName + '/' + texto + '/' + texto2 + '/' + texto3 + '/' + texto4 + '/' + texto5 + '?header='+texto_header;
        console.log(url);

        if (selectedTemplateName !== "") {
            return lhc.revealModal({
                'title': 'Import',
                'height': 350,
                'backdrop': true,
                'url': url
            });
        } else {
            alert("Por favor, selecciona una plantilla antes de previsualizar.");
        }
    }
</script>
