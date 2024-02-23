<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="text-center p-5">
            <h3>Add Karyawan</h3>
            <a href="<?= base_url(); ?>">Back</a>
        </div>
        
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <form action="<?= base_url('update') ?>" method="POST">
                    <div class="mb-2">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $data['nik'] ?>" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" style="height: 100px" name="alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= date('Y-m-d',strtotime($data['tgl_lahir'])) ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="divisi" class="form-label">Divisi</label>
                        <select class="form-select" aria-label="Default select example" id="divisi" name="divisi" required>
                            <option value="" <?php if( $data['divisi'] == '' ): ?> selected="selected"<?php endif; ?>>Select</option>
                            <option value="IT" <?php if( $data['divisi'] == 'IT' ): ?> selected="selected"<?php endif; ?>>IT</option>
                            <option value="HRD" <?php if( $data['divisi'] == 'HRD' ): ?> selected="selected"<?php endif; ?>>HRD</option>
                            <option value="FINANCE" <?php if( $data['divisi'] == 'FINANCE' ): ?> selected="selected"<?php endif; ?>>FINANCE</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" id="status" name="status" required>
                            <option value="" <?php if( $data['status'] == '' ): ?> selected="selected"<?php endif; ?>>Select</option>
                            <option value="Tetap" <?php if( $data['status'] == 'Tetap' ): ?> selected="selected"<?php endif; ?>>Tetap</option>
                            <option value="Kontrak" <?php if( $data['status'] == 'Kontrak' ): ?> selected="selected"<?php endif; ?>>Kontrak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>