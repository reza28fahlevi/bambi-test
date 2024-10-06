<div class="modal fade" id="saham-modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form name="f_ipo" id="f_ipo" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="action" name="action" value="add" required>
                <input type="hidden" class="form-control" id="saham_id" name="saham_id" value="" required>
                <div class="modal-header">
                    <h5 class="modal-title">Saham Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">IDX Saham</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="idx_saham" name="idx_saham" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Harga IPO</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" id="harga_ipo" name="harga_ipo" required>
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