<style>
    .carousel-inner {
        position: relative;
        border-radius: 30px;
    }

    .carousel-caption {
        position: absolute;
        bottom: 20px;
        left: 20px;
        text-align: left;
        color: white;
        text-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
    }

    .carousel-control-prev,
    .carousel-control-next {
        top: 50%;
        transform: translateY(-50%);
        width: 47px;
        height: 47px;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 25px;
        height: 25px;
    }

    .carousel-item img {
        border-radius: 3px;
        height: 100%;
        width: 100%;
        object-fit: fill;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    .carousel-item {
        position: relative;
        height: 100%;
    }

    .carousel-inner {
        height: 95vh;
        padding: 50px;
    }

    @media (width < 690px) {
        .carousel-inner {
            height: 40vh;
            padding: 10px;
        }

        .carousel-inner {
            position: relative;
            border-radius: 10px;
        }
    }
</style>
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://5.imimg.com/data5/UH/VO/MY-6076314/online-bus-booking-services.png" class="d-block w-100 h-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h3>Stunning Landscape</h3>
                <p>Experience the beauty of nature</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://ideausher.com/wp-content/uploads/2021/03/Instagram-Post-%E2%80%93-2-1.png" class="d-block w-100 h-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h3>Creative Innovation</h3>
                <p>Empowering the future of design</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://www.bdtask.com/blog/uploads/web-based-bus-reservation-system.jpg" class="d-block w-100 h-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h3>Bold Ideas</h3>
                <p>Bringing creativity to life</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 50%; padding: 10px;">
        <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1);"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 50%; padding: 10px;">
        <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1);"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>