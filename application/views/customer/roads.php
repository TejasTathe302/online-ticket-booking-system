<div class="container-fluid p-3 p-md-5">
    <form action="<?= base_url() ?>customer/roads" method="GET" onsubmit="return validateForm()">
        <div class="row">
            <div class="col-12">
                <h2 class="fw-bold">View Routes</h2>
            </div>
            <hr class="mt-2 mt-2">
            <div class="col-md-4 text-start mt-2">
                <label for="">From Location: </label>
                <select name="from" required class="form-control" id=from-location>
                    <option value="" selected disabled hidden>Select From Location</option>
                    <?php foreach ($citys as $row) { ?>
                        <option value="<?= $row['city_tbl_id'] ?>" <?php if (isset($_GET['from']) && $_GET['from'] == $row['city_tbl_id']) {
                                                                        echo "selected";
                                                                    } ?>><?= $row['city_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4 text-start mt-2">
                <label for="">To Location: </label>
                <select name="to" required class="form-control" id="to-location">
                    <option value="" selected disabled hidden>Select To Location</option>
                    <?php foreach ($citys as $row) { ?>
                        <option value="<?= $row['city_tbl_id'] ?>" <?php if (isset($_GET['to']) && $_GET['to'] == $row['city_tbl_id']) {
                                                                        echo "selected";
                                                                    } ?>><?= $row['city_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4 mt-3 text-center">
                <button class="btn btn-primary mt-3">Get Seat Details</button>
            </div>
        </div>
    </form>

    <script>
        function validateForm() {
            var fromLocation = document.getElementById('from-location').value;
            var toLocation = document.getElementById('to-location').value;
            if (fromLocation === toLocation) {
                alert("From and To locations cannot be the same.");
                return false;
            }
            return true;
        }
    </script>

    <?php if (isset($routs)) { ?>
        <style>
            .route-container {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
            }

            .route-stop {
                position: relative;
                padding: 10px 20px;
                text-align: center;
                margin: 10px;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                background-color: #fff;
            }

            .route-stop .stop-name {
                font-weight: bold;
            }

            .route-stop .prices {
                margin-top: 10px;
            }

            .route-stop:after {
                content: '→';
                position: absolute;
                right: -20px;
                top: 50%;
                transform: translateY(-50%);
                font-size: 24px;
            }

            .route-stop:last-child:after {
                display: none;
            }

            @media (max-width: 690px) {
                .route-container {
                    flex-direction: column;
                }

                .route-stop {
                    margin-bottom: 20px;
                }

                .route-stop:after {
                    content: '↓';
                    right: 50%;
                    top: 100%;
                    transform: translateX(50%);
                    font-size: 24px;
                }

                .route-stop:last-child:after {
                    display: none;
                }
            }
        </style>
        <hr class="mt-5 mb-4">
        <div class="row">
            <div class="col-12 route-container">
                <?php foreach ($routs as $key => $value) { ?>
                    <div class="route-stop">
                        <div class="stop-name"><?= $value['city_name'] ?></div>
                        <div class="prices">
                            <p>Single seat: ₹<?= $value['amount_to_reach_single'] ?></p>
                            <p>Double seat: ₹<?= $value['amount_to_reach_double'] ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>