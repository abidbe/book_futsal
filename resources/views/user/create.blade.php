@extends('user.user')
@section('title', 'Create Booking User')
@section('content')
    <div class="container">
        <div class="main-content container-fluid">
            <div class="page-title my-3 ">
                <h3>Create Booking</h3>
            </div>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-xl-6 mb-3">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h4 class="card-title">Pembayaran</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body pt-2">
                                    <div class="text-center">
                                        <h5>Nomor DANA</h5>
                                        <p>087700343303</p>
                                        <img src="{{ asset('qrdana.png') }}" alt="DANA QR Code" width="350"
                                            class="mb-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h4 class="card-title">Isi Semua Data</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body pt-2">
                                    <form class="form" method="POST" action="{{ route('bookinguser.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="col">
                                            <div class="row-md-6 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="no">No booking</label>
                                                    <select name="lapangan_id" id="lapangan_id" class="form-select">
                                                        @foreach ($lapangans as $lapangan)
                                                            <option value="{{ $lapangan->id }}"
                                                                data-price="{{ $lapangan->price }}">{{ $lapangan->no }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="from">From</label>
                                                    <input type="text" id="from" class="form-control datetimepicker"
                                                        placeholder="From" name="from">
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="to">To</label>
                                                    <input type="text" id="to" class="form-control datetimepicker"
                                                        placeholder="To" name="to">
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="totalPrice">Harga Total</label>
                                                    <input type="text" id="totalPrice" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="image">Bukti Pembayaran</label>
                                                    <input type="file" id="image" class="form-control"
                                                        placeholder="Image" name="payment" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="row-12 d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <a href="{{ url()->previous() }}"
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function hitungHargaTotal() {
            var hargaLapanganPerJam = parseFloat($('#lapangan_id option:selected').data('price'));
            var dari = new Date($('#from').val());
            var ke = new Date($('#to').val());
            var selisihWaktu = (ke - dari) / 1000 / 3600;
            var hargaTotal = hargaLapanganPerJam * selisihWaktu;

            // Ubah hargaTotal ke format mata uang Indonesia (IDR)
            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
            var hargaTotalFormatted = formatter.format(hargaTotal);

            $('#totalPrice').val(hargaTotalFormatted);
        }

        $('#from, #to, #lapangan_id').on('change', function() {
            hitungHargaTotal();
        });

        // Perhitungan awal
        hitungHargaTotal();

        // Perbarui harga total setiap 1 detik (opsional)
        setInterval(function() {
            hitungHargaTotal();
        }, 0);
    </script>
@endsection
