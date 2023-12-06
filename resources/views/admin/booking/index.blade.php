@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="main-content container-fluid">
            <div class="page-title mb-3 ">
                <h3>Data Booking</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 ">
                                <a href="{{ route('booking.create') }}" class="btn btn-success btn-icon-split me-4"
                                    role="button"><span class="text-white text"><i data-feather="plus"></i>
                                        Create</span></a>
                            </div>
                            <div class="col-xl-6 d-flex justify-content-end">
                                <form style="width: 50% " action="{{ route('booking.index') }}" method="get">
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
                                        <th>Nama Penyewa</th>
                                        <th>Nomor Lapangan</th>
                                        <th>Dari</th>
                                        <th>Ke</th>
                                        <th>Total Jam</th>
                                        <th>Total Harga</th>
                                        <th>Bukti Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $booking)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $booking->user->name }}</td>
                                            <td>{{ $booking->lapangan->no }}</td>
                                            {{-- @dd($bookings) --}}
                                            @php
                                                Carbon\Carbon::setLocale('id');
                                            @endphp
                                            <td>{{ Carbon\Carbon::parse($booking->from)->isoFormat('ddd, DD MMM Y HH:mm') }}
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($booking->to)->isoFormat('ddd, DD MMM Y HH:mm') }}
                                            </td>
                                            @php
                                                $from = Carbon\Carbon::parse($booking->from);
                                                $to = Carbon\Carbon::parse($booking->to);
                                                $hourDifference = $to->diffInHours($from);
                                            @endphp

                                            <td>{{ $hourDifference }} Jam</td>
                                            <td>Rp{{ number_format($booking->lapangan->price * $hourDifference, 2, ',', '.') }}
                                            </td>
                                            <td>
                                                <a href="{{ asset('storage/booking/' . $booking->payment) }}"
                                                    id="img" target="_blank">
                                                    <img class="card-img-top w-10 enlarge-image"
                                                        src="{{ asset('storage/booking/' . $booking->payment) }}" />
                                                </a>
                                            </td>
                                            <td>
                                                @if ($booking->status == 0)
                                                    <span class="badge bg-danger">Pending</span>
                                                @endif
                                                @if ($booking->status == 1)
                                                    <span class="badge bg-success">Success</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-primary rounded-4 p-2 " type="submit"
                                                        style="text-align: justify;">
                                                        <i class="text-white" data-feather="edit"></i>
                                                    </button>
                                                    <form action="{{ route('booking.destroy', $booking) }}" method="post">
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
                                            <td colspan="10" class="text-center">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="col">
                                {{-- <div class="row-xl-4">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">
                                        Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of
                                        {{ $bookings->total() }} entries
                                    </p>
                                </div>

                                <div class="row-xl-4">
                                    <div class="d-flex justify-content-end">
                                        {{ $bookings->links() }}
                                    </div>
                                </div>
                            </div> --}}
                            </div>
                        </div>
                    </div>

            </section>
        </div>

    </div>
@endsection
