<div class="site-table" style="padding-left: 1em;text-align:left; position: relative; left: 0em; right: 0em; background:#FFFFFF;  z-index: 1;">
<div class="table-category" style="padding: 2em;">
<table border="1" width="95%" cellpadding="5">
<thead>
<tr>
<th>Номер</th>
<th>Название товара</th>
<th>Категория товара</th>
<th>Краткое описание</th>
<th>Полное описание</th>
<th>Возможность заказа</th>
<th>Заказать</th>
</tr>
</thead>
<tbody>
<?php
if(!empty($pageData['goods_table'])) {
foreach($pageData['goods_table'] as $key => $value) {

	echo "<tr>";
	echo "<td>" . $value['num'] . "</td>";
	echo "<td>" . $value['name'] . "</td>";
	echo "<td>" ;
	echo "<ul>";

	foreach($pageData['goods_table2'] as $key => $value2) if ($value['name'] == $value2['name']) {
		echo "<li>";

		echo "<form name='myForm' method='post' action='/goods/1'>";
	echo "<input type='submit' name='myForm' value='$value2[nameCat]'>";
echo "</form>";
	echo "</li>";
		}
		echo "</ul>";
		echo "</td>";
	echo "<td>" . $value['short_description'] . "</td>";
	echo "<td>" . $value['full_description'] . "</td>";
	echo "<td>" . $value['disposal'] . "</td>";

	if ($value['disposal'] > 0) {
		echo "<td><button type='submit'>Заказать</button></td>";

	}

		echo "<tr>";
}
} /*else {

	http_response_code(404);
	include('my_404.php');
	die();
}*/

?>
	</tbody>
	</tbody>
 </table>

</div>
</div>
