<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class BookingsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $bookings;
    protected $totalRevenue;

    public function __construct($bookings, $totalRevenue)
    {
        $this->bookings = $bookings;
        $this->totalRevenue = $totalRevenue;
    }

    public function collection()
    {
        return $this->bookings->map(function ($booking) {
            $flight = $booking->flight;
            $airline = $flight ? $flight->airline : null;
            $origin = $flight ? $flight->origin : null;
            $destination = $flight ? $flight->destination : null;

            $hargaPerOrang = ($booking->jumlah_penumpang > 0)
                ? $booking->total_harga / $booking->jumlah_penumpang
                : $booking->total_harga;

            $tglBerangkat = '-';
            if ($flight && $flight->tanggal_keberangkatan) {
                $tglBerangkat = Carbon::parse($flight->tanggal_keberangkatan)->format('d/m/Y');
            }

            return [
                'kode_booking' => $booking->kode_booking,
                'tanggal_transaksi' => $booking->created_at ? $booking->created_at->format('d/m/Y H:i:s') : '-',
                'nama_pemesan' => $booking->nama_pemesan,
                'email' => $booking->email,
                'nomor_hp' => $booking->nomor_hp,
                'maskapai' => $airline ? $airline->nama_maskapai : '-',
                'rute' => ($origin ? $origin->kode_bandara : '-') . ' - ' . ($destination ? $destination->kode_bandara : '-'),
                'tanggal_keberangkatan' => $tglBerangkat,
                'jumlah_penumpang' => $booking->jumlah_penumpang,
                'harga_tiket' => 'Rp ' . number_format($hargaPerOrang, 0, ',', '.'),
                'total_pembayaran' => 'Rp ' . number_format($booking->total_harga, 0, ',', '.'),
                'status_pemesanan' => $booking->status_pemesanan,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Booking',
            'Tanggal Transaksi',
            'Nama Pemesan',
            'Email',
            'Nomor HP',
            'Maskapai',
            'Rute',
            'Tanggal Keberangkatan',
            'Jumlah Penumpang',
            'Harga Tiket (Per Orang)',
            'Total Pembayaran',
            'Status Pemesanan',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $rowCount = $this->bookings->count();
                $lastRow = $rowCount + 2;

                // Baris Total di bagian bawah
                $sheet->setCellValue('A' . $lastRow, 'TOTAL PENDAPATAN (Transaksi Berhasil):');
                $sheet->setCellValue('K' . $lastRow, 'Rp ' . number_format($this->totalRevenue, 0, ',', '.'));

                // Styling Total Row
                $sheet->getStyle('A' . $lastRow . ':L' . $lastRow)->getFont()->setBold(true);
                if (class_exists(\PhpOffice\PhpSpreadsheet\Style\Fill::class)) {
                    $sheet->getStyle('A' . $lastRow . ':L' . $lastRow)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FFF5ECEC');

                    // Styling Header Row (Mahogany background with white bold text)
                    $sheet->getStyle('A1:L1')->getFont()->setBold(true);
                    $sheet->getStyle('A1:L1')->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FF57272D');
                    $sheet->getStyle('A1:L1')->getFont()->getColor()->setARGB('FFFFFFFF');
                }
            },
        ];
    }
}
