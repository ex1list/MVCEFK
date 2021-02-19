<?php

namespace application\controllers;
use application\models\Notes as Notes;
use ItForFree\SimpleMVC\Config;
use \application\models\ExampleUser as Adminusers;

/**
 * Контроллер для домашней страницы
 */
class HomepageController extends \ItForFree\SimpleMVC\mvc\Controller
{
    /**
     * @var string Название страницы
     */
    public $homepageTitle = "Домашняя страница";
    
    /**
     * @var string Пусть к файлу шаблона 
     */
    public $layoutPath = 'main.php';
      
    /**
     * Выводит на экран страницу "Домашняя страница"
     */
    public function indexAction()
    {
        $this->view->addVar('homepageTitle', $this->homepageTitle); // передаём переменную по view
        $this->view->render('homepage/index.php');
    }


    
        protected $rules = [ //вариант 2:  здесь всё гибче, проще развивать в дальнешем
         ['allow' => true, 'roles' => ['@']],
         ['allow' => false, 'roles' => ['admin', '?']],
    ];
  
        public function userindexAction()
    {
        // var_dump ($_SESSION["user"]["userName"]);die();
            $Notes = new Notes();
            $userlogin = $_SESSION["user"]["userName"] ?? null;
        if ($userlogin) { // если указан конктреный пользователь
            $viewNotes = $Notes->IzloginaPoluchaemDannieUsera($userlogin);
            //var_dump($viewNotes); die();
            
            
            $this->view->addVar('viewNotes', $viewNotes);
            $this->view->render('note/view-item.php');
        } else { // выводим полный список         
            $Notes = new Notes();
            $notes = $Notes->getList()['results'];
            $this->view->addVar('notes', $notes); 
            $Adminusers = new Adminusers();
            $users = $Adminusers->getList()['results'];
            $this->view->addVar('users', $users);     
            //var_dump($notes);die();
            $this->view->render('note/index.php');
            
                 
            
        }
    }
    
    
    
    
    
    
    
    
    }

