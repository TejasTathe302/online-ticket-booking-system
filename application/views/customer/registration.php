<style>
    .outer {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .login-form h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .input-group {
        margin-bottom: 15px;
    }

    .input-group label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        color: #333;
    }

    .input-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    #button {
        width: 100%;
        padding: 10px;
        background-color: #5cb85c;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #4cae4c;
    }

    @media (width>690px) {
        .login-container {
            background-color: #fff;
            padding: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 500px;
        }
    }
</style>
<div class="outer text-end">
    <div class="login-container">
        <form class="login-form" action="<?= base_url() ?>login/save_customer" method="POST">
            <h2>Registration</h2>
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>
            <div class="input-group">
                <label for="mobile">Mobile</label>
                <input type="tel" id="mobile" name="mobile" placeholder="Enter your mobile" minlength="10"  maxlength="10" pattern="[0-9]{10}" inputmode="numeric" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name='email' placeholder="Enter your email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" minlength="5" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" id='button'>Register</button>
        </form>
        <br>
        <span>
            Already have an account <a href="<?= base_url() ?>login/login" style="text-decoration: none;">Login here..</a>
        </span>
    </div>
</div>