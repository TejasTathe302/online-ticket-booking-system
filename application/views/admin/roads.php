<div class="container">
    <form action="<?= base_url() ?>admin/roads" method="get">
        <div class="row">
            <div class="col-12">
                <h3 class="p-4 fw-bold">Get Bus Routs</h3>
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
                </select>
            </div>
            <div class="col-4 text-center p-4">
                <button class="btn btn-success">Get Rout</button>
            </div>
            <div class="col-2"> </div>
        </div>
    </form>
</div>
<?php if (isset($routs)) { ?>
    <div class="container mt-5">
        <hr>
    </div>
    <div class="container">
        <form action="<?= base_url() ?>admin/save_routs" method="POST" onsubmit="return checkData()">
            <div class="row">
                <div class="col-12">
                    <h3 class="p-4 fw-bold">Routs Of <?= $bus_det[0]['bus_name'] ?></h3>
                    <input type="hidden" name="city_tbl_id" value="<?= $bus_det[0]['buses_tbl_id'] ?>">
                </div>
                <div class="col-12 table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr style="text-wrap:nowrap">
                                <th style="width:10%;">Action</th>
                                <th>Sr. No</th>
                                <th>City Name</th>
                                <th>Distance From Prev City (KM)</th>
                                <th>Amount Reach Single Seat (&#8377;)</th>
                                <th>Amount Reach Double Seat (&#8377;)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($routs) > 0) {
                                foreach ($routs as $key => $value) {
                                    $readonly = 'readonly';
                            ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php if ($key != 0) {
                                                $readonly = "";
                                            ?>
                                                <button class="btn btn-danger btn-sm" onclick="deleteThis(this)"><i class="fa fa-trash"></i></button>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center sr_no"><?= $key + 1 ?></td>
                                        <td class="text-center">
                                            <input type="text" name="city_name[]" placeholder="Enter City Name" value="<?= $value['city_name'] ?>" class="form-control city_name">
                                        </td>
                                        <td class="text-center">
                                            <input type="number" <?= $readonly ?> name="distance_form_parent[]" placeholder="Enter Distance From Previous City" value="<?= $value['distance_form_parent'] ?>" class="form-control distance_form_parent">
                                        </td>
                                        <td class="text-center">
                                            <input type="number" <?= $readonly ?> name="amount_to_reach_single[]" placeholder="Single Seat Amount" value="<?= $value['amount_to_reach_single'] ?>" class="form-control amount_to_reach_single">
                                        </td>
                                        <td class="text-center">
                                            <input type="number" <?= $readonly ?> name="amount_to_reach_double[]" placeholder="Double Seat Amount" value="<?= $value['amount_to_reach_double'] ?>" class="form-control amount_to_reach_double">
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td class="text-center">
                                    </td>
                                    <td class="text-center sr_no p-3">1</td>
                                    <td class="text-center">
                                        <input type="text" name="city_name[]" required placeholder="Enter City Name" class="form-control city_name">
                                    </td>
                                    <td class="text-center">
                                        <input type="number" name="distance_form_parent[]" placeholder="Enter Distance From Previous City" value="0" class="form-control distance_form_parent" readonly>
                                    </td>
                                    <td class="text-center">
                                        <input type="number" name="amount_to_reach_single[]" placeholder="Single Seat Amount" value="0" class="form-control amount_to_reach_single" readonly>
                                    </td>
                                    <td class="text-center">
                                        <input type="number" name="amount_to_reach_double[]" placeholder="Double Seat Amount" readonly value="0" class="form-control amount_to_reach_double">
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 text-center">
                    <button class="btn btn-sm btn-primary" type="button" id="addRow">Add Row</button>&nbsp;
                    <button class="btn btn-sm btn-success">Save Data</button>
                </div>
            </div>
        </form>

        <script>
            document.querySelector("#addRow").addEventListener('click', (event) => {
                var taBody = document.querySelector('tbody');
                var newRow = `
                    <tr>
                        <td class="text-center">
                            <button class="btn btn-danger btn-sm" onclick="deleteThis(this)"><i class="fa fa-trash"></i></button>
                        </td>
                        <td class="text-center sr_no p-3">1</td>
                        <td class="text-center">
                            <input type="text" name="city_name[]" required placeholder="Enter First City Name" class="form-control city_name">
                        </td>
                        <td class="text-center">
                            <input type="number" name="distance_form_parent[]" placeholder="Enter Distance From Previous City" class="form-control distance_form_parent" required>
                        </td>
                        <td class="text-center">
                            <input type="number" name="amount_to_reach_single[]" placeholder="Single Seat Amount" class="form-control amount_to_reach_single" required>
                        </td>
                        <td class="text-center">
                            <input type="number" name="amount_to_reach_double[]" placeholder="Double Seat Amount" required class="form-control amount_to_reach_double">
                        </td>
                    </tr>
                `;
                taBody.insertAdjacentHTML("beforeend", newRow);
                countSirNo();
            })

            function countSirNo() {
                var allTr = document.querySelectorAll(".sr_no");
                var count = 0;
                allTr.forEach((element) => {
                    element.innerText = ++count;
                })
            }
            function deleteThis(element) {
                var row = element.closest("tr");
                row.remove();
            }
            function checkData(){
                var allTr = document.querySelectorAll(".sr_no");
                if(allTr.length < 2){
                    alert("Please Add At list two cities...");
                    return false;
                }
                return true;
            }
        </script>

    <?php } ?>