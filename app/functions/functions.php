<?php

function update_app(){
	$sql = mysqli_query($link, "SELECT * FROM application WHERE user = '{$_SESSION['auth_id']}' ") or die("Ошибка вывода заявки");
				$row = mysqli_fetch_array($sql);
				
				if (mysqli_num_rows($sql) > 0)
				{
				echo
					'<div class="table__row">
			        <div class="table__column">Номер</div>
			        <div class="table__column">Название</div>
			        <div class="table__column">Автор</div>
			        <div class="table__column">Время</div>
			        <div class="table__column"></div>
					</div>';
					do {
					echo '
					 <div class="table__row">
			        <div class="table__column">'.$row["id_application"].'</div>
			        <div class="table__column">'.$row["title"].'</div>
			        <div class="table__column">'.$_SESSION['auth_name'].'</div>
			        <div class="table__column">00.00.00</div>
			        <div class="table__column table__column--function">
			        	<div class="table__func">
				        	<a href="#">
				        		<svg class="icon">
	                              <use xlink:href="#my-first-icon" />
	                            </svg>
	                        </a>

				        	<a class="delApp" onclick = "return false" href="'.$row["id_application"].'">
				        		<svg class="icon">
                                  <use xlink:href="#my-second-icon" />
                                </svg>
							</a>
			        	</div>
			        </div>
			    </div>';
				}	
					while($row = mysqli_fetch_array($sql));
				}
				else
				{
					echo '<div class="error">Заявок пока нет!</div>';
				}
}


function clear_string($link, $cl_str)
{
$cl_str = @strip_tags($cl_str);
$cl_str = mysqli_real_escape_string($link, $cl_str);
$cl_str = trim($cl_str);
return $cl_str;
}
/* 
function fungenpass(){
$number = 7;
$arr = array('a','b','c','d','e','f',
			 'g','h','i','j','k','l',
			 'm','n','o','p','r','s',
			 't','u','v','x','y','z',
			 '1','2','3','4','5','6',
			 '7','8','9','0');

//Генерируеи пароль
	$pass = "";
	
	for ($i = 0; $i < $number; i++;)
	{
		//Вычисляем случайный индекс массива
		$index = rand(0, count($arr) - 1);
		$pass .= $arr[$index];
	}
	
	return $pass;
}

function send_mail($from, $to, $subject, $body)
{
	$charset = 'utf-8';
	mb_language("ru");
	$headers = "MIME-Version: 1.0 \n";
	$headers .= "From: <".$from."> \n";
	$headers .= "Reply-To: <".$from."> \n";
	$headers .= "Content-Type: text/html; charset=$charset \n";
	
	$subject = '=?'.$charset.'?B?'.base64_encode($subject).'?=';
	
	mail($to,$subject,$body,$headers)
} */

?>