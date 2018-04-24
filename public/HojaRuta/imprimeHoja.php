<?php
/* @var $connection PDO */
$connection = require('connection.php');
if (empty($_REQUEST['id'])) return;
$id = $_REQUEST['id'];
$pos = empty($_REQUEST['pos']) ? 1 : $_REQUEST['pos'];

$stmt = $connection->prepare('select * from hoja_ruta where id = ?');
$stmt->execute([$id]);
$hoja = $stmt->fetch();
var_dump($hoja['anexo_hojas']);
$hoja['anexoHojas_fjs'] = preg_match('/(\d+)\s*fjs/i', $hoja['anexo_hojas'], $ma) ? $ma[1] : '';
$hoja['anexoHojas_arch'] = preg_match('/(\d+)\s*arc/i', $hoja['anexo_hojas'], $ma) ? $ma[1] : '';
$hoja['anexoHojas_ani'] = preg_match('/(\d+)\s*ani/i', $hoja['anexo_hojas'], $ma) ? $ma[1] : '';
$hoja['anexoHojas_leg'] = preg_match('/(\d+)\s*leg/i', $hoja['anexo_hojas'], $ma) ? $ma[1] : '';
$hoja['anexoHojas_eje'] = preg_match('/(\d+)\s*eje/i', $hoja['anexo_hojas'], $ma) ? $ma[1] : '';
$hoja['anexoHojas_eng'] = preg_match('/(\d+)\s*eng/i', $hoja['anexo_hojas'], $ma) ? $ma[1] : '';
$hoja['anexoHojas_cd'] = preg_match('/(\d+)\s*cd/i', $hoja['anexo_hojas'], $ma) ? $ma[1] : '';

