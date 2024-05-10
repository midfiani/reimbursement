@extends('adminlte::page')

@section('css')
<style>
      .imgUpload {
                max-width: 300px;
                max-height: 300px;
                min-width: 300px;
                min-height: 300px;
            }
</style>
@stop
@section('title', 'New Reimburse')
@section('content_header')
    <h1>Create a New Reimburse</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('REIMBURSE.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row mb-3">
                                <label for="namareimburse" class="col-sm-2 col-form-label">Nama Reimbursement</label>
                                <div class="col-sm-10">
                                    <input type="text" required class="form-control" name="title" id="title">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nominal" class="col-sm-2 col-form-label">Nominal Rp.</label>
                                <div class="col-sm-10">
                                    <input type="number" required class="form-control" name="nominal" id="nominal">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="filependukung" class="col-sm-2 col-form-label">File Pendukung</label>
                                <div class="col-sm-10">
                                    <input name="filename" required type="file" id="filename" accept="image/jpeg,image/png,application/pdf">
                                    <p>*note : Accept only JPG, PNG, PDF </p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea type="text" required class="form-control" name="deskripsi"></textarea>
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

@stop