<div class="container">
    <form action="<?= base_url() ?>admin/booking" method="get">
        <div class="row">
            <div class="col-12">
                <h3 class="p-4 fw-bold">Get Bus Booking</h3>
            </div>
            <div class="col-2">
            </div>
            <div class="col-4">
                <label for="">Bus Name : </label>
                <select name="buses_tbl_id" class="form-control" required>
                    <option value="">Select Bus</option>
                    <?php foreach ($buses as $key => $value) { ?>
                        <option value="<?= $value['buses_tbl_id'] ?>" <?= isset($_GET['buses_tbl_id']) && $_GET['buses_tbl_id'] == $value['buses_tbl_id'] ? "selected" : "" ?>><?= $value['bus_name'] ?></option>
                    <?php } ?>
                    <option value="all">All Buses</option>
                </select>
            </div>
            <div class="col-4 text-center p-4">
                <button class="btn btn-success">Get Rout</button>
            </div>
            <div class="col-2"> </div>
        </div>
    </form>
</div>
<?php if (isset($bookings)) { ?>
    <div class="container mt-3">
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="p-4 fw-bold">Bookings Of <?= $bus_det ?></h3>
            </div>
            <div class="col-12 table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr style="text-wrap:nowrap">
                            <th>Sr. No</th>
                            <th>Bus Name</th>
                            <th>Customer Name</th>
                            <th>From Location</th>
                            <th>To Location</th>
                            <th>Booked Sits</th>
                            <th>Total Amount (&#8377;)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($bookings) > 0) {
                            foreach ($bookings as $key => $value) {
                        ?>
                                <tr>
                                    <td class="text-center sr_no"><?= $key + 1 ?></td>
                                    <td class="text-center">
                                        <?= getBusName($value['buses_tbl_id']) ?>
                                    </td>
                                    <td class="text-center">
                                        <?= getCustomerName($value['customer_tbl_id']) ?>
                                    </td>
                                    <td class="text-center">
                                        <?= getCityName($value['from_location']) ?>
                                    </td>
                                    <td class="text-center">
                                        <?= getCityName($value['to_location']) ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $value['booked_seats'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $value['totalPrice'] ?>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="7" class="text-warning text-center">
                                    No Booking yet...
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php } ?>