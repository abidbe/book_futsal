<?php

namespace App\Charts;

use App\Models\Booking;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class PemasukanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
{
    $tahun = date('Y');
    $bulan = date('m');
    $data = [];
    $dataBulan = [];

    for ($i = 1; $i <= $bulan; $i++) {
        $totalSaldoP = 0; // Inisialisasi total saldo untuk bulan ini
        foreach (Booking::whereYear('from', $tahun)->where('status', 1)->whereMonth('from', $i)->get() as $booking) {
            $from = Carbon::parse($booking->from);
            $to = Carbon::parse($booking->to);
            $hourDifference = $to->diffInHours($from);
            $bookingp = $booking->lapangan->price * $hourDifference;
            $totalSaldoP += $bookingp; // Akumulasi total saldo untuk bulan ini
        }

        // Ubah angka menjadi format dengan desimal
        $formattedTotalSaldoPWithDecimal = number_format($totalSaldoP, 0, ',', '.');

        // Hapus desimal
        $formattedTotalSaldoP = str_replace('.', '', $formattedTotalSaldoPWithDecimal);

        $dataBulan[] = Carbon::create()->month($i)->format('F');
        $data[] = $formattedTotalSaldoP;
    }

    return $this->chart->barChart()
        ->addData('Pemasukan', $data)
        ->setXAxis($dataBulan);
}
}
