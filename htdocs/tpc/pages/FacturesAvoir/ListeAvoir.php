<?php
include_once 'class/Avoir.class.php';

// Delete action
if (isset($_GET['Delete'])) {
    $id = (int)$_GET['Delete'];
    if ($avoir->delete($id)) {
        echo "<script>document.location.href='main.php?Avoir'</script>";
        exit;
    }
}

$list = $avoir->getAll();
?>

<div class="card shadow mb-4">
  <div style="width:100%;text-align:center" class="col-12">
    <a href="?Avoir&Add" class="btn btn-primary active" style="position:relative; top:20px;">Ajouter Avoir</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Num Avoir</th>
            <th>Date</th>
            <th>Client</th>
            <th>Facture Ref</th>
            <th>Total HT</th>
            <th>Total TVA</th>
            <th>Total TTC</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php if (!empty($list)) { foreach ($list as $row) { ?>
          <tr>
            <td><?= htmlspecialchars($row['num_avoir']) ?></td>
            <td><?= htmlspecialchars($row['date_avoir']) ?></td>
            <td><?= htmlspecialchars($row['nom_client']) ?></td>
            <td><?= htmlspecialchars($row['num_fact'] ?? '') ?></td>
            <td><?= number_format((float)$row['total_ht'],3,'.','') ?></td>
            <td><?= number_format((float)$row['total_tva'],3,'.','') ?></td>
            <td><?= number_format((float)$row['total_ttc'],3,'.','') ?></td>
            <td style="white-space:nowrap">
              <a class="btn btn-sm btn-warning" href="?Avoir&Modifier&id=<?= (int)$row['id'] ?>">Modifier</a>
              <a class="btn btn-sm btn-success" href="?Avoir&View&id=<?= (int)$row['id'] ?>">Imprimer</a>
              <a class="btn btn-sm btn-danger" href="?Avoir&Delete=<?= (int)$row['id'] ?>" onclick="return confirm('Supprimer cet avoir ?');">Supprimer</a>
            </td>
          </tr>
        <?php }} ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
