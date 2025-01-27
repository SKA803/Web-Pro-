<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name"; // تأكد من تغيير اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استلام البيانات من النموذج
$siteName = $_POST['site-name'];
$siteDescription = $_POST['site-description'];
$siteLink = $_POST['site-link'];
$category = $_POST['existing-category'] ? $_POST['existing-category'] : $_POST['new-category'];
$siteIcon = $_FILES['site-icon'];

// رفع الصورة
$iconPath = "uploads/" . basename($siteIcon["name"]);
move_uploaded_file($siteIcon["tmp_name"], $iconPath);

// إدخال البيانات في قاعدة البيانات
$sql = "INSERT INTO sites (name, description, link, category, icon) 
        VALUES ('$siteName', '$siteDescription', '$siteLink', '$category', '$iconPath')";

if ($conn->query($sql) === TRUE) {
    echo "تم حفظ البيانات بنجاح!";
} else {
    echo "خطأ: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>