<html lang="ar">

<head>
    <title>شهادة تسجيل سنوي</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @font-face {
            font-family: 'Bahij_TheSansArabic';
            src: url(./Bahij_TheSansArabic-Bold.ttf);
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'Bahij_TheSansArabic';
            src: url(./Bahij_TheSansArabic-Plain.ttf);
            font-weight: normal;
            font-style: normal;
        }

        body {
            margin: 0;
            overflow-x: hidden;
            font-family: 'Bahij_TheSansArabic';
        }

        #certificate {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            max-width: 1280px;
            padding: 0px 20px;
            margin: auto;
            direction: rtl;
            font-size: 16px;
            min-height: 100vh;
        }

        #certificate img {
            width: 100%;
        }

        .scout-name {
            position: absolute;
            top: 470px;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .scout-name h1 {
            margin: 0;
            font-size: 3em;
            font-weight: bold;
            color: #8d5f3e;
        }

        .certificate-signature {
            position: absolute;
            top: 750px;
            left: 340px;
            transform: translate(-50%, -50%);
        }

        .certificate-signature img {
            height: 90px;
            width: auto;
        }

        .scout-date {
            position: absolute;
            right: 300px;
            top: 727px;
            transform: translate(-50%, -50%);
        }

        .scout-number {
            position: absolute;
            right: 324px;
            top: 770px;
            transform: translate(-50%, -50%);
        }

        .scout-date h3,
        .scout-number h3 {
            margin: 0;
            font-weight: normal;
            font-size: 1.17em;
            color: #8d5f3e;
        }

        .scout-year {
            position: absolute;
            top: 554px;
            right: 480px;
            transform: translate(-50%, -50%);
        }

        .scout-year h2 {
            margin: 0;
            font-weight: bold;
            font-size: 2em;
            color: #8d5f3e;
        }
    </style>
</head>

<body onload="window.print()">
    <main id="certificate">
        <img src="https://tawasol.privatescouts.org/public/certificate/certificate.jpg" />
        <div class="scout-name">
            <h1>{{ $objFile->Admin->group_name }}</h1>
        </div>
        <div class="certificate-signature">
            <img src="https://tawasol.privatescouts.org/public/certificate//signature.png" />
        </div>
        <div class="scout-date">
            <h3>{{ date('d/m/Y') }}</h3>
        </div>
        <div class="scout-number">
            <h3>{{ $objFile->Admin->registration_number }}</h3>
        </div>
        <div class="scout-year">
            <h2>{{ $objFile->year }}</h2>
        </div>
    </main>
</body>

</html>