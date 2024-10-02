<div class="container">
    <div class="row">
        <div class="col-md-3 p-4">
            <a href="<?= base_url() ?>admin/booking" style="text-decoration:none; color:black;">
                <div class="shadow p-4">
                    <h6 class="text-center fw-bold">Total Bookings</h6>
                    <br>
                    <h1 class="text-center fw-bold"><?= $total_booking ?></h1>
                </div>
            </a>
        </div>
        <div class="col-md-3 p-4">
            <a href="<?= base_url() ?>admin/booking" style="text-decoration:none; color:black;">
                <div class="shadow p-4">
                    <h6 class="text-center fw-bold">Total Bookings Amount</h6>
                    <br>
                    <h1 class="text-center fw-bold"><?= $totalPrice ?></h1>
                </div>
            </a>
        </div>
        <div class="col-md-3 p-4">
            <a href="<?= base_url() ?>admin/buses" style="text-decoration:none; color:black;">
                <div class="shadow p-4">
                    <h6 class="text-center fw-bold">Total Buses</h6>
                    <br>
                    <h1 class="text-center fw-bold"><?= $total_buses ?></h1>
                </div>
            </a>
        </div>
        <div class="col-md-3 p-4">
            <a href="<?= base_url() ?>admin/customers" style="text-decoration:none; color:black;">
                <div class="shadow p-4">
                    <h6 class="text-center fw-bold">Total Customers</h6>
                    <br>
                    <h1 class="text-center fw-bold"><?= $total_customer ?></h1>
                </div>
            </a>
        </div>
    </div>
</div>