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
									<h3 class="panel-title" ><i class="lnr lnr-layers"></i>  Galeri Surat Masuk</h3><br>
                    <div class="form-group input-group col-md-6 right">
                      <form action="/galeri" method="GET">
                      <br><input type="search" class="form-control" id="inputPassword2" placeholder="Search..." name="search">
                         <!-- <input type="search" class="form-control" placeholder="Search..." name="search"> -->
                      <!-- <input type="search" class="form-control" placeholder="Search..." > -->
                      </form> 
                    </div>
                
								</div>
								<div class="panel-body">
                
									<table class="table table-hover">
                  <thead>
											<tr>
                        <!-- <th>No</th> -->
                        <th>No. Surat</th>
                        <th>Perihal</th>
                        <th>File</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
										</thead>
                    <tbody>
                    @foreach($suratmasuk as $surat_masuk)
                      <tr>
                        
                          <td>{{$surat_masuk->nomor_surat}} </td>
                          <td>{{$surat_masuk->perihal}} </td>
                          <td>{{$surat_masuk->file}} </td>
                          <td> @if($surat_masuk->disposisi != NULL)
                          <a class="btn btn-success"> Disposisi </a>
                          @else
                          <a class="btn btn-danger"> Disposisi </a>
                                @endif
                          </td>
                          <td>
                          @if($loggedIn->role_id == 1 )
                          <a href="" class="btn btn-info"  data-toggle="modal" data-target="#practice_modal-{{ $surat_masuk->id}}">Lihat</a>
                          @endif  
                          @if($loggedIn->role_id == 2 )
                          <a href="" class="btn btn-info"  data-toggle="modal" data-target="#practice_modal-{{ $surat_masuk->id}}">Lihat</a>
                          @endif
                          @if($loggedIn->role_id == 3 )
                          <a href="" class="btn btn-info"  data-toggle="modal" data-target="#practice_modal-{{ $surat_masuk->id}}">Lihat</a>
                          @endif    
                        </td>
                      </tr>
                    @endforeach
										</tbody>
                  </table>
                  {{ $suratmasuk->links() }}
                </div>
                 
                
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
</div>
</div>


@foreach ($suratmasuk as $surat_masuk)
<!-- Modal -->
<div class="modal fade" id="practice_modal-{{ $surat_masuk->id }}" tabindex="-1" aria-hidden="true" role="dialog">
                 <div class="modal-dialog" role="document">
                    <div class="modal-content">
                         <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel" style="font;bold"><i class="lnr lnr-layers"></i> Lihat Galeri Surat Masuk</h3>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                              <div class="modal-body">
                                <form action="/galeri/{{$surat_masuk->id}}" enctype="multipart/form-data" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                  <label for="exampleInputNama">Keterangan Disposisi</label>
                                   <input name="ket_disposisi" type="text" class="form-control" id="ket_disposisi"  value="{{$surat_masuk->ket_disposisi}}" readonly>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputNama">Keterangan Tindak Lanjut</label>
                                  <input name="tindak_lanjut"  type="text" class="form-control" id="tindak_lanjut"  value="{{$surat_masuk->tindak_lanjut}}" readonly>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputNama">Download File Surat(pdf)</label><br>
                                  <input name="file"  type="text" class="form-control" id="file"  value="<?php echo "{$surat_masuk->file}";?>" readonly><br>
                                  <a href="{{asset($surat_masuk->file)}}" class="btn btn-success btn-sm" download="" id="file">Download</a> 
                                  <!-- {{-- <img src="{{ assets('admin/assets/img/pdf.jpg') }}"> --}} -->
                                </div>
                                </form>
                              </div>      
                              
                    </div>
                  </div>
                 
</div> 
@endforeach

@endsection