<?php
include_once 'class/Avoir.class.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$info = $id > 0 ? $avoir->getById($id) : null;
if (!$info) {
    echo '<div class="alert alert-danger">Avoir introuvable.</div>';
    return;
}

// Safe defaults and mapping to the template inputs
$infosAvoir = [
    'num_avoir'       => $info['num_avoir'],
    'num_fact'        => $info['num_fact'],
    'facture_ref'     => ($info['num_fact'] ? 'FACTURE N°'. $info['num_fact'] : ''),
    'nom_client'      => $info['nom_client'],
    'adresse'         => $info['adresse'] ?? '',
    'matriculeFiscale'=> ($info['mf_avoir'] ?? '') ?: ($info['mf_client'] ?? ''),
    'code'            => 'DAS-ACH-04',
    'ir'              => '00',
];

$date = date('d/m/Y', strtotime($info['date_avoir']));

// Rows source: if bound to a facture, we can emit a single summary line
$ProjetsAvoir = [
    [
        'designation' => 'AVOIR SUR '. ($info['num_fact'] ? ('FACTURE '.$info['num_fact']) : 'OPÉRATION'),
        'qte' => 1,
        'pu'  => (float)$info['total_ht'],
    ],
];

if (!function_exists('asLetters')) {
  function asLetters($number,$separateur=".") {
    $convert = explode($separateur, (string)$number);
    $num17 = array('zero','un','deux','trois','quatre','cinq','six','sept','huit','neuf','dix','onze','douze','treize','quatorze','quinze','seize');
    $num100= array(20=>'vingt',30=>'trente',40=>'quarante',50=>'cinquante',60=>'soixante',70=>'soixante-dix',80=>'quatre-vingt',90=>'quatre-vingt-dix');
    if (isset($convert[1]) && $convert[1] !== '') {
      $dinars = (int)$convert[0];
      $mills  = (int)$convert[1];
      $dinTxt = asLetters((string)$dinars);
      $milTxt = $mills !== 0 ? asLetters((string)$mills) : asLetters('0');
      if ($mills !== 0) return trim($dinTxt.' dinars et '.$milTxt.' millimes');
      else              return trim($dinTxt.' dinars '.$milTxt.' millimes');
    }
    $n = (int)$number;
    if ($n < 0)  return 'moins '.asLetters(-$n);
    if ($n < 17) return $num17[$n];
    if ($n < 20) return 'dix-'.asLetters($n-10);
    if ($n < 100) {
      if ($n % 10 == 0) return $num100[$n];
      if (substr((string)$n,-1) == '1') {
        if(((int)($n/10)*10) < 70) return asLetters((int)($n/10)*10).'-et-un';
        elseif ($n==71) return 'soixante-et-onze';
        elseif ($n==81) return 'quatre-vingt-un';
        elseif ($n==91) return 'quatre-vingt-onze';
      }
      if ($n < 70) return asLetters($n-$n%10).'-'.asLetters($n%10);
      if ($n < 80) return asLetters(60).'-'.asLetters($n%20);
      return asLetters(80).'-'.asLetters($n%20);
    }
    if ($n == 100) return 'cent';
    if ($n < 200)  return asLetters(100).' '.asLetters($n%100);
    if ($n < 1000) return asLetters((int)($n/100)).' '.asLetters(100).($n%100>0?' '.asLetters($n%100):'');
    if ($n == 1000) return 'mille';
    if ($n < 2000)  return asLetters(1000).' '.asLetters($n%1000).' ';
    if ($n < 1000000) return asLetters((int)($n/1000)).' '.asLetters(1000).($n%1000>0?' '.asLetters($n%1000):'');
    if ($n == 1000000) return 'millions';
    if ($n < 2000000)  return asLetters(1000000).' '.asLetters($n%1000000);
    if ($n < 1000000000) return asLetters((int)($n/1000000)).' '.asLetters(1000000).($n%1000000>0?' '.asLetters($n%1000000):'');
    return (string)$n;
  }
}

// Compute totals like the provided A4 template
$rows = !empty($ProjetsAvoir) ? $ProjetsAvoir : [
  ['designation' => 'description de la facture', 'qte'=>1, 'pu'=>2200.000]
];

