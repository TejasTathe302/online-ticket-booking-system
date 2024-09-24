<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Buss Ticket Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        @media(width>690px) {
            .extra {
                display: flex;
                gap: 30px;
                font-weight: bold;
            }
        }
    </style>
</head>

<body>
    <?php $page_name = $this->router->fetch_method(); ?>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand me-auto fw-bolder" href="<?= base_url() ?>customer/index">Ticket Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto extra">
                    <li class="nav-item">
                        <a class="nav-link <?= $page_name == 'index' ? 'active' : '' ?>" aria-current="page" href="<?= base_url() ?>customer/index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page_name == 'booking' ? 'active' : '' ?>" href="<?= base_url() ?>customer/booking">Book Ticket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page_name == 'your_booking' ? 'active' : '' ?>" href="<?= base_url() ?>customer/your_booking">Your Booking's</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page_name == 'roads' ? 'active' : '' ?>" href="<?= base_url() ?>customer/roads">Check Route's</a>
                    </li>
                    <?php if (isset($_SESSION['customer_tbl_id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>login/log_out" onclick="return confirm('Are You Sure...')"> <button class="btn btn-sm btn-danger fw-bold text-white">Log Out</button></a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>login"><button class="btn btn-sm btn-success fw-bold text-white">Login</button></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>