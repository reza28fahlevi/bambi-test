<?= $this->include('Layout/Header') ?>
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="card-body">
                  <h5 class="card-title">Charts <span id="idx_saham">/GOTO</span></h5>

                  <div class="row mb-4">
                    <div class="col-4">
                      <select name="idx" id="idx" class="form-control">
                        <?php
                        foreach($saham_list as $key => $list){
                          $selected = ($key == 0) ? "selected" : "";
                          ?>
                          <option value="<?=$list->saham_id?>" <?=$selected?>><?=$list->idx_saham?> | <?=$list->nama_perusahaan?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    // document.addEventListener("DOMContentLoaded", () => {
                    //   new ApexCharts(document.querySelector("#reportsChart"), {
                    //     series: [{
                    //       data: [{
                    //           x: new Date(1728070550000),
                    //           y: [6629.81, 6650.5, 6623.04, 6633.33]
                    //         },
                    //         {
                    //           x: new Date(1728066950000),
                    //           y: [6632.01, 6643.59, 6620, 6630.11]
                    //         },
                    //         {
                    //           x: new Date(1728063350000),
                    //           y: [6630.71, 6648.95, 6623.34, 6635.65]
                    //         },
                    //         {
                    //           x: new Date(1728059750000),
                    //           y: [6635.65, 6651, 6629.67, 6638.24]
                    //         },
                    //       ]
                    //     }],
                    //       chart: {
                    //       type: 'candlestick',
                    //       height: 350
                    //     },
                    //     title: {
                    //       text: 'CandleStick Chart',
                    //       align: 'left'
                    //     },
                    //     xaxis: {
                    //       type: 'datetime'
                    //     },
                    //     yaxis: {
                    //       tooltip: {
                    //         enabled: true
                    //       }
                    //     }
                    //   }).render();
                    // });
                    document.addEventListener("DOMContentLoaded", () => {
                      const renderChart = (id) => {
                        fetch(`<?=base_url("theGraph")?>/${id}`) // Replace with your API endpoint
                        .then(response => response.json())
                        .then(responseData => {
                          // Assuming the API returns an array of objects with 'x' and 'y' properties
                          const data = responseData.data; // Access the array inside the response

                          if (!Array.isArray(data)) {
                            throw new Error('Expected an array but got something else');
                          }

                          const formattedData = data.map(item => ({
                            x: new Date(item.t_time), // Use `t_time` for the timestamp
                            y: [parseFloat(item.topen), parseFloat(item.thigh), parseFloat(item.tlow), parseFloat(item.tclose)] // Convert values to numbers
                          }));

                          new ApexCharts(document.querySelector("#reportsChart"), {
                            series: [{
                              data: formattedData
                            }],
                            chart: {
                              type: 'candlestick',
                              height: 350
                            },
                            title: {
                              text: 'CandleStick Chart',
                              align: 'left'
                            },
                            xaxis: {
                              type: 'datetime'
                            },
                            yaxis: {
                              tooltip: {
                                enabled: true
                              }
                            }
                          }).render();
                        })
                        .catch(error => console.error('Error fetching data:', error));
                      }
                      // Initial chart render with the default selected option
                      const selectElement = document.getElementById("idx");
                      renderChart(selectElement.value);

                      // Event listener for select option change
                      selectElement.addEventListener("change", () => {
                        const selectedValue = selectElement.value;
                        renderChart(selectedValue);
                      });
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->


          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

<?= $this->include('Layout/Footer') ?>