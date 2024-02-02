<?php /*
<pre><?php print_r($template);?></pre>
*/ ?>
<style>
    .btn-beige {
    background-color: beige;
    color: #212529; /* Ajusta el color del texto según tu diseño */
    border-color: beige;
}

.btn-beige:hover {
    background-color: #e6d9b8; /* Color de hover */
    border-color: #e6d9b8; /* Color del borde al hacer hover */
}
</style>

<h6><?php echo htmlspecialchars($template['name']) ?> <span class="badge badge-secondary"><?php echo htmlspecialchars($template['category']) ?></span></h6>
<?php $fieldsCount = 0;
$fieldsCountHeader = 0;
$fieldCountHeaderDocument = 0;
$fieldCountHeaderImage = 0;
$fieldCountHeaderVideo = 0; ?>
<div class="rounded bg-light p-2" title="<?php echo htmlspecialchars(json_encode($template, JSON_PRETTY_PRINT)) ?>">
    <?php foreach ($template['components'] as $component) : ?>
        <?php if ($component['type'] == 'HEADER' && $component['format'] == 'IMAGE' && isset($component['example']['header_url'][0])) : ?>
            <img src="<?php echo htmlspecialchars($component['example']['header_url'][0]) ?>" />
        <?php endif; ?>
        <?php if ($component['type'] == 'HEADER' && $component['format'] == 'DOCUMENT' && isset($component['example']['header_url'][0])) : ?>
            <div>
                <span class="badge badge-secondary">FILE: <?php echo htmlspecialchars($component['example']['header_url'][0]) ?></span>
            </div>
        <?php endif; ?>
        <?php if ($component['type'] == 'HEADER' && $component['format'] == 'VIDEO' && isset($component['example']['header_url'][0])) : ?>
            <div>
                <span class="badge badge-secondary">VIDEO: <?php echo htmlspecialchars($component['example']['header_url'][0]) ?></span>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php foreach ($template['components'] as $component) : ?>
        <?php if ($component['type'] == 'BODY') :
            $matchesReplace = [];
            preg_match_all('/\{\{[0-9]\}\}/is', $component['text'], $matchesReplace);
            if (isset($matchesReplace[0])) {
                $fieldsCount = count($matchesReplace[0]);
            }
        ?><p><?php echo htmlspecialchars($component['text']) ?></p><?php endif; ?>
        <?php if ($component['type'] == 'HEADER') : ?>
            <?php if ($component['format'] == 'DOCUMENT') : $fieldCountHeaderDocument = 1; ?>
                <h5 class="text-secondary">DOCUMENT</h5>
            <?php elseif ($component['format'] == 'VIDEO') : $fieldCountHeaderVideo = 1; ?>
                <h5 class="text-secondary">VIDEO</h5>
                <?php if (isset($component['example']['header_handle'][0])) : ?>
                    <video width="100">
                        <source src="<?php echo htmlspecialchars($component['example']['header_handle'][0]) ?>" type="video/mp4">
                    </video>
                <?php endif; ?>
            <?php elseif ($component['format'] == 'IMAGE') : $fieldCountHeaderImage = 1; ?>
                <h5 class="text-secondary">IMAGE</h5>
                <?php if (isset($component['example']['header_handle'][0])) : ?>
                    <img src="<?php echo htmlspecialchars($component['example']['header_handle'][0]) ?>" />
                <?php endif; ?>
            <?php else : ?>
                <?php
                $matchesReplace = [];
                preg_match_all('/\{\{[0-9]\}\}/is', $component['text'], $matchesReplace);
                if (isset($matchesReplace[0])) {
                    $fieldsCountHeader = count($matchesReplace[0]);
                }
                ?>
                <h5 class="text-secondary"><?php echo htmlspecialchars($component['text']) ?></h5>
            <?php endif; ?>

        <?php endif; ?>
        <?php if ($component['type'] == 'FOOTER') : ?><p class="text-secondary"><?php echo htmlspecialchars($component['text']) ?></p><?php endif; ?>
        <?php if ($component['type'] == 'BUTTONS') : ?>
            <?php foreach ($component['buttons'] as $button) : ?>
                <div class="pb-2"><button class="btn btn-sm btn-secondary"><?php echo htmlspecialchars($button['text']) ?> | <?php echo htmlspecialchars($button['type']) ?></button></div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<!--=========||=========-->
