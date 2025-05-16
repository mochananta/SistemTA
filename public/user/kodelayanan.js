window.addEventListener('DOMContentLoaded', function () {
    const kodeLayanan = document.body.dataset.kodelayanan;
    const noHP = document.body.dataset.nohp;

    if (kodeLayanan && noHP) {
        const combinedText = `Kode Layanan: ${kodeLayanan}\nNo. HP: ${noHP}`;

        Swal.fire({
            icon: 'success',
            title: 'Formulir Berhasil Dikirim 🎉',
            html: `
                <div style="text-align: left;">
                    <p><strong>Kode Layanan:</strong> <span id="kodeLayanan">${kodeLayanan}</span></p>
                    <p><strong>No. HP:</strong> <span id="nohp">${noHP}</span></p>
                    <button id="copyBtn" style="
                        margin-top: 10px;
                        padding: 6px 12px;
                        background-color: #10b981;
                        color: white;
                        border: none;
                        border-radius: 5px;
                        font-size: 13px;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        gap: 6px;
                    ">
                        <i class="fas fa-copy"></i> Salin Info Layanan
                    </button>
                    <p class="mt-2 text-sm text-gray-600">Gunakan informasi ini untuk melacak layanan Anda.</p>
                    <p id="copySuccessMsg" class="text-xs text-green-600 mt-2" style="display:none;">✅ Disalin ke clipboard!</p>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Lacak Sekarang',
            cancelButtonText: 'Tutup',
            didOpen: () => {
                document.getElementById('copyBtn').addEventListener('click', function () {
                    navigator.clipboard.writeText(combinedText).then(() => {
                        document.getElementById('copySuccessMsg').style.display = 'block';
                    });
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/#lacak';
            }
        });
    }
});
