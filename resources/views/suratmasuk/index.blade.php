@extends('layouts.master')


@section('content')
<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel">     
								<div class="panel-heading">
									<h1 class="panel-title"><i class="lnr lnr-layers"></i> Kelola Surat Masuk </h1>
								</div>
                <!-- message error validation -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
								<div class="panel-body">
                <div class="row " >
                    <div class=" col-md-6">
                    @if($loggedIn->role_id == 1 )
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-square" ></i> Tambah data</button>
                      @endif
                    </div>
                    <div class="form-group input-group col-md-6">
                      <form action="/suratmasuk" method="GET">
                      <input type="search" class="form-control" id="inputPassword2" placeholder="Search..." name="search">
                      </form> 
                    </div>
                  </div>
									<table class="table table-hover">
                  <thead>
											<tr>
                        <th scope>No</th>
                        <th scope>Pengirim</th>
                        <th scope>Nomor Surat</th>
                        <th scope>Klasifikasi</th>
                        <th scope> Status </th>
                        <th scope>Tujuan Disposisi</th>
                        <th scope>Action</th>
                      </tr>
										</thead>
                    <tbody>
                     
                     
                    @foreach($suratmasuk as $surat_masuk)
                      <tr>
                          <th scope="row">{{ $loop->iteration }} </th>
                          <td>{{$surat_masuk->nama_pengirim}} </td>
                          <td>{{$surat_masuk->nomor_surat}} </td>
                          <td>{{$surat_masuk->klasifikasi}} </td>
                          <td> @if($surat_masuk->disposisi != NULL)
                          <a class="btn btn-success"> Disposisi </a>
                          @else
                          <a class="btn btn-danger"> Disposisi </a>
                                @endif
                          </td>
                          <td>{{$surat_masuk->disposisi}} </td>
                          <td>
                          
                          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Disposisi</button> -->
                          @if($loggedIn->role_id == 2 )
                          <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalsDisposisi-{{ $surat_masuk->id}}">Disposisi</a>
                          @endif
                          @if($loggedIn->role_id == 3 )
                          <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ModalsTL-{{ $surat_masuk->id}}">Tindak lanjut</a>
                          @endif
                          @if($loggedIn->role_id == 1 ) 
                          <a href="" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#ModalsEdit-{{ $surat_masuk->id}}">Edit</a>
                          <a href="/suratmasuk/{{$surat_masuk->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data?')">Delete</a>
                          @endif
                          </td>
                      </tr>
                    @endforeach
										</tbody>
                  </table>
                </div>
                <div class="position-absolute bottom-0 end-0">
                    <!-- <ul > -->
                        {{ $suratmasuk->links() }}
                    <!-- </ul> -->
                </div>
              </div>
             
            </div>
            
          </div>
        </div>
      </div>
</div>
</div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"> <i class="lnr lnr-layers"></i> Tambah Data Surat Masuk</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="/suratmasuk/create" method="POST" enctype="multipart/form-data" id="frmaddsm">
          {{csrf_field()}}
          <div class="form-group">
            <label for="exampleInputNama" id="frmaddnp">Nama Pengirim</label>
              <input name="nama_pengirim"  type="text" class="form-control" id="exampleInputnama_pengirim" aria-describedby="nama_pengirimHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputNama" id="frmaddns">Nomor Surat</label>
              <input name="nomor_surat"  type="text" class="form-control" id="exampleInputnomor_surat" aria-describedby="nomor_suratHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputNama" id="frmaddhal">Perihal</label>
              <input name="perihal"  type="text" class="form-control" id="exampleInputperihal" aria-describedby="perihalHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputNama" id="frmaddklas">Klasifikasi</label>
              <input name="klasifikasi"  type="text" class="form-control" id="exampleInputperihal" aria-describedby="klasifikasiHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputNama" id="frmaddfile">Unggah File Surat(pdf)</label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
        </form>     
    </div> 
  </div>
</div>
   
@foreach($suratmasuk as $surat_masuk)
<!-- Modal Edit Data -->
<div class="modal " id="ModalsEdit-{{ $surat_masuk->id }}" tabindex="-2" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
          <div class="modal-header" id="headeredit">
            <h3 class="modal-title" id="exampleModalLabel2"> <i class="lnr lnr-layers"></i> Edit Data Surat Masuk</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body" id="bodyedit">
            <form action="/suratmasuk/{{$surat_masuk->id}}/update" method="POST" enctype="multipart/form-data" id="frmeditsm">
              {{csrf_field()}}
              <div class="form-group">
                <label for="" id="lbleditnama">Nama Pengirim</label>
                  <input name="editnamapengirim"  type="text" class="form-control" id="editnamapengirim" value="{{$surat_masuk->nama_pengirim}}">
              </div>
              <div class="form-group">
                <label for="" id="lbleditns">Nomor Surat</label>
                  <input name="editnomorsurat"  type="text" class="form-control" id="editnomorsurat" value="{{$surat_masuk->nomor_surat}}">
              </div>
              <div class="form-group">
                <label for="" id="lbledithal">Perihal</label>
                  <input name="editperihal"  type="text" class="form-control" id="editperihal" value="{{$surat_masuk->perihal}}">
              </div>
              <div class="form-group">
                <label for="" id="lbleditklas">Klasifikasi</label>
                  <input name="editklas"  type="text" class="form-control" id="editklas" value="{{$surat_masuk->klasifikasi}}">
              </div>
              <div class="form-group">
                <label for="" id="lbleditfile">Unggah File Surat(pdf)</label>
                  <input type="file" class="form-control-file" id="editfile" name="editfile">
                    <file src="{{ asset('admin/assets/file/' . $surat_masuk->file) }}" alt="file" >
              </div>
          </div>
          <div class="modal-footer" id="footeredit">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </form> 
    </div> 
  </div>