<div class="row">
    <div class="row">
    <?php for ($i = 0; $i < $fieldsCount; $i++) : ?>
        <div class="col-6 mb-3" ng-non-bindable>
            <div class="input-group">             
            <input placeholder="<?php echo 'Campo de texto - {{' . ($i + 1) . '}}' ?>" type="text" list="fields_placeholders" class="form-control form-control-sm" id="field_<?php echo $i+1?>" name="field_<?php echo $i+1?>" value="<?php if (isset($data['field_' .  ($i + 1)])) { echo htmlspecialchars($data['field_' .  ($i + 1)]); } ?>">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-beige" type="button" onclick="showSelect(<?php echo $i+1?>)">Mostrar opciones</button>
                </div>
                <select id="select_<?php echo $i + 1 ?>" class="field-select form-control form-control-sm" style="display: none;">
                    <?php for ($j = 1; $j <= 15; $j++) : ?>
                        <option value="<?php echo $j ?>">Opción <?php echo $j ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    <?php endfor; ?>
</div>
<?php for ($i = 0; $i < $fieldsCountHeader; $i++) : ?>
    <div class="col-6" ng-non-bindable>
        <div class="form-group">
            <label class="font-weight-bold">Campo de encabezado - {{<?php echo $i + 1 ?>}}</label>
            <div class="input-group">             
                <input type="text" list="fields_placeholders" class="form-control form-control-sm" id="field_header_<?php echo $i + 1 ?>" name="field_header_<?php echo $i + 1 ?>" value="<?php if (isset($data['field_header_' .  $i + 1])) : ?><?php echo htmlspecialchars($data['field_header_' .  $i + 1]) ?><?php endif; ?>">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-beige" type="button" onclick="showSelectHeader(<?php echo $i+1?>)">Mostrar opciones</button>
                </div>
                <select id="select_header_<?php echo $i + 1 ?>" class="field-select form-control form-control-sm" style="display: none;">
                    <?php for ($j = 1; $j <= 15; $j++) : ?>
                        <option value="<?php echo $j ?>">Opción <?php echo $j ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
    </div>
