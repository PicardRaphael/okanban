<h1 class="mt-3">Mon tableau</h1>

<div class="task-list row">
  <?php 
  foreach($array_vars['array_listModel'] as $listModel):
  ?>
    <div class="card">
      <div class="card-header">
        <?= $listModel->getName()?>
      </div>
      <ul class="list-group list-group-flush">
        <?php 
        foreach($array_vars['array_CardModel'] as $cardModel):
          if( $cardModel->getListId() === $listModel->getId()):
        ?>
            <li class="list-group-item"><?= $cardModel->getTitle()?></li>
        <?php 
          endif;
        endforeach;
        ?> 
      </ul>
    </div>
  <?php endforeach;?> 

</div>
<div class="row mt-3">
  <form class="form-inline" id="addList" action="submit" method="post">
    <div class="form-group mb-2">
      <input class="form-control" type="text" id="listName" name="listName" placeholder="Nom de la nouvelle liste">
    </div>
    <button class="btn btn-success mb-2" type="submit">Ajouter une liste</button>
  </form>
</div>
