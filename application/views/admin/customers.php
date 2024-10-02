<div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="p-4 fw-bold">All Customers</h3>
            </div>
            <div class="col-12 table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr style="text-wrap:nowrap">
                            <th class="text-center">Action</th>
                            <th class="text-center">Sr. No</th>
                            <th class="text-center">Customer Name</th>
                            <th class="text-center">Customer Mobile</th>
                            <th class="text-center">Customer Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($customers) > 0) {
                            foreach ($customers as $key => $value) {
                        ?>
                                <tr>
                                    <td class="text-center">
                                        <?php if($value['status']=='active'){ ?>
                                            <a href="<?=base_url()?>admin/block_customer/<?=$value['customer_tbl_id']?>" onclick=" return confirm('Are You Sure...')">
                                            <button class="btn btn-sm btn-secondary">Block</button>
                                        </a>
                                        <?php }else{ ?>
                                            <a href="<?=base_url()?>admin/activate_customer/<?=$value['customer_tbl_id']?>" onclick=" return confirm('Are You Sure...')">
                                            <button class="btn btn-sm btn-success">Activate</button>
                                        </a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center sr_no"><?= $key + 1 ?></td>
                                    <td class="text-center">
                                        <?= $value['name'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $value['mobile'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $value['email'] ?>
                                    </td>
                                    
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="7" class="text-warning text-center">
                                    No Customer yet...
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>