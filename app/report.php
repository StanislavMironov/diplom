<?php
session_start();
include ("include/header.php");
include ("include/db_connect.php");


if(isset($_GET["performer"]) && @$_GET["status"] == "create"){
	function get_report() {
	include ("include/db_connect.php");
	include ("include/PHPExcel.php");
	$sql = "SELECT * FROM application WHERE performers = '{$_GET["performer"]}' ";
	$result = mysqli_query($link,$sql);

	if(!$result) {
	exit(mysql_error());
	}

	$row = array();
	for($i = 0;$i < mysqli_num_rows($result);$i++) {
	$row[] = mysqli_fetch_assoc($result);
	}

	return $row; 
}
$report_list = get_report();


$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$active_sheet = $objPHPExcel->getActiveSheet();

//Ориентация страницы и  размер листа
$active_sheet->getPageSetup()
 ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$active_sheet->getPageSetup()
 ->SetPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
//Поля документа  
$active_sheet->getPageMargins()->setTop(1);
$active_sheet->getPageMargins()->setRight(0.75);
$active_sheet->getPageMargins()->setLeft(0.75);
$active_sheet->getPageMargins()->setBottom(1);
//Название листа
$active_sheet->setTitle("Отчёт"); 
//Шапа и футер 
$active_sheet->getHeaderFooter()->setOddHeader("&CШапка нашего прайс-листа"); 
$active_sheet->getHeaderFooter()->setOddFooter('&L&B'.$active_sheet->getTitle().'&RСтраница &P из &N');
//Настройки шрифта
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(8);

$active_sheet->getColumnDimension('A')->setWidth(7);
$active_sheet->getColumnDimension('B')->setWidth(10); 
$active_sheet->getColumnDimension('C')->setWidth(10);
$active_sheet->getColumnDimension('D')->setAutoSize(true); 
$active_sheet->getColumnDimension('E')->setAutoSize(true); 
$active_sheet->getColumnDimension('F')->setAutoSize(true); 
$active_sheet->getColumnDimension('G')->setAutoSize(true); 
$active_sheet->getColumnDimension('H')->setAutoSize(true); 
$active_sheet->getColumnDimension('I')->setAutoSize(true); 
$active_sheet->getColumnDimension('J')->setAutoSize(true); 
$active_sheet->getColumnDimension('K')->setAutoSize(true); 
$active_sheet->getColumnDimension('L')->setAutoSize(true); 
$active_sheet->getColumnDimension('M')->setAutoSize(true); 
$active_sheet->getColumnDimension('N')->setAutoSize(true); 


$active_sheet->mergeCells('A1:D1');
$active_sheet->getRowDimension('1')->setRowHeight(40);
$active_sheet->setCellValue('A1','ООО Корпорация Центр');
 
$active_sheet->mergeCells('A2:D2');
$active_sheet->setCellValue('A2','Компьютеры и бытовая техника на любой вкус и цвет');
 
$active_sheet->mergeCells('A4:C4');
$active_sheet->setCellValue('A4','Дата создания отчёта');

//Записываем данные в ячейку
$date = date('d-m-Y');
$active_sheet->setCellValue('D4',$date);
//Устанавливает формат данных в ячейке - дата
$active_sheet->getStyle('D4')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);

//Создаем шапку таблички данных
$active_sheet->setCellValue('A6','№');
$active_sheet->setCellValue('B6','Отдел');
$active_sheet->setCellValue('C6','Диспетчер');
$active_sheet->setCellValue('D6','Название');
$active_sheet->setCellValue('E6','Описание');
$active_sheet->setCellValue('F6','Дата создания');
$active_sheet->setCellValue('G6','Дата создания');
$active_sheet->setCellValue('H6','Инициатор');
$active_sheet->setCellValue('I6','Дата последнего обновления');
$active_sheet->setCellValue('J6','Автор последнего обновления');
$active_sheet->setCellValue('K6','Категория');
$active_sheet->setCellValue('L6','Дата завершения');
$active_sheet->setCellValue('M6','Исполнитель');
$active_sheet->setCellValue('N6','Время выполнения');

