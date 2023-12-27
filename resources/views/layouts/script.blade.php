<script src="{{ asset('voler/dist/assets/js/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('voler/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('voler/dist/assets/js/app.js') }}"></script>

<script src="{{ asset('voler/dist/assets/vendors/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('voler/dist/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('voler/dist/assets/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('voler/dist/assets/js/main.js') }}"></script>
    <script src="{{ asset('carousel/js/popper.js')}}"></script>
    <script src="{{ asset('carousel/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('carousel/js/owl.carousel.min.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script>
</head>
<script>
    $(document).ready(function() {


        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            locale: 'id', // Set locale to Indonesian
            sideBySide: true,
            icons: {
                up: 'fas fa-chevron-up',
                down: 'fas fa-chevron-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right'
            },
            stepping: 60,
            minDate: moment().startOf('now'), // Set minimum date to today
            maxDate: moment().startOf('now').add(14, 'days'), // Set maximum date to 14 days after minimum date
            enabledHours: [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
        });
    });
    
</script>
