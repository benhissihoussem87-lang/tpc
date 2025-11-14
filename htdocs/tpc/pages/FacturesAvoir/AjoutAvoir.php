<?php
include_once 'class/Avoir.class.php';
include_once 'class/client.class.php';
include_once 'class/Factures.class.php';

$clients  = $clt->getAllClients();
$factures = $facture->AfficherFactures();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSaveAvoir'])) {
    $id_client  = (int)($_POST['id_client'] ?? 0);
    $date_avoir = trim($_POST['date_avoir'] ?? '');
    $num_fact   = trim($_POST['num_fact'] ?? '');
    $num_avoir  = trim($_POST['num_avoir'] ?? '');
    $mat_fisc   = trim($_POST['matriculeFiscale'] ?? '');
    $total_ht   = (float)($_POST['total_ht'] ?? 0);
    $tva_pct    = (float)($_POST['tva_pct'] ?? 19);
    $total_tva  = round($total_ht * ($tva_pct/100), 3);
    $total_ttc  = round($total_ht + $total_tva, 3);

    if ($id_client <= 0) $errors[] = 'Client requis';
    if ($date_avoir === '') $errors[] = 'Date requise';
    if ($num_avoir === '') { $num_avoir = $avoir->nextNumber(); }

    // Fallback: ensure matricule is pulled from client if not posted
    if ($mat_fisc === '' && $id_client > 0) {
        $clientRow = $clt->getClient($id_client);
        if ($clientRow && !empty($clientRow['matriculeFiscale'])) {
            $mat_fisc = $clientRow['matriculeFiscale'];
        }
    }

    if (!$errors) {
        $ok = $avoir->create([
            'num_avoir'        => $num_avoir,
            'num_fact'         => ($num_fact !== '' ? $num_fact : null),
            'id_client'        => $id_client,
            'date_avoir'       => $date_avoir,
            'total_ht'         => $total_ht,
            'total_tva'        => $total_tva,
            'total_ttc'        => $total_ttc,
            'matriculeFiscale' => ($mat_fisc !== '' ? $mat_fisc : null),
        ]);
        if ($ok) {
            echo "<script>document.location.href='main.php?Avoir'</script>";
            exit;
        } else {
            $errors[] = "Erreur d'enregistrement";
        }
    }
}
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Ajouter Avoir</h6>
  </div>
  <div class="card-body">
    <?php if (!empty($errors)) { echo '<div class="alert alert-danger">'.implode('<br>', array_map('htmlspecialchars', $errors)).'</div>'; } ?>
    <form method="post">
      <div class="row">
        <div class="col-md-3 mb-3">
          <label>Num Avoir</label>
          <input type="text" name="num_avoir" class="form-control" value="<?= htmlspecialchars($avoir->nextNumber()) ?>" readonly />
        </div>
        <div class="col-md-3 mb-3">
          <label>Date</label>
          <input type="date" name="date_avoir" class="form-control" value="<?= date('Y-m-d') ?>" required />
        </div>
        <div class="col-md-6 mb-3">
          <label>Client</label>
          <input type="text" class="form-control mb-2" id="client_filter" placeholder="Rechercher client..."/>
          <select class="form-control" name="id_client" id="id_client_select" required>
            <option value="">-- choisir --</option>
            <?php foreach ($clients as $c) { ?>
              <option value="<?= (int)$c['id'] ?>" data-mf="<?= htmlspecialchars($c['matriculeFiscale'] ?? '') ?>" data-search="<?= htmlspecialchars(($c['nom_client'] ?? '').' '.($c['adresse'] ?? '').' '.($c['matriculeFiscale'] ?? '')) ?>"><?= htmlspecialchars($c['nom_client']) ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label>Choisir Facture (optionnel)</label>
          <input type="text" class="form-control mb-2" id="facture_filter" placeholder="Rechercher facture..."/>
          <select class="form-control" name="num_fact" id="num_fact_select">
            <option value="">-- aucune --</option>
            <?php if (!empty($factures)) { foreach ($factures as $f) { ?>
              <option value="<?= htmlspecialchars($f['num_fact']) ?>" data-search="<?= htmlspecialchars($f['num_fact'].' '.($f['nom_client'] ?? '').' '.($f['date'] ?? '')) ?>"><?= htmlspecialchars($f['num_fact']) ?> — <?= htmlspecialchars($f['nom_client'] ?? '') ?> (<?= htmlspecialchars($f['date'] ?? '') ?>)</option>
            <?php }} ?>
          </select>
        </div>
        <input type="hidden" name="matriculeFiscale" id="matriculeFiscale" value="" />
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label>Total HT</label>
          <input type="number" step="0.001" name="total_ht" id="total_ht" class="form-control" value="0.000" />
        </div>
        <div class="col-md-4 mb-3">
          <label>TVA (%)</label>
          <input type="number" step="0.01" name="tva_pct" id="tva_pct" class="form-control" value="19" />
        </div>
        <div class="col-md-4 mb-3">
          <label>Total TVA (calculé)</label>
          <input type="number" step="0.001" name="total_tva" id="total_tva" class="form-control" value="0.000" readonly />
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label>Total TTC (calculé)</label>
          <input type="number" step="0.001" name="total_ttc" id="total_ttc" class="form-control" value="0.000" readonly />
        </div>
      </div>

      <div class="text-right">
        <button type="submit" name="btnSaveAvoir" class="btn btn-primary">Enregistrer</button>
        <a href="?Avoir" class="btn btn-secondary">Annuler</a>
      </div>
    </form>
  </div>
</div>

<script>
  (function(){
    function filterSelect(inputId, selectId){
      const search = document.getElementById(inputId);
      const sel = document.getElementById(selectId);
      if (!search || !sel) return;
      search.addEventListener('input', () => {
        const q = search.value.toLowerCase();
        Array.from(sel.options).forEach(opt => {
          if (!opt.value) { opt.hidden = false; return; }
          const hay = (opt.getAttribute('data-search') || opt.textContent).toLowerCase();
          opt.hidden = q !== '' && !hay.includes(q);
        });
      });
    }
    filterSelect('client_filter','id_client_select');
    filterSelect('facture_filter','num_fact_select');

    function recalc(){
      const ht = parseFloat(document.getElementById('total_ht').value)||0;
      const pct = parseFloat(document.getElementById('tva_pct').value)||0;
      const tva = +(ht * (pct/100)).toFixed(3);
      const ttc = +(ht + tva).toFixed(3);
      document.getElementById('total_tva').value = tva.toFixed(3);
      document.getElementById('total_ttc').value = ttc.toFixed(3);
    }
    ['total_ht','tva_pct'].forEach(id=>{
      const el = document.getElementById(id);
      if (el) el.addEventListener('input', recalc);
    });
    recalc();

    const selClient = document.getElementById('id_client_select');
    const mf = document.getElementById('matriculeFiscale');
    if (selClient && mf){
      selClient.addEventListener('change', () => {
        const opt = selClient.options[selClient.selectedIndex];
        if (opt) mf.value = opt.getAttribute('data-mf') || '';
      });
    }
  })();
</script>
