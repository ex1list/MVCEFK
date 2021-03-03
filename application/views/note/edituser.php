<style> 
    
    textarea{
        height: 200%;
        width: 1110px;
        color: #003300;
    }
   
</style>

<?php 
use ItForFree\SimpleMVC\Config;

$Url = Config::getObject('core.url.class');
$User = Config::getObject('core.user.class');
?>

<?php include('includes/admin-notes-nav.php'); ?>

<h2><?= $editNotesTitle ?></h2>

<form id="editNote" method="post" action="<?= $Url::link("homepage/useredit&id=" . $_GET['id'])?>">


       <div class="form-group">
        <label for="content">Cотрудник </label><br>
        <input type="hidden" name="user_id" placeholred="описание заметки"  value="<?php echo htmlspecialchars($viewNotes->user_id);?>">
        <?php echo htmlspecialchars($viewNotes->user_id);?>
        </input>
    </div>
     
     
    <div class="form-group">
        <label for="content">Отпуск c </label><br>
        <input type="date" name="SDATE" placeholred="описание заметки"  value=></textarea>
    </div>
   <div class="form-group">
        <label for="content">Отпуск по</label><br>
        <input type="date" name="BDate" placeholred="описание заметки"  value=></textarea>
    </div>
    <div class="form-group">
        <label for="content">Комментарий</label><br>
        <textarea type="description" name="content" placeholred="описание заметки"  value=></textarea>
    </div>

  












<input type="hidden" name="id" value="<?= $_GET['id']; ?>">
<input type="submit" name="saveChanges" value="Сохранить">
<input type="submit" name="cancel" value="Назад">
</form>