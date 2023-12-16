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
									<h3 class="panel-title"><i class="lnr lnr-layers"></i> Klasifikasi Surat</h3>
								</div>
								<div class="panel-body">
                <div class="row " >
                    <div class=" col-md-6">
                     @if($loggedIn->role_id == 1 )
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus-square" ></i> Tambah data</button>
                      @endif
                    </div>
                    <div class="form-group input-group col-md-6">
                      <form action="/klasifikasi" method="GET">
                      <input type="search" class="form-control" id="inputPassword2" placeholder="Search..." name="search">
                      </form> 
                    </div>
                </div>
								<table class="table table-hover">
                  <thead>
											<tr>
                        <th scope>No</th>
                        <th scope>Nama</th>
                        <th scope>Kode</th>
                        <th scope>Uraian</th>
                        <th scope>Aksi</th>
                      </tr>
									</thead>
                    <tbody>
                    @foreach($klasifikasi as $klas)
                      <tr>
                          <th scope="row">{{ $loop->iteration }} </th>
                          <td>{{$klas->nama}} </td>
                          <td>{{$klas->kode}} </td>
                          <td>{{$klas->uraian}} </td>
                          <td>
                          @if($loggedIn->role_id == 1 )
                          <a href="" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#ModalsEdit-{{ $klas->id}}">Edit</a>
                          <!-- <a href="/klasifikasi/{{$klas->id}}/edit" class="btn btn-warning btn-sm">Edit</a> -->
                          <a href="/klasifikasi/{{$klas->id}}/delete" class="btn btn-danger btn-sm" >Delete</a>
                          @endif  
                        </td>
                      </tr>
                    @endforeach
										</tbody>
                </table>
                  {{ $klasifikasi->links() }}
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
  <div class="modal-dialog" id="modaladd">
    <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel"> <i class="lnr lnr-layers"></i> Tambah Data Klasifikasi</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id=bodytambah>
          <form action="/klasifikasi/create" method="POST" id="frmadd">
            {{csrf_field()}}
            <div class="form-group">
              <label for="exampleInputNama" id="frmnamaadd">Nama</label>
              <input name="nama"  type="text" class="form-control" id="addInputnama" aria-describedby="namaHelp">
            </div>
            <div class="form-group">
              <label for="exampleInputNama" id="frmkodeadd">Kode</label>
              <input name="kode"  type="text" class="form-control" id="addInputkode" aria-describedby="kodeHelp">
            </div>
            <div class="form-group">
              <label for="exampleInputNama" id="frmuraianadd">Uraian</label>
              <textarea name="uraian"  type="text" class="form-control" id="addInputuraian" row="3" aria-describedby="uraianHelp"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>     
        </div>
    </div>
  </div>
</div>

@foreach ($klasifikasi as $klas)
<!-- Modal Update Data -->
<div class="modal " id="ModalsEdit-{{ $klas->id }}" tabindex="-2"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
      <div class="modal-content">
                <div class="modal-header" id="headerupdate">
                  <h3 class="modal-title" id="UpdateLabel"> <i class="lnr lnr-layers"></i> Edit Data Klasifikasi</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="bodyupdate">
                  <form action="/klasifikasi/{{$klas->id}}/update" method="POST" id="frmupdate">
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="" id="namalblup">Nama</label>
                      <input name="updateInputnama"  type="text" class="form-control" id="updateInputnama"  value="{{$klas->nama}}">
                  </div>
                  <div class="form-group">
                    <label for="" id="kodelblup">Kode</label>
                    <input name="updateInputkode"  type="text" class="form-control" id="updateInputkode"  value="{{$klas->kode}}">
                  </div>
                  <div class="form-group">
                    <label for="" id="uraianlblup">Uraian</label>
                    <textarea name="updateInputuraian"  type="text" class="form-control" id="updateInputuraian" row="3" ><?php echo "{$klas->uraian}";?></textarea>
                  </div>
                </div>
                
                <div class="modal-footer" id="fotup">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
      </div>
    </div>
</div>
@endforeach

@endsection