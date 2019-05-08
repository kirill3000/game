<?php  include_once ("func_Conn.php");

?>







<html>
<head>
 <title>Clickhouse мануал</title>
<meta charset="utf-8"> 
<meta name="yandex-verification" content="91981b26bdff965f, Clickhouse мануал , Clickhouse manual , Clickhouse документация, Кликхаус документация" />


<style type="text/css">





#Title
{
 position: absolute; /* Относительное позиционирование */
   background: #f0f0f0;
  width: 1200px; 
    height:80px;
 /*
 transform: translate(-50%, -50%);
  top: 45; 
  left: 50%;
  */
	
}




#Add
{
  text-align: right;	
 position: absolute; /* Относительное позиционирование */
    float: left; /* Совмещение колонок по горизонтали */
    width: 600px; /* Ширина слоя */
    height:320px;
   background: #add8e6;
    color: black; /* Цвет текста */
top: 250px; /* Смещение слоя вниз */
 transform: translate(-50%, -50%);
  position: absolute; 
  left: 50%;
display: none;

	
	
}


#Filter
{
position: absolute; /* Относительное позиционирование */
    float: left; /* Совмещение колонок по горизонтали */
    width: 510px; /* Ширина слоя */
    height:210px;
   background: #add8e6;
    color: black; /* Цвет текста */
top: 200px; /* Смещение слоя вниз */
 transform: translate(-50%, -50%);
  position: absolute; 
  left: 50%;


	<?php  

 ( isset($_POST['Sub_filter']) or isset($_POST['Sub_filter_del']) )?  $Temp = " display: inline;" :  $Temp = "display: none;"  ;
  echo $Temp ;
?>
	

}




#Result
{
 position: absolute; /* Относительное позиционирование */
    height:350px;
  /*  background: #800000; */
    color: white; /* Цвет текста */


	<?php  

 ( isset($_POST['Sub_filter']) or isset($_POST['Sub_filter_del']) ) ?  $Temp = "top: 350px;" :  $Temp = " top: 90px; "  ;
  echo $Temp ;
?>


}


 
	


.table_blur { 
    width: 100%; 
    border-collapse: collapse; 
   /* margin:50px auto;*/
    }
.table_blur tr:nth-of-type(odd) { 
    background: #eee; 
    }
.table_blur th { 
    background: #add8e6; 
    color: black; 
    font-weight: bold; 
	    text-align: center; 
    }
.table_blur td { 
    padding: 10px; 
    border: 1px solid #ccc; 
    text-align: left; 
    font-size: 18px;
    }




</style>



