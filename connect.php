<?php
$host = 'localhost'; // ชื่อโฮสต์ของฐานข้อมูล
$db = 'test'; // ชื่อฐานข้อมูล
$user = 'root'; // ชื่อผู้ใช้ฐานข้อมูล
$pass = ''; // รหัสผ่านผู้ใช้ฐานข้อมูล
$charset = 'utf8mb4'; // ชุดอักขระที่ใช้ในฐานข้อมูล

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // แสดงข้อผิดพลาดในรูปแบบ Exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // ดึงข้อมูลในรูปแบบแอสโซซิเอทีฟอาร์เรย์
    PDO::ATTR_EMULATE_PREPARES => false, // ปิดการใช้การจำลองการเตรียมคำสั่ง SQL
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
