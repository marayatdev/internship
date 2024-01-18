$(document).ready(function(){
    $('#getName').on("keyup", function(){
      var getName = $(this).val();
      $.ajax({
        method:'POST',
        url:'searchajax.php',
        data:{name:getName},
        success:function(response)
        {
             $("#showdata").html(response);
        } 
      });
    });
   });
 
   $(document).ready(function(){
     $('.statusDropdown').change(function(){
         var username = $(this).data('username');
         var newStatus = $(this).val();
 
         // ส่งค่าไปยังไฟล์ php เพื่ออัพเดตในฐานข้อมูล
         $.ajax({
             url: 'update_status.php',
             method: 'POST',
             data: { username: username, newStatus: newStatus },
             success: function(response){
                 // ทำอะไรก็ตามหลังจากอัพเดตฐานข้อมูล
                 console.log(response);
             },
             error: function(error){
                 console.log(error);
             }
         });
     });
 });
 
 
 $(document).ready(function(){
         // โหลดข้อมูลใน dropdown เมื่อหน้าเว็บโหลด
         $.ajax({
             url: 'fetch_data.php',
             type: 'GET',
             dataType: 'json',
             success: function(data) {
                 // เติมข้อมูลใน dropdown
                 $.each(data, function(index, value){
                     $('#year').append($('<option>').text(value.year).attr('value', value.year));
                 });
             }
         });
 
         // กรองข้อมูลเมื่อค่าใน dropdown เปลี่ยน
         $('#year').change(function(){
             var selectedYear = $(this).val();
 
             // โหลดข้อมูลจากฐานข้อมูลโดยใช้ค่าที่เลือกจาก dropdown
             $.ajax({
                 url: 'filter_data.php',
                 type: 'POST',
                 data: {year: selectedYear},
                 dataType: 'html',
                 success: function(data) {
                     $('#showdata').html(data);
                 }
             });
         });
     });
 
     function updateStatus(username, newStatus) {
         $.ajax({
             type: 'POST',
             url: 'update_status.php',
             data: { username: username, newStatus: newStatus },
             success: function(response) {
                 // Update the status in the HTML table without reloading the page
                 $('#status_' + username).text(newStatus);
             },
             error: function(error) {
                 console.log('Error:', error);
             }
         });
     }
 
     // Function to filter data using AJAX
     function filterData(year) {
         $.ajax({
             type: 'POST',
             url: 'filter_data.php',
             data: { year: year },
             success: function(response) {
                 // Update the table with filtered data
                 $('#showdata').html(response);
             },
             error: function(error) {
                 console.log('Error:', error);
             }
         });
     }
 
     function updateStatus(username, newStatus) {
         $.ajax({
             type: 'POST',
             url: 'update_status.php',
             data: { username: username, newStatus: newStatus },
             success: function(response) {
                 // Update the status in the HTML table without reloading the page
                 $('#status_' + username).text(newStatus);
             },
             error: function(error) {
                 console.log('Error:', error);
             }
         });
     }
 
     function filterData(name) {
         $.ajax({
             type: 'POST',
             url: 'searchajax.php',
             data: { name: name },
             success: function(response) {
                 // Update the table with filtered data
                 $('#showdata').html(response);
             },
             error: function(error) {
                 console.log('Error:', error);
             }
         });
     }
 

     function filterStatus(status) {
        $.ajax({
            type: 'POST',
            url: 'filter_status.php',
            data: { status: status },
            success: function(response) {
                // Update the table with filtered data
                $('#showdata').html(response);
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    }

    document.getElementById('reloadButton').addEventListener('click', function() {
        // รอ 3 วินาที (3000 มิลลิวินาที) ก่อนที่จะโหลดหน้าใหม่
        setTimeout(function() {
            location.reload();
        }, 600);
    });
    

    document.addEventListener('DOMContentLoaded', function () {
        const rotateBtn = document.getElementById('reloadButton');
    
        rotateBtn.addEventListener('click', function () {
            // ทำให้หมุน 360 องศาเมื่อคลิก
            rotateBtn.style.transition = 'transform 0.5s ease-in-out';
            rotateBtn.style.transform = `rotate(${(360)}deg)`;
    
            // หลังจาก animation เสร็จสิ้น, สามารถ reset ให้กลับมาเริ่มต้น
            setTimeout(() => {
                rotateBtn.style.transition = 'none';
                rotateBtn.style.transform = 'rotate(0deg)';
            }, 500); // 0.5 วินาทีเท่ากับค่า transition ใน CSS
        });
    });
    