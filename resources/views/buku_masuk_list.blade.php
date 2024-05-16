@extends('adminlte::page')

@section('title','Buku Masuk List')
@section('content_header')
    <h1>Buku Masuk List</h1>
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
                                <a href="{{ route('buku_masuk.create')}}" class="btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    Create</a>

                            </div>
                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Buku</th>
                                    <th scope="col">Quantity</th>
                                  </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach ($buku_masuk as $c)
                                    <tr>
                                        <th scope="row">{{ ++$i }}</th>
                                        <td>{{ $c->created_at }}</td>
                                        <td>{{ $c->title }}</td>
                                        <td>{{ $c->quantity }}</td>
                                      </tr>
                                    @endforeach
                               
                                 
                                </tbody>
                              </table>

                              {{ $buku_masuk->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop

@section('js')
   <script>
       //fungsi dibawah untuk menghilangkan alert dengan efek fadeout   
        $("#success-alert").fadeTo(2000, 500).fadeOut(500, function(){
        $("#success-alert").fadeOut(500);
        });
   </script>
@stop