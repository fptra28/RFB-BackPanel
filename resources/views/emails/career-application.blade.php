<!DOCTYPE html>
<html>
<head>
    <title>Lamaran Baru - {{ $details['position'] }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #d22a27; color: white; padding: 15px; text-align: center; }
        .content { padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; }
        .footer { margin-top: 20px; font-size: 12px; color: #777; text-align: center; }
        .detail-item { margin-bottom: 10px; }
        .detail-label { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Lamaran Baru Diterima</h2>
        </div>
        
        <div class="content">
            <h3>Detail Pelamar</h3>
            
            <div class="detail-item">
                <span class="detail-label">Posisi:</span>
                <span>{{ $details['position'] }}</span>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Nama Lengkap:</span>
                <span>{{ $details['name'] }}</span>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Email:</span>
                <span>{{ $details['email'] }}</span>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Nomor Telepon:</span>
                <span>{{ $details['phone'] }}</span>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Pengalaman:</span>
                <span>{{ $details['experience'] }}</span>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Pemberitahuan Kerja:</span>
                <span>{{ $details['noticePeriod'] }}</span>
            </div>
            
            @if(!empty($details['vacancySource']))
            <div class="detail-item">
                <span class="detail-label">Sumber Lowongan:</span>
                <span>{{ $details['vacancySource'] }}</span>
            </div>
            @endif
            
            <div class="detail-item">
                <div class="detail-label">Motivasi:</div>
                <div style="white-space: pre-line;">{{ $details['motivation'] }}</div>
            </div>
            
            <div class="detail-item" style="margin-top: 20px;">
                <p>CV pelamar terlampir dalam email ini.</p>
            </div>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} Nama Perusahaan Anda. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>
