@extends('user.user')
@section('title', 'Jadwal lapangan '. $lapangans->no)
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <div class="container">
        <div class="main-content container-fluid">
            <div class="page-title my-4 ">
                <h3>Jadwal lapangan {{$lapangans->no}}</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 p-3">
                                <label for="from" class="form-label">Pilih Tanggal </label>
                                <input type="date" id="from" name="from" placeholder="Pilih Tanggal"
                                    class="form-control" >
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="datatables" class="table table-striped my-0">
                                <thead>
                                    <tr>
                                        <th>Jam</th>
                                        <th>Tim</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('jadwal.show', $lapangans->id) }}',
                    data: function(d) {
                        d.from = $('#from').val();
                        
                    }
                },

                columns: [{
                        data: null,
                        name: null,
                        render: function(data, type, row) {
                            if (type === 'display') {
                                // Ubah format tanggal menggunakan Moment.js
                                const toTime = moment(data.to).format('HH:mm');
                                const fromTime = moment(data.from).format('HH:mm');
                                return fromTime + ' - ' + toTime;
                            }
                            return data.to; // Return data 'to' as is for other types
                        }
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                ]
            });
        });
        $('#from').on('change', function() {
            $('#datatables').DataTable().ajax.reload();
        });
    </script>
    <script>
        // Mendapatkan elemen input tanggal
        var fromDateInput = document.getElementById("from");
      
        // Mendapatkan tanggal hari ini
        var today = new Date();
      
        // Format tanggal ke dalam string yang sesuai dengan format input tanggal (YYYY-MM-DD)
        var formattedDate = today.toISOString().substr(0, 10);
      
        // Setel nilai input tanggal dengan tanggal hari ini
        fromDateInput.value = formattedDate;
      </script>
@endsection
