@extends('layouts.admin-dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Supir</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Supir</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

     <!-- Main content -->
     <section class="content">
        <div class="container-fluid">
        @if(Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> {{ Session::get('success') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @elseif(Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops!</strong> {{ Session::get('error') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif        
        @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Oops!</strong> Terjadi kesalahan.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <!-- Modal Edit -->
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Form Ubah Supir</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form id="formEdit" method="post">
                    @csrf
                    <input type="hidden" id="id_edit">
                    <div class="modal-body">             
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nama_supir">Nama Supir</label>
                                    <!-- <select name="nama_supir" class="form-control">
                                        <option value="hidden">Pilih Supir</option>
                                        @foreach($userSupir as $row)
                                        <option value="{{ $row->name }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select> -->
                                    <input type="text" class="form-control" name="nama_supir" id="nama_supir_edit" placeholder="Masukkan Nama Supir" required>
                                </div>
                                <div class="form-group">
                                    <label for="ttl_supir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="ttl_supir" id="ttl_supir_edit" placeholder="Masukkan Tanggal Lahir" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_telpon">No.Telpon</label>
                                    <input type="text" class="form-control" maxlength="13" name="no_telpon" id="no_telpon_edit" placeholder="Masukkan No.Telp" required>
                                </div>                                
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="jenis_kendaraan">Kendaraan</label>
                                    <input type="text" class="form-control" name="jenis_kendaraan" id="jenis_kendaraan_edit" placeholder="Masukkan Kendaraan" required>
                                </div>
                                <div class="form-group">
                                    <label for="jml_kursi">Jumlah Kursi</label>
                                    <input type="number" class="form-control" min="1" name="jml_kursi" id="jml_kursi_edit" placeholder="Masukkan Jumlah Kursi" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status_edit" class="form-control">
                                        <option value="" hidden>Pilih Status</option>
                                        <option value="available">Available</option>
                                        <option value="full">Full</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btnSubmitEdit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <!-- End of modal -->

          <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Form Tambah Supir</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form id="formTambah" action="{{ url('supir/tambah') }}" method="post">
                    @csrf
                    <div class="modal-body">             
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nama_supir">Nama Supir</label>
                                    <select name="nama_supir" class="form-control">
                                        <option value="hidden">Pilih Supir</option>
                                        @foreach($userSupir as $row)
                                        <option value="{{ $row->name }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input type="text" class="form-control" name="nama_supir" id="nama_supir" placeholder="Masukkan Nama Supir" required> -->
                                </div>
                                <div class="form-group">
                                    <label for="ttl_supir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="ttl_supir" id="ttl_supir" placeholder="Masukkan Tanggal Lahir" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_telpon">No.Telpon</label>
                                    <input type="text" class="form-control" maxlength="13" name="no_telpon" id="no_telpon" placeholder="Masukkan No.Telp" required>
                                </div>                                
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="jenis_kendaraan">Kendaraan</label>
                                    <input type="text" class="form-control" name="jenis_kendaraan" id="jenis_kendaraan" placeholder="Masukkan Kendaraan" required>
                                </div>
                                <div class="form-group">
                                    <label for="jml_kursi">Jumlah Kursi</label>
                                    <input type="number" class="form-control" min="1" name="jml_kursi" id="jml_kursi" placeholder="Masukkan Jumlah Kursi" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="" hidden>Pilih Status</option>
                                        <option value="available">Available</option>
                                        <option value="full">Full</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <!-- End of modal -->
          
          <!-- Small boxes (Stat box) -->
          <div class="row">
              <div class="col-12">
                  <div class="card">
                        <div class="card-body">
                            <!-- <div class="d-flex justify-content-end">
                                <button type="button" id="btnTambah" class="btn btn-primary mb-4" data-toggle="modal" data-target="#modalTambah">Tambah</button>
                            </div> -->
                            <table class="table table-bordered" id="tabel_pengguna">
                                <thead>
                                    <tr>
                                        <th style="width:5%">#</th>
                                        <th>Nama</th>
                                        <th>Tgl Lahir</th>       
                                        <th>No.Telp</th>  
                                        <th>Kendaraan</th>
                                        <th>Jumlah Kursi</th>         
                                        <th>Sisa Kursi</th>   
                                        <th>Status</th>
                                        <th>Aksi</th>                 
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($supir as $row)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ ($row->nama_supir != null ? $row->nama_supir : '-') }}</td>
                                        <td>{{ ($row->ttl_supir != null ? date('d M Y', strtotime($row->ttl_supir)) : '-') }}</td>
                                        <td>{{ ($row->no_telpon != null ? $row->no_telpon : '-') }}</td>
                                        <td>{{ ($row->jenis_kendaraan != null ? $row->jenis_kendaraan : '-') }}</td>
                                        <td>{{ ($row->jml_kursi != null ? $row->jml_kursi : '-') }}</td>
                                        <td>{{ ($row->jml_sisa_kursi != null ? $row->jml_sisa_kursi : '-') }}</td>
                                        <td>
                                            @if($row->status == 'available')
                                                <span class="badge bg-success">Tersedia</span>
                                            @elseif($row->status == 'full')
                                                <span class="badge bg-danger">Full</span>
                                            @else 
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btnEdit"
                                            data-id="{{ $row->id_user }}"
                                            data-nama="{{ $row->nama_supir }}"
                                            data-ttl="{{ $row->ttl_supir }}"
                                            data-no_telpon="{{ $row->no_telpon }}"
                                            data-jenis="{{ $row->jenis_kendaraan }}"
                                            data-kursi="{{ $row->jml_kursi }}"
                                            data-status="{{ $row->status }}">
                                            <i class="bi bi-pencil"></i></button>
                                            <!-- <button type="button" class="btn btn-danger btnHapus" data-id="{{ $row->id }}"><i class="bi bi-trash"></i></button> -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        </div>
                  </div>
              </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
</div>
    <!-- /.content-header -->
<script>
    $(document).ready(function() {
        $('#tabel_pengguna').dataTable();

        $('.btnEdit').each(function() {
            $(this).on('click', function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var ttl = $(this).data('ttl');
                var no_telpon = $(this).data('no_telpon');
                var jenis = $(this).data('jenis');
                var jml_kursi = $(this).data('kursi');
                var status = $(this).data('status');

                var url = "{{ url('supir/update') }}/"+id+"";

                $('#id_edit').val(id);
                $('#nama_supir_edit').val(nama);
                $('#ttl_supir_edit').val(ttl);
                $('#no_telpon_edit').val(no_telpon);
                $('#jenis_kendaraan_edit').val(jenis);
                $('#jml_kursi_edit').val(jml_kursi);
                $('#status_edit').val(status);
                
                $('#modalEdit').modal('show');
                $('#formEdit').attr('action', url);
            });
        })   
        
        setTimeout(function() {
            $('.alert').fadeOut("slow");
        }, 2000);

        $('.btnHapus').each(function() {
            $(this).on('click', function() {
                var id = $(this).data('id');
                var url = "{{ url('tujuan/delete') }}/"+id+"";

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah anda yakin ingin menghapus data?',
                    showDenyButton: true,
                    confirmButtonText: 'Hapus',
                    denyButtonText: `Batal`,
                    icon: 'warning',
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = url;
                    } else if (result.isDenied) {
                        Swal.fire('Data batal dihapus', '', 'error')
                    }
                })
            })
        })

        // $('#btnSubmit').on('click', function(e) {
        //     // e.preventDefault();

        //     if($('#harga').val() <= 0)
        //     {
        //         Swal.fire({
        //             icon: 'warning',
        //             text: 'Masukkan harga dengan nominal yang benar.',
        //         });
        //     } else {
        //         $('#formTambah').submit();
        //     }
        // })

        $('#btnSubmitEdit').on('click', function(e) {
            e.preventDefault();

            if($('#harga_edit').val() <= 0)
            {
                Swal.fire({
                    icon: 'warning',
                    text: 'Masukkan harga dengan nominal yang benar.',
                });
            } else {
                $('#formEdit').submit();
            }
        })
    })
</script>
@endsection