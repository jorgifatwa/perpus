@extends('adminlte::page')

@section('css')
<style>
      .imgUpload {
                max-width: 300px;
                max-height: 300px;
                min-width: 300px;
                min-height: 300px;
            }

    .select2-container{
        width: 1120.74px;
        border: 1px solid #ccc!important;
        padding: 5px;
        
    }
</style>

@section('title', 'New Pinjam')
@section('content_header')
    <h1>Create a New Pinjam</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pinjam.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Pinjam Id</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pinjam_id" id="pinjam_id" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Pinjam Date</label>
                                <div class="col-sm-10">
                                    @php
                                    $config = ['format' => 'YYYY-MM-DD'];
                                    $date = date('Y-m-d');
                                    @endphp
                                    <input type="date" class="form-control" name="pinjam_date" id="datetimepicker" value="{{ $date }}"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Anggota</label>
                                <div class="col-sm-10">
                                    <x-adminlte-select2 name="anggota_id" id="anggota">
                                        <option value="" disabled selected>Please Choose Anggota ...</option>
                                        @foreach ($anggota as $c)
                                            
                                            <option value="{{ $c->anggota_id}}">{{ $c->fullname }}</option>
                                        @endforeach
                                    </x-adminlte-select2>
                                    
                                </div>
                            </div>
                          
                           
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Book</label>
                                <div class="col-sm-10">
                                    <x-adminlte-select2 name="book_id" id="book">
                                        <option value="" disabled selected>Please Choose Book ...</option>
                                        @foreach ($book as $b)
                                            
                                            <option value="{{ $b->book_id}}">{{ $b->title }}</option>
                                        @endforeach
                                    
                                    </x-adminlte-select2>
                                    
                                </div>
                            </div>
                          
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Fullname </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"  id="fullname"
                                    readonly
                                    >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Quantity </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="quantity" id="quantity">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Pinjam Status </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pinjam_status" id="pinjam_status" value="Pinjam" readonly>  
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i>
                                     Save</button>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('js')
<script>

// fungsi ajax yaitu memanggil url,method,type, dan success
// ketika url mengakses API pinjam.getPinjamId dengan metode get
// jika success maka akan mengembalikan response dari json
   $.ajax({
    url:`{{ route('pinjam.getPinjamId') }}`,
    method:'get',
    type:'application/json',
    success:function(response){
    // buat variabel key dari response.key
        var key =  response.key
    // isi value yang ada di input pinjam_id
        $('#pinjam_id').val(key)
        console.log(response)
    }
   })

// ketika kita memilih anggota event ini berjalan
   $('#anggota').change(function (){
// ambil value data anggota
// ambil id pada data anggota
    var anggota  = $(this).val();
  // buat ajax untuk mengambil email dari anggota yang di pilih
        $.ajax({
            url:`{{ route('anggota.getAnggotaById') }}`,
            method:'get',
            data:{id:$('#anggota').val()},
        
            success:function(response){
              // jika berhasil ambil data response.anggota.fullname
               var fullname =  response.anggota.fullname;
              // isi value dari input fullname
               $('#fullname').val(fullname);
            }
        })
    });
</script>
@stop