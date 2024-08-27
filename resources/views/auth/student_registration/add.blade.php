<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
     <link href="{{ asset('demo1/dist/assets/plugins/custom/styles.css') }}" rel="stylesheet" type="text/css" />
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<body>
         <form class="scout-form" action="{{ url('admin/student_registration') }}" method="POST" enctype="multipart/form-data">
                        @csrf

        <div class="form-group">
            <label for="first_name">المجموعه الكشفيه</label>
            <input type="text" id="first_name" name="first_name" value="{{$admindetails->group_name}}" readonly>
        </div>

        <div class="form-group">
            <label for="first_name">الاسم الأول</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="father_name">اسم الأب</label>
            <input type="text" id="father_name" name="father_name" required>
        </div>
        <div class="form-group">
            <label for="grandfather_name">اسم الجد</label>
            <input type="text" id="grandfather_name" name="grandfather_name" required>
        </div>
        <div class="form-group">
            <label for="family_name">اسم العائلة</label>
            <input type="text" id="family_name" name="family_name" required>
        </div>
        <div class="form-group">
            <label for="birth_date">تاريخ الولادة</label>
            <input type="date" id="birth_date" name="birth_date" required>
        </div>
        <div class="form-group">
            <label for="birth_place">مكان الولادة</label>
            <input type="text" id="birth_place" name="birth_place" required>
        </div>
        <div class="form-group">
            <label for="mobile_number">رقم الموبايل</label>
            <input type="text" id="mobile_number" name="mobile_number" required>
        </div>

        <div class="form-group">
            <label for="home_number">هاتف المنزل</label>
            <input type="text" id="home_number" name="home_number" required>
        </div>


        <div class="form-group">
            <label for="national_id">الرقم الوطني</label>
            <input type="text" id="national_id" name="national_id" required>
        </div>

        <div class="form-group">
            <label for="nationality">الجنسيه</label>
            <select id="nationality" name="nationality" >
                <option value="">اختر..</option>
               
            </select>
        </div>


        <div class="form-group">
            <label for="parents_status">الحالة بين الأبوين</label>
            <select id="parents_status" name="parents_status" required>
                <option value="">اختر..</option>
                <option value="married">متزوج</option>
                <option value="divorced">مطلق</option>
                <option value="separated">منفصل</option>
            </select>
        </div>
        <div class="form-group">
            <label for="education_level">المؤهل العلمي</label>
            <select id="education_level" name="education_level" required>
                <option value="">اختر..</option>
                <option value="high_school">ثانوية عامة</option>
                <option value="bachelor">بكالوريوس</option>
                <option value="master">ماجستير</option>
            </select>
        </div>
        <div class="form-group">
            <label for="blood_type">نوع الدم</label>
            <select id="blood_type" name="blood_type" required>
                <option value="">اختر..</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>
        </div>
        <div class="form-group">
            <label for="hobbies">الهوايات</label>
            <textarea id="hobbies" name="hobbies" required></textarea>
        </div>
        <div class="form-group">
            <label>هل لديك أي أمراض مزمنة أو ظروف صحية بحاجة إلى رعاية؟</label>
            <div onchange="HealthCondition()">
                <input type="radio" id="health_yes" name="health_condition" value="yes" required>
                <label for="health_yes">نعم</label>
                <input type="radio" id="health_no" name="health_condition" value="no" required>
                <label for="health_no">لا</label>
            </div>
        </div>


        <div class="form-group" id="health_condition_type_div">
            <label for="health_condition_type">نوع  المرض</label>
            <select id="health_condition_type" name="health_condition_type[]" multiple>
                <option value="">اختر..</option>
                <option value="1">سكر</option>
                <option value="2">ضغط</option>
                <option value="3">قلب</option>
                
            </select>
        </div>

        <div class="form-group">
            <label for="city">المدينه</label>
            <select id="city" name="city" onchange="SelectCity(this.value)">
                <option value="">اختر..</option>
                
                <option value="1">عمان</option>
                <option value="2">مصر</option>
                <option value="3">ليبيا</option>
            </select>
        </div>

        <div class="form-group" id="selected_area">
            <label for="area">المنطقه</label>
            <select id="area" name="area" >
                <option value="">اختر..</option>
                
            </select>
        </div>

        <div class="form-group" id="text_area">
            <label for="area">المنطقه</label>
            <textarea id="area" name="area" ></textarea>
        </div>

        <div class="form-group">
            <label for="street">اسم الشارع</label>
            <input type="text" id="street" name="street" required>
        </div>

        <div class="form-group">
            <label for="nearest_teacher">اقرب معلم</label>
            <input type="text" id="nearest_teacher" name="nearest_teacher" required>
        </div>


        <div class="form-group">
            <label for="building_number">رقم البناء</label>
            <input type="text" id="building_number" name="building_number" required>
        </div>

        <div class="form-group">
            <label for="guardian_name">اسم ولي الامر</label>
            <input type="text" id="guardian_name" name="guardian_name" required>
        </div>

        <div class="form-group">
            <label for="division">الفرقه</label>
            <select id="division" name="division" >
                <option value="">اختر..</option>
                
            </select>
        </div>

        <div class="form-group">
            <label for="guardian_phone">رقم  ولي  الامر 1</label>
            <input type="text" id="guardian_phone" name="guardian_phone" required>
        </div>

        <div class="form-group">
            <label for="guardian_phone_2">رقم  ولي  الامر  2</label>
            <input type="text" id="guardian_phone_2" name="guardian_phone_2" required>
        </div>

        <div class="form-group">
            <label for="guardian_job">مهنه ولي الامر</label>
            <input type="text" id="guardian_job" name="guardian_job" required>
        </div>

        <div class="form-group">
            <label for="relative_relation">صله القرابه</label>
            <input type="text" id="relative_relation" name="relative_relation" required>
        </div>


        <div class="form-group">
            <label for="guardian_place_work">مكان عمل ولي الامر</label>
            <input type="text" id="guardian_place_work" name="guardian_place_work" required>
        </div>


        <div class="form-group">
            <label for="guardian_email">ايميل  ولي الامر</label>
            <input type="text" id="guardian_email" name="guardian_email" required>
        </div>


        <div class="form-group">
            <label for="identifier_name">اسم المعرف</label>
            <input type="text" id="identifier_name" name="identifier_name" required>
        </div>



        <div class="form-group">
            <label for="identifier_phone">رقم المعرف</label>
            <input type="text" id="identifier_phone" name="identifier_phone" required>
        </div>


        <div class="form-group" onchange="notes()">
            <label>هل لديك   ملاحظات  ?</label>
            <div>
                <input type="radio" id="notes_yes" name="notes" value="yes" required>
                <label for="notes_yes">نعم</label>
                <input type="radio" id="notes_no" name="notes" value="no" required>
                <label for="notes_no">لا</label>
            </div>
        </div>

        <div class="form-group" id="text_note_div">
            <label for="text_note">الملاحظات</label>
            <textarea id="text_note" name="text_note" ></textarea>
        </div>

        <input type="hidden" name="group_id" value="{{$id}}">
        <button type="submit">تسجيل</button>
    </form>
</body>
</html>

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
       }

       if(city == '1'){
        $('#selected_area').show();
        $('#text_area').hide();
       }

       if(city != '1' && city.length != 0){
        $('#selected_area').hide();
        $('#text_area').show();
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
</script>
