<html lang="ar">

<head>
    <title>شهادة تسجيل سنوي</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @font-face {
            font-family: 'Bahij_TheSansArabic';
            src: url(https://tawasol.privatescouts.org/public/certificate/Bahij_TheSansArabic-Bold.ttf);
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'Bahij_TheSansArabic';
            src: url(https://tawasol.privatescouts.org/public/certificate/Bahij_TheSansArabic-Plain.ttf);
            font-weight: normal;
            font-style: normal;
        }

        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: 'Bahij_TheSansArabic';
            direction: rtl;
        }

        #certificate {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 550px;
            padding: 80px 60px;
            margin: auto;
            border-image-source: url('https://tawasol.privatescouts.org/public/certificate/border.png');
            border-image-repeat: round;
            border-image-slice: 47.5%;
            border-image-width: auto;
            border-image-outset: 0px;
        }

        .logos {
            display: flex;
            justify-content: space-between;
        }

        .logos .logo {
            max-width: 120px;
        }

        .logos .asset {
            max-width: 300px;
            margin-top: 30px;
        }

        .certificate-text p {
            text-align: center;
            font-size: 20px;
            color: #8d5f3e;
            margin: 0;
        }

        .certificate-text .scout-name {
            margin: 25px 0;
            font-size: 2.5em;
            font-weight: bold;
            color: #8d5f3e;
            text-align: center;
        }

        .certificate-text .scout-date {
            font-weight: bold;
        }

        .certificate-text .last-line {
            margin-top: 20px;
        }

        .certificate-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
        }

        .certificate-info td {
            font-size: 16px;
            color: #8d5f3e;
        }

        .certificate-info th {
            font-size: 16px;
            color: #8d5f3e;
            text-align: right;
            font-weight: bold;
        }

        .certificate-signature p {
            text-align: center;
            margin: 0;
            font-size: 18px;
            color: #8d5f3e;
        }

        .certificate-signature img {
            margin-top: -40px;
            width: 120px;
        }
    </style>
</head>

<body>
    <main id="certificate">
        <div class="logos">
            <div>
                <img class="logo" src="https://tawasol.privatescouts.org/public/certificate/Logo-01.png" />
            </div>
            <div>
                <img class="asset" src="https://tawasol.privatescouts.org/public/certificate/Asset.png" />
            </div>
            <div>
                <img class="logo" src="https://tawasol.privatescouts.org/public/certificate/Logo-02.png" />
            </div>
        </div>
        <div class="certificate-text">
            <p>يشهد القطاع الكشفي والإرشادي الأهلي في جمعية الكشافة والمرشدات الأردنية بأنّ</p>
            <h1 class="scout-name"> {{ $objFile->Admin->group_name }} </h1>
            <p>مسجلة في القطاع للعام &#160 <span class="scout-date">{{ $objFile->year }}</span> &#160 وبناء عليها يمكنها
                إقامة
                الاجتماعات واللقاءات
                والنشاطات الكشفية.
            </p>
            <p class="last-line">علماً بأن هذه الشهادة تصدر سنوياً بناء على تقديم السّجلات السنوية.</p>
        </div>
        <div class="certificate-footer">
            <div class="certificate-info">
                <table>
                    <tbody>
                        <tr>
                            <td colspan="1">تاريخ الإصدار:</td>
                            <th colspan="1"><span class="certificate-date">{{ date('Y/m/d',strtotime($objFile->created_at)) }}</span></th>
                        </tr>
                        <tr>
                            <td colspan="1">رقم التسجيل:</td>
                            <th colspan="1"><span class="scout-number">{{ $objFile->Admin->registration_number }}</span></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="certificate-signature">
                <p>
                    رئيس القطاع<br />
                    الحسن علي نصر
                </p>
                <img src="https://tawasol.privatescouts.org/public/certificate/signature.png" />
            </div>
        </div>
    </main>
</body>

</html>