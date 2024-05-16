@extends('adminlte::page')

@section('css')
<style>
        .select2-container{
        width: 1120.74px;
        border: 1px solid #ccc!important;
        padding: 5px;
        
    }
</style>

@section('title', 'New Buku Keluar')
@section('content_header')
    <h1>Create a New Buku Keluar</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('buku_keluar.store') }}" method="post">
                            @csrf
                            
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Buku</label>
                                <div class="col-sm-10">
                                    <x-adminlte-select2 name="book_id" id="book">
                                        <option value="" disabled selected>Please Choose Buku ...</option>
                                        @foreach ($book as $c)
                                            
                                            <option value="{{ $c->book_id}}">{{ $c->title }}</option>
                                        @endforeach
                                    </x-adminlte-select2>
                                    
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="quantity" id="quantity">
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