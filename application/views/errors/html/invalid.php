<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="<?= base_url(); ?>assets/images/logo-baru.png" />
    <title>Forbidden Access | PT Pulau Sambu Guntung</title>
</head>
<style>
    * {
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        background-color: rgb(10, 145, 255);
    }

    .main {
        text-align: center;
    }

    .mb-30 {
        margin-bottom: 30px;
    }

    .main {
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .item {
        background-color: white;
        padding: 50px;
        border-radius: 20px;
    }

    .item h1 {
        font-weight: bold;
    }

    .item p {
        font-size: 1.2rem;
        margin: 0.3rem;
    }

    .item img {
        width: 300px;
    }

    .footer {
        font-size: 14px !important;
        margin-top: 60px !important;
        font-weight: lighter;
    }

    .logo p {
        font-size: 1rem;
        font-weight: 500;

    }

    .logo hr {
        border: 1px solid black;
        border-radius: 10px;
    }

    .logo img {
        margin-bottom: 5px;
        width: 80px;
    }

    @media only screen and (max-width: 1024px) {
        .item {
            padding: 20px;
        }

        .item img {
            width: 220px;
        }

        .logo img {
            width: 80px;
        }

        .item p {
            font-size: 0.8rem;
        }

        .item h1 {
            font-size: 1.2rem;
        }

        .footer {
            font-size: 11px !important;
        }
    }
</style>

<body>
    <div class="main">
        <div class="item">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo-baru.png') ?>" alt="logo">
                <p>PT PULAU SAMBU GUNTUNG</p>
                <hr>
            </div>

            <img src="<?= base_url('assets/images/403-error.svg') ?>" alt="error">
            <h1 class="mb-30">FORBIDDEN ACCESS</h1>
            <P>Silahkan Akses Aplikasi menggunakan One Login</P>
            <p>Jika belum memiliki akses silahkan hubungi Admin ITD</p>
            <p class="footer">© Copyright <?= date('Y') ?> Information Technology Departement.</p>
        </div>
    </div>
</body>

</html>