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


//bet.villkor
$sql_bet_villk = "SELECT * FROM bet_villkor WHERE id = $bet_villkor";
$res_bet = $db->select_query($sql_bet_villk);
$row2 = $res_bet->fetch();
$bet_villkor = $row2["namn"];
$antal_dagar_netto = $row2["antal_dagar_netto"];

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
        <style>@import url(&quot;https://fonts.googleapis.com/css?family=Roboto:400,500&quot;);@font-face{font-family:OCRB;font-style:normal;font-weight:normal;src:url(https://www.fakturan.nu/assets/ocr/OCRB-176e4cf0f6fb1043253f46028e6f32d3db9693108ebba7c5f8c743ba46afb3e8.woff2) format(&quot;woff2&quot;),url(https://www.fakturan.nu/assets/ocr/OCRB-bb63e8fa36e798546bbd118ab1135ca55caa0cfbbe4a455468304d6fc001f7b3.woff) format(&quot;woff&quot;)}@font-face{font-family:Helvetica;font-style:normal;font-weight:normal;src:url(https://www.fakturan.nu/assets/helvetica/helvetica-a4756f18df38a0c791b64a5d0c835bf46b94c7d02e07bfedfaa57574769d93fa.woff) format(&quot;woff&quot;),url(https://www.fakturan.nu/assets/helvetica/helvetica-ad5eb02d1cab82c072797b98e5b0fcfeddf7a92b2c64495ea9eb0a1c66f14c8e.woff2) format(&quot;woff2&quot;)}@font-face{font-family:Helvetica;font-style:normal;font-weight:bold;src:url(https://www.fakturan.nu/assets/helvetica/helvetica-bold-6c889223a4fad2bf5f1d23ed24f6493d72f2df6779cd8246462d5896fdbb19e0.woff) format(&quot;woff&quot;),url(https://www.fakturan.nu/assets/helvetica/helvetica-bold-9522eb5b67159e5069508ca60954a300e04aec860e91267d580ff4555ce59959.woff2) format(&quot;woff2&quot;)}@font-face{font-family:ProximaNova;font-style:normal;font-weight:normal;src:url(https://www.fakturan.nu/assets/proxima-nova/proxima-nova-regular-8a02077892d7b40eeff4c9c0c2393403038b09e6e80d99112bef42eb681d7bd6.woff2) format(&quot;woff2&quot;),url(https://www.fakturan.nu/assets/proxima-nova/proxima-nova-regular-cbf84deda771778cb35dbd8c66310dd65549cbc8aa66d00264fcf1c3ea73cbee.woff) format(&quot;woff&quot;)}@font-face{font-family:ProximaNova;font-style:normal;font-weight:bold;src:url(https://www.fakturan.nu/assets/proxima-nova/proxima-nova-bold-b5732b52c243a51757aa4504104e64ba2fb43b96299b2badfa5aa05b89615849.woff2) format(&quot;woff2&quot;),url(https://www.fakturan.nu/assets/proxima-nova/proxima-nova-bold-fc609d33d4c29c195f86e9f12ee1f076a6e0f0ee3004f0eeaa7748ff91866ada.woff) format(&quot;woff&quot;)}@font-face{font-family:Lato;font-style:normal;font-weight:normal;src:url(https://www.fakturan.nu/assets/lato/lato-regular-6340ab77496676e6bfc031f963c7ca297097186d5306477fe75f6385b366b4e6.woff2) format(&quot;woff2&quot;),url(https://www.fakturan.nu/assets/lato/lato-regular-5e5ff49b5169cb1a0649c084794ead30fe58ccb6aa54e6ee0ef160f6719d1fdb.woff) format(&quot;woff&quot;)}@font-face{font-family:Lato;font-style:normal;font-weight:bold;src:url(https://www.fakturan.nu/assets/lato/lato-bold-82fef11d0128009ba70eaa71853a616a3e1eb0828139fe56c6b3d92915de0409.woff2) format(&quot;woff2&quot;),url(https://www.fakturan.nu/assets/lato/lato-bold-d4731cb3b717a61f773cdcf7571307d3294ebb2d8c2e18eae4952ad247aa3d91.woff) format(&quot;woff&quot;)}/*! custom reset */table,tr,th,td{margin:0;padding:0;border:0;font-size:100%;vertical-align:baseline;word-break:break-word}ul,ol,dl{margin:0;padding:0;list-style-type:none}dl{display:flex;flex-flow:column}dl dt{font-weight:bold}dl dt:not(:first-of-type){margin-top:0.3125rem}dl dd{margin:0}dl:not(.row) dd{margin-top:0.25rem}dl.row{display:flex;flex-flow:row wrap}dl.row dt,dl.row dd{flex:1 0 auto;flex-basis:calc(50% - 0.3127rem)}dl.row dt{margin-right:0.625rem}dl.row dd{align-self:stretch}dl.row dt:not(:first-of-type),dl.row dd:not(:first-of-type){margin-top:0.25rem}a,a:visited{color:inherit;text-decoration:none;font-weight:bold}img{display:block}p{margin:1rem 0 0 0;padding:0}p.right{text-align:right}h1,h2,h3,h4,h5,h6{margin:0;padding:0;line-height:1.4em;font-weight:normal}h1,h2,h3{font-weight:bold}table{width:100%}.separate{justify-content:space-between}*{box-sizing:border-box}html{font-size:2.0vw}body{font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size:1.754385965vw;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;-moz-text-size-adjust:none;-ms-text-size-adjust:none;text-size-adjust:none;padding:0;margin:0;line-height:1.2}.page,.flyleaf{display:flex;flex-direction:column;width:calc(100vw - 1px);height:calc(141.43vw - 1.4mm);padding:2.375rem 4.25rem 4.25rem}.page>header,.page>footer,.page>.container,.flyleaf>header,.flyleaf>footer,.flyleaf>.container{flex-grow:0;flex-shrink:0;flex-basis:auto}.page>header .title,.flyleaf>header .title{display:flex;flex-flow:row nowrap;align-items:center;height:4.875rem;justify-content:space-between}.page>header .title div,.flyleaf>header .title div{flex:0 0 auto}.page>.content,.page>footer,.page>.container,.flyleaf>.content,.flyleaf>footer,.flyleaf>.container{margin-top:0.625rem}.page>.content,.flyleaf>.content{display:flex;flex-flow:column;flex-grow:1;flex-basis:13.5rem;align-self:stretch;justify-content:space-between;overflow:hidden}.page>.content>div,.flyleaf>.content>div{flex:0 0 auto}.page.not-last-page .sums,.flyleaf.not-last-page .sums{display:none}.page.not-last-page .iconic-payment-info,.flyleaf.not-last-page .iconic-payment-info{display:none}.sums,.pagination{margin-top:1.5625rem;text-align:right;vertical-align:bottom;flex:0 0 auto;align-self:stretch}.last-page .sums{margin-top:0}.sums{display:flex}.pagination{font-weight:bold;display:none}.not-last-page .pagination{display:block}.flyleaf{font-size:1rem}.flyleaf>header{display:flex;flex-wrap:wrap;justify-content:space-between}.return-address{flex:0 0 14.1875rem;margin-left:2.375rem;height:8.4375rem}.client-address{flex:0 0 18.1875rem;margin-top:5.9375rem;height:8.4375rem}.flyleaf-message{flex:1 0 37.8125rem;margin-left:2.375rem}.flyleaf-message p{margin:0}.container{padding:0.625rem;position:relative}.structure{display:flex;align-items:stretch}.structure:not(:first-child){margin-top:0.625rem}.structure>div{flex:1 1 auto}.structure>div:not(:first-child){margin-left:0.625rem}.structure.golden>div:first-child{width:66.67%}.structure.golden>div:last-child{width:33.33%}.invoice-content{border-spacing:0;border-collapse:separate}.invoice-content thead{font-weight:bold}.invoice-content td,.invoice-content th{padding:0.125rem 1em;vertical-align:top}.invoice-content td.nowrap,.invoice-content th.nowrap{white-space:nowrap}.invoice-content td.wrappable,.invoice-content th.wrappable{word-break:break-word;white-space:pre-wrap}.invoice-content td.text-right,.invoice-content th.text-right{text-align:right}.invoice-content th{text-align:left;white-space:nowrap}.invoice-content tr.text td{text-align:left;padding-top:0.25rem;padding-bottom:0.25rem}.invoice-content p{margin-top:0;margin-bottom:1rem;line-height:1.4em}.invoice-content p:last-child{margin-bottom:0}.invoice-content td:last-child,.invoice-content th:last-child{text-align:right}.invoice-content td{width:var(--cell-width);border:0px transparent}.new_payment_details{position:relative}.new_payment_details p{margin-top:0;margin-bottom:1rem}.has-flex-end{align-self:flex-end}.new_payment_details .attention{position:absolute;top:-0.5rem;right:-0.5rem;transform:rotate(0);padding:0.125rem 0.25rem;background:#C71300;color:#fff;border:0.25rem solid #C71300;border-radius:0.25rem;font-weight:bold;font-size:1.5rem;opacity:0.8;font-weight:bold}.new_payment_details .attention:before{content:&quot; &quot;;position:absolute;z-index:-1;top:-0.125rem;left:-0.125rem;right:-0.125rem;bottom:-0.125rem;border:0.125rem solid #fff;border-radius:0.25rem}.payee{font-size:0.7rem}.sums{flex:1 1 auto;margin-top:1rem;flex-flow:column;align-items:flex-end}.sums ul{display:table;flex:0 0 auto}.sums li{display:table-row;flex-flow:row nowrap;justify-content:flex-end}.sums li>div{width:auto;display:table-cell}.sums li>div:first-child::after{content:':';margin-right:1rem}.totals{margin-top:1rem;width:100%}.page>footer .structure{justify-content:space-between;flex-flow:row wrap}.page>footer .structure>div:not(:first-child),.page>footer .structure:not(:first-child){margin-left:0}.page>footer .structure>div{flex:0 1 auto;display:flex;flex-flow:row wrap;justify-content:space-between;overflow-wrap:break-word;word-wrap:break-word;-ms-word-break:break-all;word-break:break-word;-ms-hyphens:auto;-webkit-hyphens:auto;hyphens:auto}.page>footer .structure>div dl{width:100%}.container.ocr{padding:1rem}.container.ocr h4{font-size:0.6rem;margin-bottom:1.25rem}.container.ocr code{font-family:OCRB}.ad .structure{justify-content:flex-start}.ad .structure p{margin:0}.ad .structure div{display:flex;flex:1 1 auto;align-items:center}.ad .structure div:first-child{flex-grow:0;flex-shrink:0}.ad .structure div:nth-child(2){margin-left:1.875rem}.document-text .structure p,footer .structure p{margin:0}@media print{@page{margin:0}html,body{background-color:#fff}body{-webkit-print-color-adjust:exact}.page{background-color:#fff;box-shadow:none;margin:0 auto;-moz-column-break-after:always;break-after:always}}.emoji{display:inline-block}.column,.sums{display:block;flex-basis:0;flex-grow:1;flex-shrink:1;padding:0.75rem}.columns.is-mobile>.column.is-narrow,.columns>.column.is-narrow,.columns>.is-narrow.sums{flex:none}.columns.is-mobile>.column.is-full,.columns>.column.is-full,.columns>.is-full.sums{flex:none;width:100%}.columns.is-mobile>.column.is-three-quarters,.columns>.column.is-three-quarters,.columns>.is-three-quarters.sums{flex:none;width:75%}.columns.is-mobile>.column.is-two-thirds,.columns>.column.is-two-thirds,.columns>.is-two-thirds.sums{flex:none;width:66.6666%}.columns.is-mobile>.column.is-half,.columns>.column.is-half,.columns>.is-half.sums{flex:none;width:50%}.columns.is-mobile>.column.is-one-third,.columns>.column.is-one-third,.columns>.is-one-third.sums{flex:none;width:33.3333%}.columns.is-mobile>.column.is-one-quarter,.columns>.column.is-one-quarter,.columns>.is-one-quarter.sums{flex:none;width:25%}.columns.is-mobile>.column.is-offset-three-quarters,.columns>.column.is-offset-three-quarters,.columns>.is-offset-three-quarters.sums{margin-left:75%}.columns.is-mobile>.column.is-offset-two-thirds,.columns>.column.is-offset-two-thirds,.columns>.is-offset-two-thirds.sums{margin-left:66.6666%}.columns.is-mobile>.column.is-offset-half,.columns>.column.is-offset-half,.columns>.is-offset-half.sums{margin-left:50%}.columns.is-mobile>.column.is-offset-one-third,.columns>.column.is-offset-one-third,.columns>.is-offset-one-third.sums{margin-left:33.3333%}.columns.is-mobile>.column.is-offset-one-quarter,.columns>.column.is-offset-one-quarter,.columns>.is-offset-one-quarter.sums{margin-left:25%}.columns.is-mobile>.column.is-1,.columns>.column.is-1,.columns>.is-1.sums{flex:none;width:8.3333333333%}.columns.is-mobile>.column.is-offset-1,.columns>.column.is-offset-1,.columns>.is-offset-1.sums{margin-left:8.3333333333%}.columns.is-mobile>.column.is-2,.columns>.column.is-2,.columns>.is-2.sums{flex:none;width:16.6666666667%}.columns.is-mobile>.column.is-offset-2,.columns>.column.is-offset-2,.columns>.is-offset-2.sums{margin-left:16.6666666667%}.columns.is-mobile>.column.is-3,.columns>.column.is-3,.columns>.is-3.sums{flex:none;width:25%}.columns.is-mobile>.column.is-offset-3,.columns>.column.is-offset-3,.columns>.is-offset-3.sums{margin-left:25%}.columns.is-mobile>.column.is-4,.columns>.column.is-4,.columns>.is-4.sums{flex:none;width:33.3333333333%}.columns.is-mobile>.column.is-offset-4,.columns>.column.is-offset-4,.columns>.is-offset-4.sums{margin-left:33.3333333333%}.columns.is-mobile>.column.is-5,.columns>.column.is-5,.columns>.is-5.sums{flex:none;width:41.6666666667%}.columns.is-mobile>.column.is-offset-5,.columns>.column.is-offset-5,.columns>.is-offset-5.sums{margin-left:41.6666666667%}.columns.is-mobile>.column.is-6,.columns>.column.is-6,.columns>.is-6.sums{flex:none;width:50%}.columns.is-mobile>.column.is-offset-6,.columns>.column.is-offset-6,.columns>.is-offset-6.sums{margin-left:50%}.columns.is-mobile>.column.is-7,.columns>.column.is-7,.columns>.is-7.sums{flex:none;width:58.3333333333%}.columns.is-mobile>.column.is-offset-7,.columns>.column.is-offset-7,.columns>.is-offset-7.sums{margin-left:58.3333333333%}.columns.is-mobile>.column.is-8,.columns>.column.is-8,.columns>.is-8.sums{flex:none;width:66.6666666667%}.columns.is-mobile>.column.is-offset-8,.columns>.column.is-offset-8,.columns>.is-offset-8.sums{margin-left:66.6666666667%}.columns.is-mobile>.column.is-9,.columns>.column.is-9,.columns>.is-9.sums{flex:none;width:75%}.columns.is-mobile>.column.is-offset-9,.columns>.column.is-offset-9,.columns>.is-offset-9.sums{margin-left:75%}.columns.is-mobile>.column.is-10,.columns>.column.is-10,.columns>.is-10.sums{flex:none;width:83.3333333333%}.columns.is-mobile>.column.is-offset-10,.columns>.column.is-offset-10,.columns>.is-offset-10.sums{margin-left:83.3333333333%}.columns.is-mobile>.column.is-11,.columns>.column.is-11,.columns>.is-11.sums{flex:none;width:91.6666666667%}.columns.is-mobile>.column.is-offset-11,.columns>.column.is-offset-11,.columns>.is-offset-11.sums{margin-left:91.6666666667%}.columns.is-mobile>.column.is-12,.columns>.column.is-12,.columns>.is-12.sums{flex:none;width:100%}.columns.is-mobile>.column.is-offset-12,.columns>.column.is-offset-12,.columns>.is-offset-12.sums{margin-left:100%}@media screen and (max-width: 768px){.column.is-narrow-mobile,.is-narrow-mobile.sums{flex:none}.column.is-full-mobile,.is-full-mobile.sums{flex:none;width:100%}.column.is-three-quarters-mobile,.is-three-quarters-mobile.sums{flex:none;width:75%}.column.is-two-thirds-mobile,.is-two-thirds-mobile.sums{flex:none;width:66.6666%}.column.is-half-mobile,.is-half-mobile.sums{flex:none;width:50%}.column.is-one-third-mobile,.is-one-third-mobile.sums{flex:none;width:33.3333%}.column.is-one-quarter-mobile,.is-one-quarter-mobile.sums{flex:none;width:25%}.column.is-offset-three-quarters-mobile,.is-offset-three-quarters-mobile.sums{margin-left:75%}.column.is-offset-two-thirds-mobile,.is-offset-two-thirds-mobile.sums{margin-left:66.6666%}.column.is-offset-half-mobile,.is-offset-half-mobile.sums{margin-left:50%}.column.is-offset-one-third-mobile,.is-offset-one-third-mobile.sums{margin-left:33.3333%}.column.is-offset-one-quarter-mobile,.is-offset-one-quarter-mobile.sums{margin-left:25%}.column.is-1-mobile,.is-1-mobile.sums{flex:none;width:8.3333333333%}.column.is-offset-1-mobile,.is-offset-1-mobile.sums{margin-left:8.3333333333%}.column.is-2-mobile,.is-2-mobile.sums{flex:none;width:16.6666666667%}.column.is-offset-2-mobile,.is-offset-2-mobile.sums{margin-left:16.6666666667%}.column.is-3-mobile,.is-3-mobile.sums{flex:none;width:25%}.column.is-offset-3-mobile,.is-offset-3-mobile.sums{margin-left:25%}.column.is-4-mobile,.is-4-mobile.sums{flex:none;width:33.3333333333%}.column.is-offset-4-mobile,.is-offset-4-mobile.sums{margin-left:33.3333333333%}.column.is-5-mobile,.is-5-mobile.sums{flex:none;width:41.6666666667%}.column.is-offset-5-mobile,.is-offset-5-mobile.sums{margin-left:41.6666666667%}.column.is-6-mobile,.is-6-mobile.sums{flex:none;width:50%}.column.is-offset-6-mobile,.is-offset-6-mobile.sums{margin-left:50%}.column.is-7-mobile,.is-7-mobile.sums{flex:none;width:58.3333333333%}.column.is-offset-7-mobile,.is-offset-7-mobile.sums{margin-left:58.3333333333%}.column.is-8-mobile,.is-8-mobile.sums{flex:none;width:66.6666666667%}.column.is-offset-8-mobile,.is-offset-8-mobile.sums{margin-left:66.6666666667%}.column.is-9-mobile,.is-9-mobile.sums{flex:none;width:75%}.column.is-offset-9-mobile,.is-offset-9-mobile.sums{margin-left:75%}.column.is-10-mobile,.is-10-mobile.sums{flex:none;width:83.3333333333%}.column.is-offset-10-mobile,.is-offset-10-mobile.sums{margin-left:83.3333333333%}.column.is-11-mobile,.is-11-mobile.sums{flex:none;width:91.6666666667%}.column.is-offset-11-mobile,.is-offset-11-mobile.sums{margin-left:91.6666666667%}.column.is-12-mobile,.is-12-mobile.sums{flex:none;width:100%}.column.is-offset-12-mobile,.is-offset-12-mobile.sums{margin-left:100%}}@media screen and (min-width: 769px),print{.column.is-narrow,.is-narrow.sums,.column.is-narrow-tablet,.is-narrow-tablet.sums{flex:none}.column.is-full,.is-full.sums,.column.is-full-tablet,.is-full-tablet.sums{flex:none;width:100%}.column.is-three-quarters,.is-three-quarters.sums,.column.is-three-quarters-tablet,.is-three-quarters-tablet.sums{flex:none;width:75%}.column.is-two-thirds,.is-two-thirds.sums,.column.is-two-thirds-tablet,.is-two-thirds-tablet.sums{flex:none;width:66.6666%}.column.is-half,.is-half.sums,.column.is-half-tablet,.is-half-tablet.sums{flex:none;width:50%}.column.is-one-third,.is-one-third.sums,.column.is-one-third-tablet,.is-one-third-tablet.sums{flex:none;width:33.3333%}.column.is-one-quarter,.is-one-quarter.sums,.column.is-one-quarter-tablet,.is-one-quarter-tablet.sums{flex:none;width:25%}.column.is-offset-three-quarters,.is-offset-three-quarters.sums,.column.is-offset-three-quarters-tablet,.is-offset-three-quarters-tablet.sums{margin-left:75%}.column.is-offset-two-thirds,.is-offset-two-thirds.sums,.column.is-offset-two-thirds-tablet,.is-offset-two-thirds-tablet.sums{margin-left:66.6666%}.column.is-offset-half,.is-offset-half.sums,.column.is-offset-half-tablet,.is-offset-half-tablet.sums{margin-left:50%}.column.is-offset-one-third,.is-offset-one-third.sums,.column.is-offset-one-third-tablet,.is-offset-one-third-tablet.sums{margin-left:33.3333%}.column.is-offset-one-quarter,.is-offset-one-quarter.sums,.column.is-offset-one-quarter-tablet,.is-offset-one-quarter-tablet.sums{margin-left:25%}.column.is-1,.is-1.sums,.column.is-1-tablet,.is-1-tablet.sums{flex:none;width:8.3333333333%}.column.is-offset-1,.is-offset-1.sums,.column.is-offset-1-tablet,.is-offset-1-tablet.sums{margin-left:8.3333333333%}.column.is-2,.is-2.sums,.column.is-2-tablet,.is-2-tablet.sums{flex:none;width:16.6666666667%}.column.is-offset-2,.is-offset-2.sums,.column.is-offset-2-tablet,.is-offset-2-tablet.sums{margin-left:16.6666666667%}.column.is-3,.is-3.sums,.column.is-3-tablet,.is-3-tablet.sums{flex:none;width:25%}.column.is-offset-3,.is-offset-3.sums,.column.is-offset-3-tablet,.is-offset-3-tablet.sums{margin-left:25%}.column.is-4,.is-4.sums,.column.is-4-tablet,.is-4-tablet.sums{flex:none;width:33.3333333333%}.column.is-offset-4,.is-offset-4.sums,.column.is-offset-4-tablet,.is-offset-4-tablet.sums{margin-left:33.3333333333%}.column.is-5,.is-5.sums,.column.is-5-tablet,.is-5-tablet.sums{flex:none;width:41.6666666667%}.column.is-offset-5,.is-offset-5.sums,.column.is-offset-5-tablet,.is-offset-5-tablet.sums{margin-left:41.6666666667%}.column.is-6,.is-6.sums,.column.is-6-tablet,.is-6-tablet.sums{flex:none;width:50%}.column.is-offset-6,.is-offset-6.sums,.column.is-offset-6-tablet,.is-offset-6-tablet.sums{margin-left:50%}.column.is-7,.is-7.sums,.column.is-7-tablet,.is-7-tablet.sums{flex:none;width:58.3333333333%}.column.is-offset-7,.is-offset-7.sums,.column.is-offset-7-tablet,.is-offset-7-tablet.sums{margin-left:58.3333333333%}.column.is-8,.is-8.sums,.column.is-8-tablet,.is-8-tablet.sums{flex:none;width:66.6666666667%}.column.is-offset-8,.is-offset-8.sums,.column.is-offset-8-tablet,.is-offset-8-tablet.sums{margin-left:66.6666666667%}.column.is-9,.is-9.sums,.column.is-9-tablet,.is-9-tablet.sums{flex:none;width:75%}.column.is-offset-9,.is-offset-9.sums,.column.is-offset-9-tablet,.is-offset-9-tablet.sums{margin-left:75%}.column.is-10,.is-10.sums,.column.is-10-tablet,.is-10-tablet.sums{flex:none;width:83.3333333333%}.column.is-offset-10,.is-offset-10.sums,.column.is-offset-10-tablet,.is-offset-10-tablet.sums{margin-left:83.3333333333%}.column.is-11,.is-11.sums,.column.is-11-tablet,.is-11-tablet.sums{flex:none;width:91.6666666667%}.column.is-offset-11,.is-offset-11.sums,.column.is-offset-11-tablet,.is-offset-11-tablet.sums{margin-left:91.6666666667%}.column.is-12,.is-12.sums,.column.is-12-tablet,.is-12-tablet.sums{flex:none;width:100%}.column.is-offset-12,.is-offset-12.sums,.column.is-offset-12-tablet,.is-offset-12-tablet.sums{margin-left:100%}}@media screen and (max-width: 1023px){.column.is-narrow-touch,.is-narrow-touch.sums{flex:none}.column.is-full-touch,.is-full-touch.sums{flex:none;width:100%}.column.is-three-quarters-touch,.is-three-quarters-touch.sums{flex:none;width:75%}.column.is-two-thirds-touch,.is-two-thirds-touch.sums{flex:none;width:66.6666%}.column.is-half-touch,.is-half-touch.sums{flex:none;width:50%}.column.is-one-third-touch,.is-one-third-touch.sums{flex:none;width:33.3333%}.column.is-one-quarter-touch,.is-one-quarter-touch.sums{flex:none;width:25%}.column.is-offset-three-quarters-touch,.is-offset-three-quarters-touch.sums{margin-left:75%}.column.is-offset-two-thirds-touch,.is-offset-two-thirds-touch.sums{margin-left:66.6666%}.column.is-offset-half-touch,.is-offset-half-touch.sums{margin-left:50%}.column.is-offset-one-third-touch,.is-offset-one-third-touch.sums{margin-left:33.3333%}.column.is-offset-one-quarter-touch,.is-offset-one-quarter-touch.sums{margin-left:25%}.column.is-1-touch,.is-1-touch.sums{flex:none;width:8.3333333333%}.column.is-offset-1-touch,.is-offset-1-touch.sums{margin-left:8.3333333333%}.column.is-2-touch,.is-2-touch.sums{flex:none;width:16.6666666667%}.column.is-offset-2-touch,.is-offset-2-touch.sums{margin-left:16.6666666667%}.column.is-3-touch,.is-3-touch.sums{flex:none;width:25%}.column.is-offset-3-touch,.is-offset-3-touch.sums{margin-left:25%}.column.is-4-touch,.is-4-touch.sums{flex:none;width:33.3333333333%}.column.is-offset-4-touch,.is-offset-4-touch.sums{margin-left:33.3333333333%}.column.is-5-touch,.is-5-touch.sums{flex:none;width:41.6666666667%}.column.is-offset-5-touch,.is-offset-5-touch.sums{margin-left:41.6666666667%}.column.is-6-touch,.is-6-touch.sums{flex:none;width:50%}.column.is-offset-6-touch,.is-offset-6-touch.sums{margin-left:50%}.column.is-7-touch,.is-7-touch.sums{flex:none;width:58.3333333333%}.column.is-offset-7-touch,.is-offset-7-touch.sums{margin-left:58.3333333333%}.column.is-8-touch,.is-8-touch.sums{flex:none;width:66.6666666667%}.column.is-offset-8-touch,.is-offset-8-touch.sums{margin-left:66.6666666667%}.column.is-9-touch,.is-9-touch.sums{flex:none;width:75%}.column.is-offset-9-touch,.is-offset-9-touch.sums{margin-left:75%}.column.is-10-touch,.is-10-touch.sums{flex:none;width:83.3333333333%}.column.is-offset-10-touch,.is-offset-10-touch.sums{margin-left:83.3333333333%}.column.is-11-touch,.is-11-touch.sums{flex:none;width:91.6666666667%}.column.is-offset-11-touch,.is-offset-11-touch.sums{margin-left:91.6666666667%}.column.is-12-touch,.is-12-touch.sums{flex:none;width:100%}.column.is-offset-12-touch,.is-offset-12-touch.sums{margin-left:100%}}@media screen and (min-width: 1024px){.column.is-narrow-desktop,.is-narrow-desktop.sums{flex:none}.column.is-full-desktop,.is-full-desktop.sums{flex:none;width:100%}.column.is-three-quarters-desktop,.is-three-quarters-desktop.sums{flex:none;width:75%}.column.is-two-thirds-desktop,.is-two-thirds-desktop.sums{flex:none;width:66.6666%}.column.is-half-desktop,.is-half-desktop.sums{flex:none;width:50%}.column.is-one-third-desktop,.is-one-third-desktop.sums{flex:none;width:33.3333%}.column.is-one-quarter-desktop,.is-one-quarter-desktop.sums{flex:none;width:25%}.column.is-offset-three-quarters-desktop,.is-offset-three-quarters-desktop.sums{margin-left:75%}.column.is-offset-two-thirds-desktop,.is-offset-two-thirds-desktop.sums{margin-left:66.6666%}.column.is-offset-half-desktop,.is-offset-half-desktop.sums{margin-left:50%}.column.is-offset-one-third-desktop,.is-offset-one-third-desktop.sums{margin-left:33.3333%}.column.is-offset-one-quarter-desktop,.is-offset-one-quarter-desktop.sums{margin-left:25%}.column.is-1-desktop,.is-1-desktop.sums{flex:none;width:8.3333333333%}.column.is-offset-1-desktop,.is-offset-1-desktop.sums{margin-left:8.3333333333%}.column.is-2-desktop,.is-2-desktop.sums{flex:none;width:16.6666666667%}.column.is-offset-2-desktop,.is-offset-2-desktop.sums{margin-left:16.6666666667%}.column.is-3-desktop,.is-3-desktop.sums{flex:none;width:25%}.column.is-offset-3-desktop,.is-offset-3-desktop.sums{margin-left:25%}.column.is-4-desktop,.is-4-desktop.sums{flex:none;width:33.3333333333%}.column.is-offset-4-desktop,.is-offset-4-desktop.sums{margin-left:33.3333333333%}.column.is-5-desktop,.is-5-desktop.sums{flex:none;width:41.6666666667%}.column.is-offset-5-desktop,.is-offset-5-desktop.sums{margin-left:41.6666666667%}.column.is-6-desktop,.is-6-desktop.sums{flex:none;width:50%}.column.is-offset-6-desktop,.is-offset-6-desktop.sums{margin-left:50%}.column.is-7-desktop,.is-7-desktop.sums{flex:none;width:58.3333333333%}.column.is-offset-7-desktop,.is-offset-7-desktop.sums{margin-left:58.3333333333%}.column.is-8-desktop,.is-8-desktop.sums{flex:none;width:66.6666666667%}.column.is-offset-8-desktop,.is-offset-8-desktop.sums{margin-left:66.6666666667%}.column.is-9-desktop,.is-9-desktop.sums{flex:none;width:75%}.column.is-offset-9-desktop,.is-offset-9-desktop.sums{margin-left:75%}.column.is-10-desktop,.is-10-desktop.sums{flex:none;width:83.3333333333%}.column.is-offset-10-desktop,.is-offset-10-desktop.sums{margin-left:83.3333333333%}.column.is-11-desktop,.is-11-desktop.sums{flex:none;width:91.6666666667%}.column.is-offset-11-desktop,.is-offset-11-desktop.sums{margin-left:91.6666666667%}.column.is-12-desktop,.is-12-desktop.sums{flex:none;width:100%}.column.is-offset-12-desktop,.is-offset-12-desktop.sums{margin-left:100%}}@media screen and (min-width: 1216px){.column.is-narrow-widescreen,.is-narrow-widescreen.sums{flex:none}.column.is-full-widescreen,.is-full-widescreen.sums{flex:none;width:100%}.column.is-three-quarters-widescreen,.is-three-quarters-widescreen.sums{flex:none;width:75%}.column.is-two-thirds-widescreen,.is-two-thirds-widescreen.sums{flex:none;width:66.6666%}.column.is-half-widescreen,.is-half-widescreen.sums{flex:none;width:50%}.column.is-one-third-widescreen,.is-one-third-widescreen.sums{flex:none;width:33.3333%}.column.is-one-quarter-widescreen,.is-one-quarter-widescreen.sums{flex:none;width:25%}.column.is-offset-three-quarters-widescreen,.is-offset-three-quarters-widescreen.sums{margin-left:75%}.column.is-offset-two-thirds-widescreen,.is-offset-two-thirds-widescreen.sums{margin-left:66.6666%}.column.is-offset-half-widescreen,.is-offset-half-widescreen.sums{margin-left:50%}.column.is-offset-one-third-widescreen,.is-offset-one-third-widescreen.sums{margin-left:33.3333%}.column.is-offset-one-quarter-widescreen,.is-offset-one-quarter-widescreen.sums{margin-left:25%}.column.is-1-widescreen,.is-1-widescreen.sums{flex:none;width:8.3333333333%}.column.is-offset-1-widescreen,.is-offset-1-widescreen.sums{margin-left:8.3333333333%}.column.is-2-widescreen,.is-2-widescreen.sums{flex:none;width:16.6666666667%}.column.is-offset-2-widescreen,.is-offset-2-widescreen.sums{margin-left:16.6666666667%}.column.is-3-widescreen,.is-3-widescreen.sums{flex:none;width:25%}.column.is-offset-3-widescreen,.is-offset-3-widescreen.sums{margin-left:25%}.column.is-4-widescreen,.is-4-widescreen.sums{flex:none;width:33.3333333333%}.column.is-offset-4-widescreen,.is-offset-4-widescreen.sums{margin-left:33.3333333333%}.column.is-5-widescreen,.is-5-widescreen.sums{flex:none;width:41.6666666667%}.column.is-offset-5-widescreen,.is-offset-5-widescreen.sums{margin-left:41.6666666667%}.column.is-6-widescreen,.is-6-widescreen.sums{flex:none;width:50%}.column.is-offset-6-widescreen,.is-offset-6-widescreen.sums{margin-left:50%}.column.is-7-widescreen,.is-7-widescreen.sums{flex:none;width:58.3333333333%}.column.is-offset-7-widescreen,.is-offset-7-widescreen.sums{margin-left:58.3333333333%}.column.is-8-widescreen,.is-8-widescreen.sums{flex:none;width:66.6666666667%}.column.is-offset-8-widescreen,.is-offset-8-widescreen.sums{margin-left:66.6666666667%}.column.is-9-widescreen,.is-9-widescreen.sums{flex:none;width:75%}.column.is-offset-9-widescreen,.is-offset-9-widescreen.sums{margin-left:75%}.column.is-10-widescreen,.is-10-widescreen.sums{flex:none;width:83.3333333333%}.column.is-offset-10-widescreen,.is-offset-10-widescreen.sums{margin-left:83.3333333333%}.column.is-11-widescreen,.is-11-widescreen.sums{flex:none;width:91.6666666667%}.column.is-offset-11-widescreen,.is-offset-11-widescreen.sums{margin-left:91.6666666667%}.column.is-12-widescreen,.is-12-widescreen.sums{flex:none;width:100%}.column.is-offset-12-widescreen,.is-offset-12-widescreen.sums{margin-left:100%}}@media screen and (min-width: 1408px){.column.is-narrow-fullhd,.is-narrow-fullhd.sums{flex:none}.column.is-full-fullhd,.is-full-fullhd.sums{flex:none;width:100%}.column.is-three-quarters-fullhd,.is-three-quarters-fullhd.sums{flex:none;width:75%}.column.is-two-thirds-fullhd,.is-two-thirds-fullhd.sums{flex:none;width:66.6666%}.column.is-half-fullhd,.is-half-fullhd.sums{flex:none;width:50%}.column.is-one-third-fullhd,.is-one-third-fullhd.sums{flex:none;width:33.3333%}.column.is-one-quarter-fullhd,.is-one-quarter-fullhd.sums{flex:none;width:25%}.column.is-offset-three-quarters-fullhd,.is-offset-three-quarters-fullhd.sums{margin-left:75%}.column.is-offset-two-thirds-fullhd,.is-offset-two-thirds-fullhd.sums{margin-left:66.6666%}.column.is-offset-half-fullhd,.is-offset-half-fullhd.sums{margin-left:50%}.column.is-offset-one-third-fullhd,.is-offset-one-third-fullhd.sums{margin-left:33.3333%}.column.is-offset-one-quarter-fullhd,.is-offset-one-quarter-fullhd.sums{margin-left:25%}.column.is-1-fullhd,.is-1-fullhd.sums{flex:none;width:8.3333333333%}.column.is-offset-1-fullhd,.is-offset-1-fullhd.sums{margin-left:8.3333333333%}.column.is-2-fullhd,.is-2-fullhd.sums{flex:none;width:16.6666666667%}.column.is-offset-2-fullhd,.is-offset-2-fullhd.sums{margin-left:16.6666666667%}.column.is-3-fullhd,.is-3-fullhd.sums{flex:none;width:25%}.column.is-offset-3-fullhd,.is-offset-3-fullhd.sums{margin-left:25%}.column.is-4-fullhd,.is-4-fullhd.sums{flex:none;width:33.3333333333%}.column.is-offset-4-fullhd,.is-offset-4-fullhd.sums{margin-left:33.3333333333%}.column.is-5-fullhd,.is-5-fullhd.sums{flex:none;width:41.6666666667%}.column.is-offset-5-fullhd,.is-offset-5-fullhd.sums{margin-left:41.6666666667%}.column.is-6-fullhd,.is-6-fullhd.sums{flex:none;width:50%}.column.is-offset-6-fullhd,.is-offset-6-fullhd.sums{margin-left:50%}.column.is-7-fullhd,.is-7-fullhd.sums{flex:none;width:58.3333333333%}.column.is-offset-7-fullhd,.is-offset-7-fullhd.sums{margin-left:58.3333333333%}.column.is-8-fullhd,.is-8-fullhd.sums{flex:none;width:66.6666666667%}.column.is-offset-8-fullhd,.is-offset-8-fullhd.sums{margin-left:66.6666666667%}.column.is-9-fullhd,.is-9-fullhd.sums{flex:none;width:75%}.column.is-offset-9-fullhd,.is-offset-9-fullhd.sums{margin-left:75%}.column.is-10-fullhd,.is-10-fullhd.sums{flex:none;width:83.3333333333%}.column.is-offset-10-fullhd,.is-offset-10-fullhd.sums{margin-left:83.3333333333%}.column.is-11-fullhd,.is-11-fullhd.sums{flex:none;width:91.6666666667%}.column.is-offset-11-fullhd,.is-offset-11-fullhd.sums{margin-left:91.6666666667%}.column.is-12-fullhd,.is-12-fullhd.sums{flex:none;width:100%}.column.is-offset-12-fullhd,.is-offset-12-fullhd.sums{margin-left:100%}}.columns{margin-left:-0.75rem;margin-right:-0.75rem;margin-top:-0.75rem}.columns:last-child{margin-bottom:-0.75rem}.columns:not(:last-child){margin-bottom:calc(1.5rem - 0.75rem)}.columns.is-centered{justify-content:center}.columns.is-gapless{margin-left:0;margin-right:0;margin-top:0}.columns.is-gapless>.column,.columns.is-gapless>.sums{margin:0;padding:0 !important}.columns.is-gapless:not(:last-child){margin-bottom:1.5rem}.columns.is-gapless:last-child{margin-bottom:0}.columns.is-mobile,.columns{display:flex}.columns.is-multiline{flex-wrap:wrap}.columns.is-vcentered{align-items:center}@media screen and (min-width: 769px),print{.columns:not(.is-desktop){display:flex}}@media screen and (min-width: 1024px){.columns.is-desktop{display:flex}}.columns.is-variable{--columnGap: 0.75rem;margin-left:calc(-1 * var(--columnGap));margin-right:calc(-1 * var(--columnGap))}.columns.is-variable .column,.columns.is-variable .sums{padding-left:var(--columnGap);padding-right:var(--columnGap)}.columns.is-variable.is-0{--columnGap: $i * 0.25rem}.columns.is-variable.is-1{--columnGap: $i * 0.25rem}.columns.is-variable.is-2{--columnGap: $i * 0.25rem}.columns.is-variable.is-3{--columnGap: $i * 0.25rem}.columns.is-variable.is-4{--columnGap: $i * 0.25rem}.columns.is-variable.is-5{--columnGap: $i * 0.25rem}.columns.is-variable.is-6{--columnGap: $i * 0.25rem}.columns.is-variable.is-7{--columnGap: $i * 0.25rem}.columns.is-variable.is-8{--columnGap: $i * 0.25rem}.section{padding:2.5rem 1.9rem 1.6rem}@media screen and (min-width: 1024px){.section.is-medium{padding:9rem 1.5rem}.section.is-large{padding:18rem 1.5rem}}.level{align-items:center;justify-content:space-between}.level:not(:last-child){margin-bottom:1.5rem}.level code{border-radius:3px}.level img{display:inline-block;vertical-align:top}.level.is-mobile,.level.columns{display:flex}.level.is-mobile .level-left,.level.columns .level-left,.level.is-mobile .level-right,.level.columns .level-right{display:flex}.level.is-mobile .level-left+.level-right,.level.columns .level-left+.level-right{margin-top:0}.level.is-mobile .level-item:not(:last-child),.level.columns .level-item:not(:last-child){margin-bottom:0}.level.is-mobile .level-item:not(.is-narrow),.level.columns .level-item:not(.is-narrow){flex-grow:1}@media screen and (min-width: 769px),print{.level{display:flex}.level>.level-item:not(.is-narrow){flex-grow:1}}.level-item{align-items:center;display:flex;flex-basis:auto;flex-grow:0;flex-shrink:0;justify-content:center}.level-item .title,.level-item .subtitle{margin-bottom:0}@media screen and (max-width: 768px){.level-item:not(:last-child){margin-bottom:0.75rem}}.level-left,.level-right{flex-basis:auto;flex-grow:0;flex-shrink:0}.level-left .level-item.is-flexible,.level-right .level-item.is-flexible{flex-grow:1}@media screen and (min-width: 769px),print{.level-left .level-item:not(:last-child),.level-right .level-item:not(:last-child){margin-right:0.75rem}}.level-left{align-items:center;justify-content:flex-start}@media screen and (max-width: 768px){.level-left+.level-right{margin-top:1.5rem}}@media screen and (min-width: 769px),print{.level-left{display:flex}}.level-right{align-items:center;justify-content:flex-end}@media screen and (min-width: 769px),print{.level-right{display:flex}}body{font-family:Roboto, sans-serif;font-size:.75em}h1{font-size:2.5rem}h2{font-size:2rem}dl dt{font-weight:500}dl.row dt:not(:first-of-type),dl.row dd:not(:first-of-type){margin-top:0}.page,.flyleaf{display:flex;flex-direction:column;width:calc(100vw - 1px);height:calc(141.43vw - 1.4mm)}.is-full-width{min-width:100%;box-sizing:border-box}.has-content-pulled-right>*{margin-left:auto}#content-container{overflow:hidden;flex:1 1 auto}.not-last-page .ocr{display:none}.page-splitted>.column.is-full-width,.page-splitted>.is-full-width.sums{padding-top:0;padding-bottom:0}.is-border{padding:0 !important;margin:0 !important;border-top:1px dotted}.header{min-height:5.5rem;margin-bottom:2.8rem}.level-right{text-align:right}.level-right h2{margin:0 !important;padding:.3em 0 0 0}.title,th,.has-text-bolder,.is-bigger{font-weight:500}.is-bigger{font-size:1.25em}.title{color:#333;margin:0}.company-logo{color:#333;margin:1em 0 0 0}.company-logo img{max-width:65%;max-height:7.5rem}.doc-number{margin:.3em 0 0;text-align:right}.document-info p{margin:.8em 0}.document-info .box:not(:last-of-type){margin-bottom:1rem}.payment-info dl{font-weight:100;font-size:1em;padding:1em;border:1px dotted;text-align:right}.payment-info dl.row dt{margin-right:0 !important;text-align:left}.payment-info dd,.payment-info dt{padding:.35em;font-size:1.25em}.client-address-box{padding:2em 0 0 4.25em}.invoice-content{width:100%;border-spacing:0;padding:0}.invoice-content table{border-collapse:collapse}.invoice-content thead{text-align:left;font-size:1rem}.invoice-content th{border-bottom:1px dotted;padding:1rem 0.5rem 0.5rem 0;text-align:right}.invoice-content th.text-left{text-align:left}.invoice-content th:last-child{padding-right:0}.invoice-content tbody td{padding:0.8rem 0.5rem 0 0;text-align:right}.invoice-content tbody td.text-left{text-align:left}.invoice-content tbody td:last-child{padding-right:0}.invoice-content tbody td .text{padding:1em 0 1em 0}.sums{align-items:normal;padding:0;text-align:left}.sums p{padding-left:1em}.sums h2{font-size:1em;text-transform:uppercase}.sums ul{padding:.6em 0;list-style:none;width:100%;margin:0;border-top:1px dotted;border-bottom:1px dotted}.sums ul li{display:flex;flex-direction:row;justify-content:space-between}.sums ul li:not(:last-of-type){margin-bottom:0.5rem}.sums ul li>div{display:inherit}.sum_to_pay li{display:flex;flex-direction:row;justify-content:space-between;margin-top:.5em;text-transform:uppercase}.ocr p{margin:0}.ocr h4{padding-bottom:.5em}.ocr-notification{display:flex;width:1.875rem;height:1.875rem;background-image:url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMSIgaGVpZ2h0PSIzMiIgdmlld0JveD0iMCAwIDMxIDMyIj4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI%2BCiAgICAgICAgPHBhdGggZmlsbD0iI0ZBNzE2RiIgZD0iTTMwLjg5NyAxNS4wNThjLS4yODYtNC4zMi0yLjQyNy04LjM1MS01LjgxNy0xMS4wMjhDMjEuNjkgMS4zNTIgMTcuMjY0LjI0NiAxMi45OC45NiA1LjM0NSAyLjI4LS4yNTkgOS4zNDcuMjc3IDE3LjEyOGExNS4yOTQgMTUuMjk0IDAgMCAwIDQuNDYgOS44NTFjLS42NzcgMS0xLjI4NSAxLjY0Mi0yLjg5IDIuOTI2YS45Ny45NyAwIDAgMC0uMzU3IDEuMDM1Yy4wNy4zOTMuMzU2LjcxNC43MTMuODIxLjUzNi4xNzggMS4zMi4yNSAyLjIxMy4yNSAxLjg5MiAwIDQuMjgzLS40MjggNi4xMzgtMS4zOTJhMTUuMjY3IDE1LjI2NyAwIDAgMCA3LjcxLjYwN2M3LjYzNy0xLjM1NyAxMy4xNjgtOC40NiAxMi42MzMtMTYuMTY4eiIvPgogICAgICAgIDxnIGZpbGw9IiNGRkYiPgogICAgICAgICAgICA8cGF0aCBkPSJNMTQuOTg3IDQuODM0YTIuMjQgMi4yNCAwIDAgMSAyLjYwOCAxLjI2MWMuMTYzLjM1OC4yMTIuNzM2LjE4OCAxLjEyN2EzODc0LjA4IDM4NzQuMDggMCAwIDAtLjQ5NSA4LjU5Yy0uMDMxLjU0LS4wNTIgMS4wODItLjA3NiAxLjYyNC0uMDQuOTQ1LS43NDcgMS42NDUtMS42NjYgMS42NDdhMS42NTYgMS42NTYgMCAwIDEtMS42NjYtMS41ODhjLS4xNDQtMi42OTgtLjI4OC01LjM5NS0uNDM1LTguMDkyLS4wNC0uNzI2LS4wODgtMS40NS0uMTM1LTIuMTc0LS4wNzItMS4xMzMuNjI3LTIuMTMzIDEuNjc3LTIuMzk1ek0xNS41MzYgMjUuMTE3YTIuMjQzIDIuMjQzIDAgMSAxIC4wMzMtNC40ODZjMS4yMzMuMDA0IDIuMjM0IDEuMDMzIDIuMjIyIDIuMjgzLS4wMTEgMS4yMDEtMS4wNDggMi4yMTMtMi4yNTUgMi4yMDN6Ii8%2BCiAgICAgICAgPC9nPgogICAgPC9nPgo8L3N2Zz4K);background-repeat:no-repeat;background-size:contain}.scanable-payment-info code{font-size:0.8rem;font-family:OCRB}.pagination{display:none;margin:unset;align-self:flex-end}.pagination .inner{margin-top:unset;padding-top:1rem;border-top:1px solid #333;font-weight:normal}.not-last-page .document-text{display:none}.not-last-page .sum-text-container{display:none}.document-text p{margin:1.2em 0 0 0}.footer .column,.footer .sums{padding-bottom:0}.footer .inner{padding-top:1em}.footer .inner .title{text-transform:capitalize;color:#333 !important}.footer .inner .f-tax{margin-top:.5em;margin-bottom:.5em;font-size:.75em}.footer .inner ul li{padding-bottom:.25em}.footer .inner ul li :not(.title){font-size:.9em}.ad-pagination-container .inner{display:flex;flex-direction:row}.ad-pagination-container .inner>div:not(.ad){flex:1 1 auto}.ad-pagination-container .inner .container{padding:1em 0}.ad{display:flex;flex-direction:row;justify-content:space-between;flex:1 1 auto;align-items:flex-end}.ad>div,.ad a{flex:0 1 auto;order:1}.ad>p{flex:1 0 auto;order:2}.ad>p:not(div){margin:0 0 0 1rem}.ad svg{max-height:2.25rem}
</style>

<style>.page .title { color: #1c5778 }
.company-logo { color: #1c5778 }
.page .invoice-content thead { color: #1c5778 }
.invoice-content thead th { border-bottom-color: #dddddd; }
.page .footer .inner .email:before, .page .footer .inner .phone:before, .page .footer .inner .website:before { color: #dddddd }
.payment-info dl, .sums ul { border-color: #dddddd}
.ocr .inner { border: 1px #dddddd dotted;}
.footer .inner { border-top: 1px dotted #dddddd;

</style>
<style>
.page, .flyleaf {
    display: flex;
    flex-direction: column;
    width: calc(100vw - 1px);
    height: calc(140vw - 1.4mm);
}



@media print{
    .page,.flyleaf{
        padding:2rem 3rem
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
<dd id="faktura_datum"><?=$datum?></dd>
<dt>Betalningsvillkor</dt>
<dd id="bet_villkor_info" data-bt="<?=$antal_dagar_netto?>"><?=$bet_villkor?></dd>
<dt>Förfallodatum</dt>
<dd>
<strong id="forfallo_datum"><?=$forfallodatum?></strong>
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
<th class="nowrap">Produkt / tjänst</th>
<th></th>
<th class="text-right">Antal</th>
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
<td colspan="6"><p><?=$text?></p></td>
</tr>

<?php
    }
}

//moms

$moms_summa = array_sum($momser);

//summa
$summa_att_betala = $summa_netto + $moms_summa;

//avrundning
$avrundad_summa = round($summa_att_betala, 0);
$avrundning = $summa_att_betala - $avrundad_summa;

$avrundning *= -1;
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
<div><?=str_replace(".",",", sprintf("%.2f", $avrundning))?> kr</div>
</li>
</ul>
<div class="totals">
<h2><span class="sum-to-pay-text">Summa att betala:</span> <?=str_replace(".",",", sprintf("%.2f", $avrundad_summa))?> kr</h2>
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
<script>

let bet_villkor = document.getElementById("bet_villkor_info");
console.log(bet_villkor);
let antal_dagar = bet_villkor.dataset.bt;
console.log("Antal dagar: " + antal_dagar)

//faktura
let faktura_datum = document.getElementById("faktura_datum");
let forfallo_datum = document.getElementById("forfallo_datum");

let date1 = new Date(faktura_datum.innerHTML);
let date2 = new Date(forfallo_datum.innerHTML);

console.log(date1);
console.log(date2);

let diff = date2 - date1;

let diffDays = diff/3600/24/1000;
console.log("dates diff: " + diffDays);

if(diffDays != antal_dagar){
    console.log("Datum fel, förfallodatum ej " + antal_dagar + " efter fakturadatum?");
}


</script>

</body>