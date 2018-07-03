# Functiunalities's List of Okanban with URL :
## Version 1.0
|User Story|Functionality|Url|Controller|Method|
|-|-|-|-|-|
|En tant qu'utilisateur j'ai besoin d'une page d'accueil pour connaître les fonctionnalités proposées et comment cela fonctionne.|Page Index or Accueil|okanban.local/accueil|MainController|home|
|En tant qu'utilisateur je veux pouvoir créer mes listes.|To create a list|okanban.local/list/id-list/create|ListController|create|
|En tant qu'utilisateur je veux pouvoir donner le nom que je veux à mes listes.|To re/name list|okanban.local/list/id-list/edit|ListController|edit|
|En tant qu'utilisateur je veux pouvoir afficher toutes les listes.|To ahow all list|okanban.local/list/all|ListController|findAll|
|En tant qu'utilisateur je veux pouvoir supprimer mes listes.|To delete a list|okanban.local/list/id-list/delete|ListController|delete|
|En tant qu'utilisateur je veux pouvoir mettre des post it (tâches) dans les listes.|To create a task|okanban.local/task/id-task/create|TaskController|create|
|Modifier le contenue et autre différents paramètres de la tache après création.|To edit the task|okanban.local/task/id-task/edit|TaskController|edit|
|En tant qu'utilisateur je veux pouvoir supprimer mes taches.|To delete a task|okanban.local/task/id-task/delete|TaskController|delete|
|En tant qu'utilisateur je souhaite pouvoir noter une durée dédiée a une tache.|To edit the time left of a task|okanban.local/task/id-task/timer|TaskController|setTime|
|En tant que utilisateur je souhaite pouvoir modifier la position de ma tache dans la liste afin de pouvoir ordonner mes taches.|To move task|okanban.local/task/id-task/move|TaskController|move|
|En tant qu’utilisateur, je veux pouvoir identifier facilement les labels en leur mettant une couleur.|To identify a task with a color|okanban.local/task/id-task/color|TaskController|setColor|

## Version 2.0
|User Story|Functionality|Url|Controller|Method|
|-|-|-|-|-|
|En tant qu'utilisateur, je veux pouvoir m'inscrire pour utiliser les fonctionnalités du site.|Page Create account|okanban.local/register|AccountController|create|
|En tant qu'utilisateur, je veux pouvoir me connecter pour utiliser mes listes.|Page Login|okanban.local/login|AccountController|login|
|En tant qu'utilisateur, je veux pouvoir conserver les taches supprimées ou achevées dans une archive et pouvoir les restaurer.|To archive tasks|okanban.local/task/archive|TaskController|archive|