<?php
  use MvcApp\Core\App;
?>

<div  id="titleRow">
  <header class="row">
    <h1 class="columns large-12">Produits de <?php echo $artist; ?></h1>
  </header>
</div>
<div class="row">
	<div class="large-12 columns ">
	<?php if( ! is_null($items->Item)) : ?>
	<table>
	  <thead>
	    <tr>
	      <th width="150" >Artiste</th>
	      <th width="100" >Type</th>
	      <th>Titre</th>
	      <th>Liens</th>
	    </tr>
	  </thead>
	  <tbody>

		<?php foreach ($items->Item as $item) : ?>
			<tr>
		    	<td><?php echo $item->ItemAttributes->Artist; ?></td>
		    	<td><?php echo $item->ItemAttributes->ProductGroup; ?></td>
		    	<td><?php echo $item->ItemAttributes->Title; ?></td>

		    	<td> <a target="_blank" class="button tiny" href="<?php echo $item->DetailPageURL; ?>">Voir le produit</a></td>
    		</tr>
			<?php //var_dump($item); ?>
		<?php endforeach; ?>
	</table>
<?php else :  ?>
	<p class="panel text-center"> Aucun Article</p>
	<?php endif; ?>
	</div>
</div>