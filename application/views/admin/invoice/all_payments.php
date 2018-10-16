<?= message_box('success') ?>
<?= message_box('error') ?>
<?php
$edited = can_action('13', 'edited');
$deleted = can_action('13', 'deleted');
?>

<section class="panel panel-custom ">
    <header class="panel-heading"><?= lang('all_payments') ?> </header>

    <div class="panel-body">
        <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><?= lang('payment_date') ?></th>
                <th><?= lang('invoice_date') ?></th>
                <th><?= lang('invoice') ?></th>
                <th><?= lang('client') ?></th>
                <th><?= lang('amount') ?></th>
                <th><?= lang('payment_method') ?></th>
                <?php if (!empty($edited) || !empty($deleted)) { ?>
                    <th class="hidden-print"><?= lang('action') ?></th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($all_invoice_info)) {
                foreach ($all_invoice_info as $v_invoice) {
                    if (!empty($v_invoice)) {

                        $can_edit = $this->invoice_model->can_action('tbl_invoices', 'edit', array('invoices_id' => $v_invoice->invoices_id));
                        $can_delete = $this->invoice_model->can_action('tbl_invoices', 'delete', array('invoices_id' => $v_invoice->invoices_id));

                        $all_payment_info = $this->db->where('invoices_id', $v_invoice->invoices_id)->get('tbl_payments')->result();
                        if (!empty($all_payment_info)):foreach ($all_payment_info as $v_payments_info):
                            ?>
                            <tr>
                                <?php
                                $client_info = $this->invoice_model->check_by(array('client_id' => $v_invoice->client_id), 'tbl_client');
                                if (!empty($client_info)) {
                                    $c_name = $client_info->name;
                                    $currency = $this->invoice_model->client_currency_sambol($v_invoice->client_id);
                                } else {
                                    $c_name = '-';
                                    $currency = $this->invoice_model->check_by(array('code' => config_item('default_currency')), 'tbl_currencies');
                                }
                                $payment_methods = $this->invoice_model->check_by(array('payment_methods_id' => $v_payments_info->payment_method), 'tbl_payment_methods');
                                ?>

                                <td>
                                    <a href="<?= base_url() ?>admin/invoice/manage_invoice/payments_details/<?= $v_payments_info->payments_id ?>"> <?= strftime(config_item('date_format'), strtotime($v_payments_info->payment_date)); ?></a>
                                </td>
                                <td><?= strftime(config_item('date_format'), strtotime($v_invoice->date_saved)) ?></td>
                                <td><a class="text-info"
                                       href="<?= base_url() ?>admin/invoice/manage_invoice/invoice_details/<?= $v_payments_info->invoices_id ?>"><?= $v_invoice->reference_no; ?></a>
                                </td>

                                <td><?= $c_name; ?></td>
                                <td><?= display_money($v_payments_info->amount, $currency->symbol); ?> </td>
                                <td><?= $payment_methods->method_name ?></td>
                                <?php if (!empty($edited) || !empty($deleted)) { ?>
                                    <td>
                                        <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                            <?= btn_edit('admin/invoice/all_payments/' . $v_payments_info->payments_id) ?>
                                        <?php }
                                        if (!empty($can_delete) && !empty($deleted)) {
                                            ?>
                                            <?= btn_delete('admin/invoice/delete/delete_payment/' . $v_payments_info->payments_id) ?>
                                        <?php } ?>
                                        <?= btn_view('admin/invoice/manage_invoice/payments_details/' . $v_payments_info->payments_id) ?>
                                        <?php if (!empty($can_edit) && !empty($edited)) { ?>
                                            <a data-toggle="tooltip" data-placement="top"
                                               href="<?= base_url() ?>admin/invoice/send_payment/<?= $v_payments_info->payments_id . '/' . $v_payments_info->amount ?>"
                                               title="<?= lang('send_email') ?>"
                                               class="btn btn-xs btn-success">
                                                <i class="fa fa-envelope"></i> </a>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php
                        endforeach;
                        endif;
                    }

                }
            }
            ?>
            </tbody>
        </table>
    </div>
</section>