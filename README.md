#ตัวอย่าง ระบบแสดงผลรายงานประจำวัน การสแกนบัตร และการเข้าเรียนของนักศึกษา

## เกี่ยวกับโปรเจคนี้
โปรเจคนี้เป็นการทำระบบ แสดงผลข้อมูล จากฐานข้อมูล เป็นไฟล์ PDF โดยใช้ Library TCPDF เพื่อแสดงผล

## ฟีเจอร์ในโปรเจคนี้ 
- **แสดงผลข้อมูล**: แสดงข้อมูลเอกสารแบบ ไฟล์ PDF ดึงข้อมูลจาก ฐานข้อมูล มาแสดงผลให้ง่ายต่อการอ่าน

## สื่งที่ต้องมี
ตรวจสอบอุปกรณ์ของท่านก่อนว่าได้ทำตามข้อกำหนดต่อไปนี้หรือไม่:
- ติดตั้ง PHP และเว็บเซิร์ฟเวอร์ (เช่น XAMPP,IIS, Apache ฯลฯ) บนเครื่อง
- ตั้งค่าและรัน MySQL เซิร์ฟเวอร์

  
## การติดตั้ง
1. ติดตั้งโปรแกรมรัน WebApplication (XAMPP,IIS, ฯลฯ):
   
   **[XAMPP](https://www.apachefriends.org/download.html)**
2. ติดตั้งโปรแกรมจัดการฐานข้อมูล (Navicat ฯลฯ):

   **[Navicat](https://navicat.com/en/)**
3. ติดตั้งโปรแกรมรัน MySQL (หากลง XAMPP แล้วไม่จำเป็นต้องติดตั้ง):

   **[MySQL](https://www.mysql.com/)**
   
4. ดาวน์โหลดและแตกไฟล์ หรือจะโคลนก็ได้:
   ```bash
   git clone https://github.com/punyjin/Simple-report-student.git

5. ตั้งค่า MySQL ใน Connect.php ให้ตรงกับที่ได้ตั้งค่าไว้:
     ```bash
    $host = 'localhost'; // ชื่อโฮสต์ของฐานข้อมูล
    $db = 'databasename'; // ชื่อฐานข้อมูล
    $user = 'username'; // ชื่อผู้ใช้ฐานข้อมูล
    $pass = 'password'; // รหัสผ่านผู้ใช้ฐานข้อมูล
6. สร้างฐานข้อมูล MySQL 
    ```student_class```:
    ```
    SET NAMES utf8mb4;
    SET FOREIGN_KEY_CHECKS = 0;
    
    DROP TABLE IF EXISTS `students_class`;
    CREATE TABLE `students_class`  (
      `id` int NOT NULL AUTO_INCREMENT,
      `student_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
      `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
      `scan_in_time` time NULL DEFAULT NULL,
      `col1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
      `col2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
      `col3` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
      `col4` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
      `col5` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
      `col6` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
      `col7` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
      `col8` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
      `col9` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
      `col10` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
      `scan_out_time` time NULL DEFAULT NULL,
      `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
      PRIMARY KEY (`id`) USING BTREE
    ) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;
    
    SET FOREIGN_KEY_CHECKS = 1;
    ```
   และ ```teacher_home```:
   ```
    SET NAMES utf8mb4;
    SET FOREIGN_KEY_CHECKS = 0;
    
    DROP TABLE IF EXISTS `teacher_home`;
    CREATE TABLE `teacher_home`  (
      `class_level` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
      `class_teacher` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
      `major` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
      `date_year` int NULL DEFAULT NULL
    ) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;
    
    SET FOREIGN_KEY_CHECKS = 1;
   ```
   

   
