@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="main-content container-fluid">
            <div class="page-title mb-3 ">
                <h3>Data Lapangan</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 ">
                                <a href="{{ route('lapangan.create') }}" class="btn btn-success btn-icon-split me-4"
                                    role="button"><span class="text-white text"><i data-feather="plus"></i>
                                        Create</span></a>
                            </div>
                            <div class="col-xl-6 d-flex justify-content-end">
                                <form style="width: 50% " action="{{ route('lapangan.index') }}" method="get">
                                    <div class="text-md-end">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Search.."
                                                name="search">
                                            <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class='table table-striped my-0' id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($lapangans as $lapangan)
                                        <tr>
                                            <td>{{ $lapangan->no }}</td>
                                            <td>Rp {{ number_format($lapangan->price, 0, ',', '.') }},00</td>
                                            <td>
                                                <a href="{{ asset('storage/lapangan/' . $lapangan->image) }}" id="img" target="_blank">
                                                    <img class="card-img-top w-10 enlarge-image"
                                                        src="{{ asset('storage/lapangan/' . $lapangan->image) }}"
                                                        alt="{{ $lapangan->no }}" />
                                                </a>
                                            </td>
                                            <td>
                                                @if ($lapangan->status == 0)
                                                    <span class="badge bg-danger">Non Active</span>
                                                @endif
                                                @if ($lapangan->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2"> 
                                                    <button class="btn btn-primary rounded-4 p-2 " type="submit"
                                                        style="text-align: justify;">
                                                        <i class="text-white" data-feather="edit"></i>
                                                    </button>
                                                    <form action="{{ route('lapangan.destroy', $lapangan) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger rounded-4 p-2 " type="submit"
                                                            style="text-align: justify;">
                                                            <i class="text-white " data-feather="trash-2"></i>
                                                        </button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="col">
                                <div class="row-xl-4">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">
                                        Showing {{ $lapangans->firstItem() }} to {{ $lapangans->lastItem() }} of
                                        {{ $lapangans->total() }} entries
                                    </p>
                                </div>

                                <div class="row-xl-4">
                                    <div class="d-flex justify-content-end">
                                        {{ $lapangans->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>

    </div>
@endsection
