<!doctype html>
<?php
$id = 1;
$id_user = 1;
if(!empty($_GET["id"])){
    $id = intval($_GET["id"]);
}
if(!empty($_GET["id_user"])){
    $id_user = intval($_GET["id_user"]);
}
include "db.php";
$db = new db();

$sql_faktura = "SELECT * FROM faktura WHERE id = $id";
$res_faktura = $db->select_query($sql_faktura);
$row = $res_faktura->fetch();//All();
$id = $row["id"];
$nummer = $row["nr"];
$kund_nr = $row["kund_nr"];
$datum = $row["datum"];
$bet_villkor = $row["bet_villkor"];
$forfallodatum = $row["forfallo_datum"];
$kommentarer = $row["kommentarer"];

//bet.villkor
$sql_bet_villk = "SELECT * FROM bet_villkor WHERE id = $bet_villkor";
$res_bet = $db->select_query($sql_bet_villk);
$row2 = $res_bet->fetch();
$bet_villkor = $row2["namn"];

//kund
$sql_kund = "SELECT * FROM kund WHERE id = $kund_nr";
$res_kund = $db->select_query($sql_kund);
$row3 = $res_kund->fetch();
$kund_foretag_namn = $row3["namn_foretag"];
$kund_person_namn = $row3["namn_person"];
$kund_adress1 = $row3["gatuadress"];
$kund_adress2 = $row3["postnummer"];
$kund_adress3 = $row3["postort"];
?>
<html>
<!--Layout från fakturan.nu-->
    <head>
        
<style>
.page, .flyleaf {
    display: flex;
    flex-direction: column;
    width: calc(90vw - 1px);
    height: calc(130vw - 1.4mm);
}

.page{
    width: 210mm;
}

dd, dt{
    display: inline-block;
}
dd{
    margin-inline-start: 20px;
}

dl {
  display: grid;
  grid-template-columns: max-content auto;
}

dt {
  grid-column-start: 1;
}

dd {
  grid-column-start: 2;
}

.container, .container-thin{
    display: inline-block;
    vertical-align: top;
}

table.invoice-content th{
    
}

table.invoice-content td, table.invoice-content th{
    border: 1px solid gray;
    text-align: right;
}

table.invoice-content td{
    text-wrap: normal;
    word-wrap: break-word;
}

tr.kommentarer td{
    padding-top:10px;
    font-style: italic;
}

@media print{
    .page,.flyleaf{
        padding:1.8rem 2rem
     }
}

</style>
</head>
<body>

<div class="page last-page">
<header>
<div class="title structure header">
    <div>
        <h1 class="company_name">Firma Valter Ekholm</h1>
    </div>
    <div>
        <h2>Faktura</h2>
    </div>
</div>
<div class="structure header">
    <div class="container">
        <div class="structure golden">
            <div>
                <dl class="row">
                <dt>Fakturanr</dt>
                <dd><?=$nummer?></dd>
                <dt>Kundnr</dt>
                <dd><?=$kund_nr?></dd>
                <dt>Fakturadatum</dt>
                <dd><?=$datum?></dd>
                <dt>Betalningsvillkor</dt>
                <dd><?=$bet_villkor?></dd>
                <dt>Förfallodatum</dt>
                <dd>
                <strong><?=$forfallodatum?></strong>
                </dd>
                </dl>
            </div>
            <div class="referals">
                <dl>
                    <dt>Vår referens</dt>
                    <dd></dd>
                </dl>
            </div>
        </div>
        <p>Efter förfallodagen debiteras ränta enligt räntelagen</p>
    </div>
    <div class="container container-thin">
    <header>
    <h3>Faktureringsadress</h3>
    <p>
        <strong>
            <?php
            if(!empty($kund_foretag_namn)){
                echo $kund_foretag_namn;
            }
            else{
                echo $kund_person_namn;
            }
            ?>
        </strong>
        <br>
        <?=$kund_adress1?>
        <br>
        <?=$kund_adress2?> <?=$kund_adress3?>
    </p>
</header>
</div>
</div>
</header>