?>
<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <style type="text/css">
            ol{margin:0;padding:0}table td,table th{padding:0}
            .c19{height:250pt;border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-color:#000000;border-top-width:1pt;border-right-width:1pt;border-left-color:#000000;vertical-align:top;border-right-color:#000000;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:186.8pt;border-top-color:#000000;border-bottom-style:solid}
            .c15{height:250pt;border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-color:#000000;border-top-width:1pt;border-right-width:1pt;border-left-color:#000000;vertical-align:top;border-right-color:#000000;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:132pt;border-top-color:#000000;border-bottom-style:solid}.c23{border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-color:#000000;border-top-width:1pt;border-right-width:1pt;border-left-color:#000000;vertical-align:top;border-right-color:#000000;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:83.2pt;border-top-color:#000000;border-bottom-style:solid}
            .c16{height:250pt;border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-color:#000000;border-top-width:1pt;border-right-width:1pt;border-left-color:#000000;vertical-align:top;border-right-color:#000000;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:127.5pt;border-top-color:#000000;border-bottom-style:solid}
            .c9 {height:250pt;border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-color:#000000;border-top-width:1pt;border-right-width:1pt;border-left-color:#000000;vertical-align:top;border-right-color:#000000;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:113.2pt;border-top-color:#000000;border-bottom-style:solid}.c1{border-right-style:solid;border-bottom-color:#ffffff;border-top-width:1pt;border-right-width:1pt;border-left-color:#ffffff;vertical-align:top;border-right-color:#000000;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:72pt;border-top-color:#ffffff;border-bottom-style:solid}.c3{border-right-style:solid;border-bottom-color:#000000;border-top-width:1pt;border-right-width:1pt;border-left-color:#000000;vertical-align:top;border-right-color:#000000;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:29.2pt;border-top-color:#000000;border-bottom-style:solid}.c5{color:#000000;font-weight:400;text-decoration:none;vertical-align:baseline;font-size:11pt;font-family:"Arial";font-style:normal}.c25{color:#666666;font-weight:400;text-decoration:none;vertical-align:baseline;font-size:11pt;font-family:"Arial";font-style:normal}.c0{color:#000000;font-weight:700;text-decoration:none;vertical-align:baseline;font-size:11pt;font-family:"Arial";font-style:normal}.c13{color:#000000;font-weight:700;text-decoration:none;vertical-align:baseline;font-size:18pt;font-family:"Arial";font-style:normal}.c20{padding-top:0pt;padding-bottom:0pt;line-height:1.15;orphans:2;widows:2;text-align:left}.c24{padding-top:0pt;padding-bottom:0pt;line-height:1.15;orphans:2;widows:2;text-align:center}.c7{padding-top:0pt;padding-bottom:0pt;line-height:1.5;text-align:center;height:11pt}.c10{padding-top:0pt;padding-bottom:0pt;line-height:1.0;text-align:center;height:11pt}.c6{padding-top:0pt;padding-bottom:0pt;line-height:1.5;text-align:left}.c2{padding-top:0pt;padding-bottom:0pt;line-height:1.0;text-align:left}.c22{padding-top:0pt;padding-bottom:0pt;line-height:1.5;text-align:center}.c14{padding-top:0pt;padding-bottom:0pt;line-height:1.0;text-align:center}.c21{border-spacing:0;border-collapse:collapse;margin-right:auto}.c8{margin-left:auto;border-spacing:0;border-collapse:collapse;margin-right:auto}.c11{background-color:#ffffff;max-width:559.5pt;padding:43.7pt 24pt 43.7pt 28.5pt}
            .c4{height:0pt}.c12{height:11pt}.c18{height:13pt}.c17{height:15pt}.title{padding-top:0pt;color:#000000;font-size:26pt;padding-bottom:3pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}.subtitle{padding-top:0pt;color:#666666;font-size:15pt;padding-bottom:16pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}li{color:#000000;font-size:11pt;font-family:"Arial"}p{margin:0;color:#000000;font-size:11pt;font-family:"Arial"}h1{padding-top:20pt;color:#000000;font-size:20pt;padding-bottom:6pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h2{padding-top:18pt;color:#000000;font-size:16pt;padding-bottom:6pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h3{padding-top:16pt;color:#434343;font-size:14pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h4{padding-top:14pt;color:#666666;font-size:12pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h5{padding-top:12pt;color:#666666;font-size:11pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h6{padding-top:12pt;color:#666666;font-size:11pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;font-style:italic;orphans:2;widows:2;text-align:left}</style>
    </head>
    <body class="c11">
        <p class="c20">
            <span class="c25"><?= strtoupper($hoja['tipo']) ?></span>
        </p>
        <a id="t.bd050498029537270bf46a96b18f8521fa4e57a1">
        </a>
        <a id="t.0">
        </a>
        <table class="c21">
            <tbody>
                <tr class="c4" style="<?= $pos == 1 ? '' : 'visibility: hidden;' ?>">
                    <td class="c9" colspan="1" rowspan="1">
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c12 c24">
                            <span class="c5">
                            </span>
                        </p>
                        <a id="t.19367cff7ca851a9d814b79a578cd90bd5baa3e2">
                        </a>
                        <a id="t.1">
                        </a>
                        <table class="c8">
                            <tbody>
                                <tr class="c4">
                                    <td class="c23" colspan="1" rowspan="1">
                                        <p class="c14">
                                            <span class="c13"><?= $hoja['numero'] ?></span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <a id="t.53eeea0f6f674da476e9300f5d435a748dd8101a">
                        </a>
                        <a id="t.2">
                        </a>
                        <table class="c8">
                            <tbody>
                                <tr class="c17">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">fjs: </span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_fjs'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">arch.:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_arch'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">anillados:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_ani'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">legajo:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_leg'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">ejemplar:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_eje'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">engrapad:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_eng'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c18">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">cd:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_cd'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="c6 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c14">
                            <span class="c0">HR: <?= $hoja['nro_de_control'] ?></span>
                        </p>
                        <p class="c10">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c2 c12">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c2 c12">
                            <span class="c0">
                            </span>
                        </p>
                    </td>
                    <td class="c19" colspan="1" rowspan="1">
                        <p class="c2">
                            <span class="c5">DE: <?= $hoja['procedencia'] ?></span>
                        </p>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c2">
                            <span class="c5">REF: <?= $hoja['referencia'] ?></span>
                        </p>
                    </td>
                    <td class="c15" colspan="1" rowspan="1">
                        <p class="c2">
                            <span class="c5">FECHA: <?= DateTime::createFromFormat('Y-m-d', $hoja['fecha'])->format('d/m/Y') ?></span>
                        </p>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c2">
                            <span class="c5">PARA: <?= $hoja['destinatario'] ?></span>
                        </p>
                    </td>
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                    </td>
                </tr>
                <tr class="c4" style="<?= $pos == 2 ? '' : 'visibility: hidden;' ?>">
                    <td class="c9" colspan="1" rowspan="1">
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c12 c24">
                            <span class="c5">
                            </span>
                        </p>
                        <a id="t.19367cff7ca851a9d814b79a578cd90bd5baa3e2">
                        </a>
                        <a id="t.1">
                        </a>
                        <table class="c8">
                            <tbody>
                                <tr class="c4">
                                    <td class="c23" colspan="1" rowspan="1">
                                        <p class="c14">
                                            <span class="c13"><?= $hoja['numero'] ?></span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <a id="t.53eeea0f6f674da476e9300f5d435a748dd8101a">
                        </a>
                        <a id="t.2">
                        </a>
                        <table class="c8">
                            <tbody>
                                <tr class="c17">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">fjs: </span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_fjs'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">arch.:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_arch'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">anillados:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_ani'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">legajo:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_leg'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">ejemplar:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_eje'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">engrapad:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_eng'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c18">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">cd:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_cd'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="c6 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c14">
                            <span class="c0">HR: <?= $hoja['nro_de_control'] ?></span>
                        </p>
                        <p class="c10">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c2 c12">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c2 c12">
                            <span class="c0">
                            </span>
                        </p>
                    </td>
                    <td class="c19" colspan="1" rowspan="1">
                        <p class="c2">
                            <span class="c5">DE: <?= $hoja['procedencia'] ?></span>
                        </p>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c2">
                            <span class="c5">REF: <?= $hoja['referencia'] ?></span>
                        </p>
                    </td>
                    <td class="c15" colspan="1" rowspan="1">
                        <p class="c2">
                            <span class="c5">FECHA: <?= DateTime::createFromFormat('Y-m-d', $hoja['fecha'])->format('d/m/Y') ?></span>
                        </p>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c2">
                            <span class="c5">PARA: <?= $hoja['destinatario'] ?></span>
                        </p>
                    </td>
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                    </td>
                </tr>
                <tr class="c4" style="<?= $pos == 3 ? '' : 'visibility: hidden;' ?>">
                    <td class="c9" colspan="1" rowspan="1">
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c12 c24">
                            <span class="c5">
                            </span>
                        </p>
                        <a id="t.19367cff7ca851a9d814b79a578cd90bd5baa3e2">
                        </a>
                        <a id="t.1">
                        </a>
                        <table class="c8">
                            <tbody>
                                <tr class="c4">
                                    <td class="c23" colspan="1" rowspan="1">
                                        <p class="c14">
                                            <span class="c13"><?= $hoja['numero'] ?></span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <a id="t.53eeea0f6f674da476e9300f5d435a748dd8101a">
                        </a>
                        <a id="t.2">
                        </a>
                        <table class="c8">
                            <tbody>
                                <tr class="c17">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">fjs: </span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_fjs'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">arch.:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_arch'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">anillados:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_ani'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">legajo:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_leg'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">ejemplar:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_eje'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c4">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">engrapad:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_eng'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c18">
                                    <td class="c1" colspan="1" rowspan="1">
                                        <p class="c6">
                                            <span class="c5">cd:</span>
                                        </p>
                                    </td>
                                    <td class="c3" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c5"><?= $hoja['anexoHojas_cd'] ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="c6 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c14">
                            <span class="c0">HR: <?= $hoja['nro_de_control'] ?></span>
                        </p>
                        <p class="c10">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c2 c12">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c2 c12">
                            <span class="c0">
                            </span>
                        </p>
                    </td>
                    <td class="c19" colspan="1" rowspan="1">
                        <p class="c2">
                            <span class="c5">DE: <?= $hoja['procedencia'] ?></span>
                        </p>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c2">
                            <span class="c5">REF: <?= $hoja['referencia'] ?></span>
                        </p>
                    </td>
                    <td class="c15" colspan="1" rowspan="1">
                        <p class="c2">
                            <span class="c5">FECHA: <?= DateTime::createFromFormat('Y-m-d', $hoja['fecha'])->format('d/m/Y') ?></span>
                        </p>
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                        <p class="c2">
                            <span class="c5">PARA: <?= $hoja['destinatario'] ?></span>
                        </p>
                    </td>
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c2 c12">
                            <span class="c5">
                            </span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="c12 c20">
            <span class="c5">
            </span>
        </p>
        <div>
            <p class="c20 c12">
                <span class="c5">
                </span>
            </p>
        </div>
        <script>window.printPDF = true;</script>
    </body>
</html>
