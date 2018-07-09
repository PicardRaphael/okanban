<?php
class CardController extends MainController
{
    public function create()
    {
        $array_response = [
            'code' => '0',
            'errorMsg' => ''
        ];

        // Je vérifie que l'on m'a bien envoyé quelque chose.
        if (empty($_POST)) 
        {
            $array_response['code'] = '1';
            $array_response['errorMsg'] = 'POST vide';
        }

        if ($array_response['code'] == '0') 
        {
            $CardModel = new CardModel();

            $CardModel->setTitle($_POST['cardTitle']);
            $CardModel->setOrdering($_POST['ordering']);
            $CardModel->setListId($_POST['listId']);
            
            $CardModel->add();
        }
        $this->displayJson($array_response);
    }

    public function update()
    {
        $array_response = [
        'code' => '0',
        'errorMsg' => ''
        ];

        // Je vérifie que l'on m'a bien envoyé quelque chose.
        if (empty($_POST)) 
        {
            $array_response['code'] = '1';
            $array_response['errorMsg'] = 'POST vide';
        }

        if ($array_response['code'] == '0') 
        {
            // Je récupere mon objet cardmodel provenant de la BDD
            // cet objet est instancié avec les valeurs contenues en BDD
            $cardModel = CardModel::find($_POST['cardId']);

            if (!is_object($cardModel) || $cardModel->getTitle() == '') 
            {
                $array_response['code'] = '4';
                $array_response['errorMsg'] = 'Impossible de trouver la liste';
            }

            if ($array_response['code'] == '0') 
            {
                if ($cardModel->getTitle() != $_POST['cardNewTitle']) 
                {
                    $cardModel->setTitle($_POST['cardNewTitle']);
                    $edited = $cardModel->edit();
    
                    if ($edited === false) 
                    {
                        $array_response['code'] = '5';
                        $array_response['errorMsg'] = "Erreur lors de l'enregistrement en BDD";
                    }
                    else 
                    {
                        $array_response['cardId'] = $cardModel->getId();
                        $array_response['cardTitle'] = $cardModel->getTitle();
                    }
                } 
                else 
                {
                    $array_response['cardId'] = $cardModel->getId();
                    $array_response['cardTitle'] = $cardModel->getTitle();
                }
            }
        }
        $this->displayJson($array_response);
    }

    public function color()
    {
        $array_response = [
            'code' => '0',
            'errorMsg' => ''
            ];

        // Je vérifie que l'on m'a bien envoyé quelque chose.
        if (empty($_POST)) 
        {
            $array_response['code'] = '1';
            $array_response['errorMsg'] = 'POST vide';
        }

        if ($array_response['code'] == '0') 
        {

                // Je récupere mon objet cardmodel provenant de la BDD
            // cet objet est instancié avec les valeurs contenues en BDD
            $cardModel = CardModel::find($_POST['cardId']);

            if (!is_object($cardModel)) 
            {
                $array_response['code'] = '4';
                $array_response['errorMsg'] = 'Impossible de trouver la liste';
            }

            if ($array_response['code'] == '0') 
            {
                $cardModel->setColor($_POST['color']);
                $edited = $cardModel->editColor();

                // Si pour une raison X ou Y l'enregistrement en BDD n'a pas fonctionné
                if ($edited === false) 
                {
                    $array_response['code'] = '5';
                    $array_response['errorMsg'] = "Erreur lors de l'enregistrement en BDD";
                } 
                else 
                {
                    $array_response['cardId'] = $cardModel->getId();
                    $array_response['color'] = $cardModel->getColor();
                }
            }
        }

        $this->displayJson($array_response);
    }

    public function delete()
    {
        $array_response = [
        'code' => '0',
        'errorMsg' => ''
        ];
        
        // Je vérifie que l'on m'a bien envoyé quelque chose.
        if (empty($_POST) && !empty($_POST['cardId'])) 
        {
            $array_response['code'] = '1';
            $array_response['errorMsg'] = 'POST vide';
        }

        if ($array_response['code'] == '0') {
            $cardModel = CardModel::find($_POST['cardId']);
            
            if (!is_object($cardModel) || $cardModel->getTitle() == '') 
            {
                $array_response['code'] = '4';
                $array_response['errorMsg'] = 'Impossible de trouver la liste';
            }
            
            if ($array_response['code'] == '0') 
            {
                $deleted = $cardModel->delete();
                
                // Si pour une raison X ou Y la suppression en BDD n'a pas fonctionnée
                if ($deleted === false) 
                {
                    $array_response['code'] = '6';
                    $array_response['errorMsg'] = "Erreur lors de la suppression en BDD";
                }
            }
        }
        $this->displayJson($array_response);
    }
}
