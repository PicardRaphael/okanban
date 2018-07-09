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
            <i class="ml-4 fas fa-edit editL"></i>
            <i class="ml-1 fas fa-trash-alt deleteL"></i>
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
        <?php 
        $ordering= 0;
        foreach ($array_vars['array_cardModel'] as $cardModel): ?>

          <!--
          Je condition l'affichage de ma carte.
          Celle-ci sera affichée, si et seulement si:
            La valeur "list_id" de ma cardModel
            est égale à la valeur de ma propriété "id" de ma listModel
          -->
          <?php if ($cardModel->getListId() === $listModel->getId()): ?>

            <li data-ordering="<?= $ordering++ ?>" 
            id="cardContainer-<?= $cardModel->getId(); ?>"
            class="list-group-item sortableItems" style="background-color: <?= $cardModel->getColor()?>">
              
             <!-- Titre affiché de notre liste -->
            <span 
              id="editCardTitle-<?= $cardModel->getId(); ?>" class="card-name"><?= $cardModel->getTitle(); ?>
            </span>
              
            <!-- Boutons d'édition de nos post-it --> 
            <span 
              id="cardEditBtn-<?= $cardModel->getId(); ?>" 
              data-cardid="<?= $cardModel->getId(); ?>" 
              class="ml-auto">
                <i class="ml-4 fas fa-edit editC"></i>
                <i class="ml-1 fas fa-trash-alt deletC"></i>
                <i class="ml-1 fas fa-palette"></i>
            </span>
            <!-- Formulaire d'edit couleur -->
            <form 
              class="editColorCard d-none"
              method="post"
              id="editColorCard-<?= $cardModel->getId(); ?>">

              <div class="input-group mb-1">
                <!-- Recup ID Liste -->
                <input type="hidden" name="cardId" class="inputCardId" value="<?= $cardModel->getId(); ?>">

                <!-- Recup Couleur  -->
                <input type="text" name="color" class="inputColorCard" placeholder="Entrer une couleur">
              </div>

              <button class="btn btn-outline-secondary" type="submit">ok</button>              
            </form>

            <!-- Formulaire d'edit d'une post-it -->
            <form 
              action="" 
              method="post" 
              class="editCard d-none" 
              id="editCard-<?= $cardModel->getId(); ?>">
              
              <div class="input-group mb-1">
                <!-- Recup ID Card -->
                <input type="hidden" name="cardId" class="inputCardId" value="<?= $cardModel->getId(); ?>">

                <!-- Recup Title -->
                <input 
                  type="text" 
                  class="form-control" 
                  name="cardNewTitle" 
                  value="<?= $cardModel->getTitle(); ?>" />
              </div>

              <button class="btn btn-outline-secondary" type="submit">ok</button>

            </form>
            
            </li>

          <?php endif; ?>

        <?php endforeach; ?>

        <div class="card-footer">
          <span 
            id="cardAddtBtn-<?= $listModel->getId(); ?>" data-listid="<?= $listModel->getId(); ?>" 
            class="ml-auto addCardBtn">
            <i class="fas fa-plus-circle mb-2">
               Ajouter une carte
            </i>
          </span>
          <!-- Formulaire d'ajout d'une post-it -->
          <form 
            action="" 
            method="post" 
            class="addCard d-none" 
            id="addCard-<?= $listModel->getId(); ?>">
            
            <div class="input-group mb-1">
              <!-- Recup ID Liste -->
              <input type="hidden" name="listId" class="inputListId" value="<?= $listModel->getId(); ?>">

              <!-- Recup Ordering  -->
              <input type="hidden" name="ordering" class="inputListId" value="<?= $ordering ?>">

              <!-- Recup Title -->
              <input 
                type="text" 
                class="form-control" 
                name="cardTitle" 
                placeholder="Ajouter une carte"/>
            </div>

            <button class="btn btn-outline-secondary" type="submit">Ajouter</button>

          </form>
        </div>

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
