<style>
.table-space {
    padding-bottom: 20px; /* Modifier cette valeur en fonction de l'espace dont vous avez besoin */
    border-bottom: none; /* Retirer la bordure en bas */
}
</style>

<table id="<?= $config["config"]["id"] ?>" class="table table-striped table-hover <?= $config["config"]["class"] ?> table-space">
    <thead>
        <tr>
            <?php foreach ($config["headers"] as $key => $header): ?>
                <th><?= $header ?></th>
            <?php endforeach; ?>
            <?php if(!empty($config["actions"])): ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php 
        $actionColors = [
            "update" => "btn-primary",
            "delete" => "btn-danger",
            "publish" => "btn-success",
            "approve" => "btn-warning",
            "signal" => "btn-danger",
            "unpublish" => "btn-warning",
            // ajoutez plus d'actions si nécessaire
        ];
        foreach ($config["data"] as $user): ?>
            <tr>
                <?php foreach ($config["body"] as $key => $value): ?>
                    <td><?= $user->{"get".ucfirst($value)}() ?></td>  <!-- Utilisation des méthodes d'accès -->
                <?php endforeach; ?>
                <?php if(!empty($config["actions"])): ?>
                    <td>
                        <?php foreach ($config["actions"] as $action => $url): ?>
                            <a href="<?= $url . $user->getId() ?>" class="btn <?= $actionColors[$action] ?>"><?= ucfirst($action) ?></a> <!-- Suppose que vous avez une méthode getId() -->
                        <?php endforeach; ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script> $(document).ready(function() {
        $("<?= "#" . $config["config"]["id"] ?>").DataTable({
            ordering: false,
            paging: false,
            info: false,
        });
    });</script> 
