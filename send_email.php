<?php
// التحقق من أن الطلب تم عن طريق POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. إعدادات المستقبل (ضع إيميلك هنا)
    $recipient_email = "Hassan.jelo@archtexs.com"; 
    
    // 2. استقبال البيانات من النموذج وتنظيفها (للحماية)
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // 3. التحقق من أن البيانات ليست فارغة
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // في حال وجود خطأ في البيانات
        echo "<script>alert('عذراً، يرجى تعبئة البيانات بشكل صحيح.'); window.history.back();</script>";
        exit;
    }

    // 4. تجهيز موضوع الرسالة ومحتواها
    $subject = "رسالة جديدة من موقعك: $name";
    
    $email_content = "لقد استلمت رسالة جديدة من نموذج الاتصال.\n\n";
    $email_content .= "الاسم: $name\n";
    $email_content .= "البريد الإلكتروني: $email\n\n";
    $email_content .= "الرسالة:\n$message\n";

    // 5. ترويسة الرسالة (Header) لضمان ظهورها بشكل صحيح
    $email_headers = "From: $name <$email>";

    // 6. إرسال الإيميل
    if (mail($recipient_email, $subject, $email_content, $email_headers)) {
        // نجاح الإرسال: إظهار رسالة وتوجيه المستخدم للصفحة الرئيسية
        echo "<script>alert('تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.'); window.location.href='index.html';</script>"; 
        // ملاحظة: قم بتغيير index.html إلى اسم صفحتك الرئيسية إذا كان مختلفاً
    } else {
        // فشل الإرسال
        echo "<script>alert('حدث خطأ أثناء إرسال الرسالة، يرجى المحاولة لاحقاً.'); window.history.back();</script>";
    }

} else {
    // إذا حاول شخص فتح الملف مباشرة بدون تعبئة النموذج
    header("Location: index.html");
    exit;
}
?>