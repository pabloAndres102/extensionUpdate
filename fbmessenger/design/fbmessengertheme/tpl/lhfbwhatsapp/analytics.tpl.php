<small><mark>Demo for tests</mark></small>
<form method="post" action="" onsubmit="return validateForm();">
    <label for="start">Fecha de inicio:</label>
    <input type="date" name="start" id="start" required>
    <br><br>
    <label for="end">Fecha de fin:</label>
    <input type="date" name="end" id="end" required>
    <br><br>
    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Sender Phone'); ?></label>
    <select name="phone_number" id="phone_number" class="form-control form-control-sm" title="display_phone_number | verified_name | code_verification_status | quality_rating">
        <?php foreach ($phones as $phone) : ?>
            <option value="<?php echo $phone['display_phone_number'] ?>">
                <?php echo $phone['display_phone_number'], ' | ', $phone['verified_name'], ' | ', $phone['code_verification_status'], ' | ', $phone['quality_rating'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>
    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Granularity'); ?></label>
    <select name="granularity" id="granularity" class="form-control form-control-sm">
        <?php
        $granularities = ['DAILY', 'HALF_HOUR', 'MONTHLY'];
        foreach ($granularities as $granularity) : ?>
            <option value="<?php echo $granularity ?>">
                <?php echo $granularity?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>
    <input type="submit" value="Return">
</form>

<?php

if (isset($data)) {
    // Obtén los datos y ordénalos por fecha
    $data_points = $data['conversation_analytics']['data'][0]['data_points'];
    usort($data_points, function ($a, $b) {
        return $a['start'] - $b['start'];
    });
 
?>


    <!-- Agrega dos inputs para las fechas -->



    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <table>
        <thead>
            <tr>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Conversación</th>
                <th>Número de teléfono</th>
                <th>País</th>
                <th>Tipo de conversación</th>
                <th>Categoría de conversación</th>
                <th>Costo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_points as $data_point) : ?>
                <tr>
                    <td><?php echo date('Y-m-d', $data_point['start']); ?></td>
                    <td><?php echo date('Y-m-d', $data_point['end']); ?></td>
                    <td><?php echo $data_point['conversation']; ?></td>
                    <td><?php echo $data_point['phone_number']; ?></td>
                    <td><?php echo $data_point['country']; ?></td>
                    <td><?php echo $data_point['conversation_type']; ?></td>
                    <td><?php echo $data_point['conversation_category']; ?></td>
                    <td><?php echo $data_point['cost']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php
}
?>

<script>
    function validateForm() {
        var startDate = new Date(document.getElementById('start').value);
        var endDate = new Date(document.getElementById('end').value);

        if (endDate < startDate) {
            alert("La fecha de fin no puede ser anterior a la fecha de inicio.");
            return false; // Evita el envío del formulario
        }

        return true; // Permite el envío del formulario si las fechas son válidas
    }
</script>

