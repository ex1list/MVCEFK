<?php
use ItForFree\SimpleMVC\Config;

$User = Config::getObject('core.user.class');
?>

<?php include('includes/admin-notes-nav.php'); ?>
 
 

<h2><?=   $viewuserlogin["login"] ?>
    <span>
       <?php   if ($viewidnotes["Checked"]==0) {  
        $User->returnIfAllowed("admin/notes/edit", 
            "<a href=" . \ItForFree\SimpleMVC\Url::link("homepage/useredit&id=". $viewuserlogin["id"]) 
            . ">[Редактировать]</a>"); 
        } else { echo "<BR>"."Отпуск утвержден";} ?>
        <?= $User->returnIfAllowed("admin/notes/delete",
                "<a href=" . \ItForFree\SimpleMVC\Url::link("admin/notes/delete&id=". $viewuserlogin["id"])
            .    ">[Удалить]</a>"); ?>
    </span>
    
</h2> 

<p>Отпуск с : <?= $viewidnotes["SDATE"]  ?></p>
<p>Отпуск по: <?= $viewidnotes["BDate"] ?></p>

