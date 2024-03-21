<?php
$contacts = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContact::getList();
$phonesArray = [];
foreach ($contacts as $contact) {
	$phonesArray[] = $contact->phone;
}

$items = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContact::getList(['filter' => ['phone' => $chat->phone]]);


?>
<?php foreach ($items as $item) {
	$id_telefono = $item->id;
} ?>

<div role="tabpanel">
	<ul class="nav nav-underline mb-1 border-bottom nav-small nav-fill" role="tablist" id="chat-tab-items-<?php echo $chat->id ?>">
		<?php include(erLhcoreClassDesign::designtpl('lhchat/chat_tabs/tabs_order.tpl.php')); ?>

		<?php
		/**
		 * We cannot use some key => tpl here because we want template compilator to compile everything to single tpl file
		 * */
		foreach ($chatTabsOrder as $tabItem) : ?>
			<?php if ($tabItem == 'information_tab_tab') : ?>
				<?php include(erLhcoreClassDesign::designtpl('lhchat/chat_tabs/information_tab_tab.tpl.php')); ?>
			<?php elseif ($tabItem == 'private_chat_tab') : ?>
				<?php include(erLhcoreClassDesign::designtpl('lhchat/chat_tabs/private_chat_tab.tpl.php')); ?>
			<?php elseif ($tabItem == 'operator_remarks_tab') : ?>
				<?php include(erLhcoreClassDesign::designtpl('lhchat/chat_tabs/operator_remarks_tab.tpl.php')); ?>
			<?php elseif ($tabItem == 'extension_chat_tab_multiinclude') : ?>
				<?php include(erLhcoreClassDesign::designtpl('lhchat/chat_tabs/extension_chat_tab_multiinclude.tpl.php')); ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>


	<div class="tab-content">
		<?php include(erLhcoreClassDesign::designtpl('lhchat/chat_tabs/information_tab.tpl.php')); ?>


		<td>

			<button class="btn btn-success" onclick="return lhc.revealModal({
    																		'iframe': true,
    																		'height': 600,
    																		'url': '<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/send'); ?>?phone=<?php echo urlencode($chat->phone); ?>'
																			})">
				<span class="material-icons">Send</span>
				<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Send whatsapp template'); ?>
			</button>
			<br><br>

			<?php if (!in_array($chat->phone, $phonesArray)) : ?>
				<button class="btn btn-success" href="#" onclick="return lhc.revealModal({'title' : 'Import', 'height':350, backdrop:true, 'url':'<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/newmailingrecipient') ?>/?contact=<?php echo $chat->phone ?>'})">
					<span class="material-icons">add</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Add manual contact'); ?>
				</button><br><br>
			<?php else : ?>
				<button class="btn btn-success" href="#" onclick="return lhc.revealModal({'title' : 'Import', 'height':350, backdrop:true, 'url':'<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/editmailingrecipient') ?>/?id=<?php echo $id_telefono ?>'})">
					<span class="material-icons">edit</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Edit'); ?>
				</button>
				<?php
				$contacto = LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContact::getList(['filter' => ['phone' => $chat->phone]]);

				foreach ($contacto as $i) {
					$id_contacto = $i->id;
					$listas = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContactList::getList();
					$relaciones = \LiveHelperChatExtension\fbmessenger\providers\erLhcoreClassModelMessageFBWhatsAppContactListContact::getList(['filter' => ['contact_id' => $id_contacto]]);
					if (!empty($relaciones)) {
						foreach ($listas as $lista) {
							foreach ($relaciones as $relacion) {
								if ($relacion->contact_list_id == $lista->id) {
									echo '<strong>';
									echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Contact list').': ';
									echo '</strong>';
									echo '<mark>';
									echo $lista->name;
									echo '</mark>';
								}
							}
						}
					}else{
						echo '<mark>';
						print_r(erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Contact without list'));
						echo '</mark>';
					}
				}

				?>
			<?php endif ?>
		</td>


		</td>
		<?php include(erLhcoreClassDesign::designtpl('lhchat/chat_tabs/private_chat.tpl.php')); ?>
		<?php include(erLhcoreClassDesign::designtpl('lhchat/chat_tabs/operator_remarks_tab_content.tpl.php')); ?>
		<?php include(erLhcoreClassDesign::designtpl('lhchat/chat_tabs/extension_chat_tab_content_multiinclude.tpl.php')); ?>
	</div>
</div>

<?php include(erLhcoreClassDesign::designtpl('lhchat/chat_tabs/extension_post_chat_tabs_conatiner_multiinclude.tpl.php')); ?>