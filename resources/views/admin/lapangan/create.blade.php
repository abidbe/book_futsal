@extends('layouts.admin')
@section('title', 'Tambah Data Lapangan')
@section('content')
    <div class="content">
        <div class="main-content container-fluid">
            <div class="page-title mb-3 ">
                <h3>Create Lapangan</h3>
            </div>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h4 class="card-title">Isi Semua Data</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body pt-2">
                                    <form class="form" method="POST" action="{{route('lapangan.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="col">
                                            <div class="row-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="no">No Lapangan</label>
                                                    <input type="number" id="no" class="form-control"
                                                        placeholder="No Lapangan" name="no">
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="harga">Harga</label>
                                                    <input type="number" id="last-name-column" class="form-control"
                                                        placeholder="Harga" name="price">
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" id="image" class="form-control"
                                                        placeholder="Image" name="image" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select class="form-select" name="status" id="status">
                                                        <option value="1" selected>Active</option>
                                                        <option value="0">Non Active</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <a type="button" href="{{ url()->previous() }}"
                                                    class="btn btn-danger me-1 mb-1">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
