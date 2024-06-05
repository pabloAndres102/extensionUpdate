<style>
table {
  border-collapse: collapse;
  width: 100%; /* Ensure table fills available width */
  margin-top: 1rem; /* Add some space after the heading */
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
  border-radius: 5px; /* Rounded corners for a more polished look */
}

th,
td {
  padding: 12px 16px; /* Increase padding for better readability */
  text-align: left;
  border-bottom: 1px solid #ddd; /* Maintain bottom border */
}

th {
  background-color: #f2f2f2;
  font-weight: bold; /* Emphasize headers */
}

/* Action Column Styling (Improved) */
.action-column {
  display: flex; /* Arrange action buttons horizontally */
  justify-content: space-between; /* Distribute buttons evenly */
  align-items: center; /* Vertically align buttons with cell content */
}

.action-column button {
  margin-left: 5px; /* Add spacing between buttons */
}

/* Button Styles */
.btn {
  padding: 5px 10px; /* Adjust button padding for consistency */
  border: none;
  border-radius: 3px; /* Rounded corners for buttons */
  cursor: pointer;
}

.btn-primary {
  background-color: #007bff;
  color: #fff;
}

.btn-danger {
  background-color: #dc3545;
  color: #fff;
}

.btn-warning {
  background-color: #ffc107;
  color: #212529;
}
</style>


<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Kanban status'); ?></h1>
<a href="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/kanban_new'); ?>" class="btn btn-primary"><span class="material-icons">description</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Create'); ?></a>
<br>
<table>
  <thead>
    <tr>
      <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'ID'); ?></th>
      <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Name'); ?></th>
      <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Color'); ?></th>
      <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Acciones'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($status as $row) : ?>
      <tr>
        <td><?php echo $row->id; ?></td>
        <td><?php echo $row->nombre; ?></td>
        <td><?php echo $row->color; ?></td>
        <td>
            <form method="post" action="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/kanban_delete') ?>" onsubmit="return confirm('Esta acción es irreversible, ¿desea eliminar la plantilla? ');">
              <input type="hidden" name="status_id" value="<?php echo htmlspecialchars_decode($row->id); ?>">
              <button type="submit" class="btn btn-danger"><span class="material-icons">delete</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Delete'); ?></button>
            </form>
          <form method="update" action="<?php echo erLhcoreClassDesign::baseurl('fbwhatsappmessaging/kanban_edit') ?>">
            <input type="hidden" name="status_id" value="<?php echo htmlspecialchars_decode($row->id); ?>">
            <button type="submit" class="btn btn-warning"><span class="material-icons">equalizer</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/fbmessenger', 'Edit'); ?></button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>