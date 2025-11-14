<?php
include_once 'class/Avoir.class.php';
include_once 'class/client.class.php';
include_once 'class/Factures.class.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$info = $id > 0 ? $avoir->getById($id) : null;
if (!$info) { echo '<div class="alert alert-danger">Avoir introuvable.</div>'; return; }

$clients  = $clt->getAllClients();
$factures = $facture->AfficherFactures();

// defaults from DB
$num_avoir   = $info['num_avoir'];
$date_avoir  = $info['date_avoir'];
$id_client   = (int)$info['id_client'];
$num_fact    = $info['num_fact'];
$total_ht    = (float)$info['total_ht'];
$total_tva   = (float)$info['total_tva'];
$total_ttc   = (float)$info['total_ttc'];
$mat_fisc_db = ($info['mf_avoir'] ?? '') ?: ($info['mf_client'] ?? '');
$tva_pct     = ($total_ht > 0) ? round(($total_tva / $total_ht) * 100, 2) : 19;

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdateAvoir'])) {
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
    if ($num_avoir === '') $errors[] = 'Num Avoir requis';

    // Ensure matricule from client if not posted
    if ($mat_fisc === '' && $id_client > 0) {
        $clientRow = $clt->getClient($id_client);
        if ($clientRow && !empty($clientRow['matriculeFiscale'])) {
            $mat_fisc = $clientRow['matriculeFiscale'];
        }
    }

    if (!$errors) {
        $ok = $avoir->update($id, [
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
            $errors[] = "Erreur de mise à jour";
        }
    }
}
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifier Avoir</h6>
  </div>
  <div class="card-body">
    <?php if (!empty($errors)) { echo '<div class="alert alert-danger">'.implode('<br>', array_map('htmlspecialchars', $errors)).'</div>'; } ?>
    <form method="post">
      <div class="row">
        <div class="col-md-3 mb-3">
          <label>Num Avoir</label>
          <input type="text" name="num_avoir" class="form-control" value="<?= htmlspecialchars($num_avoir) ?>" readonly />
        </div>
        <div class="col-md-3 mb-3">
          <label>Date</label>
          <input type="date" name="date_avoir" class="form-control" value="<?= htmlspecialchars($date_avoir) ?>" required />
        </div>
        <div class="col-md-6 mb-3">
          <label>Client</label>
          <input type="text" class="form-control mb-2" id="client_filter" placeholder="Rechercher client..."/>
          <select class="form-control" name="id_client" id="id_client_select" required>
            <option value="">-- choisir --</option>
            <?php foreach ($clients as $c) { $sel = ((int)$c['id'] === $id_client) ? 'selected' : ''; ?>
              <option value="<?= (int)$c['id'] ?>" <?= $sel ?> data-mf="<?= htmlspecialchars($c['matriculeFiscale'] ?? '') ?>" data-search="<?= htmlspecialchars(($c['nom_client'] ?? '').' '.($c['adresse'] ?? '').' '.($c['matriculeFiscale'] ?? '')) ?>"><?= htmlspecialchars($c['nom_client']) ?></option>
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
            <?php if (!empty($factures)) { foreach ($factures as $f) { $sel = ($f['num_fact'] == $num_fact) ? 'selected' : ''; ?>
              <option value="<?= htmlspecialchars($f['num_fact']) ?>" <?= $sel ?> data-search="<?= htmlspecialchars($f['num_fact'].' '.($f['nom_client'] ?? '').' '.($f['date'] ?? '')) ?>"><?= htmlspecialchars($f['num_fact']) ?> — <?= htmlspecialchars($f['nom_client'] ?? '') ?> (<?= htmlspecialchars($f['date'] ?? '') ?>)</option>
            <?php }} ?>
          </select>
          <input type="hidden" name="matriculeFiscale" id="matriculeFiscale" value="<?= htmlspecialchars($mat_fisc_db) ?>" />
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label>Total HT</label>
          <input type="number" step="0.001" name="total_ht" id="total_ht" class="form-control" value="<?= number_format($total_ht,3,'.','') ?>" />
        </div>
        <div class="col-md-4 mb-3">
          <label>TVA (%)</label>
          <input type="number" step="0.01" name="tva_pct" id="tva_pct" class="form-control" value="<?= htmlspecialchars($tva_pct) ?>" />
        </div>
        <div class="col-md-4 mb-3">
          <label>Total TVA (calculé)</label>
          <input type="number" step="0.001" name="total_tva" id="total_tva" class="form-control" value="<?= number_format($total_tva,3,'.','') ?>" readonly />
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label>Total TTC (calculé)</label>
          <input type="number" step="0.001" name="total_ttc" id="total_ttc" class="form-control" value="<?= number_format($total_ttc,3,'.','') ?>" readonly />
        </div>
      </div>

      <div class="text-right">
        <button type="submit" name="btnUpdateAvoir" class="btn btn-primary">Enregistrer</button>
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

