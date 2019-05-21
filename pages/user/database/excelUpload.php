<?PHP
require('library/php-excel-reader/excel_reader2.php');
require('library/SpreadsheetReader.php');
require('connect.php');

$mysqli = new mysqli($host, $user, $pass, $databasename);

if(isset($_POST['Submit']))
{
    $mimes = ['application/vnd.ms-excel','text/xls','text/xlsx', 'text/csv','application/vnd.oasis.opendocument.spreadsheet'];
    if(in_array($_FILES["file"]["type"],$mimes))
    {
    $uploadFilePath = 'uploads/'.basename($_FILES['file']['name']);

    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);
    $Reader = new SpreadsheetReader($uploadFilePath);

    $totalSheet = count($Reader->sheets());
    echo "You have total ".$totalSheet." sheets".

    $html="<table border='1'>";
    $html.="<tr><th>Title</th><th>Description</th></tr>";

    /* For Loop for all sheets */
    for($i=0;$i<$totalSheet;$i++)
    {
        $Reader->ChangeSheet($i);
        foreach ($Reader as $Row)
        {
            $number = mt_rand(100000, 999999);
            $year = date("Y");
            
            $html.="<tr>";
            $User_Name = "YMM-".$year."-".$number;
            $First_Name = isset($Row[0]) ? $Row[0] : '';
            $Middle_Name = isset($Row[1]) ? $Row[1] : '';
            $Last_Name = isset($Row[2]) ? $Row[2] : '';
            $Gender = isset($Row[3]) ? $Row[3] : '';
            $Address = isset($Row[4]) ? $Row[4] : '';
            $Contact_Number = isset($Row[5]) ? $Row[5] : '';
            $Email = isset($Row[6]) ? $Row[6] : '';
            $Account_Type = isset($Row[7]) ? $Row[7] : '';
            $Account_Status = isset($Row[8]) ? $Row[8] : '';
            $password = isset($Row[9]) ? $Row[9] : '';
            $Area = isset($Row[10]) ? $Row[10] : '';
            $Sector = isset($Row[11]) ? $Row[11] : '';
            $Chapter = isset($Row[12]) ? $Row[12] : '';
            $Member_Since = isset($Row[13]) ? $Row[13] : '';
            $html.="</tr>";

            $query = "insert into `info_user`
            (
            `User_Number`,
            `First_Name`,
            `Middle_Name`,
            `Last_Name`,
            `Gender`,
            `Address`,
            `Contact_Number`,
            `Email`,
            `Account_Type`,
            `Account_Status`,
            `password`,
            `Area`,
            `Sector`,
            `Chapter`,
            `Member_Since`) 
            values(
            '".$User_Name."','".
            $First_Name ."','".
            $Middle_Name."','".
            $Last_Name."','".
            $Gender."','".
            $Address."','".
            $Contact_Number."','".
            $Email."','".
            $Account_Type."','".
            $Account_Status."','".
            $password."','".
            $Area."','".
            $Sector."','".
            $Chapter."','".
            $Member_Since."')";

            $mysqli->query($query);
        }
    }
        $html.="</table>";

        echo "<br />Data Inserted in dababase";
    }else{
        die("<br/>Sorry, File type is not allowed. Only Excel file.");
    }
}
?>