$totalHT = 0.0;
ob_start();
foreach ($rows as $r){
  $q  = $r['qte'] ?? '';
  $pu = $r['pu']  ?? '';
  $pth = (is_numeric($q) && is_numeric($pu)) ? (float)$q * (float)$pu : 0.0;
  $totalHT += $pth;
  $desc = $r['designation'] ?? '';
  echo '<tr class="item-row">';
  echo '<td class="desc" contenteditable="true">'.htmlspecialchars($desc).'</td>';
  echo '<td class="t-center" contenteditable="true">'.htmlspecialchars($q).'</td>';
  echo '<td class="t-center" contenteditable="true">'.htmlspecialchars(number_format((float)$pu,3,'.','')).'</td>';
  echo '<td class="t-right" contenteditable="true">'.htmlspecialchars(number_format($pth,3,'.','')).'</td>';
  echo '</tr>';
}
$serverRenderedRows = trim(ob_get_clean());

$tva_rate = 0.19;
$tva      = round($totalHT * $tva_rate, 3);
$ttc      = round($totalHT + $tva, 3);
$txt_sum  = asLetters(number_format($ttc,3,'.',''));

// Override totals with DB if present (>0) to keep consistency
if ((float)$info['total_ttc'] > 0) {
    $totalHT = (float)$info['total_ht'];
    $tva     = (float)$info['total_tva'];
    $ttc     = (float)$info['total_ttc'];
}

