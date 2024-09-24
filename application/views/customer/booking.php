<style>
    .container {
        max-width: 900px;
        margin: 20px auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    h3 {
        color: #333;
        font-weight: 600;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .bus-container {
        display: inline-block;
        margin-bottom: 20px;
        border-radius: 10px;
        border: 2px solid gray;
    }

    .seat {
        width: 50px;
        height: 50px;
        background-color: #28a745;
        margin: 5px;
        position: relative;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: bold;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .crown {
        position: absolute;
        top: 8px;
        left: 8px;
        font-size: 10px;
        transform: rotate(330deg);
    }

    .stairs {
        width: 100px;
        height: 50px;
        margin: 5px;
        display: inline-flex;
        align-items: center;
        color: white;
        font-weight: bold;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .seat:hover:not(.booked) {
        background-color: #218838;
        transform: translateY(-3px);
    }


    .seat.double {
        background-color: rgb(247, 62, 163);
    }

    .seat.booked {
        background-color: #6c757d;
        cursor: not-allowed;
    }

    .seat.selected {
        background-color: #dc3545;
    }

    .seat-row {
        display: flex;
        justify-content: center;
    }

    .seat.space {
        visibility: hidden;
        width: 30px;
    }

    .seat.driver {
        background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
        width: 90px;
    }

    .seat-info {
        margin-top: 20px;
        text-align: center;
    }

    .seat-info div {
        margin: 5px 0;
    }

    .seat-info span {
        display: inline-block;
        width: 150px;
        font-weight: 600;
        color: #f5576c;
    }

    .price-info {
        margin-top: 20px;
        font-weight: bold;
        color: #666;
    }

    .legend {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        margin-right: 15px;
        font-size: 14px;
    }

    .legend-color {
        width: 20px;
        height: 20px;
        margin-right: 5px;
        border-radius: 5px;
        display: inline-block;
    }

    .legend-color.single {
        background-color: #28a745;
    }

    .legend-color.double {
        background-color: rgb(247, 62, 163);
    }

    .legend-color.booked {
        background-color: #6c757d;
    }

    .legend-color.selected {
        background-color: #dc3545;
    }

    #save-booking:hover {
        background-color: #0056b3;
    }
</style>
<div class="container">
    <form action="<?= base_url() ?>customer/booking" method="GET" onsubmit="return validateForm()">
        <div class="row">
            <div class="col-12">
                <h2 class="fw-bold">Book Ticket</h2>
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
            <div class="col-md-4 mt-2">
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
    <?php if (isset($pricing)) { ?>
        <hr class="mt-4">
        <h3>Available Seats From Pune To Mumbai</h3>
        <div class="bus-container">
            <div class="seats" style="display: flex; justify-content: space-between;">
                <div class="stairs">
                    <img src="<?= base_url() ?>assets/stairs.png" alt="" height="100%" width="100%">
                </div>
                <div class="seat driver">
                    <i class="fa fa-user " style="margin-top: -5px;"></i> &nbsp; Driver
                </div>
            </div>
            <div class="seats">
                <?php for ($i = 0; $i < 5; $i++) {
                    $j = $i + 1; ?>

                    <div class="seat-row">
                        <div class="seat <?= in_array($j . 'A', $booked_seats) ? 'booked' : 'single' ?>" data-type="single" data-price="<?= $pricing['amount_to_reach_single'] ?>"><?= $j ?>A</div>
                        <div class="seat <?= in_array($j . 'B', $booked_seats) ? 'booked' : 'double' ?>" data-type="double" data-price="<?= $pricing['amount_to_reach_double'] ?>"><i class="fa fa-crown crown"></i><?= $j ?>B</div>
                        <div class="seat space"></div>
                        <div class="seat <?= in_array($j . 'C', $booked_seats) ? 'booked' : 'double' ?>" data-type="double" data-price="<?= $pricing['amount_to_reach_double'] ?>"><i class="fa fa-crown crown"></i><?= $j ?>C</div>
                        <div class="seat <?= in_array($j . 'D', $booked_seats) ? 'booked' : 'single' ?>" data-type="single" data-price="<?= $pricing['amount_to_reach_single'] ?>"><?= $j ?>D</div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="seat-info">
            <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px;">Selected Seats</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="selected-seats" style="border: 1px solid #ddd; padding: 8px;">None</td>
                        <td id="total-price" style="border: 1px solid #ddd; padding: 8px;">&#8377;0</td>
                    </tr>
                </tbody>
            </table>
            <button id="save-booking" style="margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Save Your Booking
            </button>
        </div>
        <div class="price-info">
            Single Seat: &#8377; <?= $pricing['amount_to_reach_single'] ?> | Double Seat: &#8377; <?= $pricing['amount_to_reach_double'] ?>
        </div>
        <div class="legend">
            <div class="legend-item">
                <div class="legend-color single"></div> Single Seat
            </div>
            <div class="legend-item">
                <div class="legend-color double"></div> Double Seat
            </div>
            <div class="legend-item">
                <div class="legend-color booked"></div> Booked Seat
            </div>
            <div class="legend-item">
                <div class="legend-color selected"></div> Selected Seat
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const seats = document.querySelectorAll('.seat:not(.driver):not(.space):not(.booked)');
                const selectedSeatsElement = document.getElementById('selected-seats');
                const totalPriceElement = document.getElementById('total-price');
                let selectedSeats = [];
                let totalPrice = 0;
                seats.forEach(seat => {
                    seat.addEventListener('click', () => {
                        const seatType = seat.dataset.type;
                        const seatPrice = parseInt(seat.dataset.price);
                        if (seat.classList.contains('selected')) {
                            seat.classList.remove('selected');
                            selectedSeats = selectedSeats.filter(s => s !== seat.innerText);
                            totalPrice -= seatPrice;
                        } else {
                            seat.classList.add('selected');
                            selectedSeats.push(seat.innerText);
                            totalPrice += seatPrice;
                        }
                        selectedSeatsElement.innerText = selectedSeats.length > 0 ? selectedSeats.join(', ') : 'None';
                        totalPriceElement.innerText = `₹ ${totalPrice}`;
                    });
                });
                document.getElementById('save-booking').addEventListener('click', () => {
                    if (selectedSeats.length == 0) {
                        alert("Please select at least one seat...");
                        return;
                    }
                    var form_data = new FormData();
                    selectedSeats.forEach((seat, index) => {
                        form_data.append(`selectedSeats[${index}]`, seat);
                    });
                    form_data.append('totalPrice', totalPrice);
                    form_data.append('from', <?= $_GET['from'] ?>);
                    form_data.append('to', <?= $_GET['to'] ?>);
                    fetch('<?= base_url() ?>customer/save_booking', {
                            method: 'POST',
                            body: form_data
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data)
                            if (data.status == 'success') {
                                const selectedSeatsText = selectedSeats.length > 0 ? selectedSeats.join(', ') : 'None';
                                const totalPriceText = totalPrice > 0 ? `₹ ${totalPrice}` : '₹ 0';
                                alert(`Booking Saved!\nSelected Seats: ${selectedSeatsText}\nTotal Price: ${totalPriceText}`);
                                window.location.href = "<?= base_url() ?>customer/your_booking";
                            } else {
                                alert('Error saving booking.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('There was a problem saving the booking.');
                        });
                });

            });
        </script>
    <?php } ?>
</div>