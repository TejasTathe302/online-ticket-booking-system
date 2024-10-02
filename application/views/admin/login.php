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
        <form class="login-form" action="<?=base_url()?>admin/check_login" method="POST">
            <h2>Admin Login</h2>
            <div class="input-group">
                <label for="admin_mobile">Mobile</label>
                <input type="text" id="admin_mobile" name="admin_mobile" placeholder="Enter your mobile" required>
            </div>
            <div class="input-group">
                <label for="admin_password">Password</label>
                <input type="password" id="admin_password" name="admin_password" placeholder="Enter your password" required>
            </div>
            <button type="submit" id='button'>Login</button>
        </form>
    </div>
</div>