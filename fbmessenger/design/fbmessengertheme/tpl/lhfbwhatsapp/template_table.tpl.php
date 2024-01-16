<?php $fieldsCount = 0;$fieldsCountHeader = 0;$fieldCountHeaderDocument = 0;$fieldCountHeaderImage = 0;$fieldCountHeaderVideo = 0;?>
<div class="rounded bg-light p-2" title="<?php echo htmlspecialchars(json_encode($template, JSON_PRETTY_PRINT))?>">
    <?php foreach ($template['components'] as $component) : ?>
        <?php if ($component['type'] == 'HEADER' && $component['format'] == 'IMAGE' && isset($component['example']['header_url'][0])) : ?>
            <img src="<?php echo htmlspecialchars($component['example']['header_url'][0])?>" />
        <?php endif; ?>
        <?php if ($component['type'] == 'HEADER' && $component['format'] == 'DOCUMENT' && isset($component['example']['header_url'][0])) : ?>
            <div>
                <span class="badge badge-secondary">FILE: <?php echo htmlspecialchars($component['example']['header_url'][0])?></span>
            </div>
        <?php endif; ?>
        <?php if ($component['type'] == 'HEADER' && $component['format'] == 'VIDEO' && isset($component['example']['header_url'][0])) : ?>
            <div>
                <span class="badge badge-secondary">VIDEO: <?php echo htmlspecialchars($component['example']['header_url'][0])?></span>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php foreach ($template['components'] as $component) : ?>
        <?php if ($component['type'] == 'BODY') :
            $matchesReplace = [];
            preg_match_all('/\{\{[0-9]\}\}/is',$component['text'],$matchesReplace);
            if (isset($matchesReplace[0])) {
                $fieldsCount = count($matchesReplace[0]);
            }
            ?><p><?php echo htmlspecialchars($component['text'])?></p><?php endif; ?>
        <?php if ($component['type'] == 'HEADER') : ?>
            <?php if ($component['format'] == 'DOCUMENT') : $fieldCountHeaderDocument = 1;?>
                <h5 class="text-secondary">DOCUMENT</h5>
            <?php elseif ($component['format'] == 'VIDEO') : $fieldCountHeaderVideo = 1;?>
                <h5 class="text-secondary">VIDEO</h5>
                <?php if (isset($component['example']['header_handle'][0])) : ?>
                    <video width="100">
                        <source src="<?php echo htmlspecialchars($component['example']['header_handle'][0])?>" type="video/mp4">
                    </video>
                <?php endif; ?>
            <?php elseif ($component['format'] == 'IMAGE') : $fieldCountHeaderImage = 1;?>
                <h5 class="text-secondary">IMAGE</h5>
                <?php if (isset($component['example']['header_handle'][0])) : ?>
                    <img src="<?php echo htmlspecialchars($component['example']['header_handle'][0])?>" />
                <?php endif; ?>
            <?php else : ?>
                <?php
                $matchesReplace = [];
                preg_match_all('/\{\{[0-9]\}\}/is',$component['text'],$matchesReplace);
                if (isset($matchesReplace[0])) {
                    $fieldsCountHeader = count($matchesReplace[0]);
                }
                ?>
                <h5 class="text-secondary"><?php echo htmlspecialchars($component['text'])?></h5>
            <?php endif; ?>

        <?php endif; ?>
        <?php if ($component['type'] == 'FOOTER') : ?><p class="text-secondary"><?php echo htmlspecialchars($component['text'])?></p><?php endif; ?>
        <?php if ($component['type'] == 'BUTTONS') : ?>
            <?php foreach ($component['buttons'] as $button) : ?>
                <div class="pb-2"><button class="btn btn-sm btn-secondary"><?php echo htmlspecialchars($button['text'])?> | <?php echo htmlspecialchars($button['type'])?></button></div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<!--=========||=========-->


