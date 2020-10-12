<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custom.css">
    <title>Web-PhP-Übung</title>
</head>

<body class="pt-5">
    <?php include("inc/loggedNav.inc.php"); ?>
    <div class="container bg-light py-2 my-lg-5">
        <h1 class="container rounded-lg shadow py-2 my-2 bg-secondary border border-dark">Der Wolf</h1>

        <article class="container my-5">
            <p>Der Wolf (Canis lupus) ist rezent das größte Raubtier aus der Familie der Hunde (Canidae). Wölfe leben meist in Familienverbänden, fachsprachlich Rudel genannt.
                Hauptbeute sind in den meisten Regionen mittelgroße bis große Huftiere. Die Art war seit dem späten Pleistozän in mehreren Unterarten in ganz Europa,
                weiten Teilen Asiens, einschließlich der Arabischen Halbinsel und Japan, und in Nordamerika verbreitet.
            </p>
            <p>Wölfe wurden in Mitteleuropa ab dem 15. Jahrhundert systematisch verfolgt,
                im 19. Jahrhundert waren sie in nahezu allen Regionen ihres weltweiten Verbreitungsgebiets vor allem durch menschliche Bejagung stark dezimiert und in West- und Mitteleuropa fast sowie in Japan vollständig ausgerottet.
                Seit Ende des 20. Jahrhunderts steht der Wolf in vielen Ländern unter Schutz, die Bestände erholen sich dort trotz häufiger illegaler Verfolgung.
                In etlichen anderen Ländern, unter anderem im Nahen Osten, aber auch in Teilen Europas, besteht für den Wolf kein gesetzlicher Schutz. Wölfe gelten heute als eine Schlüsselart.
                In Deutschland wurde im Jahr 2000 erstmals wieder die Geburt von Welpen nachgewiesen, seitdem steigt die Anzahl der Wölfe und Wolfsrudel auch in anderen Teilen Mittel- und Nordeuropas wieder an.
                Im Erfassungszeitraum 2018/19 wurden in Deutschland 105 Rudel, 25 Paare und 13 territoriale Einzeltiere registriert; damit gab es insgesamt 143 Wolfsterritorien.
            </p>
            <p>Wölfe zählen zu den bekanntesten Raubtieren; sie haben frühzeitig Eingang in die Mythen und Märchen vieler Völker gefunden.
                Sie sind zudem die Stammform aller Haushunde und des sekundär wilden Dingos.
            </p>
        </article>

        <section class="container">
            <div class="card-columns">
                <?php
                include('inc/login.inc.php');
                $result = $con->query("SELECT id, title, teaser, imgpath FROM content");
                //var_dump($result);
                while ($entry = $result->fetch_assoc()) {

                ?>

                    <!-- Card Anfang -->
                    <div class="card shadow" id="id<?php echo $entry['id']; ?>">
                        <?php if ($entry['imgpath']) { ?>
                            <img src="upload-img/<?php echo $entry['imgpath']; ?>" class="card-img blur" alt="...">
                        <?php } ?>
                        <div class="card-body">
                            <!-- Button trigger modal -->
                            <button type="button" class="card-title btn btn-secondary btn-lg shadow ajaxModal" data-toggle="modal" data-id="<?php echo $entry['id']; ?>">
                                <h5><?php echo $entry['title']; ?></h5>
                            </button>
                            <p class="card-text teaser">
                                <?php echo $entry['teaser']; ?>
                            </p>
                        </div>
                    </div>
                    <!-- Card Ende -->

                <?php
                }
                $con->close();
                ?>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="lexikon-entry" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Info Ende -->
        </section>
        <section class="container">
            <!-- Modal registry -->
            <div class="modal fade" tabindex="-1" role="dialog" id="registry">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="auth/registry.php?register=1" method="post">
                                <div class="form-group d-flex justify-content-between">
                                    <label for="username">Username:</label>
                                    <input type="text" size="30" maxlength="250" name="username" id="username" require>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <label for="firstname">Vorname:</label>
                                    <input type="text" size="30" maxlength="250" name="firstname" id="firstname" require>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <label for="lastname">Nachname:</label>
                                    <input type="text" size="30" maxlength="250" name="lastname" id="lastname" require>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <label for="email">E-Mail-Adresse:</label>
                                    <input type="email" size="30" maxlength="250" name="email" id="email" require>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <label for="password">Passwort:</label>
                                    <input type="password" size="30" maxlength="250" name="password" id="password" require>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <label for="password2">Passwort wiederholen:</label>
                                    <input type="password" size="30" maxlength="250" name="password2" id="password2" require>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info">Registrieren</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            $('.ajaxModal').click(function() {

                var lexikonID = $(this).data('id');

                //Ajax request
                $.ajax({
                    url: './inc/loadModal.inc.php',
                    type: 'post',
                    data: {
                        lexikonID: lexikonID
                    },
                    success: function(response) {
                        //Add response in Modal body
                        $('.modal-content').html(response);
                        console.log(response);
                        // Display Modal
                        $('#showModal').modal('show');
                    }
                });
            });
        });
    </script>
</body>

</html>