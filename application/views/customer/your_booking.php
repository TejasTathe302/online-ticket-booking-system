<style>
    table {
        background-color: #fff;
        border-collapse: collapse;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
        white-space: nowrap;
    }

    th {
        background-color: #343a40;
        color: #fff;
        font-weight: 600;
    }

    td {
        font-size: 14px;
        color: #333;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    tbody tr:nth-child(even) {
        background-color: #e9ecef;
    }

    .fw-bold {
        color: #fff;
    }

    @media (width < 768px) {
        th,
        td {
            font-size: 10px;
            padding: 10px;
        }
    }
</style>

<div class="container-fluid p-3 p-md-5">
    <div class="row">
        <div class="col-12 table-responsive">
            <?php if (isset($booking_tbl_data[0])) { ?>
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Sr. No.</th>
                            <th>From Location</th>
                            <th>To Location</th>
                            <th>Booked Seats</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalPrice = 0;
                        foreach ($booking_tbl_data as $key => $value) {
                            $totalPrice += $value['totalPrice'];
                        ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= getCityName($value['from_location']) ?></td>
                                <td><?= getCityName($value['to_location']) ?></td>
                                <td><?= $value['booked_seats'] ?></td>
                                <td><?= $value['totalPrice'] ?></td>
                            </tr>
                        <?php } ?>
                        <tr class="fw-bold">
                            <td colspan="4" class="text-end">Total Price :</td>
                            <td><?= $totalPrice ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="text-center text-warning">
                    <span>You don't have any booking yet</span> <br>
                    <a href="<?= base_url() ?>customer/booking" >Click to book your seat</a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>