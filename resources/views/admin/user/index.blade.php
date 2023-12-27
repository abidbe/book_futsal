@extends('layouts.admin')
@section('title', 'Data User')
@section('content')
    <div class="content">
        <div class="main-content container-fluid">
            <div class="page-title mb-3 ">
                <h3>Data User</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form class="d-flex justify-content-end" action="{{ route('user.index') }}" method="get">
                                <div class="col-xl-3 text-md-end">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search.." name="search">
                                        <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="table-responsive">
                            <table class='table table-striped' id="table1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>@if($user->is_admin == 1)
                                                    Admin
                                                @else
                                                    User
                                                @endif
                                                <i class="fa-solid fa-right-left"></i>
                                                </td>
                                                <td class="d-xl-flex gap-2">
                                                    @if ($user->is_admin)
                                                    <form action="{{ route('user.removeadmin', $user) }}" method="Post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-primary rounded-4 p-2 " type="submit"
                                                                    style="text-align: justify;">
                                                                    <i class="text-white" data-feather="lock"></i>
                                                                </button>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('user.makeadmin', $user) }}" method="Post">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button class="btn btn-success rounded-4 p-2  border-1" type="submit"
                                                                style="text-align: justify;">
                                                                <i class="text-white" data-feather="unlock"></i>
                                                            </button>
                                                    </form>
                                                    @endif
                                                        <form action="{{ route('user.destroy', $user) }}" method="post" >
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger rounded-4 p-2 " type="submit"
                                                                    style="text-align: justify;" >
                                                                <i class="text-white " data-feather="trash-2"></i>
                                                            </button>
                                                        </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No data available</td>
                                            </tr>
                                        @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">
                                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                                </p>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
        
            </section>
        </div>
        
    </div>
@endsection
