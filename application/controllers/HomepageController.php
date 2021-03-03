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
         //var_dump ($_SESSION["user"]["userName"]);die();
            $Notes = new Notes();
            
            $userlogin = $_SESSION["user"]["userName"] ?? null;
           
        if ($userlogin) { // если указан конктреный пользователь
            $viewuserlogin = $Notes->IzloginaPoluchaemId($userlogin);
            
            $viewidnotes = $Notes->IzIdPoluchaemDannieOtpuska($viewuserlogin);
            //var_dump($viewidnotes); die();   
            $this->view->addVar('viewidnotes', $viewidnotes);      
            $this->view->addVar('viewuserlogin', $viewuserlogin);
            $this->view->render('note/view-item.php');
        }  
    }
          public function alluserindexAction()
    { 
        // выводим полный список         
            $Notes = new Notes();
            $notes = $Notes->getList()['results'];
            $this->view->addVar('notes', $notes); 
            $Adminusers = new Adminusers();
            $users = $Adminusers->getList()['results'];
            $this->view->addVar('users', $users);     
            //var_dump($notes);die();
            $this->view->render('note/indexuser.php');  
    
    }
    
    
       public function usereditAction()
    {
        $id = $_GET['id'];
        $Url = Config::get('core.url.class');
        
        if (!empty($_POST)) { // это выполняется нормально.
            
            if (!empty($_POST['saveChanges'] )) {
                $Notes = new Notes();
                $newNotes = $Notes->loadFromArray($_POST);
                $newNotes->userupdate();
                $this->redirect($Url::link("homepage/alluserindex"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("homepage/alluserindex"));
            }
        }
        else {
            $Notes = new Notes();
            $viewNotes = $Notes->getById($id);
            $editNotesTitle = "Редактирование отпуска";         
            $this->view->addVar('viewNotes', $viewNotes);
            $this->view->addVar('editNotesTitle', $editNotesTitle); 
            $this->view->render('note/edituser.php');   
        }
        
    }
    
    
    }

    

