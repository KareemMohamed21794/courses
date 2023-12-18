<html lang="ar">

<head>
    <title>تصريح نشاط</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            overflow-x: hidden;
        }

        #approvement {
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

        #approvement section {
            width: 100%;
        }

        #approvement p {
            margin-top: 0;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        #approvement table {
            border-collapse: collapse;
        }

        #approvement .header,
        #approvement .footer {
            text-align: center;
        }

        .header img,
        .footer img {
            width: 100%;
        }

        .approvementBody {
            text-align: right;
            margin-bottom: 24px;
            margin-top: 8px;
        }

        .approvementNum,
        .approvementIntro {
            margin-bottom: 16px;
        }

        .approvementNum .two-cell {
            width: 56px;
            text-align: right;
        }

        .approvementNum td,
        .approvementNum th {
            padding: 8px 0;
        }

        .approvementInfo {
            margin-bottom: 24px;
        }

        .approvementInfo table {
            margin: auto;
        }

        .approvementInfo th,
        .approvementInfo td {
            border: 1px solid #dddddd;
            text-align: right;
            padding: 8px;
            width: 200px;
            
        }

        .approvementInfo th {
            background-color: #f2f2f2;
        }

        .approvementText h3 {
            margin: 0;
            font-weight: 400;
            text-align: center;
        }

        .approvementSignature {
            margin-right: auto;
            margin-top: 0;
            margin-bottom: 0;
            text-align: center;
            width: fit-content;
            font-size: 1.17em;
            line-height: 1.4;
            font-weight: bold;
        }

        .approvementSignature img {
            width: 120px;
            margin: auto;
            display: block;
        }
    </style>
</head>

<body onload="window.print()">
    <main id="approvement">
        <header class="header">
            <img src="https://tawasol.privatescouts.org/public/approvement/header.jpg" alt="Header" />
        </header>
        <section class="approvementBody">
            <div class="approvementNum">
                <table>
                    <tbody>
                        <tr>
                            <th class="two-cell">الرقم:</th>
                            <td>{{@$objPermit->permit_number}}</td>
                        </tr>
                        <tr>
                            <th class="two-cell">التاريخ:</th>
                            <td>{{date('Y-m-d',strtotime(@$objPermit->created_at))}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="approvementIntro">
                <p><strong>السيد قائد <span class="scoutName">مجموعة خالد بن الوليد الكشفية</span> المحترم</strong></p>
                <p><strong>تحية طيبة وبعد،،</strong></p>
                <p>
                    إشارة لكتابكم رقم <span class="bookNum">{{@$objPermit->permit_number}}</span>، تاريخ <span
                        class="date">{{date('Y-m-d',strtotime(@$objPermit->created_at))}}</span>، والمتضمن طلب إقامة نشاط تطوعي، أعلمكم بأنّه لا مانع لدى مجلس
                    القطاع الكشفي والإرشادي الأهلي من إقامة النشاط المذكور حسب الآتي:
                </p>
            </div>
            <div class="approvementInfo">
                <table>
                    <tr>
                        <th>نوع النشاط</th>
                        @if(@$objPermit->nature_activity == "camp")
                            <td>مخيم</td>
                        @elseif (@$objPermit->nature_activity == "trip") 
                           <td>رحلة</td>
                        @elseif (@$objPermit->nature_activity == "marching") 
                            <td>مسير</td>
                        @elseif (@$objPermit->nature_activity == "overnight") 
                            <td>مبيت</td>
                        @elseif (@$objPermit->nature_activity == "evening") 
                            <td>امسيه</td>
                        @elseif (@$objPermit->nature_activity == "other") 
                           <td>اخرى</td>
                        @endif
                       
                    </tr>
                    <tr>
                        <th>مكان النشاط</th>
                        <td>{{@$objPermit->place_activity}}</td>
                    </tr>
                    <tr>
                        <th>تاريخ النشاط</th>
                        <td>{{date('Y-m-d',strtotime(@$objPermit->created_at))}}</td>
                    </tr>
                    <tr>
                        <th>عدد المشاركين</th>
                        <td>{{@$objPermit->number_participants}}</td>
                    </tr>
                    <tr>
                        <th>الوحدة</th>
                        @if(@$objPermit->alwahda == "ashbal")
                            <td>اشبال /  زهرات</td>
                        @elseif (@$objPermit->alwahda == "kashaf") 
                           <td>كشاف / مرشدات</td>
                        @elseif (@$objPermit->alwahda == "mutaqadimu") 
                            <td>متقدم / متقدمات </td>
                        @elseif (@$objPermit->alwahda == "jawaluh") 
                            <td>جواله / دليلات</td>
                        @elseif (@$objPermit->alwahda == "almajmueuh") 
                            <td>المجموعه</td>
                        @elseif (@$objPermit->alwahda == "awlia_alamwr") 
                           <td> اولياء الامور</td>
                        @elseif (@$objPermit->alwahda == "other") 
                           <td>اخرى</td>
                        @endif
                       
                    </tr>
                    <tr>
                        <th>قائدة النشاط</th>
                        <td>{{@$objPermit->activity_leader}}</td>
                    </tr>
                    <tr>
                        <th>عدد القادة المشاركين</th>
                        <td>{{@$objPermit->number_leader}}</td>
                    </tr>
                </table>
            </div>
            <div class="approvementText">
                <p>
                    راجياً الحصول على الموافقات الرسمية والالتزام بالإجراءات الصحيّة والسّلامة العامة، ويتحمل قائد
                    المجموعة وقائد النشاط والقادة المساعدين مسؤولية أي حدث (لا قدر الله) واخذ موافقة أولياء أمور
                    المشاركين، والتأكد من ان المكان الذي سيتم ممارسة النشاط به مسموح بممارسة الأنشطة به، وتزويدي بتقرير
                    خطي بعد نهاية النشاط بيومين.
                </p>
                <h3>واقبلوا الاحترام</h3>
            </div>
            <div class="approvementSignature">
                رئيس القطـــاع
                <br />
                <img src="https://tawasol.privatescouts.org/public/approvement/signture.png" />
                الحسـن علي نصـــر
            </div>
        </section>
        <footer class="footer">
            <img src="https://tawasol.privatescouts.org/public/approvement/footer.jpg" alt="Footer" />
        </footer>
    </main>
</body>

</html>