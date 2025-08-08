<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
     document.querySelectorAll('.delete-form').forEach(form => {
         form.addEventListener('submit', function (event) {
             event.preventDefault(); // منع الإرسال التقليدي
 
             Swal.fire({
                 title: "هل أنت متأكد؟",
                 text: "لن تتمكن من استعادة هذه البيانات بعد الحذف!",
                 icon: "warning",
                 showCancelButton: true,
                 confirmButtonColor: "#d33",
                 cancelButtonColor: "#3085d6",
                 confirmButtonText: "نعم، احذفها!"
             }).then((result) => {
                 if (result.isConfirmed) {
                     let formData = new FormData(form);
                     let actionUrl = form.action;
 
                     fetch(actionUrl, {
                         method: "POST",
                         body: formData,
                         headers: {
                             "X-Requested-With": "XMLHttpRequest" // تأكيد أن الطلب Ajax
                         }
                     })
                     .then(response => response.json())
                     .then(data => {
                         if (data.success) {
                             Swal.fire("تم الحذف!", data.message, "success").then(() => {
                                 form.closest('tr').remove(); // إزالة الصف من الجدول
                             });
                         } else {
                             Swal.fire("خطأ!", data.message, "error");
                         }
                     })
                     .catch(error => {
                         Swal.fire("خطأ!", "حدث خطأ أثناء الحذف", "error");
                     });
                 }
             });
         });
     });
 });
 </script>