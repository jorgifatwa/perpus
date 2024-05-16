@extends('adminlte::page')

@section('title','Dashboard')
@section('content_header')
    {{-- <h1>Dashboard</h1> --}}
@stop

@section('content')
    {{-- <p>Welcome to this beautiful 
        {{ Auth::user()->level }}  panel</p> --}}
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        
                    <div class="sb-sidenav-footer">
                        <div class="small"></div>
                        {{-- Start Bootstrap --}}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        
                        <div class="row">
                            <div class="col-xl-4 col-md-6">
        
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Book
                                        <span class="badge bg-danger">{{ $totalBook }}</span>
                                    </div>
                                 
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/admin/book">View Details</a>
                                        <div class="small text-white">
                                            <i class="fas fa-angle-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Anggota 
                                        <span class="badge bg-danger">{{ $totalAnggota }}</span>

                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/admin/anggota">View Details</a>
                                        <div class="small text-white">
                                            <i class="fas fa-angle-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Peminjaman
                                        <span class="badge bg-danger">{{ $totalPinjam }}</span>

                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/admin/pinjam">View Details</a>
                                        <div class="small text-white">
                                            <i class="fas fa-angle-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Total Peminjaman Laki - Laki
                                        <span class="badge bg-danger">{{ $totalPinjamLaki }}</span>

                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/admin/pinjam">View Details</a>
                                        <div class="small text-white">
                                            <i class="fas fa-angle-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Total Peminjaman Perempuan
                                        <span class="badge bg-danger">{{ $totalPinjamCewe }}</span>
                                    </div>
                                 
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/admin/pinjam">View Details</a>
                                        <div class="small text-white">
                                            <i class="fas fa-angle-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Buku Masuk 
                                        <span class="badge bg-danger">{{ $totalQuantityMasuk }}</span>

                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/admin/buku_masuk">View Details</a>
                                        <div class="small text-white">
                                            <i class="fas fa-angle-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Buku Keluar 
                                        <span class="badge bg-danger">{{ $totalQuantityKeluar }}</span>

                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/admin/buku_keluar">View Details</a>
                                        <div class="small text-white">
                                            <i class="fas fa-angle-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </main>
                
            </div>
        </div>
            
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection
@section('js')
    <script> console.log('Hi!'); </script>
@stop