//В цикле проходимся по элементам массива и выводим все в соответствующие ячейки
$row_start = 7;
$i = 0;
foreach($report_list as $item) {
$row_next = $row_start + $i;

$active_sheet->setCellValue('A'.$row_next,$item['id_application']);
$active_sheet->setCellValue('B'.$row_next,$item['department']);
$active_sheet->setCellValue('C'.$row_next,$item['manager']);
$active_sheet->setCellValue('D'.$row_next,$item['title']);
$active_sheet->setCellValue('E'.$row_next,$item['description']);
$active_sheet->setCellValue('F'.$row_next,$item['start_date']);
$active_sheet->setCellValue('G'.$row_next,$item['initiator']);
$active_sheet->setCellValue('H'.$row_next,$item['date_last_update']);
 

$active_sheet->setCellValue('I'.$row_next,$item['author_update']);
$active_sheet->setCellValue('J'.$row_next,$item['category']);
$active_sheet->setCellValue('K'.$row_next,$item['deadline']);
$active_sheet->setCellValue('L'.$row_next,$item['date_last_update']);

 
$active_sheet->setCellValue('M'.$row_next,$item['performers']);
$active_sheet->setCellValue('N'.$row_next,$item['spent_time']); 
 
 $i++;
}



//массив стилей
$style_wrap = array(
 //рамки
 'borders'=>array(
 //внешняя рамка
 'outline' => array(
 'style'=>PHPExcel_Style_Border::BORDER_THICK
 ),
 //внутренняя
 'allborders'=>array(
 'style'=>PHPExcel_Style_Border::BORDER_THIN,
 'color' => array(
 'rgb'=>'696969'
 )
 )
 )
);
//применяем массив стилей к ячейкам 
$active_sheet->getStyle('A1:N'.($i+6))->applyFromArray($style_wrap);

$style_header = array(
 //Шрифт
 'font'=>array(
 'bold' => true,
 'name' => 'Times New Roman',
 'size' => 20
 ),
//Выравнивание
 'alignment' => array(
 'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
 'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
 ),
//Заполнение цветом
 'fill' => array(
 'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
 'color'=>array(
 'rgb' => 'CFCFCF'
 )
 )
 
 
);
 
$active_sheet->getStyle('A1:D1')->applyFromArray($style_header);
 
//Стили для слогана компании – вторая строка
$style_slogan = array(
 //шрифт
 'font'=>array(
 'bold' => true,
 'italic' => true,
 'name' => 'Times New Roman',
 'size' => 13,
 'color'=>array(
 'rgb' => '8B8989'
 )
 
 ),
//выравнивание
 'alignment' => array(
 'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
 'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
 ),
//заполнение цветом
 'fill' => array(
 'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
 'color'=>array(
 'rgb' => 'CFCFCF'
 )
 ),
//рамки
 'borders' => array(
 'bottom' => array(
 'style'=>PHPExcel_Style_Border::BORDER_THICK
 )
 
 )
 
 
);
$active_sheet->getStyle('A2:D2')->applyFromArray($style_slogan);
 
//Стили для текта возле даты
$style_tdate = array(
//выравнивание
 'alignment' => array(
 'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_RIGHT,
 ),
//заполнение цветом
 'fill' => array(
 'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
 'color'=>array(
 'rgb' => 'CFCFCF'
 )
 ),
//рамки
 'borders' => array(
 'right' => array(
 'style'=>PHPExcel_Style_Border::BORDER_NONE
 )
 
 )
 
 
);
$active_sheet->getStyle('A4:C4')->applyFromArray($style_tdate);
 
//Стили для даты
$style_date = array(
 //заполнение цветом
 'fill' => array(
 'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
 'color'=>array(
 'rgb' => 'CFCFCF'
 )
 ),
//рамки
 'borders' => array(
 'left' => array(
 'style'=>PHPExcel_Style_Border::BORDER_NONE
 )
 ),
);
$active_sheet->getStyle('D4')->applyFromArray($style_date);
 
