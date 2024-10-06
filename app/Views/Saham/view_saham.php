<?= $this->include('Layout/Header') ?>
<div class="pagetitle">
      <h1>Saham IPO</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Saham</h5>
              <button type="button" class="btn btn-primary mb-3 btn-add" data-bs-toggle="modal" data-bs-target="#saham-modal">
                <i class="bi bi-plus me-1"></i> Add
              </button>
              <!-- Table with stripped rows -->
              <table class="table" id="ipo-table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>IDX Saham</th>
                    <th>Nama Perusahaan</th>
                    <th>Harga IPO</th>
                    <th>Action</th>
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

<?= $this->include('Saham/saham_modal') ?>
<?= $this->include('Layout/Footer') ?>

<script>
  $(document).ready(function() {
      var tableIPO = $('#ipo-table').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax": {
            "url" : "<?= base_url('ipo/fetch') ?>",
            "type" : "POST"
          },
          "columns": [
              { "data": "saham_id" },
              { "data": "idx_saham" },
              { "data": "nama_perusahaan" },
              { "data": "harga_ipo" },
              { "data": null, "render": function(data, type, row) {
                  return `<button type="button" class="btn btn-secondary edit-ipo" data-id="${row.saham_id}"><i class="bi bi-pencil-square"></i></button>
                          <button type="button" class="btn btn-danger delete-ipo" data-id="${row.saham_id}"><i class="bi bi-trash2"></i></button>`;
              }}
          ]
      });

      $('#f_ipo').on('submit', function(e) {
          e.preventDefault(); // Prevent the default form submission

          var act = $('#action').val()
          var id = $('#saham_id').val()
          if(act == 'add' && id == ""){
            var link_url = '<?= base_url('ipo/add') ?>'
          }else if(act == 'update' && id != ""){
            var link_url = '<?= base_url('ipo/update') ?>'
          }else{
            var link_url = ""
          }
        //   alert(link_url)
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

                  $('#saham-modal').modal('hide')
                  tableIPO.ajax.reload(null, false);
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
        $('#f_ipo').trigger('reset');
        $('#product_id').val("")
        $('#action').val("add")
      })

      $(document).on('click', '.edit-ipo', function() {
          var id = $(this).data('id')
          $.ajax({
            url: '<?= base_url('ipo/getData'); ?>/' + id,
            type: 'GET',
            success: function(response) {
                if (response.status === 'success') {
                    $('#f_ipo').trigger('reset');
                    $('#action').val("update")
                    $('#saham_id').val(response.data.saham_id);
                    $('#idx_saham').val(response.data.idx_saham);
                    $('#nama_perusahaan').val(response.data.nama_perusahaan);
                    $('#harga_ipo').val(response.data.harga_ipo);
                    $('#saham-modal').modal('show')
                } else {
                    alert(response.message);
                }
            }
        });
      })

      $(document).on('click', '.delete-ipo', function() {
          var id = $(this).data('id')
          Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, delete it!"
          }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('ipo/delete') ?>',
                    type: 'POST',
                    data: {
                        "id" : id
                    },
                    // processData: false, // Important: Prevent jQuery from automatically transforming the data into a query string
                    // contentType: false, // Important: Set the content type to false to allow multipart form data
                    success: function(response) {
                        // Handle the response here
                        Swal.fire({
                          title: capitalizeFirstLetter(response.status),
                          text: response.message,
                          icon: "success"
                        });
                        tableIPO.ajax.reload(null, false);
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
              }
          });
      });
  });
</script>