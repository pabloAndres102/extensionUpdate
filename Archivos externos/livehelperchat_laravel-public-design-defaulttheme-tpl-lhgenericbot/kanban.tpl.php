<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <style>
        .cookie-notice p {
            margin: 0;
            color: #ff0000;
            /* Yellow text color */
        }

        .kanban-container {
            display: flex;
            padding: 20px;
            gap: 20px;
        }

        .kanban-column-container {
            display: flex;
            gap: 20px;
        }

        .kanban-column {
            flex: 1;
            height: 100%;
            padding: 20px;
            border-radius: 8px;
            max-width: 320px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            background-color: rgba(255, 255, 255, 0.9);
            /* Fondo con transparencia */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            /* Alinea el contenido al principio */
            align-items: center;
            /* Centra el contenido horizontalmente */
        }

        .kanban-column:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .kanban-item {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
            background-color: #f5f5f5;
            cursor: pointer;
            font-size: 14px;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        #todo {
            background-color: rgba(255, 210, 210, 0.7);
        }

        #in-progress {
            background-color: rgba(255, 239, 184, 0.7);
        }

        #review {
            background-color: rgba(184, 218, 255, 0.7);
        }

        #done {
            background-color: rgba(195, 230, 203, 0.7);
        }

        .kanban-item:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .kanban-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            color: #333;
        }

        .kanban-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            font-family: 'Montserrat', sans-serif;
            /* Fuente más sofisticada */
            text-transform: uppercase;
            color: #333;
            /* Color del texto */
            text-align: center;
            /* Centra el texto horizontalmente */
            margin-bottom: 20px;
            /* Espacio entre el título y los elementos */
        }
    </style>
</head>
<?php $subjects = erLhAbstractModelSubject::getList() ?>
<?php

$subjectNames = array();
foreach ($subjects as $subject) {
    $subjectNames[] = $subject->name;
}
$column_colors = array(
    'rgba(138, 43, 226, 0.5)',
    'rgba(255, 255, 0, 0.5)',
    'rgba(0, 0, 255, 0.5)',
    'rgba(0, 128, 0, 0.5)',
    'rgba(255, 0, 0, 0.5)'
);

?>


