<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/query/connect.php';
require_once '../../functions/query/select.php';
require_once '../../functions/query/delete.php';

sql_connect();

$numArt = isset($_POST['numArt']) ? intval($_POST['numArt']) : 0;

if ($numArt > 0) {
    $article = sql_select("ARTICLE", "urlPhotArt", "numArt = $numArt");

    if (!empty($article)) {
        try {
            sql_delete('LIKEART', "numArt = " . $numArt);
            sql_delete('COMMENT', "numArt = " . $numArt);
            sql_delete('MOTCLEARTICLE', "numArt = " . $numArt);

            sql_delete('ARTICLE', "numArt = " . $numArt);

            $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/' . $article[0]['urlPhotArt'];
            if (!empty($article[0]['urlPhotArt']) && file_exists($imagePath)) {
                unlink($imagePath);
            }

            header('Location: ../../views/backend/articles/list.php?success=1');
        } catch (Exception $e) {
            header('Location: ../../views/backend/articles/delete.php?numArt=' . $numArt . '&error=sql_error');
        }
    } else {
        header('Location: ../../views/backend/articles/list.php?error=not_found');
    }
} else {
    header('Location: ../../views/backend/articles/list.php?error=invalid_id');
}
exit();
?>
