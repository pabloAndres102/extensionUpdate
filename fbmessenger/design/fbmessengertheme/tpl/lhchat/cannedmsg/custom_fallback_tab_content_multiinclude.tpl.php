<div role="tabpanel" class="tab-pane" id="main-extension-fb">
    <div class="form-group">
        <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Message');?></label>
        <textarea class="form-control" name="MessageExtFB" ng-non-bindable><?php echo isset($canned_message->additional_data_array['message_fb']) ? $canned_message->additional_data_array['message_fb'] : '';?></textarea>
    </div>
    <div class="form-group">
        <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger','Fallback message');?></label>
        <textarea class="form-control" name="FallbackMessageExtFB" ng-non-bindable><?php echo isset($canned_message->additional_data_array['fallback_fb']) ? $canned_message->additional_data_array['fallback_fb'] : '';?></textarea>
    </div>
</div>