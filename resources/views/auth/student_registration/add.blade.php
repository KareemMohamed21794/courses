<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الطالب</title>
    <link href="{{ asset('demo1/dist/assets/plugins/custom/styles.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    body {
        font-family: 'Cairo', sans-serif;
        direction: rtl;
        background-color: #f4f4f4;
        color: #333;
    }

    .scout-form {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px 20px 30px 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        margin-bottom: 6px;
        font-weight: 600;
        display: inline-block;
    }

    .form-group label .required-mark {
        color: red;
        margin-right: 4px;
    }

    .form-group input[type="text"],
    .form-group input[type="date"],
    .form-group input[type="email"],
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-family: 'Cairo', sans-serif;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        height: 42px;
    }

.form-group select {
    height: 46px;
    background-image: linear-gradient(45deg, transparent 50%, gray 50%), linear-gradient(135deg, gray 50%, transparent 50%);
    background-position: calc(10px) calc(1em + 6px), calc(15px) calc(1em + 6px);
    background-size: 5px 5px, 5px 5px;
    background-repeat: no-repeat;
    appearance: none;
}

    .form-group input[type="text"]:focus,
    .form-group input[type="date"]:focus,
    .form-group input[type="email"]:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    .form-group textarea {
        height: 100px;
        resize: none;
    }

    .two-column {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .two-column .form-group {
        flex: 1;
    }

    button[type="submit"] {
        width: 100%;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
            font-family: 'Cairo', sans-serif;
            height: 42px;
    }

    button[type="submit"]:hover {
        background-color: #218838;
    }
    </style>
</head>


<body>
    <form class="scout-form" action="{{ url('student_registration') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if(session()->has('message'))
            <div class="custom-alert">
                <span class="icon">✔</span> <!-- Success icon -->
                <span class="message">{{ session()->get('message') }}</span>
            </div>
        @endif

        <style>
            .custom-alert {
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #28a745, #218838); /* Elegant gradient */
                color: white;
                font-weight: bold;
                font-size: 18px;
                font-family: 'Cairo', sans-serif;
                padding: 15px 20px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                text-align: center;
                position: relative;
                animation: fadeIn 0.5s ease-in-out;
            }

            .custom-alert .icon {
                margin-right: 10px;
                font-size: 22px;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>


         <div class="form-group">
           <p style="text-align: center;font-weight:bold;font-size:18px;font-family: 'Cairo'">التسجيل في   {{$admindetails->group_name}}</p>
        </div>

        <div class="form-group">
            <label for="first_name">المجموعه الكشفيه</label>
            <input type="text" id="first_name" name="first_name" value="{{$admindetails->group_name}}" readonly>
        </div>

        <div class="two-column">
            <div class="form-group">
                <label for="first_name">الاسم الأول <span class="required-mark">*</span></label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="father_name">اسم الأب <span class="required-mark">*</span></label>
                <input type="text" id="father_name" name="father_name" required>
            </div>
</div>
                    <div class="two-column">
            <div class="form-group">
                <label for="grandfather_name">اسم الجد <span class="required-mark">*</span></label>
                <input type="text" id="grandfather_name" name="grandfather_name" required>
            </div>
            <div class="form-group">
                <label for="family_name">اسم العائلة <span class="required-mark">*</span></label>
                <input type="text" id="family_name" name="family_name" required>
            </div>
        </div>
</div>
        <div class="two-column">
                        <div class="form-group">
                <label for="birth_place">مكان الولادة <span class="required-mark">*</span></label>
                <input type="text" id="birth_place" name="birth_place">
            </div>
            <div class="form-group">
                <label for="birth_date">تاريخ الولادة <span class="required-mark">*</span></label>
                <input type="date" id="birth_date" name="birth_date">
            </div>
        </div>

                <div class="two-column">
<div class="form-group">
    <label for="nationality"  >الجنسيه <span class="required-mark">*</span></label>
    <select onchange="ChooseNationality(this.value)" id="nationality" name="nationality" required>
        <option value="">اختر..</option>
        <option value="jordanian">أردني</option>
        <option value="emirati">إماراتي</option>
        <option value="bahraini">بحريني</option>
        <option value="tunisian">تونسي</option>
        <option value="algerian">جزائري</option>
        <option value="comorian">جزر القمر</option>
        <option value="djiboutian">جيبوتي</option>
        <option value="saudi">سعودي</option>
        <option value="sudanian">سوداني</option>
        <option value="syrian">سوري</option>
        <option value="somali">صومالي</option>
        <option value="iraqi">عراقي</option>
        <option value="omanian">عماني</option>
        <option value="palestinian">فلسطيني</option>
        <option value="qatari">قطري</option>
        <option value="kuwaitian">كويتي</option>
        <option value="lebanese">لبناني</option>
        <option value="libyan">ليبي</option>
        <option value="egyptian">مصري</option>
        <option value="moroccan">مغربي</option>
        <option value="mauritanian">موريتاني</option>
        <option value="yemeni">يمني</option>
        <option value="american">أمريكي</option>
        <option value="british">بريطاني</option>
        <option value="french">فرنسي</option>
        <option value="german">ألماني</option>
        <option value="canadian">كندي</option>
        <option value="australian">أسترالي</option>
        <option value="chinese">صيني</option>
        <option value="indian">هندي</option>
        <option value="japanese">ياباني</option>
        <option value="south_african">جنوب أفريقي</option>
        <option value="brazilian">برازيلي</option>
        <option value="russian">روسي</option>
        <option value="italian">إيطالي</option>
        <option value="spanish">إسباني</option>
        <option value="portuguese">برتغالي</option>
        <option value="swedish">سويدي</option>
        <option value="norwegian">نرويجي</option>
        <option value="dutch">هولندي</option>
        <option value="greek">يوناني</option>
        <option value="turkish">تركي</option>
        <option value="pakistani">باكستاني</option>
        <option value="afghan">أفغاني</option>
        <option value="iranian">إيراني</option>
        <option value="malaysian">ماليزي</option>
        <option value="singaporean">سنغافوري</option>
        <option value="vietnamese">فيتنامي</option>
        <option value="thai">تايلاندي</option>
        <option value="indonesian">إندونيسي</option>
        <option value="mexican">مكسيكي</option>
        <option value="colombian">كولومبي</option>
        <option value="chilean">تشيلي</option>
        <option value="argentinian">أرجنتيني</option>
        <option value="peruvian">بيروفي</option>
    </select>
</div>
            <div class="form-group">
                <label for="national_id" id="national_label">الرقم الوطني <span class="required-mark">*</span></label>
                <input type="text" id="national_id" name="national_id" required>
            </div>
        </div>

        <div class="two-column">
            <div class="form-group">
                <label for="mobile_number">رقم الهاتف  <span class="required-mark">*</span></label>
                <input type="text" id="mobile_number" name="mobile_number">
            </div>
            <div class="form-group">
                <label for="home_number">رقم المنزل</label>
                <input type="text" id="home_number" name="home_number">
            </div>
        </div>



        <div class="two-column">
            <div class="form-group">
<label for="education_level">المؤهل العلمي  </label>
<select id="education_level" name="education_level" >
    <option value="">اختر..</option>
    <option value="primary_school">ابتدائي</option>
    <option value="middle_school">إعدادي</option>
    <option value="high_school">ثانوية عامة</option>
    <option value="diploma">دبلوم</option>
    <option value="bachelor">بكالوريوس</option>
    <option value="master">ماجستير</option>
    <option value="phd">دكتوراه</option>
</select>
</div>
<div class="form-group">
    <label for="parents_status">الحالة بين الأبوين</label>
    <select id="parents_status" name="parents_status" >
        <option value="">اختر..</option>
        <option value="married">متزوج</option>
        <option value="divorced">مطلق</option>
        <option value="separated">منفصل</option>
        <option value="widowed">أرمل/أرملة</option>
    </select>
</div>
</div>

<div class="form-group">
    <label for="blood_type">نوع الدم</label>
    <select id="blood_type" name="blood_type" >
        <option value="">اختر..</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
    </select>
</div>

<div class="form-group">
    <label for="hobbies">الهوايات</label>
    <textarea id="hobbies" name="hobbies" ></textarea>
</div>
<div class="form-group">
    <label>هل لديك أي أمراض مزمنة أو ظروف صحية بحاجة إلى رعاية؟</label>
    <div onchange="HealthCondition()">
        <input type="radio" id="health_yes" name="health_condition" value="yes">
        <label for="health_yes">نعم</label>
        <input type="radio" id="health_no" name="health_condition" value="no">
        <label for="health_no">لا</label>
    </div>
</div>

<div class="form-group" id="health_condition_type_div">
    <label for="health_condition_type">هل يمكنك كتابة ما هي الأمراض مزمنة أو الظروف الصحية التي بحاجة إلى رعاية؟</label>
    <textarea id="health_condition_type" name="health_condition_type"></textarea>
</div>

        <div class="two-column">
<div class="form-group">
    <label for="city">المدينه</label>
    <select id="city" name="city" onchange="SelectCity(this.value)" >
        <option value="">اختر..</option>
        <option value="1">عمان</option>
        <option value="2">إربد</option>
        <option value="3">الزرقاء</option>
        <option value="4">العقبة</option>
        <option value="5">مأدبا</option>
        <option value="6">الكرك</option>
        <option value="7">جرش</option>
        <option value="8">عجلون</option>
        <option value="9">المفرق</option>
        <option value="10">الطفيلة</option>
        <option value="11">معان</option>
        <option value="12">البلقاء</option>
    </select>
</div>

<div class="form-group" id="selected_area">
    <label for="amman_region">المنطقه</label>
    <select id="amman_region" name="amman_region" class="form-control">
                                                    <option value="">اختر..</option>
                                                     <option value="أبو نصير">
                                                        أبو نصير</option>

                                                        <option value="شفا بدران">
                                                        شفا بدران</option>

                                                       <option value="الجبيهة">
                                                        الجبيهة</option>

                                                        <option value="طارق">
                                                        طارق</option>

                                                        <option value=" ماركا">
                                                        ماركا</option>

                                                        <option value="بسمان">
                                                        بسمان</option>

                                                        <option value="العبدلي">
                                                        العبدلي</option>

                                                        <option value="تلاع العلي وأم السماق وخلدا">
                                                        تلاع العلي وأم السماق وخلدا</option>

                                                        <option value="صويلح">
                                                        صويلح</option>

                                                        <option value="المدينة">
                                                        المدينة</option>

                                                        <option value="النصر">
                                                        النصر</option>

                                                        <option value="اليرموك">
                                                        اليرموك</option>

                                                        <option value="زهران">
                                                        زهران</option>

                                                        <option value="وادي السير">
                                                        وادي السير</option>

                                                        <option value="بدر الجديدة">
                                                        بدر الجديدة</option>

                                                        <option value="مرج الحمام">
                                                        مرج الحمام</option>

                                                        <option value="بدر">
                                                        بدر</option>

                                                        <option value="راس العين">
                                                        راس العين</option>

                                                        <option value="القويسمة وأبو علندا والجويدة و الرقيم">
                                                        القويسمة وأبو علندا والجويدة و الرقيم </option>

                                                        <option value="أم قصير ">
                                                        أم قصير والمقابلين والبنيات</option>

                                                        <option value="خريبة السوق">
                                                        خريبة السوق وجاوا واليادودة</option>

                                                        <option value="احد">
                                                        احد </option>

                                                </select>
</div>

<div class="form-group" id="text_area">
    <label for="area">المنطقه</label>
    <input type="text" id="area" name="area" ></input>
</div>
</div>

<div class="form-group">
    <label for="street">اسم الشارع</label>
    <input type="text" id="street" name="street" >
</div>
        <div class="two-column">

<div class="form-group">
    <label for="nearest_teacher">اقرب معلم</label>
    <input type="text" id="nearest_teacher" name="nearest_teacher" >
</div>

<div class="form-group">
    <label for="building_number">رقم البناء</label>
    <input type="text" id="building_number" name="building_number" >
</div>
</div>
<div class="form-group">
    <label for="division">الفرقه <span class="required-mark">*</span></label>
    <select id="division" name="division" required>
        <option value="">اختر..</option>
        <option value="1">الاشبال/الزهرات</option>
        <option value="2">الكشاف/المرشدات</option>
        <option value="3">المتقدم/المتقدمات</option>
        <option value="4">الجواله/الدليلات</option>
        <option value="5">القادة/القائدات</option>
    </select>
</div>
<div class="form-group">
    <label for="guardian_name">اسم ولي الامر</label>
    <input type="text" id="guardian_name" name="guardian_name" >
</div>

        <div class="two-column">
<div class="form-group">
    <label for="guardian_phone">رقم  ولي  الامر 1</label>
    <input type="text" id="guardian_phone" name="guardian_phone" >
</div>

<div class="form-group">
    <label for="guardian_phone_2">رقم  ولي  الامر  2</label>
    <input type="text" id="guardian_phone_2" name="guardian_phone_2">
</div>
</div>

        <div class="two-column">
<div class="form-group">
    <label for="guardian_job">مهنه ولي الامر</label>
    <input type="text" id="guardian_job" name="guardian_job" >
</div>

<div class="form-group">
    <label for="relative_relation">صله القرابه</label>
    <input type="text" id="relative_relation" name="relative_relation" >
</div>
</div>

        <div class="two-column">
<div class="form-group">
    <label for="guardian_place_work">مكان عمل ولي الامر</label>
    <input type="text" id="guardian_place_work" name="guardian_place_work" >
</div>

<div class="form-group">
    <label for="guardian_email">البريد الإلكتروني لولي الامر</label>
    <input type="email" id="guardian_email" name="guardian_email" >
</div>
</div>

        <div class="two-column">
<div class="form-group">
    <label for="identifier_name">اسم المعرف</label>
    <input type="text" id="identifier_name" name="identifier_name">
</div>

<div class="form-group">
    <label for="identifier_phone">رقم المعرف</label>
    <input type="text" id="identifier_phone" name="identifier_phone">
</div>
</div>

<div class="form-group" onchange="notes()">
    <label>هل لديك ملاحظات؟</label>
    <div>
        <input type="radio" id="notes_yes" name="notes" value="yes" >
        <label for="notes_yes">نعم</label>
        <input type="radio" id="notes_no" name="notes" value="no" >
        <label for="notes_no">لا</label>
    </div>
</div>

<div class="form-group" id="text_note_div">
    <label for="text_note">الملاحظات</label>
    <textarea id="text_note" name="text_note"></textarea>
</div>

        <input type="hidden" name="group_id" value="{{$id}}">
        <button type="submit" id="submit-btn">تسجيل</button>
    </form>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">

    $( document ).ready(function() {
        $('#health_condition_type_div').hide();
        $('#text_area').hide();
        $('#selected_area').hide();
        $('#text_note_div').hide();
       
        
    });


    function HealthCondition() {
    var  value = $('input[name="health_condition"]:checked').val();

    if(value == 'yes'){
        $('#health_condition_type_div').show();
    }else{
        $('#health_condition_type_div').hide();
    }
    
    }


    function SelectCity(city) {
     
       if(!city || city.length === 0){
        $('#text_area').hide();
        $('#selected_area').hide();
        //document.getElementById('amman_region').removeAttribute('required');
        //document.getElementById('area').removeAttribute('required');
        $('#amman_region').val(null);
        $('#area').val(null);
       }

       if(city == '1'){
        $('#selected_area').show();
        $('#text_area').hide();
        //document.getElementById('amman_region').setAttribute('required', true);
        //document.getElementById('area').removeAttribute('required');
        $('#area').val(null);
        
       }

       if(city != '1' && city.length != 0){
        $('#selected_area').hide();
        $('#text_area').show();
        //document.getElementById('area').setAttribute('required', true);
        ///document.getElementById('amman_region').removeAttribute('required');
        $('#amman_region').val(null);
        
       }
    }

    function notes() {
    var  value = $('input[name="notes"]:checked').val();

    if(value == 'yes'){
        $('#text_note_div').show();
    }else{
        $('#text_note_div').hide();
    }
    
    }

    function ChooseNationality(nationality) {
        var label = document.getElementById("national_label");
    
        // Check if nationality is 'jordanian', empty, or not a valid number
        if(nationality === 'jordanian' || !nationality || nationality.trim() === '') {
        label.innerHTML = 'الرقم الوطني <span class="required-mark">*</span>';
        } else {
            label.innerHTML = 'الرقم الجواز <span class="required-mark">*</span>';
        }
    }
</script>
