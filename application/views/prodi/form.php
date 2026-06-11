<div class="row">
    <div class="col-md-6">
        <div class="card shadow border-0 mb-4">

            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <?php echo ($button == 'Update') ? 'Ubah Program Studi' : 'Tambah Program Studi'; ?>
                </h5>

                <a href="<?php echo base_url('prodi') ?>" class="btn btn-light btn-sm">
                    Kembali
                </a>
            </div>

            <div class="card-body">

                <form action="<?php echo $action; ?>" method="post">

                    
                    <div class="mb-3">
                        <label>ID Prodi</label>
                        <input type="number" name="prodi_id"
                               class="form-control"
                               value="<?php echo set_value('prodi_id', isset($listProdi['prodi_id']) ? $listProdi['prodi_id'] : '') ?>">
                        <?php echo form_error('prodi_id', '<small class="text-danger">', '</small>'); ?>
                    </div>

                   
                    <div class="mb-3">
                        <label>Fakultas</label>

                        <select name="fakultas_id" class="form-select">
                            <option value="">-- Pilih Fakultas --</option>

                            <?php foreach ($listFakultas as $fak): ?>
                                <option value="<?php echo $fak['fakultas_id']; ?>"
                                    <?php echo set_value('fakultas_id', isset($listProdi['fakultas_id']) ? $listProdi['fakultas_id'] : '') == $fak['fakultas_id'] ? 'selected' : ''; ?>>
                                    <?php echo $fak['fakultas_name']; ?>
                                </option>
                            <?php endforeach; ?>

                        </select>

                        <?php echo form_error('fakultas_id', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    
                    <div class="mb-3">
                        <label>Nama Program Studi</label>
                        <input type="text" name="prodi_name"
                               class="form-control"
                               value="<?php echo set_value('prodi_name', isset($listProdi['prodi_name']) ? $listProdi['prodi_name'] : '') ?>">
                        <?php echo form_error('prodi_name', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    
                    <div class="mb-3">
                        <label>Strata</label><br>

                        <input type="radio" name="prodi_strata" value="D3"
                            <?php echo set_value('prodi_strata', isset($listProdi['prodi_strata']) ? $listProdi['prodi_strata'] : '') == 'D3' ? 'checked' : ''; ?>> D3

                        <input type="radio" name="prodi_strata" value="S1"
                            <?php echo set_value('prodi_strata', isset($listProdi['prodi_strata']) ? $listProdi['prodi_strata'] : '') == 'S1' ? 'checked' : ''; ?>> S1

                        <input type="radio" name="prodi_strata" value="S2"
                            <?php echo set_value('prodi_strata', isset($listProdi['prodi_strata']) ? $listProdi['prodi_strata'] : '') == 'S2' ? 'checked' : ''; ?>> S2

                        <?php echo form_error('prodi_strata', '<br><small class="text-danger">', '</small>'); ?>
                    </div>

                    
                    <button type="submit" class="btn btn-primary">
                        <?php echo $button; ?>
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>