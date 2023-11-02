$(document).ready(function() {
   
    $.ajax({
        url: "{{ route('admin.users') }}",
        type: "GET",
        dataType: "json",
        success: function(response) {
            console.log(response); // افحص البيانات المسترجعة للتحقق من صحتها
            // هنا يمكنك استخدام البيانات المُسترجعة لتحديث صفحتك
        },
        error: function(error) {
            console.log(error); // يمكنك التحقق من وجود أخطاء هنا
        }
    });
    
});
