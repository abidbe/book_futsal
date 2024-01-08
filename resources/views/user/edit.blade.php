@extends('user.user')
@section('title', 'Edit Booking User')
@section('content')
    <div class="container">
        <div class="main-content container-fluid">
            <div class="page-title my-3 ">
                <h3>Edit Booking</h3>
            </div>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h4 class="card-title">Update Data</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body pt-2">
                                    <form class="form" method="POST" action="{{ route('bookinguser.update', $bookinguser) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="col">
                                            <div class="row-md-6 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="no">No booking</label>
                                                    <select name="lapangan_id" id="lapangan_id" class="form-select">
                                                        @foreach ($lapangans as $lapangan)
                                                            <option value="{{ $lapangan->id }}"
                                                                data-price="{{ $lapangan->price }}"
                                                                {{ $lapangan->id == $bookinguser->lapangan_id ? 'selected' : '' }}>
                                                                {{ $lapangan->no }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="from">From</label>
                                                    <input type="text" id="from" class="form-control datetimepicker"
                                                        placeholder="From" name="from" value="{{ $bookinguser->from }}">
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="to">To</label>
                                                    <input type="text" id="to" class="form-control datetimepicker"
                                                        placeholder="To" name="to" value="{{ $bookinguser->to }}">
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="totalPrice">Total Price</label>
                                                    <input type="text" id="totalPrice" class="form-control" disabled
                                                        value="{{ $bookinguser->total_price }}">
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="image">Payment Proof</label>
                                                    <input type="file" id="image" class="form-control"
                                                        placeholder="Image" name="payment" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="row-12 d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
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
        function calculateTotalPrice() {
            var courtPricePerHour = parseFloat($('#lapangan_id option:selected').data('price'));
            var from = new Date($('#from').val());
            var to = new Date($('#to').val());
            var timeDifference = (to - from) / 1000 / 3600;
            var totalPrice = courtPricePerHour * timeDifference;
    
            // Format the totalPrice in Indonesian currency (IDR)
            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
            var formattedTotalPrice = formatter.format(totalPrice);
    
            $('#totalPrice').val(formattedTotalPrice);
        }
    
        $('#from, #to, #lapangan_id').on('change', function () {
            calculateTotalPrice();
        });
    
        // Initial calculation
        calculateTotalPrice();
    
        // Update total price every 1 second (optional)
        setInterval(function () {
            calculateTotalPrice();
        }, 0);
    </script>
@endsection