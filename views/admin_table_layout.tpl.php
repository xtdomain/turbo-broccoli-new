<style>
.tables {
width: 4em;
}
.tables2 {
width: 8em;
}
</style>

<div class="site-table" style="padding-left: 1em;text-align:left; position: relative; left: 0em; right: 0em; background:#FFFFFF;  ">
	<div align="left" class="table-category" style="position: relative; padding: 2em; width:95%; ">
		<h3 style="text-align:center">Таблица связей</h3>
		<table  border="1" width="100%" cellpadding="5">








				<thead >
			   	<tr>
			    	<th class='tables'>Номер</th>
						<th class='tables2'>Название категории</th>
			    	<th class='tables2'>Название товара</th>
							<th class='tables'>Активность категории</th>
						<th class='tables'>Активность товара</th>
						<th class='tables'>Краткое описание тов</th>
						<th class='tables'>Полное описание тов</th>
							<th class='tables'>Кол-во на складе</th>
							<th class='tables'>Возможность заказа</th>
						<th class='tables'>Изменить</th>
			   	</tr>
				</thead>
				<tbody>












				<?php
				if(!empty($pageData['goods_table']))
				{
					foreach($pageData['goods_table'] as $key => $value)
					{
				/*		echo "<tr>";
						echo "<td>" . $value['idB'] . "</td>";
						echo "<td>" . $value['id_category'] . "</td>";

						//foreach($pageData['goods_table2'] as $key => $value2) if ($value['name'] == $value2['name']) {
						//	echo "<td><a href='$pageData[onlyTemplate]/table/$value2[num]'>" . $value['name'] . "</a></td>"; /////////////////////////////////проверить на наличие ошибок - несколько категорий в списке товаров
						//}
						echo "<td>" . $value['id_goods'] . "</td>";
						echo "<td>" . $value['activity'] . "</td>";
						echo "<td>" . $value['activityG'] . "</td>";
						echo "<td>" . $value['short_description'] . "</td>";
						echo "<td>" . $value['full_description'] . "</td>";
						echo "<td>" . $value['quantity'] . "</td>";
						echo "<td>" . $value['disposal'] . "</td>";

						echo "<tr>";
					}
				}*/


				echo "<form action='' method='post'>";
				echo "<tr>";
				echo "<td><input name='id' type='text' value='$value[idB]' class='tables'; />" . "</td>";
				echo "<td class='zone'><input name='category' type='text' value='$value[id_category]'class='tables2'; />" . "</td>";
	    	echo "<td><input name='goods' type='text' value='$value[id_goods]' class='tables2'; />" . "</td>";
	      echo "<td ><input name='activity' type='text' value='$value[activity]' class='tables'; />" . "</td>";
		    echo "<td ><input name='activityG' type='text' value='$value[activityG]' class='tables'; />" . "</td>";
	    	echo "<td><textarea name='short_description' type='text'; />" . $value['short_description'] . "</textarea></td>";
	      echo "<td><textarea name='full_description' type='text'; />" . $value['full_description'] . "</textarea></td>";
		    echo "<td ><input name='quantity' type='text' value='$value[quantity]' class='tables';/>" . "</td>";
	      echo "<td><input name='disposal' type='text' value='$value[disposal]'class='tables';/>" . "</td>";
		  	echo "<td><input name='update' type='submit' value='Изменить' /></td>";
				echo "<tr>";
				echo "</form>";

			}

			if(($value == end($pageData['goods_table'])) && ($pageData['pagesNumber'] == Model::$countPage)) {/////////////////////////////////
		echo "<form action='' method='post'>";

						echo "<tr>";
						$one = $value[idB] +1;
				echo "<td><input name='id' type='text' value='$one' style='width: 4em'; />" . "</td>";
				echo "<td><input name='category2' type='text' value=''; />" . "</td>";
				echo "<td><input name='goods2' type='text' value=''; />" . "</td>";
				echo "<td ><input name='activity2' type='text' value='' style='width: 8em'; />" . "</td>";
				echo "<td ><input name='activityG2' type='text' value='' style='width: 8em'; />" . "</td>";
				echo "<td><textarea name='short_description2' type='text'; /></textarea></td>";
				echo "<td><textarea name='full_description2' type='text'; /></textarea></td>";
				echo "<td ><input name='quantity2' type='text' value='' style='width: 10em'; />" . "</td>";
				echo "<td ><input name='disposal2' type='text' value='' style='width: 8em'; />" . "</td>";

				echo "<td><input name='add' type='submit' value='Добавить' style='background: #CCCCFF;' /></td>";
				echo  "</tr>";
					echo "</form>";
			}
}




				 /*else {
	http_response_code(404);
	include('my_404.php');
	die();
}*/
        ?>
      </tbody>
		</table>


		<div class="Pagination" style="padding-left: 2em; padding: 1em;">
			<?php  echo "<i>";
			echo $pageData['pagination'];
			echo "</i>";
			
			?>
		</div>
	</div>
	</div>
