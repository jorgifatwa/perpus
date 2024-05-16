@extends('adminlte::page')

@section('title','Pinjam List')

@section('content_header')
    <h1>Pinjam List</h1>
@stop

@section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                               <strong>{{  session('success') }}</strong>
                                
                              </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{  session('error')}} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                            @endif

                            <div class="float-right">
                                <a href="{{ route('pinjam.create')}}" class="btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    Create</a>

                            </div>
                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Pinjam Id</th>
                                    <th scope="col">Pinjam Date</th>
                                    <th scope="col">Kembali Date</th>
                                    <th scope="col">Anggota Name</th>
                                    <th scope="col">Quantiy</th>
                                    <th scope="col">Pinjam Status</th>       
                                    <th scope="col" width="500px" class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach ($pinjam as $o)
                                    <tr>
                                        <th >{{ ++$i }}</th>
                                        <td>{{ $o->pinjam_id }}</td>
                                        <td>{{ $o->pinjam_date }}</td>
                                        <td>{{ $o->kembali_date }}</td>
                                        <td>{{ $o->fullname }}</td>
                                        <td>{{ $o->quantity }}</td>
                                        <td>{{ $o->pinjam_status }}</td>                                      
                                       
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('pinjam.edit',$o->pinjam_id)}}" class="btn btn-primary mr-2">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-info mr-2" href="{{ route('pinjam.kembalikan', ['id' => $o->pinjam_id]) }}">
                                                    <i class="fas fa-share"></i> Kembalikan
                                                </a>
                                            </div>
                                        </td>
                                      </tr>
                                    @endforeach
                               
                                 
                                </tbody>
                              </table>

                              {{ $pinjam->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop

@section('js')
   <script>
            
        $("#success-alert").fadeTo(2000, 500).fadeOut(500, function(){
        $("#success-alert").fadeOut(500);
        });
   </script>
@stop