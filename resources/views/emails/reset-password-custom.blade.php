<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Kementerian Agama</title>
</head>
<body style="margin:0; padding:0; background-color:#ffffff; font-family:'Segoe UI', sans-serif;">

    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <!-- Header -->
        <tr>
            <td align="center" style="background-color: #43A047; padding: 30px 20px;">
                <img src="https://1.bp.blogspot.com/-guWx_fglu-Q/X4fAFtyCyFI/AAAAAAAAFqE/n11dZY5gCwIe9QWIe5QMc4-Sy8tZt--HQCLcBGAsYHQ/s1578/logo%2Bkemenag.png" alt="Kemenag" style="height: 60px; margin-bottom: 10px;">
                <h1 style="color: white; font-size: 24px; font-weight: bold; margin: 0;">Kementerian Agama</h1>
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td style="padding: 30px;">
                <h2 style="font-size: 20px; color: #1f2937; margin-bottom: 20px;">Halo {{ $name }},</h2>
                <p style="font-size: 14px; color: #4b5563; line-height: 1.6;">
                    Kami menerima permintaan untuk mereset password akun Anda. Jika ini benar, silakan klik tombol di bawah untuk mengatur ulang password Anda.
                </p>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{ $url }}" style="background-color: #43A047; color: white; font-weight: bold; text-decoration: none; padding: 14px 28px; border-radius: 6px; display: inline-block;">
                        Atur Ulang Password
                    </a>
                </div>

                <p style="font-size: 14px; color: #4b5563;">
                    Tautan ini hanya berlaku selama 60 menit. Jika Anda tidak meminta reset password, Anda bisa mengabaikan email ini.
                </p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #f9fafb; text-align: center; padding: 20px; font-size: 12px; color: #6b7280;">
                © {{ now()->year }} Kementerian Agama. All rights reserved.<br>
                Ikuti kami di
                <a href="https://instagram.com/kemenag_ri" style="color: #10b981; text-decoration: none; font-weight: bold;">Instagram</a> |
                <a href="https://kemenag.go.id" style="color: #10b981; text-decoration: none; font-weight: bold;">Website</a>
            </td>
        </tr>
    </table>

</body>
</html>