<div class="content container container-thin" style="height: 449px;">
    <div class="page-splitted">
        <table class="invoice-content">
            <thead>
                <tr>
                    <th class="nowrap" width="30%">Produkt / tjänst</th>
                    <th width="40%"></th>
                    <th class="text-right" width="9%">Antal</th>
                    <th class="text-right">À-pris</th>
                    <th>Belopp</th>
                </tr>
            </thead>
            <?php
            //tjänster
            $sql_tjanst = "SELECT * FROM fakturapost_1 WHERE faktura_id = $id";
            $res_tjanst = $db->select_query($sql_tjanst);
            $rows = $res_tjanst->fetchAll();

            $summa_netto=0;
            $momser = array();
            ?>
            <tbody>

            <?php
            foreach($rows as $row_produkt){
            $produkt = $row_produkt["produkt"];
            $beskrivning = $row_produkt["beskrivning"];
            $antal = $row_produkt["antal"];
            $a_pris = $row_produkt["a_pris_kr"];
            $momssats_produkt = $row_produkt["moms_procent"];
            $kommentar_produkt = $row_produkt["kommentarer"];
            ?>
                <tr>
                    <td style=""><?=$produkt?></td><!----cell-width: 26.68%;-->
                    <td class="wrappable" style=""><?=$beskrivning?></td>
                    <td class="text-right nowrap" style="--cell-width: 12.016293279022404%;">
                    <?=$antal?>

                    </td>
                    <td class="nowrap text-right" style="--cell-width: 13.238289205702646%;"><?=$a_pris?>,00</td>
                    <td class="nowrap" style="--cell-width: 14.663951120162933%;"><?=$a_pris * $antal ?>,00</td>
                </tr>
<?php

$summa_netto += $a_pris*$antal;
$moms_produkt = ($a_pris*$antal * $momssats_produkt / 100);
$momser[]=$moms_produkt;

}


?>

<?php
//fritext rad?
$sql_textrad = "SELECT * FROM fakturapost_2 WHERE faktura_id = $id AND synlig > 0";
//echo $sql_textrad;
$res_textrad = $db->select_query($sql_textrad);
$rows_text = $res_textrad->fetchAll();

if(count($rows_text)>0){

    foreach($rows_text as $textrow){
        $text = $textrow["text"];
?>

<tr class="text">
<td colspan="5"><p><?=$text?></p></td>
</tr>

<?php
    }
}

//kommentar för faktura
?>

<tr class="kommentarer">
    <td colspan="5">
        <?=$kommentarer?>
    </td>
</tr>

<?php

//moms

$moms_summa = array_sum($momser);

//summa
$summa_att_betala = $summa_netto + $moms_summa;
?>

</tbody>
</table>
</div>
<div class="content-footer">
<!--div class="pagination">Sida <span class="current-page">1</span> av <span class="total-pages">2</span></div-->
<div class="sums">
<ul>
<li>
<div>Netto</div>
<div><?=$summa_netto?>,00 kr</div>
</li>
<li>
<div>Moms</div><!--Moms 25% (beräknad på 1 500,00 kr)-->
<div>
<?=str_replace(".",",", sprintf("%.2f", $moms_summa))?> kr
</div>
</li>
<li>
<div>Öresutjämning</div>
<div>0,00 kr</div>
</li>
</ul>
<div class="totals">
<h2><span class="sum-to-pay-text">Summa att betala:</span> <?=$summa_att_betala?> kr</h2>
</div>
</div>

</div>
</div>


<footer>
<?php
//foretag
$sql_foretag = "SELECT * FROM mitt_foretag WHERE id = $id_user";
$res_foretag = $db->select_query($sql_foretag);
$row_foretag = $res_foretag->fetch();
$foretag_namn = $row_foretag["namn"];
$foretag_adress_2 = $row_foretag["adress_2"];
$foretag_adress_3 = $row_foretag["adress_3"];
$foretag_tel = $row_foretag["telefon"];
$foretag_webbplats = $row_foretag["webbplats"];
$foretag_bic_swift = $row_foretag["bic/swift"];
$foretag_iban = $row_foretag["iban"];
$foretag_epost = $row_foretag["epost"];
//$foretag_namn = $row_foretag[""]
?>
<div class="container container-thin">
<div class="structure">
<div>
<dl>
<dt>Adress</dt>
<dd><?=$foretag_namn?></dd>
<dd></dd>
<dd></dd>
<dd>
<?=$foretag_adress_2?> <?=$foretag_adress_3?>
</dd>
<dt>BIC/SWIFT</dt>
<dd><?=$foretag_bic_swift?></dd>
</dl>
</div>
<div>
<dl>
<dt>Telefon</dt>
<dd><?=$foretag_tel?></dd>
<dt>IBAN</dt>
<dd><?=$foretag_iban?></dd>
</dl>
</div>
<div>
<dl>
<dt>Webbplats</dt>
<dd><?=$foretag_webbplats?></dd>
<dt>Företagets e-post</dt>
<dd><?=$foretag_epost?></dd>
</dl>
</div>
</div>
<div class="structure">
<p></p>
<p>Godkänd för F-skatt</p>
</div>
</div>
</footer>




</div>

</body>
