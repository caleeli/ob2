<?php
/* @var $connection PDO */
$connection = require('connection.php');
if (empty($_REQUEST['id'])) return;
$id = $_REQUEST['id'];
$pos = empty($_REQUEST['pos']) ? 1 : $_REQUEST['pos'];

$stmt = $connection->prepare('select * from hoja_ruta where id = ?');
$stmt->execute([$id]);
$hoja = $stmt->fetch();
?>
<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <style type="text/css">
            ol{margin:0;padding:0}table td,table th{padding:0}.c20{border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-color:#000000;border-top-width:1pt;border-right-width:1pt;border-left-color:#000000;vertical-align:top;border-right-color:#000000;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:83.2pt;border-top-color:#000000;border-bottom-style:solid}
            .c16{border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-color:#000000;border-top-width:1pt;border-right-width:1pt;border-left-color:#000000;vertical-align:top;border-right-color:#000000;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;
                width:165.4pt;height:228pt;border-top-color:#000000;border-bottom-style:solid}.c2{border-right-style:solid;border-bottom-color:#000000;border-top-width:1pt;border-right-width:1pt;border-left-color:#000000;vertical-align:top;border-right-color:#000000;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:29.2pt;border-top-color:#000000;border-bottom-style:solid}.c9{border-right-style:solid;border-bottom-color:#ffffff;border-top-width:1pt;border-right-width:1pt;border-left-color:#ffffff;vertical-align:top;border-right-color:#000000;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:72pt;border-top-color:#ffffff;border-bottom-style:solid}.c0{color:#000000;font-weight:400;text-decoration:none;vertical-align:baseline;font-size:11pt;font-family:"Arial";font-style:normal}.c10{color:#000000;font-weight:700;text-decoration:none;vertical-align:baseline;font-size:11pt;font-family:"Arial";font-style:normal}.c19{color:#666666;font-weight:400;text-decoration:none;vertical-align:baseline;font-size:11pt;font-family:"Arial";font-style:normal}.c14{color:#000000;font-weight:700;text-decoration:none;vertical-align:baseline;font-size:18pt;font-family:"Arial";font-style:normal}.c17{padding-top:0pt;padding-bottom:0pt;line-height:1.15;orphans:2;widows:2;text-align:left}.c12{padding-top:0pt;padding-bottom:0pt;line-height:1.15;orphans:2;widows:2;text-align:center}.c1{padding-top:0pt;padding-bottom:0pt;line-height:1.5;text-align:center}.c11{border-spacing:0;border-collapse:collapse;margin-right:auto}.c3{margin-left:auto;border-spacing:0;border-collapse:collapse;margin-right:auto}.c4{padding-top:0pt;padding-bottom:0pt;line-height:1.0;text-align:center}.c7{padding-top:0pt;padding-bottom:0pt;line-height:1.5;text-align:left}.c8{padding-top:0pt;padding-bottom:0pt;line-height:1.0;text-align:left}.c13{background-color:#ffffff;max-width:496.3pt;padding:43.7pt 43.7pt 43.7pt 72pt}.c15{height:13pt}.c6{height:11pt}.c18{height:15pt}.c5{height:0pt}.title{padding-top:0pt;color:#000000;font-size:26pt;padding-bottom:3pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}.subtitle{padding-top:0pt;color:#666666;font-size:15pt;padding-bottom:16pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}li{color:#000000;font-size:11pt;font-family:"Arial"}p{margin:0;color:#000000;font-size:11pt;font-family:"Arial"}h1{padding-top:20pt;color:#000000;font-size:20pt;padding-bottom:6pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h2{padding-top:18pt;color:#000000;font-size:16pt;padding-bottom:6pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h3{padding-top:16pt;color:#434343;font-size:14pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h4{padding-top:14pt;color:#666666;font-size:12pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h5{padding-top:12pt;color:#666666;font-size:11pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h6{padding-top:12pt;color:#666666;font-size:11pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;font-style:italic;orphans:2;widows:2;text-align:left}</style>
    </head>
    <body class="c13">
        <p class="c17">
            <span class="c19"><?= strtoupper($hoja['tipo']) ?></span>
        </p>
        <a id="t.acfd86ec113933823c828b52ca3f63e538fc11a2">
        </a>
        <a id="t.0">
        </a>
        <table class="c11">
            <tbody>
                <tr class="c5" style="<?=$pos==1 ? '': 'visibility: hidden;'?>">
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c12 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <a id="t.93b12d6b27ebe212d95654c8dd677e26b774892b">
                        </a>
                        <a id="t.1">
                        </a>
                        <table class="c3">
                            <tbody>
                                <tr class="c5">
                                    <td class="c20" colspan="1" rowspan="1">
                                        <p class="c4">
                                            <span class="c14"><?=$hoja['numero']?></span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <a id="t.7d5ba088a1a68857e433df137a2a681d15e9085c">
                        </a>
                        <a id="t.2">
                        </a>
                        <table class="c3">
                            <tbody>
                                <tr class="c18">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">fjs: </span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1">
                                            <span class="c0"></span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">arch.:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">anillados:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">legajo:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">ejemplar:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">engrapad:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c15">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">cd:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1">
                                            <span class="c0"></span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="c7 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c4">
                            <span class="c10">HR: <?=$hoja['nro_de_control']?></span>
                        </p>
                    </td>
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c8">
                            <span class="c0"><b>DE:</b> <?=$hoja['procedencia']?></span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c6 c8">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8">
                            <span class="c0"><b>REF:</b> <?=$hoja['referencia']?></span>
                        </p>
                    </td>
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c8">
                            <span class="c0"><b>FECHA:</b> <?=DateTime::createFromFormat('Y-m-d', $hoja['fecha'])->format('d/m/Y')?></span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8">
                            <span class="c0"><b>PARA:</b> <?=$hoja['destinatario']?></span>
                        </p>
                    </td>
                </tr>
                <tr class="c5" style="<?=$pos==2 ? '': 'visibility: hidden;'?>">
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c12 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <a id="t.93b12d6b27ebe212d95654c8dd677e26b774892b">
                        </a>
                        <a id="t.1">
                        </a>
                        <table class="c3">
                            <tbody>
                                <tr class="c5">
                                    <td class="c20" colspan="1" rowspan="1">
                                        <p class="c4">
                                            <span class="c14"><?=$hoja['numero']?></span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <a id="t.7d5ba088a1a68857e433df137a2a681d15e9085c">
                        </a>
                        <a id="t.2">
                        </a>
                        <table class="c3">
                            <tbody>
                                <tr class="c18">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">fjs: </span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1">
                                            <span class="c0"></span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">arch.:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">anillados:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">legajo:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">ejemplar:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">engrapad:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c15">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">cd:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1">
                                            <span class="c0"></span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="c7 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c4">
                            <span class="c10">HR: <?=$hoja['nro_de_control']?></span>
                        </p>
                    </td>
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c8">
                            <span class="c0"><b>DE:</b> <?=$hoja['procedencia']?></span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c6 c8">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8">
                            <span class="c0"><b>REF:</b> <?=$hoja['referencia']?></span>
                        </p>
                    </td>
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c8">
                            <span class="c0"><b>FECHA:</b> <?=DateTime::createFromFormat('Y-m-d', $hoja['fecha'])->format('d/m/Y')?></span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8">
                            <span class="c0"><b>PARA:</b> <?=$hoja['destinatario']?></span>
                        </p>
                    </td>
                </tr>
                <tr class="c5" style="<?=$pos==3 ? '': 'visibility: hidden;'?>">
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c12 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <a id="t.93b12d6b27ebe212d95654c8dd677e26b774892b">
                        </a>
                        <a id="t.1">
                        </a>
                        <table class="c3">
                            <tbody>
                                <tr class="c5">
                                    <td class="c20" colspan="1" rowspan="1">
                                        <p class="c4">
                                            <span class="c14"><?=$hoja['numero']?></span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <a id="t.7d5ba088a1a68857e433df137a2a681d15e9085c">
                        </a>
                        <a id="t.2">
                        </a>
                        <table class="c3">
                            <tbody>
                                <tr class="c18">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">fjs: </span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1">
                                            <span class="c0"></span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">arch.:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">anillados:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">legajo:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">ejemplar:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c5">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">engrapad:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1 c6">
                                            <span class="c0">
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="c15">
                                    <td class="c9" colspan="1" rowspan="1">
                                        <p class="c7">
                                            <span class="c0">cd:</span>
                                        </p>
                                    </td>
                                    <td class="c2" colspan="1" rowspan="1">
                                        <p class="c1">
                                            <span class="c0"></span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="c7 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c4">
                            <span class="c10">HR: <?=$hoja['nro_de_control']?></span>
                        </p>
                    </td>
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c8">
                            <span class="c0"><b>DE:</b> <?=$hoja['procedencia']?></span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c6 c8">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8">
                            <span class="c0"><b>REF:</b> <?=$hoja['referencia']?></span>
                        </p>
                    </td>
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c8">
                            <span class="c0"><b>FECHA:</b> <?=DateTime::createFromFormat('Y-m-d', $hoja['fecha'])->format('d/m/Y')?></span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8 c6">
                            <span class="c0">
                            </span>
                        </p>
                        <p class="c8">
                            <span class="c0"><b>PARA:</b> <?=$hoja['destinatario']?></span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="c17 c6">
            <span class="c0">
            </span>
        </p>
        <div>
            <p class="c6 c17">
                <span class="c0">
                </span>
            </p>
        </div>
        <script>window.printPDF = true;</script>
    </body>
</html>