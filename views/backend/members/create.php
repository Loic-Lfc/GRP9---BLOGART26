<?php
include '../../../header.php';

$statuts = sql_select("STATUT", "*", "numStat");
$numStat = sql_select("STATUT", "numStat", "numStat");

?>

<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création nouveau membre</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
            <form action="<?php echo ROOT_URL . '/api/members/create.php' ?>" method="post">
                <div class="form-group">
                    <label for="pseudoMemb">Pseudo du membre</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text" autofocus="autofocus"
                        required />
                </div>

                <div class="form-group">
                    <label for="passMemb">Mot de passe du membre</label>
                    <input id="passMemb" name="passMemb" class="form-control" type="text" autofocus="autofocus" />
                </div>

                <div class="form-group">
                    <label for="nomMemb">Nom du membre</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" autofocus="autofocus" />
                </div>

                <div class="form-group">
                    <label for="prenomMemb">Prénom du membre</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" autofocus="autofocus" />
                </div>

                <div class="form-group">
                    <label for="eMailMemb">Email du membre</label>
                    <input id="eMailMemb" name="eMailMemb" class="form-control" type="text" autofocus="autofocus" />
                </div>

                <div class="form-group">
                    <label for="dtCreaMemb">Date de création du membre</label>
                    <input id="dtCreaMemb" name="dtCreaMemb" class="form-control" type="datetime-local"
                        autofocus="autofocus" />
                </div>

                <div class="form-group">
                    <label for="dtMajMemb">Date de mise à jour du membre</label>
                    <input id="dtMajMemb" name="dtMajMemb" class="form-control" type="datetime-local"
                        autofocus="autofocus" />
                </div>

                <div class="form-group mt-3">
                    <label for="numStat">Statut</label>
                    <select name="numStat" id="numStat" class="form-control" required>
                        <?php foreach ($statuts as $statut): ?>
                            <option value="<?php echo $statut['numStat']; ?>" <?php echo ($statut['numStat'] == $numStat) ? 'selected' : ''; ?>>
                                <?php echo $statut['libStat']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-success">Confirmer create ?</button>
                </div>
            </form>
        </div>
    </div>
</div>