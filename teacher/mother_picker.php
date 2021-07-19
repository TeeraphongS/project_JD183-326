<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jquery datepicker  แบบปี พ.ศ. </title>
   <!-- เรียกไลบารี่สร้างปฎิทิน  -->
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://รับเขียนโปรแกรม.net/jquery_datepicker_thai/jquery-ui.js"></script>
  <!-- เรียกไลบารี่สร้างปฎิทิน  -->
  <script>

    function set_cal(ele)//function สร้างตัวเลือกปฎิทิน
    {
      $( ele ).datepicker({
          onSelect:(date_text)=>
          {
            let arr=date_text.split("/");
            let new_date=arr[0]+"/"+arr[1]+"/"+(parseInt(arr[2])+543).toString();
            $(ele).val(new_date);
            $(ele).css("color","");
          },
          beforeShow:()=>{

            if($(ele).val()!="")
            {
              let arr=$(ele).val().split("/");
              let new_date=arr[0]+"/"+arr[1]+"/"+(parseInt(arr[2])-543).toString();
              $(ele).val(new_date);

            }
           
            $(ele).css("color","white");
          },
          onClose:()=>{

              $(ele).css("color","");

              if($(ele).val()!="")
              {

                  let arr=$(ele).val().split("/");
                  if(parseInt(arr[2])<2500)
                  {
                      let new_date=arr[0]+"/"+arr[1]+"/"+(parseInt(arr[2])+543).toString();
                      $(ele).val(new_date);
                  }
              }


          },
          dateFormat:"dd/mm/yy", //กำหนดรูปแบบวันที่เป็น วัน/เดือน/ปี
          changeMonth:true,//กำหนดให้เลือกเดือนได้
          changeYear:true,//กำหนดให้เลือกปีได้
          showOtherMonths:true,//กำหนดให้แสดงวันของเดือนก่อนหน้าได้
          minDate: 0,
          beforeShowDay: noWeekends,
          
      });
      function noWeekends(date) {
            var day = date.getDay();
            // ถ้าวันเป็นวันอาทิตย์ (0) หรือวันเสาร์ (6)
            if (day === 0 || day === 6) {
                // เลือกไม่ได้
                return [false, "", "วันนี้เป็นวันหยุด"];
            }
            // เลือกได้ตามปกติ
            return [true, "", ""];
        }
        $("#datepicker").datepicker({
            beforeShowDay: noWeekends
        });
    

    }
    

  $(document).ready(function(){
    //เรียก function set_cal เมื่อเปิดหน้าเว็บ โดยส่ง object element ที่มี id เป็น datepicker เป็นพารามิเตอร์
    set_cal( $("#datepicker") );

  })

  </script>
</head>
<body>
<!-- input วันที่   -->
<p>วันที่: <input type="text" id="datepicker"></p>


</body>
</html>