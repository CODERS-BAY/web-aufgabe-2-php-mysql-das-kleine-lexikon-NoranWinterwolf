<div class="table-responsive" id="lexikon-table">
    <table class="table table-striped table-default">
        <thead>
            <th>Id</th>
            <th>Eintrag-Titel</th>
            <th>Edit</th>
            <th>L&ouml;schen</th>
        </thead>
        <tbody>
            <?php
            include("../inc/login.inc.php");
            $result = $con->query("SELECT id, title FROM content ORDER BY id ASC");
            while ($entry = $result->fetch_assoc()) {
                // if (mb_detect_encoding($entry['title']) != 'UTF-8' || 'ASCII') {
                //     $entry['title'] = utf8_encode($entry['title']);
                // }
            ?>

                <tr>
                    <td><?php echo $entry['id']; ?></td>
                    <td><?php echo $entry['title']; ?></td>
                    <td>
                        <button type="button" class="card-title btn btn-secondary edit_data" name="edit" value="Edit" data-toggle="modal" id="<?php echo $entry['id']; ?>">
                            Bearbeiten
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="card-title btn-danger btn delete_data" name="delete" value="L&ouml;schen" data-toggle="modal" id="<?php echo $entry['id']; ?>">
                            L&ouml;schen
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php }
            $con->close(); ?>
        </tbody>
    </table>
</div>