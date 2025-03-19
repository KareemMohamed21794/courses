<html lang="ar">

<head>
    <title>مطالبة مالية</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            overflow-x: hidden;
        }

        #claim {
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

        #claim section {
            width: 100%;
        }

        #claim p {
            margin-top: 0;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        #claim table {
            border-collapse: collapse;
        }

        #claim .header,
        #claim .footer {
            text-align: center;
        }

        .header img,
        .footer img {
            width: 100%;
        }

        .claimBody {
            text-align: right;
            margin-bottom: 20px;
            margin-top: 8px;
        }

        .claimNum {
            display: flex;
            justify-content: flex-end;
        }

        .claimNum,
        .claimIntro {
            margin-bottom: 12px;
        }

        .claimNum .two-cell {
            width: 90px;
            text-align: right;
        }

        .claimNum td,
        .claimNum th {
            padding: 8px 0;
        }

        .claimIntro p {
            font-size: 20px;
        }

        .claimIntro h2 {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-top: 0;
            margin-bottom: 30px;
        }

        .align-center {
            text-align: center;
        }

        .claimSignature {
            margin-right: auto;
            margin-top: 0;
            margin-bottom: 0;
            text-align: center;
            width: fit-content;
            font-size: 1em;
            line-height: 1.4;
            font-weight: bold;
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .claimSignature .signature {
            width: 100px;
            margin: auto;
            display: block;
        }

        .claimSignature .stamp {
            width: 120px;
            margin: auto;
            display: block;
        }

        .claimText {
            margin-top: 12px;
        }

        .claimText li:not(:last-of-type) {
            margin-bottom: 12px;
        }
    </style>
</head>

<body>
    <main id="claim">
        <header class="header">
            <img src="{{ asset('/claim/header.jpg') }}" alt="Header" />
        </header>
        <section class="claimBody">
            <div class="claimNum">
                <table>
                    <tbody>
                        <tr>
                            <th class="two-cell">رقم المطالبة:</th>
                            <td>
                                م ق أ / 26 /
                                <span class="scoutNumber">{{@$objAdmin->id}}</span> /
                                <span class="idNumber">{{@$objAdmin->claim_number}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="two-cell">تاريخ المطالبة:</th>
                            <td>{{date('Y/m/d')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="claimIntro">
                <h2>مطالبة ماليّة</h2>
                <p class="align-center">السادة / <span class="scoutName">{{@$objAdmin->group_name}}</span> المحترمين</p>
                <p>
                    يرجى التكرم بتسديد مبلغ <strong>(<span class="claimPrice">{{@$remain}}</span>) دينار أردني</strong> وذلك بدل
                    رسوم اشتراك سنوية
                    لأفراد وفرق
                    المجموعة في القطاع وبدل إصدار
                    تصاريح أنشطة المجموعة خلال الفترة الماضية.
                </p>
                <p class="align-center">وتفضلوا بقبول وافر التقدير والاحترام ،،،</p>
            </div>
            <div class="claimSignature">
                <div>
                    <img class="stamp" src="{{ asset('/claim/stamp.png') }}" alt="Stamp">
                </div>
                <div>
                    رئيس القطـــاع
                    <br />
                    <img class="signature" src="{{ asset('/claim/signature.png') }}" alt="Signature" />
                    الحسـن علي نصـــر
                </div>
            </div>
            <div class="claimText">
                <p>
                    آلية التسديد:
                </p>
                <ol>
                    <li>نقداً لدى سكرتير القطاع.</li>
                    <li>بموجب شيك باسم القطاع الكشفي والإرشادي الأهلي.</li>
                    <li>إيداع بنكي في حساب القطاع الكشفي والإرشادي الأهلي في البنك الإسلامي الأردني رقم 11696 فرع تلاع
                        العلي.</li>
                    <li>تحويل كليك لحساب القطاع (PVTSCOUTS).</li>
                </ol>
            </div>
        </section>
        <footer class="footer">
            <img src="{{ asset('/claim/footer.jpg') }}" alt="Footer" />
        </footer>
    </main>
</body>

</html>