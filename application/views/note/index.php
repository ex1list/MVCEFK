<?php 
use ItForFree\SimpleMVC\Config;

$User = Config::getObject('core.user.class');
?>
<?php include('includes/admin-notes-nav.php'); //foreach ($users as $user){var_dump($user->login); } die();?>

<h2>Лист отпусков</h2>

<?php if (!empty($notes)): ?>



<table class="table">
    <thead>
    <tr>
      <th scope="col">id otpuska</th>
      <th scope="col">Сотрудник</th>
      <th scope="col">Отпуск с</th>
      <th scope="col">Отпуск по</th>
      <th scope="col">Комментарий</th>
      <th scope="col">Закрепить отпуск</th>
     
      <th scope="col"></th>
    </tr>
     </thead>
    <tbody>

    <?php foreach ($notes as $note) {   ?>
       
       
    <tr>
        <td> <?php echo $note->id; ?>  </td>  
        
        <?php foreach ($users as $user) {  
        if ( $note->user_id == $user->id) { ?> 
        <td> <?php echo $user->login; ?> </td>
        <?php } } ?>
        
        <td> <?php echo $note->SDATE; ?>  </td>
        <td> <?php echo $note->BDate; ?>  </td> 
        <td> <?php echo $note->content; ?>  </td>
        <td>
        
        <div class="form-group">
        <label for="Checked">Подтвержден отпуск</label>  
        <?php if ( $note->Checked == 1 ) { ?>
                 <input type=checkbox name="Active" value="1" checked >     
        <?php } else { ?>
               <input type=checkbox name="Active" value="0" >
        <?php } ?>
        
        
        
         </td> 
        
        
                  <td>  <?= $User->returnIfAllowed("admin/adminusers/edit", 
                    "<a href=" . \ItForFree\SimpleMVC\Url::link("admin/notes/edit&id=". $note->id) 
                    . ">[Редактировать]</a>");?></td>
    </tr>      

    <?php } ?>

</table>

<?php else:?>
    <p> Отпуска не выдали</p>
<?php endif; ?>

