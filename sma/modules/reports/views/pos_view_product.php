<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title." ".$this->lang->line("no")." ".$inv->id; ?></title>
    <style type="text/css" media="all">
        body { text-align:center; color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; }
        #wrapper {  width: 330px; margin: 0 auto; top:-50px; }
        #wrapper img { max-width: 250px; width: auto; }

        h3 { margin: 5px 0; }
        .left { width:60%; float:left; text-align:left; margin-bottom: 3px; }
        .right { width:40%; float:right; text-align:right; margin-bottom: 3px; }
        .table, .totals { width: 100%; margin:10px 0; }
        .table th { border-bottom: 1px solid #000; }
        .table td { padding:0; }
        .totals td { width: 24%; padding:0; }
        .table td:nth-child(2) { overflow:hidden; }

        @media print {
            #buttons { display: none; }
            #wrapper { max-width: 340px; width: 100%; margin: 0 auto; font-size:9px; margin-top::-100px; }
            #wrapper img { max-width:250px; width: 80%; }
        }


    </style>
</head>

<body>
<div id="wrapper">
    <img src="<?php echo $this->config->base_url(); ?>assets/uploads/logos/<?php echo $biller->logo; ?>" alt="Biller Logo">
    <h3 style="text-transform:uppercase;"><?php echo $biller->company; ?></h3>
    <?php echo "<p style=\"text-transform:capitalize;\">".$biller->address.", ".$biller->city.", ".$biller->postal_code.", ".$biller->state.", ".$biller->country."</p>";
    echo "<div><p>".$biller->cf1."</p>";
    echo '<div style="clear:both;"></div>';
    echo "<span class=\"left\">DITF  Pavilion No.- ". $biller->cf2."</span>
    <span class=\"right\">".$this->lang->line("booth_no").": ".BOOTH_NO."</span>
    <span  class=\"left\">".$this->lang->line("sale_start_date").": ".date('d-m-Y', strtotime($sale_start_date))." To ".date('d-m-Y', strtotime($sale_end_date))."</span></div>";?>
    <div style="clear:both;"></div>

    <table class="table" cellspacing="0"  border="0">
        <thead>
        <tr>
            <th><?php echo $this->lang->line("#"); ?></th>
            <th><?php echo $this->lang->line("description"); ?></th>
            <th><?php echo $this->lang->line("qty"); ?></th>
            <th><?php echo $this->lang->line("price"); ?></th>
            <th><?php echo $this->lang->line("total"); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $r = 1; $totalCount=0;$getBuy = 0;$totalVat=0; foreach ($rows as $row):?>
            <tr>
                <td style="text-align:center; width:30px;"><?php echo $r; ?></td>
                <td style="text-align:left; width:180px;"><?php echo $row->product_name.$row->get_buy_qnt; ?></td>
                <td style="text-align:center; width:50px;"><?php echo $row->quantity; ?></td>
                <td style="text-align:right; width:55px; "><?php echo $this->ion_auth->formatMoney($row->unit_price); ?></td>
                <td style="text-align:right; width:65px;"><?php echo $this->ion_auth->formatMoney($row->gross_total); ?></td>
            </tr>
            <?php
            $getBuy = $getBuy + $row->get_buy_qnt;
            $totalCount=$totalCount+$row->quantity;
            $r++;
        endforeach;
        ?>
        </tbody>
    </table>

    <table class="totals" cellspacing="0" border="0">
        <tbody>
        <tr>
            <td style="text-align:left;"><?php echo $this->lang->line("total_items"); ?></td><td style="text-align:right; padding-right:1.5%; border-right: 1px solid #999;font-weight:bold;"><?php echo $totalCount ?></td>
            <td style="text-align:left; padding-left:1.5%;">Total</td><td style="text-align:right;font-weight:bold;"><?php echo $this->ion_auth->formatMoney($inv[0]->gross_total); ?></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td style="text-align:left; padding-left:1.5%;">SD</td><td style="text-align:right;font-weight:bold;"><?php echo $this->ion_auth->formatMoney($inv[0]->total_tax); ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td style="text-align:left; padding-left:1.5%;">Vat</td><td style="text-align:right;font-weight:bold;"><?php echo $this->ion_auth->formatMoney($inv[0]->total_tax2); ?></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td style="text-align:left; padding-left:1.5%;">Net sales</td><td style="text-align:right;font-weight:bold;"><?php echo $this->ion_auth->formatMoney($inv[0]->gross_total - $inv[0]->total_tax2 -$inv[0]->total_tax); ?></td>
        </tr>

        </tbody>
    </table>
    <div><?php echo $this->lang->line("print_date").": ".date("d-m-Y h:i:sa"); ?></div>
    <div style="border-top:1px solid #000; padding-top:10px;">
        <?php echo html_entity_decode($biller->invoice_footer); ?>
    </div>

    <div id="buttons" style="padding-top:10px; text-transform:uppercase;">
        <span class="left"><a href="#" style="width:90%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#000; background-color:#4FA950; border:2px solid #4FA950; padding: 10px 1px; font-weight:bold;" id="email"><?php echo $this->lang->line("email"); ?></a></span>
        <span class="right"><button type="button" onClick="window.print();return false;" style="width:100%; cursor:pointer; font-size:12px; background-color:#FFA93C; color:#000; text-align: center; border:1px solid #FFA93C; padding: 10px 1px; font-weight:bold;"><?php echo $this->lang->line("print"); ?></button></span>
        <div style="clear:both;"></div>
        <!-- <a href="<?php echo base_url(); ?>index.php?module=pos" style="width:98%; display:block; font-size:12px; text-decoration: none; text-align:center; color:#FFF; background-color:#007FFF; border:2px solid #007FFF; padding: 10px 1px; margin: 5px auto 10px auto; font-weight:bold;"><?php echo $this->lang->line("back_to_pos"); ?></a>
    <div style="clear:both;"></div>
     <div style="background:#F5F5F5; padding:10px;">
    <p style="font-weight:bold;">Please don't forget to disble the header and footer in browser print settings.</p>
    <p style="text-transform: capitalize;"><strong>FF:</strong> File > Print Setup > Margin & Header/Footer Make all --blank--</p>
    <p style="text-transform: capitalize;"><strong>chrome:</strong> Menu > Print > Disable Header/Footer in Option & Set Margins to None</p>	</div>
    -->
        <div style="clear:both;"></div>
    </div>

</div>

</body>
</html>
