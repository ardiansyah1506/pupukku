<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            position: relative;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .amount {
            font-size: 2.5em;
            font-weight: 700;
            color: #374151;
            margin-bottom: 40px;
            text-align: left;
        }

        .bank-selection {
            margin-bottom: 30px;
        }

        .bank-option {
            display: flex;
            align-items: center;
            padding: 18px 20px;
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .bank-option:hover {
            border-color: #8B5CF6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.15);
        }

        .bank-logo {
            width: 60px;
            height: 40px;
            background: #1E3A8A;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
            margin-right: 16px;
        }

        .bank-name {
            font-size: 1.2em;
            color: #374151;
            font-weight: 500;
        }

        .payment-details {
            margin-bottom: 30px;
        }

        .detail-row {
            margin-bottom: 20px;
        }

        .detail-label {
            font-size: 1.1em;
            color: #6B7280;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .detail-value {
            font-size: 1.3em;
            color: #111827;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .company-name {
            font-size: 1.1em;
            color: #111827;
            font-weight: 500;
        }

        .check-status-btn {
            position: absolute;
            bottom: -70px;
            right: 0;
            background: #8B5CF6;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            font-size: 1em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .check-status-btn:hover {
            background: #7C3AED;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139, 92, 246, 0.4);
        }

        .next-arrow {
            position: absolute;
            bottom: -70px;
            right: -60px;
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .next-arrow:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(5px);
        }

        /* Success Modal */
        .success-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: #F3F4F6;
            border: 3px solid #8B5CF6;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            max-width: 350px;
            width: 90%;
            position: relative;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: #8B5CF6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 40px;
            font-weight: bold;
        }

        .success-text {
            font-size: 1.8em;
            color: #8B5CF6;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .success-subtext {
            color: #8B5CF6;
            font-size: 1.1em;
            margin-bottom: 30px;
            font-weight: 500;
        }

        .continue-btn {
            background: #8B5CF6;
            color: white;
            padding: 14px 35px;
            border: none;
            border-radius: 25px;
            font-size: 1.1em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .continue-btn:hover {
            background: #7C3AED;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139, 92, 246, 0.4);
        }

        .modal-hidden {
            display: none;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }
            
            .amount {
                font-size: 2em;
            }
            
            .check-status-btn {
                position: static;
                width: 100%;
                margin-top: 30px;
            }
            
            .next-arrow {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="amount">Rp. 500.000</div>
    
        <div class="bank-selection">
            <div class="bank-option {{ $perusahaan->status == '1' ? 'clickable' : '' }}" 
                 @if($perusahaan->status == '1') onclick="showSuccess()" @endif>
                <div class="bank-logo">
                    {{ $perusahaan->jenis_bank }}
                </div>
                <div class="bank-name">Bank {{ $perusahaan->jenis_bank }}</div>
            </div>
        </div>
    
        <div class="payment-details">
            <div class="detail-row">
                <div class="detail-label">Nomor Rekening</div>
                <div class="detail-value">{{ $perusahaan->norek }}</div>
            </div>
    
            <div class="detail-row">
                <div class="detail-label">Nama Perusahaan</div>
                <div class="company-name">{{ $perusahaan->nama }}</div>
            </div>
        </div>
    
        @if($perusahaan->status == '0')
            <div class="text-center mt-3" style="color: #F59E0B; font-weight: bold;">
                <i class="fas fa-clock me-1"></i> Menunggu validasi pembayaran dari Admin
            </div>
        @elseif($perusahaan->status == '1')
            <button class="check-status-btn">Cek Status Pembayaran</button>
            <div class="next-arrow">→</div>
        @endif
    </div>
    

    <!-- Success Modal -->
    <div class="success-modal" id="successModal">
        <div class="modal-content">
            <div class="success-icon">✓</div>
            <div class="success-text">SUCCESS!</div>
            <div class="success-subtext">Pembayaran Berhasil</div>
            <button class="continue-btn" onclick="hideSuccess()">Continue</button>
        </div>
    </div>

    <script>
        function showSuccess() {
            document.getElementById('successModal').style.display = 'flex';
        }

        function hideSuccess() {
            document.getElementById('successModal').style.display = 'none';
        }

        // Close modal when clicking outside
        document.getElementById('successModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideSuccess();
            }
        });

        // Add click handler to check status button
        document.querySelector('.check-status-btn').addEventListener('click', function() {
            showSuccess();
        });

        // Add click handler to next arrow
        document.querySelector('.next-arrow').addEventListener('click', function() {
            showSuccess();
        });
    </script>
</body>
</html>