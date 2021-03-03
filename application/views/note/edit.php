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

<form id="editNote" method="post" action="<?= $Url::link("admin/notes/edit&id=" . $_GET['id'])?>">


       <div class="form-group">
        <label for="content">Cотрудник </label><br>
        <input type="hidden" name="user_id" placeholred="описание заметки"  value="<?php echo htmlspecialchars($viewNotes->user_id);?>">
        <?php echo htmlspecialchars($viewNotes->user_id);?>
        </input>
    </div>
     
    

    <div class="form-group">
        <label for="Checked">Закрепить отпуск</label>  
        <?php  if (  $viewNotes ->Checked == 1 ) { ?>
                 <input type=checkbox name="Checked" value="1" checked >     
        <?php } else { ?>
               <input type=checkbox name="Checked" value="1" >
               
        <?php } ?>     
    </div>












<input type="hidden" name="id" value="<?= $_GET['id']; ?>">
<input type="submit" name="saveChanges" value="Сохранить">
<input type="submit" name="cancel" value="Назад">
</form>