//Стили для шапочки прайс-листа
$style_hprice = array(
 //выравнивание
 'alignment' => array(
 'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
 ),
//заполнение цветом
 'fill' => array(
 'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
 'color'=>array(
 'rgb' => 'CFCFCF'
 )
 ),
//Шрифт
 'font'=>array(
 'bold' => true,
 'italic' => true,
 'name' => 'Times New Roman',
 'size' => 10
 ),
);
$active_sheet->getStyle('A6:D6')->applyFromArray($style_hprice);
//стили для данных в таблице прайс-листа
$style_price = array(
 'alignment' => array(
 'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
 )
);
$active_sheet->getStyle('A7:D'.($i+6))->applyFromArray($style_price);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="item_list.xlsx"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;
}



if(@$_GET["status"] == "create")	{				

 
function get_report() {
	include ("include/db_connect.php");
	include ("include/PHPExcel.php");
	$sql = "SELECT * FROM archive";
	$result = mysqli_query($link,$sql);

	if(!$result) {
	exit(mysql_error());
	}

	$row = array();
	for($i = 0;$i < mysqli_num_rows($result);$i++) {
	$row[] = mysqli_fetch_assoc($result);
	}

	return $row; 
}
$report_list = get_report();


$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$active_sheet = $objPHPExcel->getActiveSheet();

//Ориентация страницы и  размер листа
$active_sheet->getPageSetup()
 ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$active_sheet->getPageSetup()
 ->SetPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
//Поля документа  
$active_sheet->getPageMargins()->setTop(1);
$active_sheet->getPageMargins()->setRight(0.75);
$active_sheet->getPageMargins()->setLeft(0.75);
$active_sheet->getPageMargins()->setBottom(1);
//Название листа
$active_sheet->setTitle("Отчёт"); 
//Шапа и футер 
$active_sheet->getHeaderFooter()->setOddHeader("&CШапка нашего прайс-листа"); 
$active_sheet->getHeaderFooter()->setOddFooter('&L&B'.$active_sheet->getTitle().'&RСтраница &P из &N');
//Настройки шрифта
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(8);

$active_sheet->getColumnDimension('A')->setWidth(7);
$active_sheet->getColumnDimension('B')->setWidth(10); 
$active_sheet->getColumnDimension('C')->setWidth(10);
$active_sheet->getColumnDimension('D')->setAutoSize(true); 
$active_sheet->getColumnDimension('E')->setAutoSize(true); 
$active_sheet->getColumnDimension('F')->setAutoSize(true); 
$active_sheet->getColumnDimension('G')->setAutoSize(true); 
$active_sheet->getColumnDimension('H')->setAutoSize(true); 
$active_sheet->getColumnDimension('I')->setAutoSize(true); 
$active_sheet->getColumnDimension('J')->setAutoSize(true); 
$active_sheet->getColumnDimension('K')->setAutoSize(true); 
$active_sheet->getColumnDimension('L')->setAutoSize(true); 
$active_sheet->getColumnDimension('M')->setAutoSize(true); 
$active_sheet->getColumnDimension('N')->setAutoSize(true); 


$active_sheet->mergeCells('A1:D1');
$active_sheet->getRowDimension('1')->setRowHeight(40);
$active_sheet->setCellValue('A1','ООО Корпорация Центр');
 
$active_sheet->mergeCells('A2:D2');
$active_sheet->setCellValue('A2','Компьютеры и бытовая техника на любой вкус и цвет');
 
$active_sheet->mergeCells('A4:C4');
$active_sheet->setCellValue('A4','Дата создания отчёта');

//Записываем данные в ячейку
$date = date('d-m-Y');
$active_sheet->setCellValue('D4',$date);
//Устанавливает формат данных в ячейке - дата
$active_sheet->getStyle('D4')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);

