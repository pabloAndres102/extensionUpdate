(function() {
    // Función para ocultar campos y etiquetas según su nombre
    function hideFields() {
        $('#arguments-template-form input, #arguments-template-form select, #arguments-template-form textarea').each(function() {
            var fieldName = $(this).attr('name');
            if (fieldName.indexOf('field_header_img_') !== -1 || fieldName.indexOf('field_header_video_') !== -1) {
                $(this).hide(); // Oculta el campo
                // También oculta la etiqueta asociada al campo
                $(this).closest('.form-group').find('label').hide();
            }
        });
    }

    $('#template-to-send').change(function() {
        $.postJSON(WWW_DIR_JAVASCRIPT + '/fbwhatsapp/rendersend/' + $(this).val() + (typeof businessAccountId !== 'undefined' ? '/' + businessAccountId : ''), {'data': JSON.stringify(messageFieldsValues)}, function(data) {
            $('#arguments-template').html(data.preview);
            $('#arguments-template-form').html(data.form);

            // Llama a la función para ocultar campos y etiquetas después de cargar el formulario
            hideFields();
        });
    });

    if ($('#template-to-send').val() != '') {
        $.postJSON(WWW_DIR_JAVASCRIPT + '/fbwhatsapp/rendersend/' + $('#template-to-send').val() + (typeof businessAccountId !== 'undefined' ? '/' + businessAccountId : ''), {'data': JSON.stringify(messageFieldsValues)}, function(data) {
            $('#arguments-template').html(data.preview);
            $('#arguments-template-form').html(data.form);

            // Llama a la función para ocultar campos y etiquetas después de cargar el formulario
            hideFields();
        });
    }

    $('#id_business_account_id').change(function(){
        businessAccountId = $(this).val();
        $('#arguments-template').html('');
        $('#arguments-template-form').html('');
        $('#template-to-send').html('<option>Loading...</option>');
        $('#id_phone_sender_id').html('<option>Loading...</option>');
        $.postJSON(WWW_DIR_JAVASCRIPT + '/fbwhatsapp/rendertemplates/' +businessAccountId, function(data) {
            $('#template-to-send').html(data.templates);
            $('#id_phone_sender_id').html(data.phones);

            // Llama a la función para ocultar campos y etiquetas después de cargar el formulario
            hideFields();
        });
    });
})();
