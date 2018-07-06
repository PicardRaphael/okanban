<h1 class="mt-3">Mon tableau</h1>

<div class="task-list row">

  <!-- Je m'occupe de boucler sur mes listes -->
  <?php foreach ($array_vars['array_listModel'] as $listModel): ?>

    <div id="listContainer-<?= $listModel->getId(); ?>" class="card connectedSortable">

      <div class="card-header d-flex">

        <!-- Titre affiché de notre liste -->
        <span id="listName-<?= $listModel->getId(); ?>" class="card-name"><?= $listModel->getName(); ?></span>

        <!-- Boutons d'édition de notre liste -->
        <span id="listEditBtn-<?= $listModel->getId(); ?>" data-listid="<?= $listModel->getId(); ?>" class="ml-auto">
            <i class="ml-4 fas fa-edit"></i>
            <i class="ml-1 fas fa-trash-alt"></i>
        </span>

        <!-- Formulaire d'édition de notre liste -->
        <form action="" method="post" class="d-none editListForm" id="editListForm-<?= $listModel->getId(); ?>">
          <div class="input-group">
            <input type="hidden" name="listId" class="inputListId" value="<?= $listModel->getId(); ?>">
            <input type="text" class="form-control" value="<?= $listModel->getName(); ?>" name="listNewName" />
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">OK</button>
            </div>
          </div>
        </form>

      </div>

      <ul class="list-group list-group-flush">

        <!-- Je m'occupe de boucler sur mes cartes -->
        <?php foreach ($array_vars['array_cardModel'] as $cardModel): ?>

          <!--
          Je condition l'affichage de ma carte.
          Celle-ci sera affichée, si et seulement si:
            La valeur "list_id" de ma cardModel
            est égale à la valeur de ma propriété "id" de ma listModel
          -->
          <?php if ($cardModel->getListId() === $listModel->getId()): ?>

            <li class="list-group-item sortableItems"><?= $cardModel->getTitle(); ?></li>

          <?php endif; ?>

        <?php endforeach; ?>

      </ul>
    </div>

  <?php endforeach; ?>

</div>

<div class="row mt-3">

  <form class="form-inline" id="addList">
    <div class="form-group mb-2">
      <input type="text" class="form-control" id="listName" name="listName" placeholder="Nom de la nouvelle liste">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Ajouter une liste</button>
  </form>

</div>