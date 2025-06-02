<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CMS-APP || Email Verification</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <style>
        .otp-input {
            width: 3rem;
            height: 3rem;
            font-size: 2rem;
            text-align: center;
            margin-right: 0.5rem;
        }
    </style>
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg p-4 w-100" style="max-width: 500px;">
        <h2 class="text-center mb-4">Email Verification</h2>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <p class="mb-3">We have sent a 6-digit OTP to your email. Please enter it below to verify your account.</p>

        <form method="POST" action="{{ route('verify.email') }}">
            @csrf
            <div class="d-flex justify-content-center mb-3">
                <input type="text" inputmode="numeric" pattern="\d" maxlength="1" class="otp-input form-control" name="otp1"
                    id="otp1" required autofocus>
                <input type="text" inputmode="numeric" pattern="\d" maxlength="1" class="otp-input form-control" name="otp2"
                    id="otp2" required>
                <input type="text" inputmode="numeric" pattern="\d" maxlength="1" class="otp-input form-control" name="otp3"
                    id="otp3" required>
                <input type="text" inputmode="numeric" pattern="\d" maxlength="1" class="otp-input form-control" name="otp4"
                    id="otp4" required>
                <input type="text" inputmode="numeric" pattern="\d" maxlength="1" class="otp-input form-control" name="otp5"
                    id="otp5" required>
                <input type="text" inputmode="numeric" pattern="\d" maxlength="1" class="otp-input form-control" name="otp6"
                    id="otp6" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Verify</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script>
        const inputs = document.querySelectorAll('.otp-input');

        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                input.value = input.value.replace(/\D/g, '');

                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === "Backspace" && input.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        const form = document.querySelector('form');
        form.addEventListener('submit', (e) => {
            const otpValue = Array.from(inputs).map(i => i.value).join('');
            let hiddenOtp = document.createElement('input');
            hiddenOtp.type = 'hidden';
            hiddenOtp.name = 'otp';
            hiddenOtp.value = otpValue;

            form.appendChild(hiddenOtp);

            inputs.forEach(i => i.disabled = true);
        });
    </script>
</body>


</html>