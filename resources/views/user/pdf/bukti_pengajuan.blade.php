<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pengajuan Layanan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #0e7e4b;
            padding-bottom: 10px;
        }

        .header img {
            height: 60px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 18px;
            margin: 0;
            color: #0e7e4b;
            text-transform: uppercase;
        }

        .header p {
            font-size: 12px;
            margin: 2px 0;
        }

        .title {
            text-align: center;
            margin: 30px 0 20px;
            font-size: 16px;
            font-weight: bold;
            color: #0e7e4b;
            text-transform: uppercase;
        }

        .info {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .info p {
            margin: 5px 0;
        }

        .info span {
            font-weight: bold;
            width: 140px;
            display: inline-block;
        }

        .footer {
            font-size: 10px;
            text-align: center;
            margin-top: 40px;
            border-top: 1px dashed #ccc;
            padding-top: 10px;
        }

        ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="/public/user/kemenag.png" alt="Logo Kemenag">
        <h1>Kementerian Agama Republik Indonesia</h1>
        <p>Pelayanan Terpadu Satu Pintu (PTSP) - Kantor Urusan Agama</p>
    </div>

    <div class="title">Bukti Pengajuan Layanan</div>

    <div class="info">
        <p><span>Kode Layanan</span>: {{ $data->kode_layanan }}</p>
        <p><span>Nama Pemohon</span>: {{ $data->nama }}</p>
        <p><span>Layanan</span>: 
            {{ $isSurat ? 'PENGAJUAN SURAT - ' . strtoupper($data->jenis_surat) : 'KONSULTASI - ' . strtoupper($data->jenis_konsultasi) }}
        </p>
        <p><span>Status</span>: <strong>DISETUJUI</strong></p>
        <p><span>Tanggal Disetujui</span>: {{ $data->updated_at->format('d M Y, H:i') }}</p>
    </div>

    @if ($isSurat)
        <p>Silakan membawa <strong>berkas asli</strong> ke kantor KUA tujuan untuk proses lanjutan.</p>
        <p style="font-size: 11px; margin-top: 5px;"><em>Pastikan dokumen sesuai dengan yang telah diunggah.</em></p>
    @else
        <p>Silakan datang sesuai jadwal berikut untuk konsultasi di kantor KUA:</p>
        <ul>
            <li><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($data->tanggal_konsultasi)->format('d M Y') }}</li>
            <li><strong>Jam:</strong> {{ $data->jam_konsultasi }}</li>
        </ul>
        <p style="font-size: 11px;"><em>Mohon hadir tepat waktu dan bawa dokumen jika diminta.</em></p>
    @endif

    <div class="footer">
        Dokumen ini dicetak otomatis oleh sistem PTSP KUA - Tidak memerlukan tanda tangan.
    </div>

</body>
</html>
