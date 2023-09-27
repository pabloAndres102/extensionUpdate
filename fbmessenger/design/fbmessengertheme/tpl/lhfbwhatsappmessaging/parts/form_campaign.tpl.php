<div class="row">
    <div class="col-8">

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Name'); ?>*</label>
                    <input type="text" maxlength="250" class="form-control form-control-sm" name="name" value="<?php echo htmlspecialchars($item->name) ?>" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Business account'); ?>, <small><i><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'you can set a custom business account'); ?></i></small></label>
                    <?php echo erLhcoreClassRenderHelper::renderCombobox(array(
                        'input_name'     => 'business_account_id',
                        'optional_field' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Default configuration'),
                        'selected_id'    => $item->business_account_id,
                        'css_class'      => 'form-control form-control-sm',
                        'list_function'  => '\LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppAccount::getList'
                    )); ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Department'); ?></label>
                    <?php echo erLhcoreClassRenderHelper::renderCombobox(array(
                        'input_name'     => 'dep_id',
                        'optional_field' => erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Select department'),
                        'selected_id'    => $item->dep_id,
                        'css_class'      => 'form-control form-control-sm',
                        'list_function'  => 'erLhcoreClassModelDepartament::getList',
                        'list_function_params'  => array('limit' => false, 'sort' => 'name ASC'),
                    )); ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label><input type="checkbox" <?php if ($item->id == null || \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::getCount(['filter' => ['status' => \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaignRecipient::STATUS_PENDING, 'campaign_id' => $item->id]]) == 0) : $disabledCampaign = true; ?>disabled<?php endif; ?> name="enabled" value="on" <?php $item->enabled == 1 ? print ' checked="checked" ' : '' ?>> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Activate campaign'); ?></label>
                    <?php if (isset($disabledCampaign) && $disabledCampaign == true) : ?><div class="text-danger"><small><i>You will be able to activate campaign once you have at-least one recipient</i></small></div><?php endif; ?>
                    <div><small><i><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Only once the campaign is activated we will start sending messages. Progress you can see in statistic tab.'); ?></i></small></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="<?php ($item->starts_at > 0 && $item->starts_at < time()) ? print 'text-danger' : '' ?> "><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Start sending at'); ?> <b><?php print date_default_timezone_get() ?></b>, Current time - <b>[<?php echo (new DateTime('now', new DateTimeZone(date_default_timezone_get())))->format('Y-m-d H:i:s') ?>]</b></label>
                    <input id="startDateTime" class="form-control form-control-sm" name="starts_at" type="datetime-local" value="<?php echo date('Y-m-d\TH:i', $item->starts_at > 0 ? $item->starts_at : time()) ?>">
                </div>
                <?php if ($item->status == \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaign::STATUS_PENDING) : ?>
                    <div class="badge bg-info"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Pending, campaign has not started yet.'); ?></div>
                <?php elseif ($item->status == \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaign::STATUS_IN_PROGRESS) : ?>
                    <div class="badge bg-info"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'In progress'); ?></div>

                    <input type="submit" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Pause a running campaign'); ?>" class="btn btn-xs btn-warning" name="PauseCampaign" />

                <?php elseif ($item->status == \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaign::STATUS_FINISHED) : ?>
                    <label><input type="checkbox" name="activate_again" value="on"> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Set campaign status to pending. E.g You can activate it again if you have added more recipients.'); ?></label>
                <?php endif; ?>
            </div>
            <div class="col-6">
                <label><input type="checkbox" name="private" value="on" <?php $item->private == \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppCampaign::LIST_PRIVATE ? print ' checked="checked" ' : '' ?>> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Private'); ?></label>
            </div>
        </div>

        <script>
            var messageFieldsValues = <?php echo json_encode($item->message_variables_array); ?>;
            var businessAccountId = <?php echo (int)$item->business_account_id ?>;
        </script>

        <div class="form-group">
            <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Sender Phone'); ?></label>
            <select name="phone_sender_id" id="id_phone_sender_id" class="form-control form-control-sm" title="display_phone_number | verified_name | code_verification_status | quality_rating">
                <?php foreach ($phones as $phone) : ?>
                    <option value="<?php echo $phone['id'] ?>">
                        <?php echo $phone['display_phone_number'], ' | ', $phone['verified_name'], ' | ', $phone['code_verification_status'], ' | ', $phone['quality_rating'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Template'); ?>*</label>
            <select name="template" class="form-control form-control-sm" id="template-to-send">
                    <option value=""><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Choose a template'); ?></option>
                    <?php foreach ($templates as $template) : ?>
                        <?php
                        // Nombres de plantillas a excluir
                        $excludedTemplates = array(
                            'sample_purchase_feedback',
                            'sample_issue_resolution',
                            'sample_flight_confirmation',
                            'sample_shipping_confirmation',
                            'sample_happy_hour_announcement',
                            'sample_movie_ticket_confirmation'
                            // Agrega aquí los nombres de las plantillas que deseas excluir
                        );

                        // Verifica si el nombre de la plantilla está en la lista de excluidas
                        if (in_array($template['name'], $excludedTemplates)) {
                            continue; // Si está en la lista, salta esta iteración y no agrega la plantilla al select
                        }

                        // Verifica si la plantilla tiene estado "approved" antes de agregarla al select
                        if ($template['status'] === 'APPROVED') {
                        ?>
                            <option <?php if ($send->template == $template['name']) : ?>selected="selected" <?php endif; ?> value="<?php echo htmlspecialchars($template['name'] . '||' . $template['language'] . '||' . $template['id']) ?>"><?php echo htmlspecialchars($template['name'] . ' [' . $template['language'] . ']') ?></option>
                        <?php
                        }
                        ?>
                    <?php endforeach; ?>
                </select>
        </div>

        <div id="arguments-template-form"></div>

    </div>
    <div class="col-4">
        <div id="arguments-template"></div>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    // Selecciona el elemento de entrada de fecha y hora
    var startDateTimeInput = document.getElementById('startDateTime');

    // Agrega un evento de escucha cuando el valor del input cambia
    startDateTimeInput.addEventListener('change', function() {
        // Obtiene la fecha y hora actual en formato ISO8601
        var currentDateTime = new Date();
        currentDateTime.setMinutes(currentDateTime.getMinutes() + 5); // Agrega 5 minutos

        // Obtiene el valor del input
        var selectedDateTime = new Date(startDateTimeInput.value);

        // Compara la fecha y hora seleccionada con la fecha y hora actual más 5 minutos
        if (selectedDateTime < currentDateTime) {
            // Si la fecha y hora seleccionada es anterior a la actual más 5 minutos, muestra una alerta
            alert('La fecha y hora seleccionada debe ser posterior a al menos 5 minutos a partir de ahora.');
            // Calcula la fecha y hora mínima permitida
            currentDateTime.setMinutes(currentDateTime.getMinutes() - 5); // Resta 5 minutos
            // Actualiza el valor del input al mínimo permitido
            startDateTimeInput.value = currentDateTime.toISOString().slice(0, 16);
        }
    });
});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtén una referencia al formulario
        var form = document.querySelector('form'); // Reemplaza 'form' con el selector correcto para tu formulario

        // Nombres de campos a excluir de la validación
        var excludeFields = ['field_header_img_', 'field_header_video_','field_header_doc_','field_header_doc_filename_'];

        // Agrega un evento de escucha para el evento "submit" del formulario
        form.addEventListener('submit', function(event) {
            // Obtiene una lista de todos los elementos de entrada que deseas validar
            var inputsToValidate = form.querySelectorAll('.form-control');

            // Variable para rastrear si se encontró un campo vacío excluido
            var foundEmptyExcludedField = false;

            // Recorre la lista de elementos de entrada
            for (var i = 0; i < inputsToValidate.length; i++) {
                var input = inputsToValidate[i];

                // Verifica si el campo está vacío
                if (input.value.trim() === '') {
                    // Verifica si el nombre del campo está en el array de campos excluidos
                    if (excludeFields.some(function(excludedName) {
                        return input.name.indexOf(excludedName) === 0;
                    })) {
                        // Si es un campo excluido, marca que se encontró un campo vacío excluido
                        foundEmptyExcludedField = true;
                    } else {
                        // Si no es un campo excluido, evita que el formulario se envíe
                        event.preventDefault();
                        // Muestra un mensaje de error o realiza cualquier otra acción que desees
                        alert('Por favor, complete todos los campos obligatorios.');
                        // Sale del bucle una vez que se encuentra un campo vacío
                        return;
                    }
                }
            }

            // Si se encontró un campo vacío excluido y no se encontraron otros campos vacíos, permite enviar el formulario
            if (foundEmptyExcludedField) {
                return;
            }
        });
    });
</script>