<body>
    <?php if (isset($takes_to_long)) : $msg = erTranslationClassLhTranslation::getInstance()->getTranslation('chat/onlineusers', 'Your request takes to long. Please contact your administrator and send him url from your browser.'); ?>
        <?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_info.tpl.php')); ?>
    <?php endif; ?>

    <?php include(erLhcoreClassDesign::designtpl('lhchat/lists/search_panel_whtas.tpl.php')); ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php')); ?>

    <?php include(erLhcoreClassDesign::designtpl('lhchat/lists_chats_parts/append_table_class.tpl.php')); ?>
    <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/kanban_status'); ?>" class="btn btn-primary"><span class="material-icons">description</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Estados embudo'); ?></a>
    <div class="kanban-column-container">
        <br>
        
        <div class="cookie-notice">
            <p><i class="material-icons me-0">info_outline</i> Los movimientos en este kanban se guardan utilizando cookies. Esto significa que tus cambios pueden perderse si borras las cookies de tu navegador o si utilizas un dispositivo diferente.</p>
        </div>
        <div class="kanban-container">
            <!-- Columna General -->
            <div class="kanban-column" id="general" style="background-color: rgba(211, 211, 211, 0.5);">
                <div class="kanban-header">
                    <h3>General</h3>
                </div>
                <?php foreach ($items as $chat) : ?>
                    <div class="kanban-item" id="kanban-item-<?php echo $chat->id; ?>"> <!-- Agrega la clase y el ID aquí -->
                        <tr>
                            <?php include(erLhcoreClassDesign::designtpl('lhchat/lists/start_row.tpl.php')); ?>
                            <td><?php if ($chat->can_edit_chat == true) : ?><input class="mb-0" type="checkbox" name="ChatID[]" value="<?php echo $chat->id ?>" /><?php endif; ?></td>
                            <td>

                                <?php include(erLhcoreClassDesign::designtpl('lhchat/lists/icons_additional.tpl.php')); ?>

                                <?php foreach ($chat->aicons as $aicon) : ?>
                                    <?php if (isset($aicon['i']) && strpos($aicon['i'], '/') !== false) : ?>
                                        <img class="me-1" title="<?php isset($aicon['t']) ? print htmlspecialchars($aicon['t']) : htmlspecialchars($aicon['i']) ?>" src="<?php echo $aicon['i']; ?>" />
                                    <?php else : ?>
                                        <i class="material-icons" style="color: <?php isset($aicon['c']) ? print htmlspecialchars($aicon['c']) : print '#6c757d' ?>" title="<?php isset($aicon['t']) ? print htmlspecialchars($aicon['t']) : htmlspecialchars($aicon['i']) ?>"><?php isset($aicon['i']) ? print htmlspecialchars($aicon['i']) : htmlspecialchars($aicon) ?></i>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <span title="<?php echo $chat->id; ?>" class="material-icons fs12 me-0<?php echo $chat->user_status_front == 2 ? ' icon-user-away' : ($chat->user_status_front == 0 ? ' icon-user-online' : ' icon-user-offline') ?>" class="">&#xE3A6;</span>&nbsp;

                                <?php if (!empty($chat->country_code)) : ?><img src="<?php echo erLhcoreClassDesign::design('images/flags'); ?>/<?php echo $chat->country_code ?>.png" alt="<?php echo htmlspecialchars($chat->country_name) ?>" title="<?php echo htmlspecialchars($chat->country_name) ?>" />&nbsp;<?php endif; ?>
                                    <a class="material-icons" id="preview-item-<?php echo $chat->id ?>" data-list-navigate="true" onclick="lhc.previewChat(<?php echo $chat->id ?>,this)">info_outline</a>

                                    <a href="#!#Fchat-id-<?php echo $chat->id ?>" class="action-image material-icons" data-title="<?php echo htmlspecialchars($chat->nick, ENT_QUOTES); ?>" onclick="lhinst.startChatNewWindow('<?php echo $chat->id; ?>',$(this).attr('data-title'))" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/pendingchats', 'Open in a new window'); ?>">open_in_new</a>

                                    <a href="#!#Fchat-id-<?php echo $chat->id ?>" class="me-2" <?php if ($chat->nc != '') : ?>style="color: <?php echo htmlspecialchars($chat->nc) ?>" <?php endif; ?> onclick="ee.emitEvent('svelteOpenChat',[<?php echo $chat->id ?>]);"><?php echo $chat->id ?></a>

                                    <?php if ($chat->can_edit_chat && ($chat->status == erLhcoreClassModelChat::STATUS_PENDING_CHAT && ($can_delete_global == true || ($can_delete_general == true && $chat->user_id == $current_user_id)))) : ?>
                                        <a class="csfr-required csfr-post material-icons" data-trans="delete_confirm" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/pendingchats', 'Reject chat'); ?>" href="<?php echo erLhcoreClassDesign::baseurl('chat/delete') ?>/<?php echo $chat->id ?>">delete</a>
                                    <?php elseif ($chat->status == erLhcoreClassModelChat::STATUS_ACTIVE_CHAT) : ?>

                                        <?php if ($chat->can_edit_chat && ($can_close_global == true || $chat->user_id == $current_user_id)) : ?>
                                            <a class="csfr-required material-icons" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/activechats', 'Close chat'); ?>" href="<?php echo erLhcoreClassDesign::baseurl('chat/closechat') ?>/<?php echo $chat->id ?>">close</a>
                                        <?php endif; ?>

                                        <?php if ($chat->can_edit_chat && ($can_delete_global == true || ($can_delete_general == true && $chat->user_id == $current_user_id))) : ?>
                                            <a class="csfr-required csfr-post material-icons" data-trans="delete_confirm" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/activechats', 'Delete chat'); ?>" href="<?php echo erLhcoreClassDesign::baseurl('chat/delete') ?>/<?php echo $chat->id ?>">delete</a>
                                        <?php endif; ?>

                                    <?php elseif ($chat->status == erLhcoreClassModelChat::STATUS_CLOSED_CHAT || $chat->status == erLhcoreClassModelChat::STATUS_OPERATORS_CHAT || $chat->status == erLhcoreClassModelChat::STATUS_CHATBOX_CHAT) : ?>
                                        <?php if ($chat->can_edit_chat && ($can_delete_global == true || ($can_delete_general == true && $chat->user_id == $current_user_id))) : ?><a data-trans="delete_confirm" class="csfr-required csfr-post material-icons" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/closedchats', 'Delete chat'); ?>" href="<?php echo erLhcoreClassDesign::baseurl('chat/delete') ?>/<?php echo $chat->id ?>">delete</a><?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($chat->status_sub == erLhcoreClassModelChat::STATUS_SUB_OFFLINE_REQUEST) : ?><i title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/activechats', 'Offline request') ?>" class="material-icons">mail</i><?php endif ?>

                                    <a href="#!#Fchat-id-<?php echo $chat->id ?>" <?php if ($chat->nc != '') : ?>style="color: <?php echo htmlspecialchars($chat->nc) ?>" <?php endif; ?> onclick="ee.emitEvent('svelteOpenChat',[<?php echo $chat->id ?>]);"><span <?php if ($chat->nb == 1) : ?>class="fw-bold" <?php endif; ?>><?php echo htmlspecialchars($chat->nick); ?></span></a>

                                    <?php if ($chat->has_unread_messages == 1) : ?>
                                        <?php
                                        $diff = time() - $chat->last_user_msg_time;
                                        $hours = floor($diff / 3600);
                                        $minits = floor(($diff - ($hours * 3600)) / 60);
                                        $seconds = ($diff - ($hours * 3600) - ($minits * 60));
                                        ?> | <b><?php echo $hours ?> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/syncadmininterface', 'h.'); ?> <?php echo $minits ?> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/syncadmininterface', 'm.'); ?> <?php echo $seconds ?> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/syncadmininterface', 's.'); ?> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/syncadmininterface', 'ago'); ?>.</b>
                                    <?php endif; ?>
                                    <?php if (is_array($chat->subjects)) : ?>
                                        <?php foreach ($chat->subjects as $subject) : ?>
                                            <span class="badge bg-info mx-1" <?php if ($subject->color != '') : ?>style="background-color:#<?php echo htmlspecialchars($subject->color) ?>!important;" <?php endif; ?>><?php echo htmlspecialchars($subject) ?></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                            </td>
                            <br>
                            <?php include(erLhcoreClassDesign::designtpl('lhchat/lists_chats_parts/additional_chat_column_row.tpl.php')); ?>

                            <?php include(erLhcoreClassDesign::designtpl('lhchat/lists_chats_parts/column_value_after_department_multiinclude.tpl.php')); ?>
                            <td nowrap="nowrap">
                                <?php include(erLhcoreClassDesign::designtpl('lhchat/lists_chats_parts/status_column.tpl.php')); ?>
                            </td>
                            <td><?php if ($chat->fbst == 1) : ?><i class="material-icons up-voted">thumb_up</i><?php elseif ($chat->fbst == 2) : ?><i class="material-icons down-voted">thumb_down<i><?php endif; ?></td>
                        </tr>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php $index = 0; ?>
            <?php foreach ($kanbanData as $column) : ?>
                <div class="kanban-column" id="<?php echo strtolower(str_replace(' ', '-', $column['nombre'])); ?>" style="background-color: <?php echo $column['color']; ?>">
                    <div class="kanban-header">
                        <h3><?php echo $column['nombre']; ?></h3>
                    </div>
                </div>
                <?php $index++; ?>
            <?php endforeach; ?>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(function() {
            // Inicializa un array para almacenar los movimientos
            var movements = [];

            $(".kanban-item").draggable({
                revert: "invalid",
                cursor: "move",
                zIndex: 1000
            });
            $(".kanban-column").droppable({
                accept: ".kanban-item",
                drop: function(event, ui) {
                    $(this).append(ui.draggable);
                    $(ui.draggable).css({
                        top: 0,
                        left: 0
                    });
                    var columnTitle = $(this).find(".kanban-header h3").text();
                    var chatId = ui.draggable.attr('id').replace('kanban-item-', '');
                    console.log("Moved chat (ID: " + chatId + ") to column: " + columnTitle);
                    // Almacena el movimiento en el array
                    movements.push({
                        column: columnTitle,
                        chatId: chatId
                    });
                    // Guarda los movimientos en las cookies
                    saveMovementsToCookies();
                    console.log(movements);
                }
            });

            // Función para actualizar los campos ocultos con la información de los movimientos
            function updateHiddenFields() {
                // Reinicia los valores de los campos ocultos
                $('#movedToColumn').val('');
                $('#chat_id_kamban').val('');
                // Recorre el array de movimientos y actualiza los campos ocultos con cada movimiento
                movements.forEach(function(movement) {
                    $('#movedToColumn').val($('#movedToColumn').val() + movement.column + ',');
                    $('#chat_id_kamban').val($('#chat_id_kamban').val() + movement.chatId + ',');
                });
            }

            // Función para guardar los movimientos en las cookies
            function saveMovementsToCookies() {
                // Convertir el array de movimientos a una cadena JSON
                var movementsString = JSON.stringify(movements);
                // Guardar la cadena JSON en una cookie llamada 'kanbanMovements'
                document.cookie = "kanbanMovements=" + movementsString + "; expires=Fri, 31 Dec 9999 23:59:59 GMT";
            }

            // Función para cargar los movimientos desde las cookies
            function loadMovementsFromCookies() {
                // Obtener el valor de la cookie 'kanbanMovements'
                var cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)kanbanMovements\s*\=\s*([^;]*).*$)|^.*$/, "$1");
                // Si la cookie existe y tiene un valor
                if (cookieValue) {
                    // Convertir la cadena JSON a un array de movimientos
                    movements = JSON.parse(cookieValue);
                    // Recorrer los movimientos y mover los chats a las columnas correspondientes
                    movements.forEach(function(movement) {
                        var columnTitle = movement.column;
                        var chatId = movement.chatId;
                        // Mover el chat a la columna correspondiente
                        var $chatItem = $('#kanban-item-' + chatId);
                        var $targetColumn = $('#' + columnTitle.toLowerCase().replace(' ', '-'));
                        $targetColumn.append($chatItem);
                    });
                }
            }

            // Cargar los movimientos desde las cookies al cargar la página
            loadMovementsFromCookies();
        });
    </script>

    <script>
        $(document).ready(function() {
            lhinst.attachTabNavigator();
            $('#tabs a:first').tab('show');
            $('#check-all-items').change(function() {
                if ($(this).is(':checked')) {
                    $('input[name="ChatID[]"]').attr('checked', 'checked');
                } else {
                    $('input[name="ChatID[]"]').removeAttr('checked');
                }
                updateDeleteArchiveUI();
            });

            function updateDeleteArchiveUI() {
                let lengthChecked = $('input[name="ChatID[]"]:checked').length;
                if (lengthChecked == 0) {
                    $('#delete-selected-btn').prop('disabled', true);
                } else {
                    $('#delete-selected-btn').prop('disabled', false);
                }
                $('#delete-selected').text(lengthChecked);
            };
            $('input[name="ChatID[]"]').change(updateDeleteArchiveUI);
        });
    </script>