//Создаем шапку таблички данных
$active_sheet->setCellValue('A6','№');
$active_sheet->setCellValue('B6','Отдел');
$active_sheet->setCellValue('C6','Диспетчер');
$active_sheet->setCellValue('D6','Название');
$active_sheet->setCellValue('E6','Описание');
$active_sheet->setCellValue('F6','Дата создания');
$active_sheet->setCellValue('G6','Дата создания');
$active_sheet->setCellValue('H6','Инициатор');
$active_sheet->setCellValue('I6','Дата последнего обновления');
$active_sheet->setCellValue('J6','Автор последнего обновления');
$active_sheet->setCellValue('K6','Категория');
$active_sheet->setCellValue('L6','Дата завершения');
$active_sheet->setCellValue('M6','Исполнитель');
$active_sheet->setCellValue('N6','Время выполнения');

//В цикле проходимся по элементам массива и выводим все в соответствующие ячейки
$row_start = 7;
$i = 0;
foreach($report_list as $item) {
$row_next = $row_start + $i;

$active_sheet->setCellValue('A'.$row_next,$item['id_application']);
$active_sheet->setCellValue('B'.$row_next,$item['department']);
$active_sheet->setCellValue('C'.$row_next,$item['manager']);
$active_sheet->setCellValue('D'.$row_next,$item['title']);
$active_sheet->setCellValue('E'.$row_next,$item['description']);
$active_sheet->setCellValue('F'.$row_next,$item['start_date']);
$active_sheet->setCellValue('G'.$row_next,$item['initiator']);
$active_sheet->setCellValue('H'.$row_next,$item['date_last_update']);
 

$active_sheet->setCellValue('I'.$row_next,$item['author_update']);
$active_sheet->setCellValue('J'.$row_next,$item['category']);
$active_sheet->setCellValue('K'.$row_next,$item['deadline']);
$active_sheet->setCellValue('L'.$row_next,$item['date_last_update']);

 
$active_sheet->setCellValue('M'.$row_next,$item['performers']);
$active_sheet->setCellValue('N'.$row_next,$item['spent_time']); 
 
 $i++;
}



//массив стилей
$style_wrap = array(
 //рамки
 'borders'=>array(
 //внешняя рамка
 'outline' => array(
 'style'=>PHPExcel_Style_Border::BORDER_THICK
 ),
 //внутренняя
 'allborders'=>array(
 'style'=>PHPExcel_Style_Border::BORDER_THIN,
 'color' => array(
 'rgb'=>'696969'
 )
 )
 )
);
//применяем массив стилей к ячейкам 
$active_sheet->getStyle('A1:N'.($i+6))->applyFromArray($style_wrap);

$style_header = array(
 //Шрифт
 'font'=>array(
 'bold' => true,
 'name' => 'Times New Roman',
 'size' => 20
 ),
//Выравнивание
 'alignment' => array(
 'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
 'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
 ),
//Заполнение цветом
 'fill' => array(
 'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
 'color'=>array(
 'rgb' => 'CFCFCF'
 )
 )
 
 
);
 
$active_sheet->getStyle('A1:D1')->applyFromArray($style_header);
 
//Стили для слогана компании – вторая строка
$style_slogan = array(
 //шрифт
 'font'=>array(
 'bold' => true,
 'italic' => true,
 'name' => 'Times New Roman',
 'size' => 13,
 'color'=>array(
 'rgb' => '8B8989'
 )
 
 ),
//выравнивание
 'alignment' => array(
 'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
 'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
 ),
//заполнение цветом
 'fill' => array(
 'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
 'color'=>array(
 'rgb' => 'CFCFCF'
 )
 ),
//рамки
 'borders' => array(
 'bottom' => array(
 'style'=>PHPExcel_Style_Border::BORDER_THICK
 )
 
 )
 
 
);
$active_sheet->getStyle('A2:D2')->applyFromArray($style_slogan);
 
//Стили для текта возле даты
$style_tdate = array(
//выравнивание
 'alignment' => array(
 'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_RIGHT,
 ),
//заполнение цветом
 'fill' => array(
 'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
 'color'=>array(
 'rgb' => 'CFCFCF'
 )
 ),
//рамки
 'borders' => array(
 'right' => array(
 'style'=>PHPExcel_Style_Border::BORDER_NONE
 )
 
 )
 
 
);
$active_sheet->getStyle('A4:C4')->applyFromArray($style_tdate);
 
