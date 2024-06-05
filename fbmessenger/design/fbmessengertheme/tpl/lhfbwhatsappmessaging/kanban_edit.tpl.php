<style>
    .tarjeta {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        padding: 20px;
        text-align: center;
        width: 400px;
        margin: 0 auto;
        /* Centra horizontalmente */
    }

    .tarjeta input[type="text"],
    .tarjeta input[type="submit"],
    .tarjeta select {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .tarjeta label {
        text-align: left;
        display: block;
        margin-bottom: 5px;
    }

    /* Estilo para el select */
    .tarjeta select {
        width: 100%;
        /* Hacer que el select ocupe todo el ancho */
        padding: 10px;
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>

<div class="tarjeta">
    <form method="POST" action="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/kanban_edit') ?>">
        <label for="nombre"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Name'); ?></label>
        <input type="text" id="name_status" name="name_status" value="<?php print_r($status->nombre) ?>" required><br>
        <label for="color">Color</label>
        <input type="hidden" id="status_edit" name="status_edit" value="<?php echo $_GET['status_id']; ?>"><br>
        <input type="color" id="color" name="color" value="<?php print_r($status->color); ?>"><br>
        <button type="submit" class="btn btn-warning"><span class="material-icons">edit</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Edit'); ?></button>
    </form>
</div>