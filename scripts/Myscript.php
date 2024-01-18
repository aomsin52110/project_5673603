<?php

class myDBControl
{
    /*กำหนดตัวแปรเกี่ยวกับการติดต่อฐานข้อมูล*/
    private $host = "localhost";
    private $user = "std63102";
    private $password = "pro63102";
    private $database = "DB5672301_2564";
    private $conn;

    /*ฟังก์ชันหลัก สำหรับกำหนดค่าเริ่มต้นก่อนใช้งาน*/
    function __construct()
    {
        $this->conn = $this->connectDB();
    }

    /*ฟังก์ชัน สำหรับติดต่อฐานข้อมูล*/
    function connectDB()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        return $conn;
    }

    /*ฟังก์ชัน สำหรับสืบค้นข้อมูล รับประโยคคำสั่งผ่าน $query*/
    function Textquery($query)
    {
        $result = mysqli_query($this->conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        /* ส่งผลลัพธ์กลับ */
        if (!empty($resultset)) {
            return $resultset;
        }
    }

    /*ฟังก์ชั่น สำหรับประมวลผลคำสั่ง insert update delete */
    function Execquery($query)
    {
        mysqli_query($this->conn, $query) or die($this->error);
        return true;
    }

    /* สร้างเลขที่ใบคำสั่งซื้อ */
    function GetInvoiceNumber()
    {
        $year = date("Y") + 543;
        $numInvoiceofYear = $this->Textquery("SELECT COUNT(*) AS Cno FROM INVOICE WHERE RIGHT(TRIM(Inv_no),4) = '" . strval($year) . "'");
        $Tnum    =  '0000' . trim(strval($numInvoiceofYear[0]["Cno"] + 1));
        $InvId =  'S' . Substr($Tnum, strlen($Tnum) - 4, 4) . '/' . strval($year);
        return $InvId;
    }

    function GetOrderNumber()
    {
        $year = date("Y") + 543;
        //echo $year;       
        //echo "SELECT COUNT(*) AS Cno FROM `ORDER` WHERE RIGHT(TRIM(Order_no),4) = '" . strval($year) . "'";
        $numOrderofYear = $this->Textquery("SELECT COUNT(*) AS Cno FROM `ORDER` WHERE RIGHT(TRIM(Order_no),4) = '" . strval($year) . "'");        
        if(empty($numOrderofYear))
        {
            $OrdId =  'B0001/' . strval($year);
        } else {
            $Tnum  =  '0000' . trim(strval($numOrderofYear[0]["Cno"] + 1));
            $OrdId =  'B' . Substr($Tnum, strlen($Tnum) - 4, 4) . '/' . strval($year);
        }
        return $OrdId;
    }

}
