<table class="table table-stripped">
	<thead>
		<th>ID</th>
		<th>Name</th>
		<th>Category name</th>
		<th>Image</th>
		<th>Price</th>
		<th>
			<a href="?ctr=Product&action=AddNew" class="btn btn-xs btn-success">Add new</a>
		</th>
	</thead>
	<tbody>
		<?php
		if(count($products) > 0){
			foreach ($products as $p) {
				?>
				<tr>
					<td><?= $p->id ?></td>
					<td><?= $p->name ?></td>
					<td><?= $p->cate_name ?></td>
					<td><?= $p->image ?></td>
					<td><?= $p->price ?></td>
					<td>
						<a href="?ctr=Product&action=Update&id=<?= $p->id ?>" class="btn btn-xs btn-info">Update</a>
						<button url="?ctr=Product&action=Remove&id=<?= $p->id ?>" class="btn btn-xs btn-danger btn-remove">Remove</button>
					</td>
				</tr>
				<?php
			}
		}
		?>
		
	</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function(){
		HomeIndex.init();
	});
</script>