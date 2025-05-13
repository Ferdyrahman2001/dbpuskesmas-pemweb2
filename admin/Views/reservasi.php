<div class="container">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Periksa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pasien</label>
                            <select name="nama" id="nama" class="form-select" required>
                                <option value="" hidden>-- Pilih Pasien --</option>
                            <?php
                                require ('Controllers/Reservasi.php');
                                $reservasi = $reservasin->index();
                                foreach ($reservasi as $p) {
                                    echo '<option value="' . htmlspecialchars($p['id']) . '">' . htmlspecialchars($p['nama']) . '</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="doctor" class="form-label">Doctor</label>
                            <select name="doctor" id="doctor" class="form-select" required>
                                <option value="" hidden>-- Pilih Doctor --</option>
                            <?php
                                require ('Controllers/Reservasi.php');
                                $doctor = $doctors->index();
                                foreach ($doctors as $p) {
                                    echo '<option value="' . htmlspecialchars($p['id']) . '">' . htmlspecialchars($p['nama']) . '</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <textarea class="form-control" id="nama" name="nama" required></textarea>
                        </div>
                        <input type="hidden" name="type" value="add">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Data Periksa
            </button>
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th class="pe-1" style="width: 50px;">No</th>
                        <th class="pe-1">Tanggal</th>
                        <th class="pe-1">Nama</th>
                        <th class="pe-1">HP</th>
                        <th class="pe-1" colspan="3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require ('Controllers/Reservasi.php');
                    $row = $periksa->index();
                    $nomer=1;
                    foreach($row as $item){
                    ?>
                        <tr>
                            <td class="text-center"><?= $nomer++ ?></td>
                            <td><?= htmlspecialchars($item['tanggal']); ?></td>
                            <td><?= htmlspecialchars($item['nama']); ?></td>
                            <td><?= htmlspecialchars($item['doctor']); ?></td>
                            <td><?= htmlspecialchars($item['hp']); ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalInfo<?= $item['id']; ?>">
                                    Info
                                </button>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $item['id']; ?>">
                                    Edit
                                </button>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $item['id']; ?>">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Info -->
                        <div class="modal fade" id="modalInfo<?= $item['id'] ?>" tabindex="-1" aria-labelledby="modalInfo<?= $item['id'] ?>Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalInfo<?= $item['id'] ?>Label">Detail Periksa: <?= htmlspecialchars($item['nama_pasien']); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Tanggal:</strong> <span class="float-end"><?= htmlspecialchars($item['tanggal']); ?></span></li>
                                            <li class="list-group-item"><strong>Nama:</strong> <span class="float-end"><?= htmlspecialchars($item['nama_pasien']); ?></span></li>
                                            <li class="list-group-item"><strong>Doctor:</strong> <span class="float-end"><?= htmlspecialchars($item['nama_paramedik']); ?></span></li>
                                            <li class="list-group-item"><strong>HP:</strong> <span class="float-end"><?= htmlspecialchars($item['keterangan']); ?></span></li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit<?= $item['id'] ?>" tabindex="-1" aria-labelledby="modalEdit<?= $item['id'] ?>Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEdit<?= $item['id'] ?>Label">Edit Data Periksa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="type" value="update">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">

                                            <div class="mb-3">
                                                <label for="tanggal" class="form-label">Tanggal</label>
                                                <input type="date" class="form-control" name="tanggal" value="<?= htmlspecialchars($item['tanggal']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <select name="nama" id="nama" class="form-select" required>
                                                    <?php
                                                    $reservasi = $reservasin->index();
                                                    foreach ($reservasi as $p) {
                                                        echo '<option value="' . htmlspecialchars($p['id']) . '"' . ($item['nama'] == $p['id'] ? ' selected' : '') . '>' . htmlspecialchars($p['nama']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="doctor" class="form-label">Doctor</label>
                                                <select name="doctor" id="doctor" class="form-select" required>
                                                    <?php
                                                    $doctor = $doctors->index();
                                                    foreach ($doctor as $p) {
                                                        echo '<option value="' . htmlspecialchars($p['id']) . '"' . ($item['doctor'] == $p['id'] ? ' selected' : '') . '>' . htmlspecialchars($p['nama']) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="keluhan" class="form-label">Keluhan</label>
                                                <textarea class="form-control" name="keluhan" required><?= htmlspecialchars($item['keluhan']) ?></textarea>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <label for="hp" class="form-label">No. HP</label>
                                                    <input type="text" class="form-control" name="hp" value="<?= htmlspecialchars($item['hp']) ?>" required>
                                                </div>
                            
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Delete -->
                        <div class="modal fade" id="deleteModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $item['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel<?= $item['id']; ?>">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus data periksa untuk <strong><?= htmlspecialchars($item['nama_pasien']); ?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?= $item['id']; ?>">
                                            <input type="hidden" name="type" value="delete">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php }
                    if(isset($_POST['type'])){
                        if($_POST['type'] == 'delete'){
                            $periksa->delete($_POST['id']);
                            echo "<script>alert('Data berhasil dihapus.');</script>";
                            echo "<script>window.location.href = '?url=periksa';</script>";
                        } elseif($_POST['type'] == 'add'){
                            $_POST['nama'] = $_POST['hp'] . '/' . $_POST['doctor'];
                            $periksa->create($_POST['nama'], $_POST['doctor'], $_POST['hp'], $_POST['tanggal']);
                            echo "<script>alert('Data berhasil ditambahkan.');</script>";
                            echo "<script>window.location.href = '?url=periksa';</script>";
                        } elseif ($_POST['type'] == 'update') {
                            $id = $_POST['id'];
                            $data = [
                                'nama' => $_POST['nama'],
                                'hp' => $_POST['hp'],
                                'doctor' => $_POST['doctor'],
                                'tanggal' => $_POST['tanggal'],
                            ];
                            $periksa->update($id, $data);
                            echo "<script>alert('Data berhasil diperbarui.');</script>";
                            echo "<script>window.location.href = '?url=periksa';</script>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
