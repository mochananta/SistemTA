window.addEventListener('DOMContentLoaded', function () {
    const kodeLayanan = document.body.dataset.kodelayanan;

    if (kodeLayanan) {
        Swal.fire({
            icon: 'success',
            title: 'Formulir Berhasil Dikirim 🎉',
            html: `
                <div style="text-align: left;">
                    <p><strong>Kode Layanan Anda:</strong> <span id="kodeLayanan">${kodeLayanan}</span></p>
                    <button id="copyBtn" style="
                        margin-top: 10px;
                        padding: 6px 12px;
                        background-color: #0EDF99FF;
                        color: white;
                        border: none;
                        border-radius: 5px;
                        font-size: 13px;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        gap: 6px;
                    ">
                        <i class="fas fa-copy"></i> Salin Kode
                    </button>
                    <p class="mt-2 text-sm text-gray-600">Gunakan kode ini untuk melacak layanan Anda.</p>
                    <p id="copySuccessMsg" class="text-xs text-green-600 mt-2" style="display:none;">✅ Kode disalin ke clipboard!</p>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Lacak Sekarang',
            cancelButtonText: 'Tutup',
            didOpen: () => {
                document.getElementById('copyBtn').addEventListener('click', function () {
                    navigator.clipboard.writeText(kodeLayanan).then(() => {
                        document.getElementById('copySuccessMsg').style.display = 'block';
                    });
                });
            }
        }).then((result) => {
            window.history.replaceState({}, document.title, window.location.pathname);

            if (result.isConfirmed) {
                window.location.href = '/#lacak';
            }
        });
    }
});
