<style>
    textarea{
        height: 200%;
        width: 1110px;
        color: #003300;
    } 
</style>

<?php include('includes/admin-notes-nav.php');  ?>
<h2><?= $addNotesTitle ?></h2>

<form id="addNote" method="post" action="<?= \ItForFree\SimpleMVC\Url::link("admin/notes/add")?>"> 
    <div class="form-group">
        <label for="user_id">Cотрудник</label>  
                <select name="user_id">
                <?php foreach ($users as $user) { ?>        
                  <option value="<?php echo $user->id?>"<?php echo ( $user->login) ? " selected" : ""?> ><?php echo htmlspecialchars($user->login);?></option>
                <?php  }  ?>
                </select> 
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
    <input type="submit" class="btn btn-primary" name="saveNewNote" value="Сохранить">
    <input type="submit" class="btn" name="cancel" value="Назад">
</form>    
