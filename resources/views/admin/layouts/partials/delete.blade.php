<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Function to initialize SweetAlert for delete forms
    function initializeSweetAlert() {
        document.querySelectorAll('.delete-form').forEach(form => {
            // Remove existing event listeners to prevent duplicates
            form.removeEventListener('submit', handleDeleteSubmit);
            // Add new event listener
            form.addEventListener('submit', handleDeleteSubmit);
        });
    }

    // Handle delete form submission
    function handleDeleteSubmit(event) {
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
                let formData = new FormData(event.target);
                let actionUrl = event.target.action;

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
                            event.target.closest('tr').remove(); // إزالة الصف من الجدول
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
    }

    // Initialize on DOM content loaded
    document.addEventListener("DOMContentLoaded", function () {
        initializeSweetAlert();
    });

    // Make the function globally available so it can be called after AJAX updates
    window.initializeSweetAlert = initializeSweetAlert;
</script>