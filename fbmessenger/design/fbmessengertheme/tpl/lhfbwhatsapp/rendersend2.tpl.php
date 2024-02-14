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
            <div class="input-group">             
                <input placeholder="<?php echo 'Campo de encabezado - {{' . ($i + 1) . '}}' ?>" type="text" list="fields_placeholders" class="form-control form-control-sm" id="field_header_<?php echo $i + 1 ?>" name="field_header_<?php echo $i + 1 ?>" value="<?php if (isset($data['field_header_' .  $i + 1])) : ?><?php echo htmlspecialchars($data['field_header_' .  $i + 1]) ?><?php endif; ?>">
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
                <!-- &nbsp;&nbsp;<a data-selector="#field_header_doc_<?php echo $i + 1 ?>" class="fb-choose-file btn btn-sm btn-success" href="#" class="btn btn-secondary btn-sm"><span class="material-icons">upload</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('file/list', 'Upload a file'); ?></a> -->
                <input placeholder="<?php echo 'Campo de documento - {{' . ($i + 1) . '}}' ?>" type="text" list="fields_placeholders" class="form-control form-control-sm" placeholder="https://example.com/filename.pdf" id="field_header_doc_<?php echo $i + 1 ?>" name="field_header_doc_<?php echo $i + 1 ?>" value="<?php if (isset($data['field_header_doc_' .  $i + 1])) : ?><?php echo htmlspecialchars($data['field_header_doc_' .  $i + 1]) ?><?php endif; ?>">
                <input placeholder="<?php echo 'Nombre de archivo - {{' . ($i + 1) . '}}' ?>" list="fields_placeholders" type="text" class="form-control form-control-sm" placeholder="filename.pdf" id="field_header_doc_filename_<?php echo $i + 1 ?>" name="field_header_doc_filename_<?php echo $i + 1 ?>" value="<?php if (isset($data['field_header_doc_filename_' .  $i + 1])) : ?><?php echo htmlspecialchars($data['field_header_doc_filename_' .  $i + 1]) ?><?php endif; ?>">
            </div>
        </div>
    <?php endfor; ?>
    <?php for ($i = 0; $i < $fieldCountHeaderImage; $i++) : ?>
        <div class="col-6" ng-non-bindable>
            <div class="form-group">
                <!-- &nbsp;&nbsp;<a data-selector="#field_header_img_<?php echo $i + 1 ?>" class="fb-choose-file btn btn-sm btn-success" href="#" class="btn btn-secondary btn-sm"><span class="material-icons">upload</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('file/list', 'Upload a file'); ?></a> -->
                <input placeholder="<?php echo 'Campo de imagen URL - {{' . ($i + 1) . '}}' ?>" list="fields_placeholders" type="text" class="form-control form-control-sm" placeholder="https://example.com/image.png" id="field_header_img_<?php echo $i + 1 ?>" name="field_header_img_<?php echo $i + 1 ?>" value="<?php if (isset($data['field_header_img_' .  $i + 1])) : ?><?php echo htmlspecialchars($data['field_header_img_' .  $i + 1]) ?><?php endif; ?>">
            </div>
        </div>
    <?php endfor; ?>

    <?php for ($i = 0; $i < $fieldCountHeaderVideo; $i++) : ?>
        <div class="col-6" ng-non-bindable>
            <div class="form-group">
                <!-- &nbsp;&nbsp;<a data-selector="#field_header_video_<?php echo $i + 1 ?>" class="fb-choose-file btn btn-sm btn-success" href="#" class="btn btn-secondary btn-sm"><span class="material-icons">upload</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('file/list', 'Upload a file'); ?></a> -->
                <input placeholder="<?php echo 'Campo de video URL - {{' . ($i + 1) . '}}' ?>" list="fields_placeholders" type="text" class="form-control form-control-sm" placeholder="https://example.com/video.mp4" id="field_header_video_<?php echo $i + 1 ?>" name="field_header_video_<?php echo $i + 1 ?>" value="<?php if (isset($data['field_header_video_' .  $i + 1])) : ?><?php echo htmlspecialchars($data['field_header_video_' .  $i + 1]) ?><?php endif; ?>">
            </div>
        </div>
    <?php endfor; ?>


</div>

<?php /*<pre><?php echo json_encode($template, JSON_PRETTY_PRINT)?></pre>*/ ?>
