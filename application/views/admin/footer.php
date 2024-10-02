<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-3 p-md-5">
                <div class="rounded shadow p-3 text-center">
                    <span style="font-family: cursive;">Design and developed by :</span>
                    <spa class="text-danger">♥</spa> <span style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"> Tejas Tathe</span>
                </div>
            </div>
        </div>
    </div>
</footer>
<style>
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        pointer-events: none;
    }

    .toast {
        background-color: #333;
        color: #fff;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 10px;
        position: relative;
        overflow: hidden;
        opacity: 0;
        transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        transform: translateY(-20px);
    }

    .toast.show {
        opacity: 1;
        transform: translateY(0);
    }

    .toast .progress-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        background-color: #f39c12;
        width: 0%;
        transition: width 3s linear;
    }
</style>
<div id="toast-container" class="toast-container"></div>

<script>
    function showToast(message, color) {
        var toast = document.createElement('div');
        toast.className = 'toast';
        toast.style.backgroundColor = color;
        var progressBar = document.createElement('div');
        progressBar.className = 'progress-bar';
        toast.appendChild(progressBar);
        var text = document.createElement('span');
        text.textContent = message;
        toast.appendChild(text);
        var container = document.getElementById('toast-container');
        container.appendChild(toast);
        setTimeout(function() {
            toast.classList.add('show');
            progressBar.style.width = '100%';
        }, 100);
        setTimeout(function() {
            toast.classList.remove('show');
            setTimeout(function() {
                container.removeChild(toast);
            }, 500);
        }, 3000);
    }
</script>
<?php
if (isset($_SESSION['toast_message']) && isset($_SESSION['toast_color'])) {
    $colorMap = [
        'Danger' => '#f74242',
        'Warning' => '#f39c12',
        'Success' => '#2A3042'
    ];
    $color = $colorMap[$_SESSION['toast_color']] ?? '#333';
    $message = $_SESSION['toast_message'];
    echo "<script>showToast('$message', '$color');</script>";
    unset($_SESSION['toast_message']);
    unset($_SESSION['toast_color']);
}
?>
</body>

</html>