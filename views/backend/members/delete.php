<?php
include '../../../header.php';

if (isset($_GET['numMemb'])) {
    $numMemb = $_GET['numMemb'];
    $membre = sql_select("MEMBRE", "*", "numMemb = $numMemb")[0];
    $nomMemb = $membre['nomMemb'];
    $prenomMemb = $membre['prenomMemb'];
    $pseudoMemb = $membre['pseudoMemb'];
    $emailMemb = $membre['eMailMemb'];
} ?>

<!-- Bootstrap form to delete a member -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
                <!-- Form to delete a member -->
            <h1>Suppression Membre</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/members/delete.php' ?>" method="post">
                <div class="form-group">
                    <label>Identité</label>
                    <input id="numMemb" name="numMemb" class="form-control"
                           style="display:none"
                           type="text"
                           value="<?php echo $numMemb; ?>"
                           readonly="readonly" />
                    <input class="form-control mb-2"
                           type="text"
                           value="Prénom : <?php echo $prenomMemb ?? ''; ?>"
                           disabled />
                    <input class="form-control mb-2"
                           type="text"
                           value="Nom : <?php echo $nomMemb ?? ''; ?>"
                           disabled />
                    <input class="form-control mb-2"
                           type="text"
                           value="Pseudo : <?php echo $pseudoMemb ?? ''; ?>"
                           disabled />
                    <input class="form-control"
                           type="text"
                           value="Email : <?php echo $emailMemb ?? ''; ?>"
                           disabled />
                </div>
                <br>
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-danger">
                        Confirmer delete ?
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>