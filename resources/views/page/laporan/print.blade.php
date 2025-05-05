<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembayaran Tiket</title>
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page {
            width: 297mm;
            min-height: 210mm;
            padding: 10mm;
            margin: 0mm auto;
            background: white;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #204b8c;
        }

        .company-name {
            font-size: 20px;
            font-weight: bold;
            color: #204b8c;
            margin-bottom: 5px;
        }

        .report-title h1 {
            font-size: 24px;
            color: #204b8c;
            margin: 0;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 12px;
        }

        th {
            background-color: #204b8c;
            color: white;
            padding: 10px;
            text-align: left;
        }

        td {
            padding: 8px 10px;
            border-bottom: 1px solid #ddd;
        }

        .status-lunas {
            color: #28a745;
            font-weight: bold;
        }

        .status-pending {
            color: #ffc107;
            font-weight: bold;
        }

        .status-gagal {
            color: #dc3545;
            font-weight: bold;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 150px;
            margin: 0 auto 5px;
            padding-top: 5px;
        }

        @page {
            size: A4 landscape;
            margin: 10mm;
        }
    </style>
</head>

<body>
    <div class="page">

        <!-- Judul Laporan -->
        <div class="report-title" style="text-align: center;">
            <h1>LAPORAN PEMBAYARAN TIKET</h1>
            <p>Periode: {{ $startDate ?? 'Tanggal Mulai' }} hingga {{ $endDate ?? 'Tanggal Selesai' }}</p>
        </div>

        <!-- Tabel Pembayaran -->
        <table border="1">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>KODE RESERVASI</th>
                    <th>METODE PEMBAYARAN</th>
                    <th>JUMLAH PEMBAYARAN</th>
                    <th>STATUS</th>
                    <th>WAKTU PEMBAYARAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $totalLunas = 0;
                    $totalPending = 0;
                    $totalGagal = 0;
                    $totalPembayaran = 0;
                @endphp
                
                @forelse ($pembayaran ?? [] as $p)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $p->reservasi->kode_reservasi ?? 'N/A' }}</td>
                        <td>{{ ucwords($p->metode_pembayaran) ?? '-' }}</td>
                        <td>{{ number_format($p->jumlah_pembayaran, 0, ',', '.') }}</td>
                        <td class="status-{{ strtolower($p->status_pembayaran) }}">
                            {{ ucfirst($p->status_pembayaran) }}
                        </td>
                        <td>{{ $p->waktu_pembayaran ? date('d/m/Y H:i', strtotime($p->waktu_pembayaran)) : '-' }}</td>
                    </tr>
                    @php
                        if($p->status_pembayaran == 'lunas') $totalLunas++;
                        elseif($p->status_pembayaran == 'pending') $totalPending++;
                        elseif($p->status_pembayaran == 'gagal') $totalGagal++;
                        $totalPembayaran += $p->jumlah_pembayaran;
                    @endphp
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">Tidak ada data pembayaran</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Rekapitulasi -->
        <div style="margin-top: 20px;">
            <h3>Rekapitulasi Pembayaran:</h3>
            <p>Total Lunas: {{ $totalLunas }} transaksi</p>
            <p>Total Pending: {{ $totalPending }} transaksi</p>
            <p>Total Gagal: {{ $totalGagal }} transaksi</p>
            <p>Total Nominal Pembayaran: {{ number_format($totalPembayaran, 0, ',', '.') }}</p>
        </div>

        <!-- Tanda Tangan -->
        <div style="margin-top: 50px; text-align: right;">
            <div style="width: 200px; display: inline-block;">
                <p>Bandung, {{ date('d F Y') }}</p>
                <div class="signature-line"></div>
                <p>Mengetahui,</p>
                <p style="margin-top: 30px;">(_)</p>
            </div>
        </div>

        <!-- Footer -->
        <div style="margin-top: 30px; text-align: center; font-size: 10px;">
            Dokumen ini dicetak secara otomatis pada {{ date('d/m/Y H:i:s') }}
        </div>
    </div>

    <!-- Tombol Cetak -->
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>