<?php endfor; ?>

    <?php for ($i = 0; $i < $fieldCountHeaderDocument; $i++) : ?>
        <div class="col-6" ng-non-bindable>
            <div class="form-group">
                <label class="font-weight-bold">Campo de documento - {{<?php echo $i + 1 ?>}}</label>
                <!-- &nbsp;&nbsp;<a data-selector="#field_header_doc_<?php echo $i + 1 ?>" class="fb-choose-file btn btn-sm btn-success" href="#" class="btn btn-secondary btn-sm"><span class="material-icons">upload</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('file/list', 'Upload a file'); ?></a> -->
                <input type="text" list="fields_placeholders" class="form-control form-control-sm" placeholder="https://example.com/filename.pdf" id="field_header_doc_<?php echo $i + 1 ?>" name="field_header_doc_<?php echo $i + 1 ?>" value="<?php if (isset($data['field_header_doc_' .  $i + 1])) : ?><?php echo htmlspecialchars($data['field_header_doc_' .  $i + 1]) ?><?php endif; ?>">
                <label class="font-weight-bold">Nombre de archivo - {{<?php echo $i + 1 ?>}}</label>
                <input list="fields_placeholders" type="text" class="form-control form-control-sm" placeholder="filename.pdf" id="field_header_doc_filename_<?php echo $i + 1 ?>" name="field_header_doc_filename_<?php echo $i + 1 ?>" value="<?php if (isset($data['field_header_doc_filename_' .  $i + 1])) : ?><?php echo htmlspecialchars($data['field_header_doc_filename_' .  $i + 1]) ?><?php endif; ?>">
            </div>
        </div>
    <?php endfor; ?>
    <?php for ($i = 0; $i < $fieldCountHeaderImage; $i++) : ?>
        <div class="col-6" ng-non-bindable>
            <div class="form-group">
                <label class="font-weight-bold">Campo de imagen URL - {{<?php echo $i + 1 ?>}}</label>
                <!-- &nbsp;&nbsp;<a data-selector="#field_header_img_<?php echo $i + 1 ?>" class="fb-choose-file btn btn-sm btn-success" href="#" class="btn btn-secondary btn-sm"><span class="material-icons">upload</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('file/list', 'Upload a file'); ?></a> -->
                <input list="fields_placeholders" type="text" class="form-control form-control-sm" placeholder="https://example.com/image.png" id="field_header_img_<?php echo $i + 1 ?>" name="field_header_img_<?php echo $i + 1 ?>" value="<?php if (isset($data['field_header_img_' .  $i + 1])) : ?><?php echo htmlspecialchars($data['field_header_img_' .  $i + 1]) ?><?php endif; ?>">
            </div>
        </div>
    <?php endfor; ?>

    <?php for ($i = 0; $i < $fieldCountHeaderVideo; $i++) : ?>
        <div class="col-6" ng-non-bindable>
            <div class="form-group">
                <label class="font-weight-bold">Campo de video URL - {{<?php echo $i + 1 ?>}}</label>
                <!-- &nbsp;&nbsp;<a data-selector="#field_header_video_<?php echo $i + 1 ?>" class="fb-choose-file btn btn-sm btn-success" href="#" class="btn btn-secondary btn-sm"><span class="material-icons">upload</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('file/list', 'Upload a file'); ?></a> -->
                <input list="fields_placeholders" type="text" class="form-control form-control-sm" placeholder="https://example.com/video.mp4" id="field_header_video_<?php echo $i + 1 ?>" name="field_header_video_<?php echo $i + 1 ?>" value="<?php if (isset($data['field_header_video_' .  $i + 1])) : ?><?php echo htmlspecialchars($data['field_header_video_' .  $i + 1]) ?><?php endif; ?>">
            </div>
        </div>
    <?php endfor; ?>


</div>

<?php /*<pre><?php echo json_encode($template, JSON_PRETTY_PRINT)?></pre>*/ ?>
<script>
    // Función para mostrar el select al hacer clic en el botón
    function showSelectHeader(fieldId) {
        // Ocultar todos los selects
        var allSelects = document.querySelectorAll('.field-select');
        allSelects.forEach(function(select) {
            select.style.display = 'none';
        });

        // Mostrar el select correspondiente al botón clicado
        var selectId = 'select_header_' + fieldId;
        var select = document.getElementById(selectId);
        if (select) {
            select.style.display = 'block';

            // Limpia las opciones existentes
            select.innerHTML = '';

            // Define las opciones deseadas para el encabezado
            var optionsMap = {
                'Seleccionar dato': '',
                'Nombre': '{args.recipient.name_front}',
                'Apellido': '{args.recipient.lastname_front}',
                'Empresa': '{args.recipient.company_front}',
                'Título': '{args.recipient.title_front}',
                'Email': '{args.recipient.email_front}',
                'Agregar solo Imágenes JPG': '{args.recipient.file_1_url_front}',
                'Agregar solo Documentos PDF': '{args.recipient.file_2_url_front}',
                'Agregar solo Videos MP4': '{args.recipient.file_3_url_front}',
                'Campo personalizado 1': '{args.recipient.attr_str_1_front}',
                'Campo personalizado 2': '{args.recipient.attr_str_2_front}',
                'Campo personalizado 3': '{args.recipient.attr_str_3_front}',
                'Campo personalizado 4': '{args.recipient.attr_str_4_front}',
                'Campo personalizado 5': '{args.recipient.attr_str_5_front}',
                'Campo personalizado 6': '{args.recipient.attr_str_6_front}'
            };

            // Agrega las opciones al select
            for (var optionName in optionsMap) {
                var optionValue = optionsMap[optionName];

                var option = document.createElement('option');
                option.value = optionValue;
                option.textContent = optionName;
                select.appendChild(option);
            }

            // Agregar evento de cambio al select
            select.addEventListener('change', function() {
                var selectedOption = select.options[select.selectedIndex].value;
                var inputFieldId = 'field_header_' + fieldId;
                var inputField = document.getElementById(inputFieldId);
                if (inputField) {
                    inputField.value = selectedOption;
                }
            });
        }
    }
