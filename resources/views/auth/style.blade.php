<style>
    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url('https://img.freepik.com/free-photo/fuji-mountain-kawaguchiko-lake-morning-autumn-seasons-fuji-mountain-yamanachi-japan_335224-102.jpg?t=st=1742388101~exp=1742391701~hmac=f40a01e3639a778da549a6dbeb7620f8455a5ae1e982834972bf54419d378ec6&w=1800');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        font-family: 'Poppins', sans-serif;
        position: relative;
    }

    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Adjust the opacity as needed */
        z-index: -1;
    }

    .login-card {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .login-title {
        font-weight: 600;
    }

    .login-title span {
        color: #007bff;
        font-weight: bold;
    }

    .form-control {
        height: 45px;
    }

    .captcha-display {
        background-image: url('/path/to/paper-texture.jpg');
        /* Replace with your texture image */
        background-size: cover;
        background-repeat: no-repeat;
        padding: 10px 15px;
        display: inline-flex;
        font-family: 'Courier New', Courier, monospace;
        font-size: 20px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 4px;
        /* Additional letter spacing */
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .captcha-char {
        display: inline-block;
        transform: rotate(calc(-5deg + 10deg * var(--rotation)));
        margin-right: 8px;
        /* Adjust the spacing between each character */
    }

    .color-0 {
        color: #FF5733;
    }

    .color-1 {
        color: #33FF57;
    }

    .color-2 {
        color: #3357FF;
    }

    .color-3 {
        color: #FF33A6;
    }

    .color-4 {
        color: #FFBD33;
    }

    .captcha-input {
        flex: 1;
        /* Allows input to scale as needed */
        max-width: 150px;
    }
</style>