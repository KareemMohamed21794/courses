<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{@$title}}</title>
    <link href="{{ asset('demo1/dist/assets/plugins/custom/styles.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap');

    body {
        font-family: "IBM Plex Sans Arabic", serif;
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
        font-size: 16px;
    }

    .form-group label .required-mark {
        color: red;
        margin-right: 0px;
        font-size: 10px;
        top: -2px;
        position: relative;
    }
    
    .form-group input[type="radio"] {
        width: auto;
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
        font-family: "IBM Plex Sans Arabic", serif;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        height: 42px;
        text-align: right;
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
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-family: "IBM Plex Sans Arabic", serif;
    }

    button[type="submit"]:hover {
        background-color: #218838;
    }
    
    .custom-alert {
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #28a745, #218838); /* Elegant gradient */
        color: white;
        font-weight: bold;
        font-size: 18px;
        font-family: "IBM Plex Sans Arabic", serif;
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
    
    .healthCondition div label,
    .notes div label {
        margin-bottom: 0;
        margin-right: 2px;
    }
    </style>
</head>


<body>
  
        <form class="scout-form" action="{{url('update_student_registration/')}}/{{$StudentRegistration->id}}" method="post" enctype="multipart/form-data">
            @csrf 
            @method('PUT') 

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
           <p style="text-align: center;font-weight:bold;font-size:18px;font-family: 'Cairo'">{{@$title}}</p>
        </div>

        <div class="form-group">
            <label for="first_name">المجموعة الكشفية</label>
            <input type="text" id="first_name" name="first_name" value="{{@$StudentRegistration->Admin->group_name}}" readonly>
        </div>

        <div class="two-column">
            <div class="form-group">
                <label for="first_name">الاسم الأول <span class="required-mark">*</span></label>
                <input type="text" id="first_name" name="first_name" required value="{{@$StudentRegistration->first_name}}">
            </div>
            <div class="form-group">
                <label for="father_name">اسم الأب <span class="required-mark">*</span></label>
                <input type="text" id="father_name" name="father_name" required value="{{@$StudentRegistration->father_name}}">
            </div>
</div>
                    <div class="two-column">
            <div class="form-group">
                <label for="grandfather_name">اسم الجد <span class="required-mark">*</span></label>
                <input type="text" id="grandfather_name" name="grandfather_name" required value="{{@$StudentRegistration->grandfather_name}}">
            </div>
            <div class="form-group">
                <label for="family_name">اسم العائلة <span class="required-mark">*</span></label>
                <input type="text" id="family_name" name="family_name" required value="{{@$StudentRegistration->family_name}}">
            </div>
        </div>
</div>
        <div class="two-column">
                        <div class="form-group">
                <label for="birth_place">مكان الولادة <span class="required-mark">*</span></label>
                <input type="text" id="birth_place" name="birth_place" value="{{@$StudentRegistration->birth_place}}">
            </div>
            <div class="form-group">
                <label for="birth_date">تاريخ الولادة <span class="required-mark">*</span></label>
                <input type="date" id="birth_date" name="birth_date" value="{{date('Y-m-d',strtotime(@$StudentRegistration->birth_date))}}">
            </div>
        </div>

                <div class="two-column">
<div class="form-group">
    <label for="nationality">الجنسية <span class="required-mark">*</span></label>
    <select onchange="ChooseNationality(this.value)" id="nationality" name="nationality" required>
        <option value="">اختر..</option>
        <option value="jordanian" {{@$StudentRegistration->nationality == 'jordanian' ? 'selected' : ''}}>أردني</option>
        <option value="emirati" {{@$StudentRegistration->nationality == 'emirati' ? 'selected' : ''}}>إماراتي</option>
        <option value="bahraini" {{@$StudentRegistration->nationality == 'bahraini' ? 'selected' : ''}}>بحريني</option>
        <option value="tunisian" {{@$StudentRegistration->nationality == 'tunisian' ? 'selected' : ''}}>تونسي</option>
        <option value="algerian" {{@$StudentRegistration->nationality == 'algerian' ? 'selected' : ''}}>جزائري</option>
        <option value="comorian" {{@$StudentRegistration->nationality == 'comorian' ? 'selected' : ''}}>جزر القمر</option>
        <option value="djiboutian" {{@$StudentRegistration->nationality == 'djiboutian' ? 'selected' : ''}}>جيبوتي</option>
        <option value="saudi" {{@$StudentRegistration->nationality == 'saudi' ? 'selected' : ''}}>سعودي</option>
        <option value="sudanian" {{@$StudentRegistration->nationality == 'sudanian' ? 'selected' : ''}}>سوداني</option>
        <option value="syrian" {{@$StudentRegistration->nationality == 'syrian' ? 'selected' : ''}}>سوري</option>
        <option value="somali" {{@$StudentRegistration->nationality == 'somali' ? 'selected' : ''}}>صومالي</option>
        <option value="iraqi" {{@$StudentRegistration->nationality == 'iraqi' ? 'selected' : ''}}>عراقي</option>
        <option value="omanian" {{@$StudentRegistration->nationality == 'omanian' ? 'selected' : ''}}>عماني</option>
        <option value="palestinian" {{@$StudentRegistration->nationality == 'palestinian' ? 'selected' : ''}}>فلسطيني</option>
        <option value="qatari" {{@$StudentRegistration->nationality == 'qatari' ? 'selected' : ''}}>قطري</option>
        <option value="kuwaitian" {{@$StudentRegistration->nationality == 'kuwaitian' ? 'selected' : ''}}>كويتي</option>
        <option value="lebanese" {{@$StudentRegistration->nationality == 'lebanese' ? 'selected' : ''}}>لبناني</option>
        <option value="libyan" {{@$StudentRegistration->nationality == 'libyan' ? 'selected' : ''}}>ليبي</option>
        <option value="egyptian" {{@$StudentRegistration->nationality == 'egyptian' ? 'selected' : ''}}>مصري</option>
        <option value="moroccan" {{@$StudentRegistration->nationality == 'moroccan' ? 'selected' : ''}}>مغربي</option>
        <option value="mauritanian" {{@$StudentRegistration->nationality == 'mauritanian' ? 'selected' : ''}}>موريتاني</option>
        <option value="yemeni" {{@$StudentRegistration->nationality == 'yemeni' ? 'selected' : ''}}>يمني</option>
        <option value="american" {{@$StudentRegistration->nationality == 'american' ? 'selected' : ''}}>أمريكي</option>
        <option value="british" {{@$StudentRegistration->nationality == 'british' ? 'selected' : ''}}>بريطاني</option>
        <option value="french" {{@$StudentRegistration->nationality == 'french' ? 'selected' : ''}}>فرنسي</option>
        <option value="german" {{@$StudentRegistration->nationality == 'german' ? 'selected' : ''}}>ألماني</option>
        <option value="canadian" {{@$StudentRegistration->nationality == 'canadian' ? 'selected' : ''}}>كندي</option>
        <option value="australian" {{@$StudentRegistration->nationality == 'australian' ? 'selected' : ''}}>أسترالي</option>
        <option value="chinese" {{@$StudentRegistration->nationality == 'chinese' ? 'selected' : ''}}>صيني</option>
        <option value="indian" {{@$StudentRegistration->nationality == 'indian' ? 'selected' : ''}}>هندي</option>
        <option value="japanese" {{@$StudentRegistration->nationality == 'japanese' ? 'selected' : ''}}>ياباني</option>
        <option value="south_african" {{@$StudentRegistration->nationality == 'south_african' ? 'selected' : ''}}>جنوب أفريقي</option>
        <option value="brazilian" {{@$StudentRegistration->nationality == 'brazilian' ? 'selected' : ''}}>برازيلي</option>
        <option value="russian" {{@$StudentRegistration->nationality == 'russian' ? 'selected' : ''}}>روسي</option>
        <option value="italian" {{@$StudentRegistration->nationality == 'italian' ? 'selected' : ''}}>إيطالي</option>
        <option value="spanish" {{@$StudentRegistration->nationality == 'spanish' ? 'selected' : ''}}>إسباني</option>
        <option value="portuguese" {{@$StudentRegistration->nationality == 'portuguese' ? 'selected' : ''}}>برتغالي</option>
        <option value="swedish" {{@$StudentRegistration->nationality == 'swedish' ? 'selected' : ''}}>سويدي</option>
        <option value="norwegian" {{@$StudentRegistration->nationality == 'norwegian' ? 'selected' : ''}}>نرويجي</option>
        <option value="dutch" {{@$StudentRegistration->nationality == 'dutch' ? 'selected' : ''}}>هولندي</option>
        <option value="greek" {{@$StudentRegistration->nationality == 'greek' ? 'selected' : ''}}>يوناني</option>
        <option value="turkish" {{@$StudentRegistration->nationality == 'turkish' ? 'selected' : ''}}>تركي</option>
        <option value="pakistani" {{@$StudentRegistration->nationality == 'pakistani' ? 'selected' : ''}}>باكستاني</option>
        <option value="afghan" {{@$StudentRegistration->nationality == 'afghan' ? 'selected' : ''}}>أفغاني</option>
        <option value="iranian" {{@$StudentRegistration->nationality == 'iranian' ? 'selected' : ''}}>إيراني</option>
        <option value="malaysian" {{@$StudentRegistration->nationality == 'malaysian' ? 'selected' : ''}}>ماليزي</option>
        <option value="singaporean" {{@$StudentRegistration->nationality == 'singaporean' ? 'selected' : ''}}>سنغافوري</option>
        <option value="vietnamese" {{@$StudentRegistration->nationality == 'vietnamese' ? 'selected' : ''}}>فيتنامي</option>
        <option value="thai" {{@$StudentRegistration->nationality == 'thai' ? 'selected' : ''}}>تايلاندي</option>
        <option value="indonesian" {{@$StudentRegistration->nationality == 'indonesian' ? 'selected' : ''}}>إندونيسي</option>
        <option value="mexican" {{@$StudentRegistration->nationality == 'mexican' ? 'selected' : ''}}>مكسيكي</option>
        <option value="colombian" {{@$StudentRegistration->nationality == 'colombian' ? 'selected' : ''}}>كولومبي</option>
        <option value="chilean" {{@$StudentRegistration->nationality == 'chilean' ? 'selected' : ''}}>تشيلي</option>
        <option value="argentinian" {{@$StudentRegistration->nationality == 'argentinian' ? 'selected' : ''}}>أرجنتيني</option>
        <option value="peruvian" {{@$StudentRegistration->nationality == 'peruvian' ? 'selected' : ''}}>بيروفي</option>
    </select>
</div>
            <div class="form-group">
                <label for="national_id" id="national_label">الرقم الوطني <span class="required-mark">*</span></label>
                <input type="text" id="national_id" name="national_id" required value="{{@$StudentRegistration->national_id}}">
            </div>
        </div>

        <div class="two-column">
            <div class="form-group">
                <label for="mobile_number">رقم الهاتف  <span class="required-mark">*</span></label>
                <input type="text" id="mobile_number" name="mobile_number" value="{{@$StudentRegistration->mobile_number}}">
            </div>
            <div class="form-group">
                <label for="home_number">رقم المنزل</label>
                <input type="text" id="home_number" name="home_number" value="{{@$StudentRegistration->home_number}}">
            </div>
        </div>



        <div class="two-column">
            <div class="form-group">
<label for="education_level">المؤهل العلمي  </label>
<select id="education_level" name="education_level" >
    <option value="">اختر..</option>
    <option value="primary_school" {{@$StudentRegistration->education_level == 'primary_school' ? 'selected' : ''}}>ابتدائي</option>
    <option value="middle_school" {{@$StudentRegistration->education_level == 'middle_school' ? 'selected' : ''}}>إعدادي</option>
    <option value="high_school" {{@$StudentRegistration->education_level == 'high_school' ? 'selected' : ''}}>ثانوية عامة</option>
    <option value="diploma" {{@$StudentRegistration->education_level == 'diploma' ? 'selected' : ''}}>دبلوم</option>
    <option value="bachelor" {{@$StudentRegistration->education_level == 'bachelor' ? 'selected' : ''}}>بكالوريوس</option>
    <option value="master" {{@$StudentRegistration->education_level == 'master' ? 'selected' : ''}}>ماجستير</option>
    <option value="phd" {{@$StudentRegistration->education_level == 'phd' ? 'selected' : ''}}>دكتوراه</option>
</select>
</div>
<div class="form-group">
    <label for="parents_status">الحالة بين الأبوين</label>
    <select id="parents_status" name="parents_status" >
        <option value="">اختر..</option>
        <option value="married" {{@$StudentRegistration->parents_status == 'married' ? 'selected' : ''}}>متزوج</option>
        <option value="divorced" {{@$StudentRegistration->parents_status == 'divorced' ? 'selected' : ''}}>مطلق</option>
        <option value="separated" {{@$StudentRegistration->parents_status == 'separated' ? 'selected' : ''}}>منفصل</option>
        <option value="widowed" {{@$StudentRegistration->parents_status == 'widowed' ? 'selected' : ''}}>أرمل/أرملة</option>
    </select>
</div>
</div>

<div class="form-group">
    <label for="blood_type">نوع الدم</label>
    <select id="blood_type" name="blood_type" >
        <option value="">اختر..</option>
        <option value="A+" {{@$StudentRegistration->blood_type == 'A+' ? 'selected' : ''}}>A+</option>
        <option value="A-" {{@$StudentRegistration->blood_type == 'A-' ? 'selected' : ''}}>A-</option>
        <option value="B+" {{@$StudentRegistration->blood_type == 'B+' ? 'selected' : ''}}>B+</option>
        <option value="B-" {{@$StudentRegistration->blood_type == 'B-' ? 'selected' : ''}}>B-</option>
        <option value="AB+" {{@$StudentRegistration->blood_type == 'AB+' ? 'selected' : ''}}>AB+</option>
        <option value="AB-" {{@$StudentRegistration->blood_type == 'AB-' ? 'selected' : ''}}>AB-</option>
        <option value="O+" {{@$StudentRegistration->blood_type == 'O+' ? 'selected' : ''}}>O+</option>
        <option value="O-" {{@$StudentRegistration->blood_type == 'O-' ? 'selected' : ''}}>O-</option>
    </select>
</div>

<div class="form-group">
    <label for="hobbies">الهوايات</label>
    <textarea id="hobbies" name="hobbies" ></textarea>
</div>
<div class="form-group">
    <label>هل لديك أي أمراض مزمنة أو ظروف صحية بحاجة إلى رعاية؟</label>
    <div onchange="HealthCondition()">
        <input type="radio" id="health_yes" name="health_condition" value="yes" {{@$StudentRegistration->health_condition == 'yes' ? 'checked' : ''}}>
        <label for="health_yes">نعم</label>
        <input type="radio" id="health_no" name="health_condition" value="no" {{@$StudentRegistration->health_condition == 'no' ? 'checked' : ''}}>
        <label for="health_no">لا</label>
    </div>
</div>


<div class="form-group" id="health_condition_type_div">
    <label for="health_condition_type">هل يمكنك كتابة ما هي الأمراض مزمنة أو الظروف الصحية التي بحاجة إلى رعاية؟</label>
    <textarea id="health_condition_type" name="health_condition_type">{{@$StudentRegistration->health_condition_type}}</textarea>
</div>

        <div class="two-column">
<div class="form-group">
    <label for="city">المدينة</label>
    <select id="city" name="city" onchange="SelectCity(this.value)" >
        <option value="">اختر..</option>
        <option value="1" {{@$StudentRegistration->city == '1' ? 'selected' : ''}}>عمان</option>
        <option value="2" {{@$StudentRegistration->city == '2' ? 'selected' : ''}}>إربد</option>
        <option value="3" {{@$StudentRegistration->city == '3' ? 'selected' : ''}}>الزرقاء</option>
        <option value="4" {{@$StudentRegistration->city == '4' ? 'selected' : ''}}>العقبة</option>
        <option value="5" {{@$StudentRegistration->city == '5' ? 'selected' : ''}}>مأدبا</option>
        <option value="6" {{@$StudentRegistration->city == '6' ? 'selected' : ''}}>الكرك</option>
        <option value="7" {{@$StudentRegistration->city == '7' ? 'selected' : ''}}>جرش</option>
        <option value="8" {{@$StudentRegistration->city == '8' ? 'selected' : ''}}>عجلون</option>
        <option value="9" {{@$StudentRegistration->city == '9' ? 'selected' : ''}}>المفرق</option>
        <option value="10" {{@$StudentRegistration->city == '10' ? 'selected' : ''}}>الطفيلة</option>
        <option value="11" {{@$StudentRegistration->city == '11' ? 'selected' : ''}}>معان</option>
        <option value="12" {{@$StudentRegistration->city == '12' ? 'selected' : ''}}>البلقاء</option>
    </select>
</div>

<div class="form-group" id="selected_area">
    <label for="amman_region">المنطقة</label>
    <select id="amman_region" name="amman_region" class="form-control">
        <option value="">اختر..</option>
         <option value="أبو نصير" {{@$StudentRegistration->area == 'أبو نصير' ? 'selected' : ''}}>أبو نصير</option>

            <option value="شفا بدران" {{@$StudentRegistration->area == 'شفا بدران' ? 'selected' : ''}}>
            شفا بدران</option>

           <option value="الجبيهة" {{@$StudentRegistration->area == 'الجبيهة' ? 'selected' : ''}}>
            الجبيهة</option>

            <option value="طارق" {{@$StudentRegistration->area == 'طارق' ? 'selected' : ''}}>
            طارق</option>

            <option value=" ماركا" {{@$StudentRegistration->area == 'ماركا' ? 'selected' : ''}}>
            ماركا</option>

            <option value="بسمان" {{@$StudentRegistration->area == 'بسمان' ? 'selected' : ''}}>
            بسمان</option>

            <option value="العبدلي" {{@$StudentRegistration->area == 'العبدلي' ? 'selected' : ''}}>
            العبدلي</option>

            <option value="تلاع العلي وأم السماق وخلدا" {{@$StudentRegistration->area == 'تلاع العلي وأم السماق وخلدا' ? 'selected' : ''}}>
            تلاع العلي وأم السماق وخلدا</option>

            <option value="صويلح" {{@$StudentRegistration->area == 'صويلح' ? 'selected' : ''}}>
            صويلح</option>

            <option value="المدينة" {{@$StudentRegistration->area == 'المدينة' ? 'selected' : ''}}>
            المدينة</option>

            <option value="النصر" {{@$StudentRegistration->area == 'النصر' ? 'selected' : ''}}>
            النصر</option>

            <option value="اليرموك" {{@$StudentRegistration->area == 'اليرموك' ? 'selected' : ''}}>
            اليرموك</option>

            <option value="زهران" {{@$StudentRegistration->area == 'زهران' ? 'selected' : ''}}>
            زهران</option>

            <option value="وادي السير" {{@$StudentRegistration->area == 'وادي السير' ? 'selected' : ''}}>
            وادي السير</option>

            <option value="بدر الجديدة" {{@$StudentRegistration->area == 'بدر الجديدة' ? 'selected' : ''}}>
            بدر الجديدة</option>

            <option value="مرج الحمام" {{@$StudentRegistration->area == 'مرج الحمام' ? 'selected' : ''}}>
            مرج الحمام</option>

            <option value="بدر" {{@$StudentRegistration->area == 'بدر' ? 'selected' : ''}}>
            بدر</option>

            <option value="راس العين" {{@$StudentRegistration->area == 'راس العين' ? 'selected' : ''}}>
            راس العين</option>

            <option value="القويسمة وأبو علندا والجويدة و الرقيم" {{@$StudentRegistration->area == 'القويسمة وأبو علندا والجويدة و الرقيم' ? 'selected' : ''}}>
            القويسمة وأبو علندا والجويدة و الرقيم </option>

            <option value="أم قصير " {{@$StudentRegistration->area == 'أم قصير ' ? 'selected' : ''}}>
            أم قصير والمقابلين والبنيات</option>

            <option value="خريبة السوق" {{@$StudentRegistration->area == 'خريبة السوق' ? 'selected' : ''}}>
            خريبة السوق وجاوا واليادودة</option>

            <option value="احد" {{@$StudentRegistration->area == 'احد' ? 'selected' : ''}}>
            احد </option>

    </select>
</div>

<div class="form-group" id="text_area">
    <label for="area">المنطقة</label>
    <input type="text" id="area" name="area" value="{{@$StudentRegistration->area}}"></input>
</div>
</div>

<div class="form-group">
    <label for="street">اسم الشارع</label>
    <input type="text" id="street" name="street" value="{{@$StudentRegistration->street}}">
</div>
        <div class="two-column">

<div class="form-group">
    <label for="nearest_teacher">أقرب معلم</label>
    <input type="text" id="nearest_teacher" name="nearest_teacher" value="{{@$StudentRegistration->nearest_teacher}}">
</div>

<div class="form-group">
    <label for="building_number">رقم البناء</label>
    <input type="text" id="building_number" name="building_number" value="{{@$StudentRegistration->building_number}}">
</div>
</div>
<div class="form-group">
    <label for="division">الفرقة <span class="required-mark">*</span></label>
    <select id="division" name="division" required>
        <option value="">اختر..</option>
        <option value="1" {{@$StudentRegistration->division == '1' ? 'selected' : ''}}>الاشبال/الزهرات</option>
        <option value="2" {{@$StudentRegistration->division == '2' ? 'selected' : ''}}>الكشاف/المرشدات</option>
        <option value="3" {{@$StudentRegistration->division == '3' ? 'selected' : ''}}>المتقدم/المتقدمات</option>
        <option value="4" {{@$StudentRegistration->division == '4' ? 'selected' : ''}}>الجواله/الدليلات</option>
        <option value="5" {{@$StudentRegistration->division == '5' ? 'selected' : ''}}>القادة/القائدات</option>
    </select>
</div>
<div class="form-group">
    <label for="guardian_name">اسم ولي الأمر</label>
    <input type="text" id="guardian_name" name="guardian_name" value="{{@$StudentRegistration->guardian_name}}">
</div>

        <div class="two-column">
<div class="form-group">
    <label for="guardian_phone">رقم  ولي  الأمر 1</label>
    <input type="text" id="guardian_phone" name="guardian_phone" value="{{@$StudentRegistration->guardian_phone}}">
</div>

<div class="form-group">
    <label for="guardian_phone_2">رقم  ولي  الأمر  2</label>
    <input type="text" id="guardian_phone_2" name="guardian_phone_2" value="{{@$StudentRegistration->guardian_phone_2}}">
</div>
</div>

        <div class="two-column">
<div class="form-group">
    <label for="guardian_job">مهنة ولي الأمر</label>
    <input type="text" id="guardian_job" name="guardian_job" value="{{@$StudentRegistration->guardian_job}}">
</div>

<div class="form-group">
    <label for="relative_relation">صلة القرابة</label>
    <input type="text" id="relative_relation" name="relative_relation" value="{{@$StudentRegistration->relative_relation}}">
</div>
</div>

        <div class="two-column">
<div class="form-group">
    <label for="guardian_place_work">مكان عمل ولي الأمر</label>
    <input type="text" id="guardian_place_work" name="guardian_place_work" value="{{@$StudentRegistration->guardian_place_work}}">
</div>

<div class="form-group">
    <label for="guardian_email">البريد الإلكتروني لولي الأمر</label>
    <input type="email" id="guardian_email" name="guardian_email" value="{{@$StudentRegistration->guardian_email}}">
</div>
</div>

        <div class="two-column">
<div class="form-group">
    <label for="identifier_name">اسم المعرف</label>
    <input type="text" id="identifier_name" name="identifier_name" value="{{@$StudentRegistration->identifier_name}}">
</div>

<div class="form-group">
    <label for="identifier_phone">رقم المعرف</label>
    <input type="text" id="identifier_phone" name="identifier_phone" value="{{@$StudentRegistration->identifier_phone}}">
</div>
</div>

<div class="form-group">
    <label>هل لديك ملاحظات؟</label>
    <div onchange="notes()">
        <input type="radio" id="notes_yes" name="notes" value="yes" {{@$StudentRegistration->notes == 'yes' ? 'checked' : ''}} >
        <label for="notes_yes">نعم</label>
        <input type="radio" id="notes_no" name="notes" value="no" {{@$StudentRegistration->notes == 'no' ? 'checked' : ''}}>
        <label for="notes_no">لا</label>
    </div>
</div>


<div class="form-group" id="text_note_div">
    <label for="text_note">الملاحظات</label>
    <textarea id="text_note" name="text_note">{{@$StudentRegistration->text_note}}</textarea>
</div>

        <input type="hidden" name="StudentRegistration_id" value="{{$id}}">
        <button type="submit" id="submit-btn">تعديل</button>
    </form>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">

    $( document ).ready(function() {
        var  value = $('input[name="health_condition"]:checked').val();
        var  value = $('input[name="notes"]:checked').val();
        var  city = $('#city').val();

        var label = document.getElementById("national_label");
        var nationality = $('#nationality').val();
        // Check if nationality is 'jordanian', empty, or not a valid number
        if(nationality === 'jordanian' || !nationality || nationality.trim() === '') {
        label.innerHTML = 'الرقم الوطني <span class="required-mark">*</span>';
        } else {
            label.innerHTML = 'رقم الجواز <span class="required-mark">*</span>';
        }

        if(value == 'yes'){
            $('#health_condition_type_div').show();
        }else{
            $('#health_condition_type_div').hide();
        }

        if(value == 'yes'){
            $('#text_note_div').show();
        }else{
            $('#text_note_div').hide();
        }


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
       
        
    });


    function HealthCondition() {
    var  value = $('input[name="health_condition"]:checked').val();

    if(value == 'yes'){
        $('#health_condition_type_div').show();
    }else{
        $('#health_condition_type_div').hide();
        $('#health_condition_type').val(null);
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
        $('#text_note').val(null);
    }
    
    }

    function ChooseNationality(nationality) {
        var label = document.getElementById("national_label");
    
        // Check if nationality is 'jordanian', empty, or not a valid number
        if(nationality === 'jordanian' || !nationality || nationality.trim() === '') {
        label.innerHTML = 'الرقم الوطني <span class="required-mark">*</span>';
        } else {
            label.innerHTML = ' رقم الجواز <span class="required-mark">*</span>';
        }
    }
</script>