<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter50797789 = new Ya.Metrika2({
                    id:50797789,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/50797789" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

 <meta charset="UTF-8">

 
 
        <script type="text/javascript">


		
		
            function show_Max_Add() {
		  document.getElementById("Result").style.top = "420px";
			document.getElementById("Add").style.display = "inline";
			document.getElementById("Filter").style.display = "none";
           }

            function show_Min_Add() {
                document.getElementById("Result").style.top = "90px";
				document.getElementById("Add").style.display = "none";
           }
		   

		               function show_Max_Filter() {
		  document.getElementById("Result").style.top = "350px";
			document.getElementById("Add").style.display = "none";
			document.getElementById("Filter").style.display = "inline";
           }

            function show_Min_Filter() {
                document.getElementById("Result").style.top = "90px";
				document.getElementById("Filter").style.display = "none";
           }
		   
	   
   

        </script>





</head>
<body>


<?php 


isset($_POST['Sub_filter_del']) ?  $_POST['HTML_Author']="" : $_POST['HTML_Author']  ;
isset($_POST['Sub_filter_del']) ?  $_POST['Sel_types']="" : $_POST['Sel_types']  ;



$Filter = " and 1=1";


( !isset($_POST['Page_Limit']) or isset($_POST['HTML_Sub_filter']) ) ? $_POST['Page_Limit']=1 : $_POST['Page_Limit']  ;

(isset($_POST['HTML_Author']) && $_POST['HTML_Author'] != '')  ? $Filter_Author = " and Author ='".$_POST['HTML_Author']."'"  : $Filter_Author = " and 1=1";
( isset($_POST['Sel_types']) && $_POST['Sel_types'] != '')  ? $Filter_Sel_types = " and Types ='".$_POST['Sel_types']."'"  : $Filter_Sel_types = " and 1=1";





$Limits_min = ($_POST['Page_Limit'] ) * 1 -1;
$Limits_min = ($Limits_min ) * 1000;

$Limits_max = $Limits_min+1000 ;
$Limits = ' LIMIT '.$Limits_min.' , '.$Limits_max.'';
$Desc = ' order by Ro ';


$query = "SELECT Id as Idd, row_number() over ( order by Id desc ) as Ro , cast(Create_Date as date) as  Create_Date, Types, Q,A, Author FROM test where 1=1 ";
$query = $query . $Filter . $Filter_Author  . $Filter_Sel_types  . $Desc . $Limits;
  
$Counter_Page = "SELECT  CEIL(count(*)/1000) as Counter_Page , Max(Id) as Max_Rows  FROM test where 1=1 ";
$Counter_Page = $Counter_Page . $Filter . $Filter_Author  . $Filter_Sel_types   ;

/*
 if ($result = $connect->query($Counter_Page)) {
$row_Counter_Page = mysqli_fetch_array($result);
print $row_Counter_Page["Max_Rows"];
 }

*/



/* Update selected rows  */

$Update_Array_Massive =  ($_POST['submit_UP_HTML'] * 1) - 1;

$UP_HTML_Idd = $_POST['UP_HTML_Idd'][$Update_Array_Massive];
$UP_HTML_Types = '"'.$_POST['UP_HTML_Types'][$Update_Array_Massive].'"';

$Up_Types_query = "update test set Types = " .$UP_HTML_Types." where id = " .$UP_HTML_Idd."";
isset($_POST['submit_UP_HTML']) ? mysqli_query($connect, $Up_Types_query) : ""  ;



/* Select types for filter */

$Q_Types='
select "" as name union all
SELECT distinct Types as name FROM test where 1=1 ';

$X2 =$connect->query($Q_Types);
$Filter_Q_Types =$connect->query($Q_Types);

print'
  
<div id ="Title">

<fieldset>
<legend>
Clickhouse мануал
</legend>';

 if ($result = $connect->query($Counter_Page)) {
$row_Counter_Page = mysqli_fetch_array($result);
print '

<form action="" method="POST" ">
<table>
<tr>	
<th>  
Текущая страница: <input type="number" name="Page_Limit" value='.$_POST['Page_Limit'].' min="1" max=' . $row_Counter_Page["Counter_Page"].' step="1">  из ' . $row_Counter_Page["Counter_Page"].'
	<input type="hidden" name="HTML_Author" value="'.$_POST['HTML_Author'].'">
	<input type="hidden" name="date" value='.$_POST['date'].'>
	<input type="hidden" name="Q" value='.$_POST['Q'].'>
	<input type="hidden" name="A" value='.$_POST['A'].'>
	<input type="hidden" name="A" value='.$_POST['Types'].'>

<input type="submit" name="Submit_HTML_Page_Limit"  value="Выбрать страницу"></form>
<th>  <input type="button" onclick="show_Max_Filter();" value="Добавить фильтры:"/> </th>
<th>  <input type="button" onclick="show_Max_Add();" value="Добавить вопрос:"/> </th>
<th>  <input type="text" id="user" size="50"" value="Вопросы и пожелания на почту: kiril-2012@list.ru"/></th>
</tr>
</table>  

</fieldset>

</div>	
';} 
 print'
<div id="Add">

<form action="Add.php" method="POST">
<fieldset>
<legend>
Здесь можно добавить вопрос и решение по Clickhouse: 
</legend>


Выбрать тип вопроса:
<select name="Sel_types" >
';


while ($row = mysqli_fetch_assoc($Filter_Q_Types))
{
if ($_POST["Sel_types"]	==  $row["name"]) 
{	    echo '<option selected  value='.$row["name"].'>'.$row["name"].'</option>';}
 else 
 {    echo '<option value='.$row["name"].'>'.$row["name"].'</option>';};
	
}
print'       
</select>
 <p>
				
Задать вопрос: <textarea name = "Q" rows="5" cols="50"  ></textarea>  
 <br>
Ответить: <textarea name = "A" rows="5" cols="50"  required></textarea>  
 <br>
Уже есть в FAQ на Githab ? 
	Нет<input type =  "radio" name = "Git" value =  "N" checked>
	Да<input type =  "radio" name = "Git" value =  "Y"> 

<p>
<input type="button" onclick="show_Min_Add();" value="Свернуть"/>
	<input type="submit" name="add" value="Добавить в базу" >

	
			</fieldset>
				</form>		

					
</div>
	
	
<div id="Filter">



<form action="" method="POST">
<fieldset>
<legend>
Здесь можно отфильтровать вопрос и решение по Clickhouse: 
</legend>

<table border="1">
<tr>
<th>Тип</th>
<th> <select name="Sel_types" >
';


while ($row = mysqli_fetch_assoc($X2))
{
if ($_POST["Sel_types"]	==  $row["name"]) 
{	    echo '<option selected  value='.$row["name"].'>'.$row["name"].'</option>';}
 else 
 {    echo '<option value='.$row["name"].'>'.$row["name"].'</option>';};
	
}
print'       
</select></th>



<tr>
<th>Автор</th>
<th> <input type="text" name="HTML_Author" value ="'.$_POST['HTML_Author'].'"></th>


<!--
<tr>
<th Width  = 110>  Дата С: </th>
<th Width  = 110> <input type="date" name="date"></th>
-->


<tr>
<th Width  = 110>Вопрос</th>
<th Width  = 110> <textarea rows="2" cols="45" name="Q"></textarea></th>


<tr>
<th Width  = 110>Ответ</th>
<th Width  = 110> <textarea rows="2" cols="45" name="A"></textarea></th>

</tr>

<input type="hidden" name="Page_Limit" value='.$_POST['Page_Limit'].'>


<tr>
<th Width  = 110>Действие</th>
<th Width  = 110>  
 <input type="button" onclick="show_Min_Filter();" value="Свернуть"/>
 <input type="submit" name="HTML_Sub_filter"  value="Отфильтровать" >
<input type="submit" name="Sub_filter_del"  value="Очистить фильтры" >
 </th></th> </th>


</tr>


</table>  



		</fieldset>
				</form>	


</div>	


';


/* echo $query;*/


	
	

print '	
<div id="Result">
	';





print '<form action="" method="POST">';
print '<table class="table_blur">';
 print '<tr>
<th>&#9998;</th>
<th nowrap>Тип</th>
<!--<th>Дата</th>-->
<th>Автор</th>
<th>Вопрос</th>
<th>Ответ</th>
</tr>';


	
	
	
	if ($result = mysqli_query($connect, $query)) {

    /* извлечение ассоциативного массива */
    while ($row = mysqli_fetch_assoc($result)) {
    print '<tr>';		
/*print '<td>'.$row["Author"][0].'</td>';*/
		print '<td><input type="submit" name="submit_UP_HTML" value ="'.$row["Ro"].'"></td>';
		print '<input type="hidden" name="UP_HTML_Idd[]" value ="'.$row["Idd"].'">';
		print '<td><input type="text" name="UP_HTML_Types[]" value ="'.$row["Types"].'"></td>';
		print '<td>'.$row["Author"].'</td>';
		print '<td>'.$row["Q"].'</td>';
		print '<td>'.$row["A"].'</td>';



	
    print '</tr>';	


    }}


print '</table>';
print '</from>';
mysqli_free_result($result);



/* закрытие соединения */
$connect->close();
  
  
  
		
?>


	
		


</div>

</body>
</html>




