<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title . " " . $this->lang->line("no") . " " . $inv->id; ?></title>
    <link rel="shortcut icon" href="<?php echo $this->config->base_url(); ?>assets/img/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo $this->config->base_url(); ?>assets/css/<?php echo THEME; ?>.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo $this->config->base_url(); ?>assets/js/jquery.js"></script>
    <style type="text/css">
        html, body {
            height: 100%; /* font-family: "Segoe UI", Candara, "Bitstream Vera Sans", "DejaVu Sans", "Bitstream Vera Sans", "Trebuchet MS", Verdana, "Verdana Ref", sans-serif; */
        }

        #wrap {
            padding: 20px;
        }

        .table th {
            text-align: center;
        }
    </style>
</head>

<body>
<div id="wrap">
    <div class="row-fluid text-center" style="margin-bottom:20px;">
        <img src="<?php echo base_url() . 'assets/img/' . LOGO2; ?>" alt="<?php echo SITE_NAME; ?>">
    </div>
    <div class="row-fluid">
        <h3>Received Item List</h3>
    </div>
    <div class="row-fluid">

        <div class="span6">

            <p style="font-weight:bold;">Challan No: <?php echo $inv->reference_no; ?></p>

            <p style="font-weight:bold;">Received Date: <?php echo date("d-m-Y", strtotime($inv->date)); ?></p>
        </div>
        <div style="clear: both;"></div>
    </div>
    <p>&nbsp;</p>
    <table class="table table-bordered table-hover table-striped" style="margin-bottom: 5px;">

        <thead>

        <tr>
            <th><?php echo $this->lang->line("no"); ?></th>
            <th><?php echo $this->lang->line("description"); ?> (<?php echo $this->lang->line("code"); ?>)</th>
            <th>UM</th>
            <th><?php echo $this->lang->line("quantity"); ?></th>
        </tr>

        </thead>

        <tbody>

        <?php $grandTotal = 0;
        $taxTotal = 0;
        $r = 1;
        foreach ($rows as $row): ?>
            <tr>
                <td style="text-align:center; width:40px; vertical-align:middle;"><?php echo $r; ?></td>
                <td style="vertical-align:middle;"><?php echo $row->product_name . " (" . $row->product_code . ")"; ?></td>
                <td style="vertical-align:middle;"><?php echo $row->um; ?></td>
                <td style="width: 100px; text-align:right; vertical-align:middle;"><?php echo $row->quantity; ?></td>
            </tr>
            <?php
            $r++;
            $grandTotal = ($grandTotal + ($row->quantity));
        endforeach;
        ?>
        <?php $col = 5;
        if (TAX1) {
            $col += 1;
        } ?>


        <tr>
            <td colspan="3" style="text-align:right; padding-right:10px;">Total</td>
            <td style="text-align:right; padding-right:10px;"><?php echo $grandTotal; ?></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right; padding-right:10px; font-weight:bold; vertical-align:middle;">Grand
                Total
            </td>
            <td style="text-align:right; padding-right:10px; font-weight:bold; vertical-align:middle;"><?php echo($grandTotal); ?></td>
        </tr>

        </tbody>

    </table>
    <div style="clear: both;"></div>

</div>
</body>
</html>