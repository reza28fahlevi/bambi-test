<?= $this->include('Layout/Header') ?>
<div class="pagetitle">
      <h1>Transactions</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Trabsactions</h5>
              <button type="button" class="btn btn-primary mb-3 btn-add" data-bs-toggle="modal" data-bs-target="#transactions-modal">
                <i class="bi bi-plus me-1"></i> Add
              </button>
              <!-- Table with stripped rows -->
              <table class="table" id="transactions-table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>IDX Saham</th>
                    <th>Open</th>
                    <th>High</th>
                    <th>Low</th>
                    <th>Close</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

<?= $this->include('Transaction/transaction_modal') ?>
<?= $this->include('Layout/Footer') ?>

<script>
  $(document).ready(function() {
      var tableTransactions = $('#transactions-table').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax": {
            "url" : "<?= base_url('transactions/fetch') ?>",
            "type" : "POST"
          },
          "columns": [
              { "data": "transaction_id" },
              { "data": "idx_saham" },
              { "data": "topen" },
              { "data": "thigh" },
              { "data": "tlow" },
              { "data": "tclose" },
          ]
      });

      $('#f_transaction').on('submit', function(e) {
          e.preventDefault(); // Prevent the default form submission

          var act = $('#action').val()
          var id = $('#transaction_id').val()
          var link_url = '<?= base_url('transactions/add') ?>'

          $.ajax({
              url: link_url,
              type: 'POST',
              data: new FormData(this),
              processData: false, // Important: Prevent jQuery from automatically transforming the data into a query string
              contentType: false, // Important: Set the content type to false to allow multipart form data
              success: function(response) {
                  // Handle the response here
                  Swal.fire({
                    title: capitalizeFirstLetter(response.status),
                    text: response.message,
                    icon: "success"
                  });

                  $('#transactions-modal').modal('hide')
                  tableTransactions.ajax.reload(null, false);
              },
              error: function(xhr, status, error) {
                  // Handle errors here
                  Swal.fire({
                    title: "Error",
                    text: "Can't perform this action! Something wrong.",
                    icon: "error"
                  });
              }
          });
      });

      $(document).on('click', '.btn-add', function() {
        $('#f_transaction').trigger('reset');
        $('#transaction_id').val("")
        $('#action').val("add")
      })
  });
</script>