@extends('adminlte::page')

@section('css')
<style>
        .select2-container{
        width: 1120.74px;
        border: 1px solid #ccc!important;
        padding: 5px;
        
    }
</style>

@section('title', 'New Kelas')
@section('content_header')
    <h1>Create a New Kelas</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('kelas.store') }}" method="post">
                            @csrf
                            
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name">
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