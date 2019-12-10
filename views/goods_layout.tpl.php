<div class="site-table" style="padding-left: 1em;text-align:left; position: relative; left: 0em; right: 0em; background:#FFFFFF;  z-index: 1;">
	<div align="left" class="table-category" style="position: relative; padding: 2em; width:45%; ">
		<h3 style="text-align:center">Товары</h3>
		<table  border="1" width="100%" cellpadding="5">
			<thead>
				<tr>
					<th>Номер</th>
					<th>Название товара</th>
				</tr>
			</thead>
      <tbody>
				<?php
				if(!empty($pageData['goods_table']))
				{
					foreach($pageData['goods_table'] as $key => $value)
					{
						echo "<tr>";
						echo "<td>" . $value['num'] . "</td>";
						foreach($pageData['goods_table2'] as $key => $value2) if ($value['name'] == $value2['name']) {
							echo "<td><a href='$pageData[onlyTemplate]/table/$value2[num]'>" . $value['name'] . "</a></td>"; /////////////////////////////////проверить на наличие ошибок - несколько категорий в списке товаров
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
		</table>
		<div class="Pagination" style="padding-left: 2em; padding: 1em;">
			<?php  echo "<i>";
			for ($i=1; $i<=$pageData['pagesNumber']; $i++) {
				echo "<a href='$pageData[saveUrlBefore]/goods/$i/$pageData[saveUrlAfter]'>$i</a> ";
			}
			echo "</i>";
			?>
		</div>
	</div>
</div>
