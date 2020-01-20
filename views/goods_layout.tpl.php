<div style="	padding-top: 2em; padding-bottom: 2em;">
	<h3 style="text-align:center">Товары</h3>
	<div class="admin-table" >
	<?php
	echo ($pageData['printDiv']);
	?>
	</div>
	<div class="pagination">
		<?php
		echo $pageData['pagination'];
		?>
		<div class="a_paginationPhp">
<?php echo $pageData['sortButton']; ?>
</div>
	</div>
</div>
