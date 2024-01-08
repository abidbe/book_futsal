@extends('user.user')
@section('title', 'Data Booking User')
@section('content')
    <div class="container">
        <div class="main-content container-fluid">
            <div class="page-title mt-3 ">
                <h3>Data Booking</h3>
            </div>
            <section class="section">
                <div class="card my-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 my-3">
                                <a href="{{ route('bookinguser.create') }}" class="btn btn-success btn-icon-split me-4"
                                    role="button"><span class="text-white text"><i data-feather="plus"></i>
                                        Booking</span></a>
                            </div>
                            
                        </div>
                        <div class="table-responsive">
                            <table class='table table-striped my-0' id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
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
                                    @forelse ($bookings as $bookinguser)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $bookinguser->lapangan->no }}</td>
                                            {{-- @dd($bookingusers) --}}
                                            @php
                                                Carbon\Carbon::setLocale('id');
                                            @endphp
                                            <td>{{ Carbon\Carbon::parse($bookinguser->from)->isoFormat('ddd, DD MMM Y HH:mm') }}
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($bookinguser->to)->isoFormat('ddd, DD MMM Y HH:mm') }}
                                            </td>
                                            @php
                                                $from = Carbon\Carbon::parse($bookinguser->from);
                                                $to = Carbon\Carbon::parse($bookinguser->to);
                                                $hourDifference = $to->diffInHours($from);
                                            @endphp

                                            <td>{{ $hourDifference }} Jam</td>
                                            <td>Rp{{ number_format($bookinguser->lapangan->price * $hourDifference, 2, ',', '.') }}
                                            </td>
                                            <td>
                                                <a href="{{ asset('storage/booking/' . $bookinguser->payment) }}"
                                                    id="img" target="_blank">
                                                    <img width="50px"
                                                        src="{{ asset('storage/booking/' . $bookinguser->payment) }}" />
                                                </a>
                                            </td>
                                            <td>
                                                @if ($bookinguser->status == 0)
                                                    <span class="badge bg-danger">Pending</span>
                                                @endif
                                                @if ($bookinguser->status == 1)
                                                    <span class="badge bg-success">Success</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <form action="{{ route('bookinguser.destroy', $bookinguser) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger rounded p-2 " type="submit"
                                                            style="text-align: justify;">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="col">
                                <div class="row-xl-4">
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
                            </div>
                            </div>
                        </div>
                    </div>

            </section>
        </div>

    </div>
@endsection