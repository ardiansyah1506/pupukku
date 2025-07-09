<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Selection Interface</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content:first baseline;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
            position: relative;
        }

        .amount {
            font-size: 2.5em;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .bank-option {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border: 2px solid #f0f0f0;
            border-radius: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .bank-option:hover {
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .bank-logo {
            width: 50px;
            height: 35px;
            margin-right: 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 12px;
        }

        .bank-bca { background: #003d7a; }
        .bank-bri { background: #003d7a; }
        .bank-mandiri { background: #003d7a; }
        .bank-bni { background: #ff6b35; }

        .bank-name {
            font-size: 1.2em;
            color: #333;
            font-weight: 500;
        }

        .success-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            position: relative;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 40px;
        }

        .success-text {
            font-size: 1.5em;
            color: #667eea;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .success-subtext {
            color: #888;
            margin-bottom: 30px;
        }

        .continue-btn {
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1.1em;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .continue-btn:hover {
            background: #5a6fd8;
            transform: translateY(-2px);
        }

        .form-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .form-content {
            background: white;
            padding: 40px;
            border-radius: 20px;
            max-width: 450px;
            width: 90%;
            position: relative;
        }

        .form-title {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #f0f0f0;
            border-radius: 10px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn-cancel {
            background: #f0f0f0;
            color: #666;
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            font-size: 1em;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #e0e0e0;
        }

        .btn-submit {
            background: #667eea;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            font-size: 1em;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: #5a6fd8;
            transform: translateY(-2px);
        }
        small{
         font-size: 20px;
         font-weight: lighter;   
        }
        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #999;
        }

        .close-btn:hover {
            color: #333;
        }

        .bank-selection-container {
            max-height: 400px;
            overflow-y: auto;
        }

        .check-status-btn {
            position: absolute;
            bottom: -60px;
            right: 0;
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 0.9em;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .check-status-btn:hover {
            background: #5a6fd8;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="amount">
            <p>Rp. 500.000</p>
            <small>No Rekening: 1892323232</small>
        </div>
        <div class="bank-selection-container">
            <div class="bank-option" onclick="selectBank('BCA', 'BCA')">
                <div class="bank-logo bank-bca">BCA</div>
                <div class="bank-name">BCA</div>
            </div>
            
            <div class="bank-option" onclick="selectBank('BRI', 'BRI')">
                <div class="bank-logo bank-bri">BRI</div>
                <div class="bank-name">BRI</div>
            </div>
            
            <div class="bank-option" onclick="selectBank('MANDIRI', 'Bank Mandiri')">
                <div class="bank-logo bank-mandiri">MDR</div>
                <div class="bank-name">Mandiri</div>
            </div>
            
            <div class="bank-option" onclick="selectBank('BNI', 'BNI')">
                <div class="bank-logo bank-bni">BNI</div>
                <div class="bank-name">BNI</div>
            </div>
        </div>

    </div>

    <!-- Form Modal -->
    <div class="form-modal" id="formModal">
        <div class="form-content">
            <button class="close-btn" onclick="closeFormModal()">&times;</button>
            <h2 class="form-title">Detail Pembayaran</h2>
            
            <form action="{{ route('daftar.uploadBuktiBayar', $id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Jenis Bank</label>
                    <input type="text" class="form-input" name="bank" id="selectedBank" readonly>
                </div>
                
                <div class="form-group">
                    <label class="form-label">No Rekening</label>
                    <input type="text" class="form-input" name="norek" id="norek" placeholder="Masukkan nomor rekening" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Bukti Pembayaran</label>
                    <input type="file" class="form-input" name="bukti_bayar" id="bukti" placeholder="Masukkan nomor rekening" required>
                </div>
                
                <div class="form-buttons">
                    <button type="button" class="btn-cancel" onclick="closeFormModal()">Batal</button>
                    <button type="submit" class="btn-submit">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>

  

    <script>
        let selectedBankCode = '';
        let selectedBankName = '';

        function selectBank(bankCode, bankName) {
            selectedBankCode = bankCode;
            selectedBankName = bankName;
            document.getElementById('selectedBank').value = bankName;
            document.getElementById('formModal').style.display = 'flex';
        }

        function closeFormModal() {
            document.getElementById('formModal').style.display = 'none';
            document.getElementById('accountNumber').value = '';
        }

        function closeSuccessModal() {
            document.getElementById('successModal').style.display = 'none';
        }

        document.getElementById('bankForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const accountNumber = document.getElementById('accountNumber').value;
            
            if (accountNumber.trim() === '') {
                alert('Mohon masukkan nomor rekening');
                return;
            }
            
            // Simulate processing
            setTimeout(() => {
                closeFormModal();
                document.getElementById('successModal').style.display = 'flex';
            }, 1000);
        });

        // Close modal when clicking outside
        document.getElementById('formModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeFormModal();
            }
        });

     
    </script>
</body>
</html>