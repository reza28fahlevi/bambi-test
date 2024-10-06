<div class="modal fade" id="transactions-modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form name="f_transaction" id="f_transaction" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="action" name="action" value="add" required>
                <input type="hidden" class="form-control" id="transaction_id" name="transaction_id" value="" required>
                <div class="modal-header">
                    <h5 class="modal-title">Product Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">IDX Saham</label>
                        <div class="col-sm-10">
                            <select name="saham_id" id="saham_id" class="form-control" required>
                                <option value="">-- Pilih Saham --</option>
                                <?php
                                foreach($saham_list as $saham){
                                    ?>
                                        <option value="<?=$saham->saham_id?>"><?=$saham->idx_saham?> | <?=$saham->nama_perusahaan?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Open</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="topen" name="topen" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">High</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="thigh" name="thigh" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Low</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="tlow" name="tlow" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Close</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="tclose" name="tclose" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>