//Стили для даты
$style_date = array(
 //заполнение цветом
 'fill' => array(
 'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
 'color'=>array(
 'rgb' => 'CFCFCF'
 )
 ),
//рамки
 'borders' => array(
 'left' => array(
 'style'=>PHPExcel_Style_Border::BORDER_NONE
 )
 ),
);
$active_sheet->getStyle('D4')->applyFromArray($style_date);
 
//Стили для шапочки прайс-листа
$style_hprice = array(
 //выравнивание
 'alignment' => array(
 'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
 ),
//заполнение цветом
 'fill' => array(
 'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
 'color'=>array(
 'rgb' => 'CFCFCF'
 )
 ),
//Шрифт
 'font'=>array(
 'bold' => true,
 'italic' => true,
 'name' => 'Times New Roman',
 'size' => 10
 ),
);
$active_sheet->getStyle('A6:D6')->applyFromArray($style_hprice);
//стили для данных в таблице прайс-листа
$style_price = array(
 'alignment' => array(
 'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
 )
);
$active_sheet->getStyle('A7:D'.($i+6))->applyFromArray($style_price);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="item_list.xlsx"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
$objWriter->save('php://output');
exit;
}
?>
<div class="report">
	<div class="report__block">
		<div class="report__title">
			Здесь вы сможете создать отчёт.
		</div>
				
		<div class="report__info">
		<div class="setting__menu">
		<a href="javascript:void(0)" class="setting__link active" id="users">
		Архив
		</a>
		<a href="javascript:void(0)" class="setting__link">
		В работе
		</a>
		<a href="javascript:void(0)" class="setting__link">
		Созданные
		</a>
		</div>
		
		<div class="setting__info show">
		<div class="report__grid">
		<div class="report__item">
			<form>
				<ul>
					<li>
						<label for="date">С: </label>
						<input type="datetime-local" id="lastDate" name="lastDate"/>
					</li>
					<li>
						<label for="date">До: </label>
						<input type="datetime-local" id="lastDate" name="lastDate"/>
					</li>
				</ul>
				<a href="report.php?status=create" id="crReport" class="Btn">Создать</a>
			</form>
		</div>
		<div class="report__item">
		<div>
			За всё время
		</div>
		<a id="crReportsAll" class="report__func Btn">Создать</a>
		</div>
		</div>
		</div>	
		
		
		<div class="setting__info show">
		<div class="report__grid">
		<div class="report__item">
		<div class="center-on-page">
		  <div class="select">
			<select name="sitetime" id="sitetime" onchange="document.getElementById('report').value=value">
			  <option value="" >Выберите исполнителя</option>
			  <?php 
				$sql = mysqli_query($link, "SELECT performers FROM application")or die("Ошибка");
				$row = mysqli_fetch_array($sql);
				$tempPerf = '';
				if(mysqli_num_rows($sql) > 0){
				$i = 0;
					while($row = mysqli_fetch_array($sql)) {
						echo '
							<option value="'.$row["performers"].'" >'.$row["performers"].'</option>
						';
						$i++;
					}
				}
			  ?>
			</select>
		  </div>
		</div>	
		<input type='hidden' id='report' name='report'/>
		<a id="crReport" class="report__func Btn">Создать</a>
		</div>
		<div class="report__item">
		<div>
			Все
		</div>
		<a id="crReportsAll" class="report__func Btn">Создать</a>
		</div>
		</div>
		</div>	
		
		
		<div class="setting__info show">
		<div class="report__grid">
		<div class="report__item">
		<div>
			Все созданные заявки
		</div>
		<a id="crReportsAll" class="report__func Btn">Создать</a>
		</div>
		</div>
		</div>	
		
		
		
		</div>
	</div>
</div>	

<?php
	include ("include/footer.php");
?>
</body>
</html>