</script>
<script>
    // Función para mostrar el select al hacer clic en el botón
    function showSelect(fieldId) {
        // Ocultar todos los selects
        var allSelects = document.querySelectorAll('.field-select');
        allSelects.forEach(function(select) {
            select.style.display = 'none';
        });

        // Mostrar el select correspondiente al botón clicado
        var selectId = 'select_' + fieldId;
        var select = document.getElementById(selectId);
        if (select) {
            select.style.display = 'block';

            // Limpia las opciones existentes
            select.innerHTML = '';

            // Define las opciones deseadas
            var optionsMap = {
                'Seleccionar dato': '',
                'Nombre': '{args.recipient.name_front}',
                'Apellido': '{args.recipient.lastname_front}',
                'Empresa': '{args.recipient.company_front}',
                'Título': '{args.recipient.title_front}',
                'Email': '{args.recipient.email_front}',
                'Agregar solo Imágenes JPG': '{args.recipient.file_1_url_front}',
                'Agregar solo Imágenes JPG': '{args.recipient.file_2_url_front}',
                'Agregar solo Documentos PDF': '{args.recipient.file_3_url_front}',
                'Agregar solo Videos MP4': '{args.recipient.file_4_url_front}',
                'Campo personalizado 1': '{args.recipient.attr_str_1_front}',
                'Campo personalizado 2': '{args.recipient.attr_str_2_front}',
                'Campo personalizado 3': '{args.recipient.attr_str_3_front}',
                'Campo personalizado 4': '{args.recipient.attr_str_4_front}',
                'Campo personalizado 5': '{args.recipient.attr_str_5_front}',
                'Campo personalizado 6': '{args.recipient.attr_str_6_front}'
            };


            // Agrega las opciones al select
            for (var optionName in optionsMap) {
                var optionValue = optionsMap[optionName];

                var option = document.createElement('option');
                option.value = optionValue;
                option.textContent = optionName;
                select.appendChild(option);
            }

            // Agregar evento de cambio al select
            select.addEventListener('change', function() {
                var selectedOption = select.options[select.selectedIndex].value;
                var inputFieldId = 'field_' + fieldId;
                var inputField = document.getElementById(inputFieldId);
                if (inputField) {
                    inputField.value = selectedOption;
                }
            });
        }
    }
</script>

<script>
    (function() {
        var fields = document.querySelectorAll('input[name^="field_"]');

        // Itera sobre los campos seleccionados
        fields.forEach(function(field) {
            // Aplica readonly solo si el campo tiene algún valor
            if (field.value.trim() !== '') {
                field.setAttribute('readonly', 'readonly');
            }
        });

        $('.fb-choose-file').click(function(e) {
            e.preventDefault(); // Evita que el enlace siga el href

            // Encuentra el contenedor del campo de entrada relacionado
            var inputContainer = $(this).closest('.form-group');

            // Encuentra la entrada de texto dentro del contenedor
            var inputField = inputContainer.find('input[type="text"]');

            // Agrega la clase 'embed-into' al campo de entrada
            inputField.addClass('embed-into');

            // Abre el modal
            lhc.revealModal({
                'iframe': true,
                'height': 400,
                'url': '<?php echo erLhcoreClassDesign::baseurl('file/attatchfileimg') ?>'
            });

        });

    })();
</script>