// Extra print CSS to hide the app layout (sidebar/navbar) when printing
?>
<style>
@media print{
  #accordionSidebar, .sidebar, .navbar, .scroll-to-top{ display:none !important }
  #content-wrapper{ margin:0 !important }
  body,html{ background:#fff !important }
}
</style>

<?php
// Reuse the provided A4 print module content (without duplicating <html>/<body>)
$avoir_no    = $infosAvoir['num_avoir'] ?? ($infosAvoir['num_fact'] ?? '');
$facture_ref = $infosAvoir['facture_ref'] ?? '';
$client_name = $infosAvoir['nom_client'] ?? '';
$client_addr = $infosAvoir['adresse'] ?? '';
$mat_fisc    = $infosAvoir['matriculeFiscale'] ?? '';
$codeDoc     = $infosAvoir['code'] ?? 'DAS-ACH-04';
$irDoc       = $infosAvoir['ir']   ?? '00';
?>

<div id="controls"><button id="printBtn" onclick="window.print()">Imprimer</button></div>
<div class="sheets" id="sheets"></div>

<template id="tpl-header">
  <div class="header-card">
    <div class="header-cell logo">
      <div class="pad"><img src="assets/images/logo.png" alt="TPC"></div>
    </div>
    <div class="header-cell title">
      <h1 class="doc-title" contenteditable="true">FACTURE AVOIR <?= htmlspecialchars($avoir_no) ?></h1>
    </div>
    <div class="header-cell meta">
      <div class="meta-pad">
        <div class="meta-card">
          <div class="meta-row"><div class="meta-label">Code :</div><div contenteditable="true"><?= htmlspecialchars($codeDoc) ?></div></div>
          <div class="meta-row"><div class="meta-label">I.R :</div><div contenteditable="true"><?= htmlspecialchars($irDoc) ?></div></div>
          <div class="meta-row"><div class="meta-label">D.E :</div><div contenteditable="true">xx/xx/xx<?= date('y') ?></div></div>
          <div class="meta-row"><div class="meta-label">Page :</div><div><span class="page-i">1</span> / <span class="page-n">1</span></div></div>
        </div>
      </div>
    </div>
  </div>
</template>

<template id="tpl-info">
  <div class="info-card">
    <div class="info-grid">
      <div><b>Facture :</b> <span contenteditable="true"><?= htmlspecialchars($facture_ref) ?></span></div>
      <div><b>Date :</b> <span contenteditable="true"><?= htmlspecialchars($date) ?></span></div>
      <div><b>Client :</b> <span contenteditable="true"><?= htmlspecialchars($client_name) ?></span></div>
      <div class="wide"><b>Adresse :</b> <span contenteditable="true"><?= htmlspecialchars($client_addr) ?></span></div>
      <div class="wide"><b>Matricule Fiscale :</b> <span contenteditable="true"><?= htmlspecialchars($mat_fisc) ?></span></div>
    </div>
  </div>
</template>

<template id="tpl-table">
  <div class="table-wrap">
    <table class="invoice-table">
      <thead>
        <tr>
          <th class="col-desc">DESCRIPTION</th>
          <th class="col-qte t-center">QTE</th>
          <th class="col-puh t-center">P.U. H.T</th>
          <th class="col-pth t-center">P.T. H.T</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</template>

<template id="tpl-totals">
  <div class="totals">
    <div class="labels">
      <div>TOTAL H.T</div>
      <div>T.V.A </div>
      <div>T.T.C</div>
    </div>
    <div class="values">
      <div><?= number_format($totalHT,3,'.','') ?></div>
      <div><?= number_format($tva,3,'.','') ?></div>
      <div><?= number_format($ttc,3,'.','') ?></div>
    </div>
  </div>
</template>

<template id="tpl-amount">
  <div class="amount-letters">
    Arrêtée la présente facture à la somme de :
    <span class="line" contenteditable="true"><?= htmlspecialchars($txt_sum) ?></span>
  </div>
</template>

<template id="tpl-signature">
  <div class="signature">
    <div class="sig-note">MERCI DE VOTRE CONFIANCE — LA DIRECTION — T.P.C</div>
    <div class="sig-pad">Signature / Visa / Cachet</div>
  </div>
</template>

<template id="tpl-legal">
  <div class="legal">
    <div class="cols">
      <div>
        <p contenteditable="true">
          Veuillez rédiger tous les chèques à l'ordre de <b>TUNISIA POLYCONTROLS</b>.<br>
          Pour toute question concernant cette facture, veuillez nous contacter par e-mail:
          <b>tunisia.polycontrols.tpc@gmail.com</b>.<br>
          Veuillez rédiger les virements au nom de <b>T.P.C</b> sur le <b>RIB N° 14 305 305 1017 00061 8 08</b>
        </p>
      </div>
      <div>
        <p contenteditable="true">
          <b>T.P.C : TUNISIA POLYCONTROLS S.A.R.L</b> au capital de 20.000 DT<br>
          Code TVA: 1426729 H/A/M/000 — R.C: B 2621285205<br>
          Siège Social : 5 Rue Benghazi, Bureau 4-5, 4<sup>ème</sup> étage - 1002 Tunis<br>
          Tél : 36 131 731 — GSM : 24 131 544
        </p>
      </div>
    </div>
    <div class="page-number">Page <span class="page-i">1</span> / <span class="page-n">1</span></div>
  </div>
</template>

<div id="rows-source" style="display:none">
  <table><tbody id="rows-body">
    <?= $serverRenderedRows !== '' ? $serverRenderedRows : '<tr><td colspan="4" class="t-center" contenteditable="true">Aucune ligne</td></tr>' ?>
  </tbody></table>
</div>

<script>
(function(){
  const sheetsRoot = document.getElementById('sheets');
  const rowsSrc    = Array.from(document.querySelectorAll('#rows-body > tr'));
  const EPS = 2;

  const createSheet = () => {
    const s = document.createElement('div');
    s.className = 'sheet';
    s.append( document.getElementById('tpl-header').content.cloneNode(true) );
    s.append( document.getElementById('tpl-info').content.cloneNode(true) );
    const tableFrag = document.getElementById('tpl-table').content.cloneNode(true);
    s.append(tableFrag);
    return s;
  };

  const getTBody = (sheet) => sheet.querySelector('tbody');
  const fits = (container, node) => {
    container.append(node);
    const sheet = container.closest('.sheet');
    const ok = (sheet.scrollHeight - sheet.clientHeight) <= EPS;
    if (!ok) node.remove();
    return ok;
  };

  const sheets = [];
  let sheet = createSheet();
  sheetsRoot.appendChild(sheet);
  sheets.push(sheet);

  for (const row of rowsSrc){
    const clone = row.cloneNode(true);
    if (!fits(getTBody(sheet), clone)){
      sheet = createSheet();
      sheetsRoot.appendChild(sheet);
      sheets.push(sheet);
      if (!fits(getTBody(sheet), clone)) getTBody(sheet).appendChild(clone);
    }
  }

  let last = sheets[sheets.length-1];
  for (const tplId of ['tpl-totals','tpl-amount','tpl-signature','tpl-legal']){
    const frag = document.getElementById(tplId).content.cloneNode(true);
    if (!fits(last, frag)){ last = createSheet(); sheetsRoot.appendChild(last); sheets.push(last); }
    last.append(frag);
  }

  const N = sheetsRoot.children.length;
  if (N === 1) document.body.classList.add('single-sheet');
  Array.from(sheetsRoot.children).forEach((s, idx)=>{
    const i = idx+1;
    s.querySelectorAll('.page-i').forEach(n=>n.textContent = String(i));
    s.querySelectorAll('.page-n').forEach(n=>n.textContent = String(N));
  });
})();
</script>

<style>
/* A4 sheet system (copied as in provided module) */
:root{ --sheet-w:210mm; --sheet-h:297mm; --pad:10mm; --gap:4mm; --font:Arial,Helvetica,sans-serif }
*{ box-sizing:border-box }
html,body{ background:#f6f6f6; margin:0; color:#111; font-family:var(--font) }
#controls{ position:sticky; top:0; z-index:999; background:#111; padding:8px 10px; text-align:right }
#printBtn{ appearance:none; border:0; padding:8px 14px; font-weight:700; cursor:pointer; border-radius:6px; background:#0b57d0; color:#fff }

.sheets{ width:var(--sheet-w); margin:12px auto }
.sheet{
  width:var(--sheet-w);
  min-height:var(--sheet-h);
  background:#fff; margin:0 auto 12px;
  box-shadow:0 2px 8px rgba(0,0,0,.1);
  position:relative; overflow:hidden;
  padding:var(--pad); display:flex; flex-direction:column; gap:var(--gap)
}

@media print{
  html,body{ background:#fff }
  @page{ size:A4; margin:0 }
  #controls{ display:none !important }
  .sheets{ margin:0 }
  .sheet{
    box-shadow:none;
    padding:9.5mm;
    margin:0 !important;
    min-height:auto !important;
    height:auto !important;
    break-inside:avoid; page-break-inside:avoid;
    -webkit-print-color-adjust:exact; print-color-adjust:exact;
  }
  .sheet + .sheet{ break-before:page; page-break-before:always; }
  .single-sheet .sheet{ break-before:auto !important; page-break-before:auto !important; }
}

.header-card{
  display:grid;
  grid-template-columns:46mm 1fr 62mm;  /* logo | title | meta */
  align-items:stretch;
  border:1px solid #000;
  background:#fff; /* no color to match other headers */
}
.header-cell.logo{
  padding:0;
  border-right:1px solid #000;
  align-self:stretch;
  display:flex;
}
.header-cell.logo .pad{
  padding:4mm;
  height:100%; width:100%;
  display:flex; align-items:center; justify-content:center;
}
.header-cell.logo img{ display:block; height:16mm; width:auto }
.header-cell.title{ padding:4mm; display:flex; align-items:center }
.header-cell.meta{
  padding:0;
  border-left:1px solid #000;
  align-self:stretch;
  display:flex;
}
.header-cell.meta .meta-pad{ padding:3mm; height:100%; width:100% }

.doc-title{ margin:0; text-transform:uppercase; font-weight:800; font-size:5mm; letter-spacing:.2mm }
.meta-card{ height:100%; display:grid; gap:2mm; background:#fff; font-size:3.2mm }
.meta-row{ display:grid; grid-template-columns:16mm 1fr; gap:2mm; line-height:1.2 }
.meta-label{ font-weight:700 }

.info-card{ border:1px solid #000; padding:4mm; background:#fff }
.info-grid{ display:grid; grid-template-columns:1fr 1fr 1fr; gap:2mm 10mm; font-size:3.4mm }
.info-grid .wide{ grid-column:1 / -1 }

.table-wrap{ width:100% }
.invoice-table{ width:100%; border-collapse:collapse; table-layout:fixed; background:#fff; border:1px solid #000 }
.invoice-table thead th{
  background:#f4f4f4; text-transform:uppercase; font-weight:700; font-size:3.2mm;
  border:1px solid #000; padding:2.2mm; line-height:1.2
}
.col-desc{ width:120mm }
.col-qte,.col-puh,.col-pth{ width:22mm }
.invoice-table td{
  border:1px solid #000; padding:2.2mm; font-size:3.2mm; line-height:1.35; vertical-align:top
}
.t-center{ text-align:center } .t-right{ text-align:right } .desc{ text-transform:uppercase; letter-spacing:.1mm }

.totals{
  margin-top:2mm;
  width:90mm;
  margin-left:auto;
  display:grid;
  grid-template-columns:1fr 38mm;
  gap:2mm;
  border:1px solid #000;
  background:#fff;
}
.totals .labels, .totals .values{ padding:2mm }
.totals .labels div, .totals .values div{ margin:1mm 0; font-size:3.2mm }
.totals .values div{ text-align:right }

.amount-letters{ margin-top:3mm; font-size:3.2mm }
.amount-letters .line{ display:inline-block; min-width:80mm; border-bottom:1px dashed #777; text-transform:uppercase }
.signature{ margin-top:3mm; display:flex; flex-direction:column; align-items:center }
.sig-note{ margin-bottom:2mm; font-weight:600; font-size:3mm; text-align:center }
.sig-pad{ border:1px dashed #666; height:26mm; width:90mm; background:#fafafa; display:flex; align-items:center; justify-content:center; font-size:3mm; color:#555 }

.legal{ border-top:1px solid #000; padding-top:3mm; font-size:3mm; margin-top:4mm }
.legal .cols{ display:grid; grid-template-columns:1fr 1fr; gap:10mm }
.legal p{ margin:2mm 0 }

.page-number{ font-size:3.2mm; text-align:right }
</style>
