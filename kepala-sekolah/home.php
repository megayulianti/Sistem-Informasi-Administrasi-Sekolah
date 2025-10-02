<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">
                  <a href="index.php" class="text-dark text-decoration-none">Dashboard</a>
                </h3>

               
              </div>

            </div>
            <div class="row">
           <div class="col-sm-6 col-md-3">
              <a href="?page=surat-aktif/index" class="text-decoration-none text-dark">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-icon">
                                  <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                      <i class="fas fa-solid fa-file"></i>
                                  </div>
                              </div>
                              <div class="col col-stats ms-3 ms-sm-0">
                                  <div class="numbers">
                                      <p class="card-category">Data Surat Aktif Siswa</p>
                                      <h4 class="card-title"><?= $surat_aktif_count ?> </h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>

           <div class="col-sm-6 col-md-3">
              <a href="?page=surat-keterangan/index" class="text-decoration-none text-dark">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-icon">
                                  <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                  <i class="fas fa-solid fa-book"></i>   
                                  </div>
                              </div>
                              <div class="col col-stats ms-3 ms-sm-0">
                                  <div class="numbers">
                                      <p class="card-category">Data Surat Keterangan</p>
                                      <h4 class="card-title"><?= $surat_keterangan_count ?> </h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>

           <div class="col-sm-6 col-md-3">
                  <a href="?page=laporan-absensi/index" class="text-decoration-none">
                      <div class="card card-stats card-round">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col-icon">
                                      <div class="icon-big text-center icon-primary bubble-shadow-small">
                                          <i class="fas fa-user-check"></i> 
                                      </div>
                                  </div>
                                  <div class="col col-stats ms-3 ms-sm-0">
                                      <div class="numbers">
                                          <p class="card-category">Laporan Absensi</p>
                                          <h4 class="card-title"><?= $absensi_count ?></h4>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>
              </div>




          <div class="col-sm-6 col-md-3">
              <a href="?page=laporan-surat-masuk/index" class="text-decoration-none text-dark">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-icon">
                                  <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                      <i class="fas fa-solid fa-folder-open"></i>
                                  </div>
                              </div>
                              <div class="col col-stats ms-3 ms-sm-0">
                                  <div class="numbers">
                                      <p class="card-category">Laporan Surat Masuk</p>
                                      <h4 class="card-title"><?= $surat_masuk_count ?> </h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>


          <div class="col-sm-6 col-md-3">
              <a href="?page=laporan-surat-keluar/index" class="text-decoration-none text-dark">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-icon">
                                  <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                      <i class="fas fa-solid fa-folder-open"></i>
                                  </div>
                              </div>
                              <div class="col col-stats ms-3 ms-sm-0">
                                  <div class="numbers">
                                      <p class="card-category">Laporan Surat Keluar</p>
                                      <h4 class="card-title"><?= $surat_keluar_count ?> </h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
          </div>



            </div>

          </div>
        </div>

      