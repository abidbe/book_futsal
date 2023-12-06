@extends('user.user')
@section('content')
    <div class="container">
        <div class="main-content container-fluid">
            <div class="page-title mt-5 ">
                <h3>Jadwal</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 ">
                                <a href="{{ route('bookinguser.create') }}" class="btn btn-success btn-icon-split me-4"
                                    role="button"><span class="text-white text"><i data-feather="plus"></i>
                                        Create</span></a>
                            </div>
                            <div class="col-xl-6 d-flex justify-content-end">
                                <form style="width: 50% " action="{{ route('bookinguser.index') }}" method="get">
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
                        <div class="row">
                            <select name="lapangan_id" id="lapangan_id" class="form-select">
                                @foreach ($lapangans as $lapangan)
                                    <option value="{{ $lapangan->id }}">{{ $lapangan->no }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <input type="date" name="" id="">
                        </div>
                        <div class="table-responsive">
                            <table class='table table-striped my-0' id="table1">
                                <thead>
                                    <tr>
                                        <th>Jam</th>
                                        <th>Tim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>09:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 09:00:00'&& $booking->to >= '2023-12-06 10:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>10:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 10:00:00'&& $booking->to >= '2023-12-06 11:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>11:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 11:00:00'&& $booking->to >= '2023-12-06 12:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>12:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 12:00:00'&& $booking->to >= '2023-12-06 13:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>13:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 13:00:00'&& $booking->to >= '2023-12-06 14:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>14:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 14:00:00'&& $booking->to >= '2023-12-06 15:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>15:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 15:00:00'&& $booking->to >= '2023-12-06 16:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>16:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if ($booking->lapangan->no == '2' && ($booking->from <= '2023-12-06 17:00:00' && $booking->to >= '2023-12-06 16:00:00'))
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>17:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 17:00:00'&& $booking->to >= '2023-12-06 18:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>18:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 18:00:00'&& $booking->to >= '2023-12-06 19:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>19:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 19:00:00'&& $booking->to >= '2023-12-06 20:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>20:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 20:00:00'&& $booking->to >= '2023-12-06 21:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>21:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 21:00:00'&&$booking->to >= '2023-12-06 22:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>22:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 22:00:00'&&$booking->to >= '2023-12-06 23:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>23:00</td>
                                            <td>
                                                @forelse ($bookings as $booking)
                                                @if (($booking->from <= '2023-12-06 23:00:00'&& $booking->to >= '2023-12-06 24:00:00')&& $booking->lapangan->no == '2')
                                                {{ $booking->user->name }}
                                            @endif
                                            @empty
                                        
                                    @endforelse
                                        </td>
                                        </tr>
                                    
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