</div>
@endforeach

@foreach($suratmasuk as $surat_masuk)
<!-- Modal Disposisi Data -->
<div class="modal fade" id="ModalsDisposisi-{{ $surat_masuk->id }}" tabindex="-3" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
          <div class="modal-header" id="headerdispo">
            <h3 class="modal-title" id="exampleModalLabel3"> <i class="lnr lnr-layers"></i> Disposisi </h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body" id="bodydispo">
            <form action="/suratmasuk/{{$surat_masuk->id}}/disposisi" method="POST" enctype="multipart/form-data" id="frmdisposm">
              {{csrf_field()}}
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="disposisi" id="exampleRadios1" value="Bidang Pembinaan Prestasi" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      Bidang Pembinaan Prestasi
                    </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="disposisi" id="exampleRadios2" value="Bidang Organisasi dan Hukum Olahraga" checked>
                    <label class="form-check-label" for="exampleRadios2">
                      Bidang Organisasi dan Hukum Olahraga
                    </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="disposisi" id="exampleRadios3" value="Bidang Pendidikan dan Penataran" checked>
                    <label class="form-check-label" for="exampleRadios2">
                      Bidang Pendidikan dan Penataran
                    </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="disposisi" id="exampleRadios3" value="Bidang Sport Science dan Iptek" checked>
                    <label class="form-check-label" for="exampleRadios2">
                      Bidang Sport Science dan Iptek
                    </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="disposisi" id="exampleRadios3" value="Bidang Pengumpulan dan Pengelolaan Data Dan Penelitian dan Pengembangan" checked>
                    <label class="form-check-label" for="exampleRadios2">
                      Bidang Pengumpulan dan Pengelolaan Data Dan Penelitian dan Pengembangan
                    </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="disposisi" id="exampleRadios3" value="Bidang Mobilisasi Sumber Daya & Kerjasama Antar Lembaga" checked>
                    <label class="form-check-label" for="exampleRadios2">
                      Bidang Mobilisasi Sumber Daya & Kerjasama Antar Lembaga
                    </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="disposisi" id="exampleRadios3" value="Bidang Perencanaan Program dan Anggaran" checked>
                    <label class="form-check-label" for="exampleRadios2">
                      Bidang Perencanaan Program dan Anggaran
                    </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="disposisi" id="exampleRadios3" value="Bidang Media dan Humas" checked>
                    <label class="form-check-label" for="exampleRadios2">
                      Bidang Media dan Humas
                    </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="disposisi" id="exampleRadios3" value="Bidang Kesejahteraan Pelaku Olahraga" checked>
                    <label class="form-check-label" for="exampleRadios2">
                      Bidang Kesejahteraan Pelaku Olahraga
                    </label>
                </div>
              </div>
              <div class="form-group">
                <label for="" id="lbldispons">Keterangan Disposisi</label>
                  <textarea name="updatedispoket"  type="text" class="form-control" id="updatedispoket" ><?php echo "{$surat_masuk->ket_disposisi}";?></textarea>
              </div>
              
          </div>
          <div class="modal-footer" id="footeredit">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </form> 
    </div> 
  </div>
</div>
@endforeach


@foreach($suratmasuk as $surat_masuk)
<!-- Modal Ket Tindak Lanjut Data -->
<div class="modal fade" id="ModalsTL-{{ $surat_masuk->id }}" tabindex="-4" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
          <div class="modal-header" id="headertl">
            <h3 class="modal-title" id="exampleModalLabel4"> <i class="lnr lnr-layers"></i> Keterangan Tindak Lanjut </h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body" id="bodytl">
            <form action="/suratmasuk/{{$surat_masuk->id}}/tindaklanjut" method="POST" enctype="multipart/form-data" id="frmtlsm">
              {{csrf_field()}}
              <div class="form-group">
                <label for="" id="lblkettl">Keterangan Tindak Lanjut</label>
                  <textarea name="updatekettl"  type="text" class="form-control" id="updatekettl" row="5px" ><?php echo "{$surat_masuk->tindak_lanjut}";?></textarea>
              </div>
              
          </div>
          <div class="modal-footer" id="footertl">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </form> 
    </div> 
  </div>
</div>
@endforeach
@endsection