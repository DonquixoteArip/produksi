<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Export</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
        }

        .container {
            width: 100%;
            height: 100%;
        }

        .tbl_ex {
            width: 100%;
            border: 1px solid #000;
        }

        .tbl_ex tr td {
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    <?php
    $total = count($data);
    $page = $total / 8;
    $ex = explode('.', $page);
    $total_ex = count($ex);
    $total_page = round($page);
    if ($total_ex == 2) {
        $total_page = $total_page + 1;
    }
    $offset = 0;
    $i = 0;
    $asd = 0;
    ?>
    <div class="container">
        <?php
        for ($t = 0; $t < $total_page; $t++) {
        ?>
            <div class="table-cont">
                <table class="tbl_ex">
                    <tr>
                        <td rowspan="2" colspan="2" style="border: 1px solid #000;">
                            <div style="margin-left: 25px; margin-right: 150px;">
                                <h4 style="font-weight: 500;">Materials</h4>
                                <h4 style="font-weight: normal;"><?= $row['ordernumber'] ?></h4>
                            </div>
                        </td>
                        <td rowspan="2" colspan="2" style="border: 1px solid #000;">
                            <div style="margin-left: 25px; margin-right: 90px;">
                                <h4 style="font-weight: 500;">Batch Number</h4>
                                <h4 style="font-weight: normal;"><?= $row['batchnumber'] ?></h4>
                            </div>
                        </td>
                        <td colspan="2" style="border: 1px solid #000;">
                            <div style="margin-left: 25px; margin-right: 25px;">
                                <h5 style="font-weight: 300;">Serial Number(s)</h6>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div style="margin-left: 25px; margin-right: 25px;">
                                <h5 style="font-weight: 500;">Print Date: &nbsp;<span style="font-weight: normal;"><?= date('l, d F Y') ?></span> </h5>
                            </div>
                        </td>
                    </tr>
                    <tr style="font-weight: 300; font-size: 14px;">
                        <td>Unit</td>
                        <td>Serial Number</td>
                        <td colspan="2">Serial Number Barcode</td>
                        <td>Status</td>
                        <td>Date</td>
                    </tr>
                    <?php
                    $barcode = new \Picqer\Barcode\BarcodeGeneratorPNG();
                    for ($b = $offset; $b < count($data); $b++) {
                        $i++;
                        $asd++;
                        $offset = $b;
                    ?>
                        <tr>
                            <td><?= $b + 1 ?></td>
                            <td><?= $data[$b]['data']['serialnumber'] ?></td>
                            <td colspan="2" style="text-align: center;">
                                <img style="margin-top: 10px; margin-bottom: 10px;" src="data:image/png;base64,<?= base64_encode($barcode->getBarcode($data[$b]['data']['serialnumber'], $barcode::TYPE_CODE_128)) ?>">
                            </td>
                            <td>
                                <?php
                                $sts = $data[$b]['data']['status'];
                                $status = '';
                                switch ($sts) {
                                    case '1':
                                        $status = 'Ok By Camera';
                                        break;
                                    case '2':
                                        $status = 'Ok By Admin';
                                        break;
                                    case '3':
                                        $status = 'Reject';
                                        break;
                                }
                                ?>
                                <?= $status ?>
                            </td>
                            <td><?= date('d-m-Y', strtotime($data[$b]['data']['createddate'])) ?></td>
                        </tr>
                        <?php
                        if ($asd == 8) {
                            $asd = 0;
                            $offset++;
                            break;
                        }
                        ?>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>
    </div>
</body>

</html>