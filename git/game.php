<?php  include_once ("func_Conn.php");


ini_set('error_reporting', (E_ALL & ~E_NOTICE));
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);




function json_encode_($string) {

  $arrayUtf = array('\u0410', '\u0430', '\u0411', '\u0431', '\u0412', '\u0432', '\u0413', '\u0433', '\u0414', '\u0434', '\u0415', '\u0435', '\u0401', '\u0451', '\u0416', '\u0436', '\u0417', '\u0437', '\u0418', '\u0438', '\u0419', '\u0439', '\u041a', '\u043a', '\u041b', '\u043b', '\u041c', '\u043c', '\u041d', '\u043d', '\u041e', '\u043e', '\u041f', '\u043f', '\u0420', '\u0440', '\u0421', '\u0441', '\u0422', '\u0442', '\u0423', '\u0443', '\u0424', '\u0444', '\u0425', '\u0445', '\u0426', '\u0446', '\u0427', '\u0447', '\u0428', '\u0448', '\u0429', '\u0449', '\u042a', '\u044a', '\u042b', '\u044b', '\u042c', '\u044c', '\u042d', '\u044d', '\u042e', '\u044e', '\u042f', '\u044f');

  $arrayCyr = array('А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е', 'Ё', 'ё', 'Ж', 'ж', 'З', 'з', 'И', 'и', 'Й', 'й', 'К', 'к', 'Л', 'л', 'М', 'м', 'Н', 'н', 'О', 'о', 'П', 'п', 'Р', 'р', 'С', 'с', 'Т', 'т', 'У', 'у', 'Ф', 'ф', 'Х', 'х', 'Ц', 'ц', 'Ч', 'ч', 'Ш', 'ш',  'Щ', 'щ', 'Ъ', 'ъ', 'Ы', 'ы', 'Ь', 'ь', 'Э', 'э', 'Ю', 'ю', 'Я', 'я');

  return str_replace($arrayUtf,$arrayCyr,json_encode($string));
}


?>


<?php 








 $_POST['HTML_Id'] != ''  ? $JS = " and Id ='".$_POST['HTML_Id']."'"  : $JS = "";

$Filter = " and 1=1";

$Filter_Sel_types = " limit 4";
  
$Counter_Page = "SELECT  Id , Text   FROM game where 1=1 ";
$Counter_Page = $Counter_Page . $Filter . $JS . $Filter_Sel_types   ;

  $json_array = array();  
  $Counter_Page = mysqli_query($connect, $Counter_Page); 
           while($row_Counter_Page = mysqli_fetch_assoc($Counter_Page))  
           {  
                $json_array[] = $row_Counter_Page;  
           }  
           /*echo '<pre>';  
           print_r(json_encode($json_array));  
           echo '</pre>';*/  
		/*   echo json_encode($json_array);*/
	
	
	echo json_encode_($json_array);

	
?>



