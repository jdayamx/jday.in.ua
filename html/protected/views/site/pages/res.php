<html>
<style>
html, body {	font-family:arial;
}
.content {	width:960px;
/*	background:#eee;*/
	margin: 0 auto;
	padding:5px;}
table {	border-collapse:collapse;
	width:100%;}
table .info {	text-align:right;
	padding-right:10px;
	font-weight:bold;}
h1,h2,ul {	margin:1px;}
h2 {	color:#555;}
</style>
<?php
$this->layout = 'balnk';
?>
<body>
	<div class="content">
		<h1>Дмитренко Николай Николаевич<small style="float:right;">v.1.0</small></h1>
		<h2>Личные данные</h2>
		<table border=1>
			<tr>
				<td width="200" class="info">Год рождения:</td><td>11 января 1983г.</td>
			</tr>
			<tr>
				<td width="200" class="info">рост/вес:</td><td>183 см/93 кг</td>
			</tr>
			<tr>
				<td width="200" class="info">Адрес проживания:</td><td>Украина г. Киев, 02121, ул.Вербитского 14-В, кв.154</td>
			</tr>
			<tr>
				<td width="200" class="info">Телефон:</td><td>моб. (068) 373-24-31, дом. (044) 563-52-86</td>
			</tr>
			<tr>
				<td width="200" class="info">Семейное положение:</td><td>Женат, есть дочь</td>
			</tr>
		</table>
		<h2>Образование, работа, другое</h2>
		<table border=1>
			<tr>
				<td width="200" class="info">1990-2000г.</td>
				<td>Средняя Школа №266</td>
				<td>участвовал в городской олимпиаде по информатике (<b>3</b> место за графический редактор на "Turbo Pascal")</td>
			</tr>
			<tr>
				<td width="200" class="info">2003-2004г.</td>
				<td>был призван в армию</td>
				<td>Отслужил в г.Харькове (ПВО на должности "Лiнiйний наглядач")</td>
			</tr>
			<tr>
				<td width="200" class="info">2001-2005г.</td>
				<td>Киевский Техникум Электронных Приборов (КТЭП), специальность "Метролог"</td>
				<td>Диплом с изготовлением (занял первое место за "Высокоточный цифровой генератор прямоугольных импульсов с регулировкой частоты" на базе процессора ATMEL)</td>
			</tr>
			<tr valign="top">
				<td width="200" class="info">Дополнительно:</td>
				<td colspan=2>
					<ul>
						<li>курсы английского языка</li>
						<li>курсы информатики</li>
						<li>кружек "Радиолюбитель" (выиграл в конкурсе "Изобретатель" микропередатчик УКВ на SMD)</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td width="200" class="info">2005-2006г.</td>
				<td>Компания "ЦИФРА"</td>
				<td>За время работы получил много полезных знаний и опыта по монтажу серверных стоек и сетевого оборудования</td>
			</tr>
			<tr>
				<td width="200" class="info">2006-2011г.</td>
				<td>Компания "Пролайн ТМ"</td>
				<td>За время работы получил много полезных знаний и опыта в сфере IT</td>
			</tr>
			<tr>
				<td width="200" class="info">с 2011г.</td>
				<td>Компания "Дельта-НЕТ"</td>
				<td>За время работы получил много полезных знаний и опыта в сфере разработки ПО на PHP</td>
			</tr>
		</table>
		<h2>Профессиональные навыки и знания</h2>
		<table border=1>
			<tr>
				<td width="200" class="info">Владение ПК:</td>
				<td>
					OS:
					<ul>
						<li>Windows 95, 98, me, 2000, xp, 2003, Vista, 7, 8</li>
						<li>Linux (средне) CentOS, Ubuntu, Linux MINT, Debian</li>
						<li>FreeBSD (основы)</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td width="200" class="info">Программы Windows:</td>
				<td>
					MS Office, Photoshop, CorelDraw, Paint NET... и многое другое
				</td>
			</tr>
			<tr>
				<td width="200" class="info">Программы UNIX:</td>
				<td>
					<b>Servers:</b><br>Apache, Mysql, DNS, DHCP, IPTables;<br> <b>Gui:</b><br>LibreOffice, OpenOffice
				</td>
			</tr>
			<tr>
				<td width="200" class="info">Разработка ПО (языки):</td>
				<td>
					Delphi 7, html, php, javascript
				</td>
			</tr>
			<tr>
				<td width="200" class="info">Сеть и интернет:</td>
				<td>
					<ul>
						<li>Монтаж сетевого оборудования</li>
						<li>Построение офисных сетей</li>
						<li>Настройка сетевого оборудования (коммутаторы, роутеры)</li>
						<li>Участвовал в построении гермозоны (серверной)</li>
						<li>Опыт в настройке серверов (Web,Игровых) на базе Linux CentOS с 2008г.</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td width="200" class="info">Игры:</td>
				<td>
					<ul>
						<li>Установка и настройка игровых серверов</li>
						<li>Разработка игровых приложений, дополнений, карт</li>
					</ul>
				</td>
			</tr>
		</table>
		<h2>Увлечения</h2>
		<table border=1>
			<tr>
				<td width="200" class="info">Спорт:</td><td>баскетбол, волейбол</td>
			</tr>
			<tr>
				<td width="200" class="info">Творчество:</td><td>рисование, трехмерная графика</td>
			</tr>
			<tr>
				<td width="200" class="info">Другое:</td><td>Изучение структур данных игр</td>
			</tr>
		</table>
		<h2>Личностные характеристики</h2>
		Доброжелательный, отзывчивый, всегда готов помочь коллегам. Все конфликты стараюсь решать мирным путем. Есть способности организатора и управления большим коллективом.<br>
		Люблю изучать всё новое. Если задача интересная подхожу к ее решению с энтузиазмом.
	</div>
</body>
</html>