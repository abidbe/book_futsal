@extends('layouts.admin')
@section('title', 'Edit Booking admin')
@section('content')

    <div class="content">
        <div class="main-content container-fluid">
            <div class="page-title mb-3 ">
                <h3>Edit Booking</h3>
            </div>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h4 class="card-title">Edit Data</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body pt-2">
                                    <form class="form" method="POST" action="{{ route('booking.update', $booking->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="col">
                                            <div class="row-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="no">No booking</label>
                                                    <select name="lapangan_id" id="lapangan_id" class="form-select">
                                                        @foreach ($lapangans as $lapangan)
                                                            <option value="{{ $lapangan->id }}" @if ($lapangan->id == $booking->lapangan_id) selected @endif>{{ $lapangan->no }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="from">From</label>
                                                    <input type="text" id="from" class="form-control datetimepicker"
                                                        placeholder="From" name="from" value="{{ $booking->from }}">
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="to">To</label>
                                                    <input type="text" id="to" class="form-control datetimepicker"
                                                        placeholder="To" name="to" value="{{ $booking->to }}">
                                                </div>
                                            </div>
                                            <div class="row-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" id="image" class="form-control"
                                                        placeholder="Image" name="payment" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="row-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <a type="button" href="{{ route('booking.index') }}"
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