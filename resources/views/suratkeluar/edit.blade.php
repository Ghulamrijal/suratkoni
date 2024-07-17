@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
     @if(session('sukses'))
    <div class="alert alert-success" role="alert">
    {{session('sukses')}}
    </div>
</div>
    @endif
<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
     
      <div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title"> <i class="lnr lnr-layers"></i> Edit Surat keluar</h3>
		</div>
	  <div class="panel-body">
        <form action="/suratmasuk/{{$suratmasuk->id}}/update" method="POST"  enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                                  <label for="exampleInputNama">Tujuan</label>
                                   <input name="nama_pengirim"  type="text" class="form-control" id="exampleInputnama_pengirim" aria-describedby="nama_pengirimHelp" value="{{$suratmasuk->nama_pengirim}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputNama">Nomor Surat</label>
                                  <input name="nomor_surat"  type="text" class="form-control" id="exampleInputnomor_surat" aria-describedby="nomor_suratHelp" value="{{$suratmasuk->nomor_surat}}"> 
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputNama">Perihal</label>
                                  <input name="perihal"  type="text" class="form-control" id="exampleInputperihal" aria-describedby="perihalHelp" value="{{$suratmasuk->perihal}}">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputNama">Klasifikasi</label>
                                  <input name="klasifikasi"  type="text" class="form-control" id="exampleInputperihal" aria-describedby="klasifikasiHelp" value="{{$suratmasuk->klasifikasi}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputNama">Unggah File Surat (pdf)</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
                                    <file src="{{ asset('admin/assets/filekeluar/' . $suratmasuk->file) }}" alt="file" >
                                </div>
                                <!-- <div class="form-group">
                                  <label for="exampleInputNama">Unggah File Surat(pdf)</label>
                                  <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
                                   {{-- <img src="{{ asset('admin/assets/img/user-medium.png') }}"> --}} 
                                </div> -->
                                
  
  

    <button type="submit" class="btn btn-warning">Update</button>
  
</form>
								</div>
							</div>
    </div>
  </div>


@endsection