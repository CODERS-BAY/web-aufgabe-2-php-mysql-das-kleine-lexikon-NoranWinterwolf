<!DOCTYPE html>
<html lang="de">
<?php
//include auth.php to all secure pages
include("auth.php");
define('SECURE', true);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
</head>

<body>
    <?php include('../inc/loggedNav.inc.php'); ?>
    <section class="container px-5 pt-3 mt-5 bg-light">
        <!-- data-table for all entrys -->
        <?php include('../auth/dataTable.inc.php'); ?>
    </section>

    <!-- Edit-Content Modal -->
    <div class="modal fade" id="editEntry" tabindex="-1" role="dialog" areaLabeledby="editModalLabel" area-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Eintrag "<span id="entryTitle"></span>" bearbeiten</h5>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_form">
                        <div class="form-group">
                            <label for="title">Titel</label>
                            <input type="text" name="title" id="title" class="form-control">
                            <input name="entry_id" type="hidden" id="entry_id">
                        </div>
                        <div class="form-group">
                            <label for="teaser">Teaser</label>
                            <textarea name="teaser" id="teaser" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Beschreibung</label>
                            <textarea name="description" id="description" class="form-control" rows="10"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <img src="" class="img-fluid text-center" id="imgOld" alt="No Image">
                        </div>
                        <div class="form-group">
                            <label for="imgUpdate">Neues Bild</label>
                            <input type="file" class="form-control-file" name="imgUpdate" id="imgUpdate">
                        </div>
                        <button type="button" class="btn btn-success" name="insert" id="insert">Insert</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Content Modal END -->
    <!-- DELETE MODAL -->
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span id="entryTitleDelete"></span> L&ouml;schen</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p id="titleDelete"></p>
                    <img class="img-fluid" id="imgDelete" alt="No Image"></img>
                    <p id="descriptionDelete"></p>
                    <p id="teaserDelete"></p>

                </div>
                <form method="post" id="delete_form">
                    <input type="hidden" id="deleteIMG" name="deleteIMG">
                    <input type="hidden" id="entryDelete_id" name="entry_id">
                    <button class="btn btn-danger btn-lg ml-2" type="button" name="delete" id="delete">L&ouml;schen</button>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!-- DELETE MODAL END -->

    <section class="container py-3 bg-light" id="lexikon">
        <!-- Button trigger modal -->
        <div class="container">
            <div class="ribbon-fold"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEntry">
                    <i class="fas fa-plus"></i> Eintrag hinzuf&uuml;gen
                </button></div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addEntry" tabindex="-1" role="dialog" areaLabeledby="exampleModalLabel" area-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Neuer Eintrag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="../inc/saveEntry.inc.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Titel (max 30 Zeichen)</label>
                                <input type="text" class="form-control" name="title" require>
                            </div>
                            <div class="form-group">
                                <label for="teaser">Teaser (max 30 Zeichen)</label>
                                <textarea class="form-control" rows="3" name="teaser" require></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Beschreibung (max 30 Zeichen)</label>
                                <textarea class="form-control" rows="3" name="description" require></textarea>
                            </div>
                            <div class="form-group">
                                <label for="fileUpload">File Upload</label>
                                <input type="file" class="form-control-file" name="fileUpload">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Speichern</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit_data', function() {
                var entry_id = $(this).attr("id");
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {
                        entry_id: entry_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#entryTitle').html(data.title);
                        $('#title').val(data.title);
                        $('#teaser').val(data.teaser);
                        $('#description').val(data.description);
                        $('#entry_id').val(data.id);
                        $('#imgOld').attr("src", '../upload-img/' + data.imgpath);
                        $('#insert').val("Update");
                        $('#editEntry').modal('show');
                    },
                    error: function(req, err) {
                        console.log('my message ' + err);
                    }
                });
            });
            $(document).on('click', '#insert', function(e) {
                e.preventDefault();
                var form = $('#insert_form')[0];
                var formData = new FormData(form);
                console.log(form);
                if ($('#title').val() == "") {
                    alert("Bitte einen Namen eingeben!");
                } else if ($('#teaser').val == "") {
                    alert("Der Beitrag benötigt eine Zusammenfassung.");
                } else if ($('#description').val == "") {
                    alert("Es wird eine Beschreibung benötigt!");
                } else {
                    $.ajax({
                        url: 'insert.php',
                        type: 'POST',
                        data: formData,
                        enctype: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        dataType: 'html',
                        success: function(data) {
                            $('#insert_form')[0].reset();
                            $('#editEntry').modal('hide');
                            $('#lexikon-table').html(data);
                        }
                    });
                }
            });
            $(document).on('click', '.delete_data', function() {
                var entryDelete_id = $(this).attr("id");
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {
                        entry_id: entryDelete_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#entryTitleDelete').html(data.title);
                        $('#titleDelete').html(data.title);
                        $('#teaserDelete').html(data.teaser);
                        $('#descriptionDelete').html(data.description);
                        $('#imgDelete').attr('src', '../upload-img/' + data.imgpath);
                        $('#deleteIMG').val(data.imgpath);
                        $('#entryDelete_id').val(data.id);
                        $('#delete').html("Eintrag L&ouml;schen");
                        $('#deleteModal').modal('show');
                    },
                    error: function(req, err) {
                        console.log('my message ' + err);
                    }
                });
            });
            $(document).on('click', '#delete_form', function(event) {
                event.preventDefault();

                $.ajax({
                    url: "delete.php",
                    method: 'POST',
                    data: $('#delete_form').serialize(),
                    beforeSend: function() {
                        $('#delete').val("Deleting");
                    },
                    success: function(data) {
                        $('#delete_form')[0].reset();
                        $('#deleteModal').modal('hide');
                        $('#lexikon-table').html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>