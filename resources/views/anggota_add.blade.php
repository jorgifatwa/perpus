@extends('adminlte::page')

@section('css')
<style>
        .select2-container{
        width: 1120.74px;
        border: 1px solid #ccc!important;
        padding: 5px;
        
    }
</style>

@section('title', 'New Anggota')
@section('content_header')
    <h1>Create a New Anggota</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('anggota.store') }}" method="post">
                            @csrf
                            
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">FullName</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fullname" id="fullname">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-10">
                                    <x-adminlte-select2 name="kelas_id" id="kelas">
                                        <option value="" disabled selected>Please Choose Kelas ...</option>
                                        @foreach ($kelas as $c)
                                            
                                            <option value="{{ $c->kelas_id}}">{{ $c->name }}</option>
                                        @endforeach
                                    </x-adminlte-select2>
                                    
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                            </div>
                           
                            <fieldset class="row mb-3">
                                <label class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender"
                                            value="male" checked>
                                        <label class="form-check-label" for="gridRadios1">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender"
                                            value="female">
                                        <label class="form-check-label" for="gridRadios2">
                                            Female
                                        </label>
                                    </div>
                                    
                                </div>
                            </fieldset>
                           
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea  class="form-control" name="address" id="address"></textarea>
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