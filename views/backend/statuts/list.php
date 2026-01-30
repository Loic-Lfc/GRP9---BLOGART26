<?php
$pageTitle = "Gestion des Statuts";
$pageIcon = "fas fa-toggle-on";
include '../header-admin.php';

//Load all statuts
$statuts = sql_select("STATUT", "*");
?>

<div class="mb-3">
    <a href="create.php" class="btn-cartoon-sm">
        <i class="fas fa-plus me-2"></i>Créer un statut
    </a>
</div>

<div class="table-responsive bg-white p-3" style="border-radius: var(--radius-sm); box-shadow: var(--shadow); border: 1px solid var(--color-accent);">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom des statuts</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($statuts)): ?>
                <tr>
                    <td colspan="3" class="text-center py-5">
                        <i class="fas fa-inbox fa-3x mb-3" style="color: var(--color-gray); opacity: 0.3;"></i>
                        <p class="text-muted">Aucun statut disponible</p>
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach($statuts as $statut): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($statut['numStat']); ?></td>
                        <td><?php echo htmlspecialchars($statut['libStat']); ?></td>
                        <td class="text-end">
                            <a href="edit.php?numStat=<?php echo $statut['numStat']; ?>" class="btn-cartoon-outline-sm me-2">
                                <i class="fas fa-edit me-1"></i>Modifier
                            </a>
                            <a href="delete.php?numStat=<?php echo $statut['numStat']; ?>" class="btn-cartoon-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce statut ?');">
                                <i class="fas fa-trash me-1"></i>Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../footer-admin.php'; ?>