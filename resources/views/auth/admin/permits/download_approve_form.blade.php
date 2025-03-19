<html lang="ar">

<head>
    <title>تصريح نشاط -    {{ $objPermit->Admin->group_name }}  - {{@$objPermit->place_activity}}-  {{@$objPermit->activity_leader}}</title>
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
            font-size: 14px;
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
            margin-bottom: 20px;
            margin-top: 8px;
        }

        .approvementNum,
        .approvementIntro {
            margin-bottom: 12px;
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
            margin-bottom: 18px;
        }

        .approvementInfo table {
            margin: auto;
        }

        .approvementInfo th,
        .approvementInfo td {
            border: 1px solid #dddddd;
            text-align: right;
            padding: 8px;
            font-size: 14px;
        }

        .approvementInfo th {
            width: 120px;
        }

        .approvementInfo td {
            width: 300px;
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
            font-size: 1em;
            line-height: 1.4;
            font-weight: bold;
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .approvementSignature .signature {
            width: 100px;
            margin: auto;
            display: block;
        }

        .approvementSignature .stamp {
            width: 120px;
            margin: auto;
            display: block;
        }

        .leaders-list {
            padding-right: 16px;
            margin: 0;
            column-count: 3;
        }

        .leaders-list li {
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
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
                <p><strong>السيد/ة قائد/ة<span class="scoutName">  {{ @$objPermit->Admin->group_name }} </span> المحترم</strong></p>
                <p><strong>تحية طيبة وبعد،،</strong></p>
                <p>
                 إشارة لكتابكم رقم <span class="bookNum">{{@$objPermit->number_order}}</span>، تاريخ <span class="date">{{date('d-m-Y',strtotime(@$objPermit->created_at))}}</span>، والمتضمن طلب إقامة نشاط، أعلمكم بأنّه لا مانع لدى مجلس القطاع الكشفي والإرشادي الأهلي من إقامة النشاط المذكور حسب الآتي: 
             </p>
            </div>
            <div class="approvementInfo">
                <table>
                    @if(@$objPermit->TypeActivity->name_ar)
                    <tr>
                        <th>نوع النشاط</th>
                        <td>{{@$objPermit->TypeActivity->name_ar}}</td>
                       {{--  @if(@$objPermit->nature_activity == "camp")
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
                        @endif --}}
                    </tr>
                    @endif
                    <tr>
                        <th>مكان النشاط</th>
                        <td>{{@$objPermit->place_activity}}</td>
                    </tr>
                    <tr>
                        <th>تاريخ النشاط</th>
                        <td>{{date('Y-m-d',strtotime(@$objPermit->activity_history))}}</td>
                    </tr>

                    <tr>
                        <th>عدد الأيام</th>
                        <td>{{@$objPermit->number_days}}</td>
                    </tr>

                    <tr>
                        <th>عدد المشاركين</th>
                        <td>{{@$objPermit->number_participants}}</td>
                    </tr>
                    <tr>


                        <?php 

                        $alwahda = '';
            if (is_array($objPermit->alwahda)) {
                // If alwahda is an array, map each value to its corresponding Arabic value
                $alwahda = array_map(function ($value) {
                    switch ($value) {
                        case 'ashbal':
                            return 'اشبال / زهرات';
                        case 'kashaf':
                            return 'كشاف / مرشدات';
                        case 'mutaqadimu':
                            return 'متقدم / متقدمات';
                        case 'jawaluh':
                            return 'جواله / دليلات';
                        case 'almajmueuh':
                            return 'المجموعه';
                        case 'awlia_alamwr':
                            return 'اولياء الامور';
                        case 'other':
                            return 'اخرى';
                        default:
                            return $value; // Handle any unexpected values
                    }
                }, $objPermit->alwahda);
                $alwahda = implode(', ', $alwahda); // Convert the array back to a comma-separated string
            } else {
                // If alwahda is a single comma-separated string, split it and map each value
                $alwahdaValues = explode(',', $objPermit->alwahda);
                $alwahda = implode(', ', array_map(function ($value) {
                    switch ($value) {
                        case 'ashbal':
                            return 'اشبال / زهرات';
                        case 'kashaf':
                            return 'كشاف / مرشدات';
                        case 'mutaqadimu':
                            return 'متقدم / متقدمات';
                        case 'jawaluh':
                            return 'جواله / دليلات';
                        case 'almajmueuh':
                            return 'المجموعه';
                        case 'awlia_alamwr':
                            return 'اولياء الامور';
                        case 'other':
                            return 'اخرى';
                        default:
                            return $value; // Handle any unexpected values
                    }
                }, $alwahdaValues));
            }


                        ?>


                        <th>الوحدة</th>
                        <td>{{ $alwahda }}</td>
                    </tr>
                    <tr>
                        <th>قائد  النشاط</th>
                        <td>{{@$objPermit->activity_leader}}</td>
                    </tr>
                    <tr>
                        <th>عدد القادة المشاركين</th>
                        <td>{{@$objPermit->number_leader}}</td>
                    </tr>
                    <tr>
                        <th>اسماء القادة المشاركين</th>
                        <td>
                            <ul class="leaders-list">
                                @php
                                    $leadersArray = explode("\n", $objPermit->leaders_names);
                                @endphp

                                @foreach($leadersArray as $leader)
                                    <li>{{ $leader }}</li>
                                @endforeach
                            </ul>
                        </td>
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
                <div>
                    <img class="stamp" src="https://tawasol.privatescouts.org/public/approvement/stamp.png">
                </div>
                <div>
                    رئيس القطـــاع
                    <br />
                    <img class="signature" src="https://tawasol.privatescouts.org/public/approvement/signature.png" />
                    الحسـن علي نصـــر
                </div>
            </div>

        </section>
        <footer class="footer">
            <img src="https://tawasol.privatescouts.org/public/approvement/footer.jpg" alt="Footer" />
        </footer>
    </main>
</body>

</html>