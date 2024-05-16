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
@stop
@section('title', 'New Pinjam')
@section('content_header')
    <h1> Edit Pinjam</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pinjam.update',$pinjam->pinjam_id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Pinjam Id</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pinjam_id" id="pinjam_id" readonly value="{{ $pinjam->pinjam_id}}">
                                    <input type="hidden" name="status_update" value="Kembali">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Kembali Date</label>
                                <div class="col-sm-10">
                                    @php
                                    $config = ['format' => 'YYYY-MM-DD'];
                                    $date = date('Y-m-d');
                                    @endphp
                                    <input type="date" class="form-control" name="kembali_date" value="{{ $date }}"/>
                                    <input type="hidden" class="form-control" name="pinjam_date" value="{{ $date }}"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Anggota</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="anggota_id" id="anggota" readonly>
                                        <option value="" disabled selected>Please Choose Anggota ...</option>
                                        @foreach ($anggota as $c)
                                            
                                            <option value="{{ $c->anggota_id}}"
                                                @if($pinjam->anggota_id == $c->anggota_id) {{ 'selected'}} @endif
                                                >{{ $c->fullname }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                          
                           
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Book</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="book_id" id="book" readonly>
                                        <option value="" disabled selected>Please Choose Book ...</option>
                                        @foreach ($book as $b)
                                            
                                            <option value="{{ $b->book_id}}"
                                                @if($pinjam->book_id == $b->book_id)
                                                {{ 'selected'}}
                                                @endif
                                                >{{ $b->title }}</option>
                                        @endforeach
                                    
                                    </select>
                                    
                                </div>
                            </div>
                          
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Fullname </label>
                                <div class="col-sm-10">
                                    <input type="rext" class="form-control"  id="fullanme"
                                    value="{{ $pinjam->fulllname}}"
                                    readonly
                                    >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Quantity </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="quantity" id="quantity"
                                    value="{{ $pinjam->quantity}}" readonly
                                    >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Pinjam Status </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pinjam_status" id="pinjam_status" value="Sudah dikembalikan" readonly>  
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

// fungsi edit berbeda dengan add jadi silahkan copas dari sini
 $('#anggota').change(function (){
    var anggota  = $(this).val();
        $.ajax({
            url:`{{ route('anggota.getAnggotaById') }}`,
            method:'get',
            data:{id:$('#anggota').val()},
        
            success:function(response){
               var fullname =  response.anggota.fullname;

               $('#fullname').val(fullname);
            }
        })
    });
</script>
@stop