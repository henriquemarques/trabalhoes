<div class="row">
  <?php foreach ($products as $product): ?>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <div class="caption">
        <h4><?php echo utf8_encode($product["Product"]["name"]);?></h4>
        <p><strong>Preço:</strong> R$ <?php echo $product["Product"]["price"];?></p>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>