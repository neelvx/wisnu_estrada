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
            <h3>Data Karyawan</h3>
            <a href="<?= base_url('add'); ?>">Tambah karyawan</a>
        </div>
        
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success" role="alert">
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>

        <?php if ($this->session->flashdata('failed')) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $this->session->flashdata('failed'); ?>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">NIK</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Tgl Lahir</th>
                            <th scope="col">Divisi</th>
                            <th scope="col">Status Karyawan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if ($data['payload']['data']) :
                            foreach ($data['payload']['data'] as $key => $value) : ?>
                            <tr>
                                <td><?= $value['nik'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td><?= date('Y-m-d', strtotime($value['tgl_lahir'])) ?></td>
                                <td><?= $value['divisi'] ?></td>
                                <td><?= $value['status'] ?></td>
                                <td>
                                    <a href="<?= base_url('edit/'.$value['nik']) ?>">Edit</a>
                                    <a href="<?= base_url('delete/'.$value['nik']) ?>">Delete</a>
                                </td>
                            </tr>
                        <?php 
                            endforeach;
                            else : ?>
                            <tr>
                                <td colspan="7" class="text-center">Data is empty</td>
                            </tr>
                        <?php endif;; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>