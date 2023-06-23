<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <style>
		body {
			background-image: url('/assets/img/motor.png');
			background-size: cover;
			background-position: center;
            backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
        }
            .card {
            background-image: url('/assets/img/registerbengkel2.png');
            background-size: cover;
            background-position: center;
            margin-top: 60px;
            margin-bottom: 80px;

		}
	</style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">


</head>

<body>
    <div class="container">
    <div class="row justify-content-center ">
    <div class="col-md-6">
        <div class="card ">
        

<div class="card-body text-center text-dark">
<h4>Registrasi Akun Untuk Pelanggan dan Bengkel</h4>
</div>
<div class="card-body">
        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session()->get('errors') as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <?php if (session()->has('success')): ?>
            <div class="alert alert-success"><?= session()->get('success') ?></div>
        <?php endif ?>

        <form action="/register" method="post">
            <div class="mb-3">
                <label for="nama" class="form-label text-dark">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?= old('nama') ?>">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label text-dark">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= old('username') ?>">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-dark">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>

            <div class="mb-3">
                <label for="level" class="form-label text-dark">Level</label>
                <select class="form-control" name="level" id="level">
                    <option value="">Pilih level</option>
                    <option value="Pengguna" <?= old('level') === 'Pengguna' ? 'selected' : '' ?>>Pengguna</option>
                    <option value="Bengkel" <?= old('level') === 'Bengkel' ? 'selected' : '' ?>>Bengkel</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label text-dark">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat"><?= old('alamat') ?></textarea>
            </div>
            <div class=" text-center text-dark">
            <div class="mb-3 text-center">
                <button type="submit" class="btn-control btn-light" >Daftar</button>
            </div>
            
            <div class="mb-3 text-center">
            <a href="login" class="btn btn-control btn-danger">Kembali Ke Login</a>
            </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>

</body>
</html>
