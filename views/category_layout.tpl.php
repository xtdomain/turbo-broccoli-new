<div class="site-table" style="padding-left: 1em;text-align:left; position: relative; left: 0em;   right: 0em; background:#FFFFFF;  z-index: 1;">
	<div align="left" class="table-category" style="position: relative; padding: 2em; width:45%;">
		<h3 style="text-align:center">Категории</h3>
    <table  border="1" width="100%" cellpadding="5">
			<thead>
				<tr>
					<th>Номер</th>
					<th>Название категории</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($pageData['goods_table']))
				{
					foreach($pageData['goods_table'] as $key => $value) {
						echo "<tr>";
						echo "<td>" . $value['num'] . "</td>";
						echo "<td>" . $value['nameCat'] . "</td>";
						echo "<tr>";
					}
				}
				?>
			</tbody>
		</table>
		<div class="Pagination" style="padding-left: 2em; padding: 1em;">
			<?php echo "<i>";
			echo($pageData['pagination']);
			echo "</i>";
			?>
		</div>
	</div>
</div>
