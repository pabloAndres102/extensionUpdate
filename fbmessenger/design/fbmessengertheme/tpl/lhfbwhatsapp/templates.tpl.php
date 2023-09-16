<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Templates'); ?></h1>
    <a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/create'); ?>" class="btn btn-primary">Crear</a> <br> <br>
    <?php
    // Comprueba si hay un mensaje de éxito en la variable de sesión
    if (isset($_SESSION['delete_template_message'])) {
        echo '<div class="alert alert-success">' . $_SESSION['delete_template_message'] . '</div>';
        // Elimina el mensaje de éxito de la variable de sesión para que no se muestre nuevamente después de la recarga
        unset($_SESSION['delete_template_message']);
    }

    // Comprueba si hay un mensaje de error en la variable de sesión
    if (isset($_SESSION['delete_template_error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['delete_template_error'] . '</div>';
        // Elimina el mensaje de error de la variable de sesión para que no se muestre nuevamente después de la recarga
        unset($_SESSION['delete_template_error']);
    }

    if (isset($_SESSION['api_error'])) {
        $apiError = $_SESSION['api_error'];
        echo '<div class="alert alert-danger">' . $apiError['error']['error_user_msg'] . '</div>';
        unset($_SESSION['api_error']);
    }
    
    if (isset($_SESSION['api_response'])) {
        $apiResponse = $_SESSION['api_response'];
        
        // Accede a campos específicos del JSON
        $id = $apiResponse['id'];
        $status = $apiResponse['status'];
        $category = $apiResponse['category'];
    
        // Mapea los valores de status a representaciones en español
        $statusMap = array(
            'PENDING' => 'PENDIENTE',
            'APPROVED' => 'APROBADA',
            'REJECTED' => 'RECHAZADA'
        );
        $categoryMap = array(
            'MARKETING' => 'MARKETING',
            'UTILITY' => 'UTILIDAD',
            'AUTHENTICATION' => 'AUTENTICACIÓN'
        );

        if (array_key_exists($category, $categoryMap)) {
            $categoryLegible = $categoryMap[$category];
        } else {
            $categoryLegible = $category; // Si no está en el mapa, muestra el valor original
        }
    
        // Verifica si el valor de status está en el mapa
        if (array_key_exists($status, $statusMap)) {
            $statusLegible = $statusMap[$status];
        } else {
            $statusLegible = $status; // Si no está en el mapa, muestra el valor original
        }
    
        echo '<div class="alert alert-success">';
        echo '<h4>Su plantilla se ha creado con éxito</h4>';
        echo '<div class="response-details">';
        echo '<p><strong>ID de plantilla:</strong> ' . $id . '</p>';
        echo '<p><strong>Estado:</strong> ' . $statusLegible . '</p>';
        echo '<p><strong>Categoría:</strong> ' . $categoryLegible  . '</p>';
        echo '</div>';
        echo '</div>'; // Cierra div class="alert alert-success"
        
        unset($_SESSION['api_response']);
    }
    ?>

    <table class="table table-sm" ng-non-bindable>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Idioma</th>
                <th>Estado</th>
                <th>Categoría</th>
                <th>Componentes</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Lista de nombres de plantillas a excluir
            $excludedTemplates = array(
                'sample_purchase_feedback',
                'sample_issue_resolution',
                'sample_flight_confirmation',
                'sample_shipping_confirmation',
                'sample_happy_hour_announcement',
                'sample_movie_ticket_confirmation'
            );

            foreach ($templates as $template) : 
                // Verifica si el nombre de la plantilla está en la lista de exclusiones
                if (!in_array($template['name'], $excludedTemplates)):
            ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($template['name']) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($template['language']) ?>
                        </td>
                        <td>
                            <?php
                            $status = htmlspecialchars($template['status']);
                            if ($status == 'APPROVED') {
                                echo '<span style="color: green;">APROBADA</span>';
                            } elseif ($status == 'PENDING') {
                                echo '<span style="color: red;">PENDIENTE</span>';
                            } elseif ($status == 'REJECTED') {
                                echo '<span style="color: red;">RECHAZADA</span>';
                            } else {
                                echo htmlspecialchars($template['status']);
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $category = htmlspecialchars($template['category']);
                            // Mostrar categorías en mayúsculas y en español
                            if ($category == 'MARKETING') {
                                echo 'MARKETING';
                            } elseif ($category == 'UTILITY') {
                                echo 'UTILIDAD';
                            } elseif ($category == 'AUTHENTICATION') {
                                echo 'AUTENTICACIÓN';
                            } else {
                                echo $category; // Mostrar categoría original si no coincide con las categorías hardcoded
                            }
                            ?>
                        </td>
                        <td>
                            <textarea class="form-control form-control-sm fs12"><?php echo htmlspecialchars(json_encode($template['components'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?></textarea>
                        </td>
                        <td>
                            <form method="post" action="<?php echo erLhcoreClassDesign::baseurl('fbwhatsapp/delete') ?>" onsubmit="return confirm('Esta acción es irreversible, ¿desea eliminar la plantilla? ');">
                                <input type="hidden" name="template_name" value="<?php echo htmlspecialchars_decode($template['name']); ?>">
                                <button type="submit" class="btn btn-danger">Borrar</button>
                            </form>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
