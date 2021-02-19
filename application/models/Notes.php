<?php
namespace application\models;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//var_dump($_POST);die();
class Notes extends BaseExampleModel {
    
    public $tableName = "notes";
    
    public $orderBy = 'BDate ASC';
    
    public $id = null;
    
    public $user_id = null;
    
    public $content = null;
    
    public $SDATE = null;
    
    public $BDate = null;
    
    public $Checked= null; 
    
    
 public function IzloginaPoluchaemDannieUsera ($userlogin)  
    {
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM users
                WHERE login=:login"; 
      
        $st = $this->pdo->prepare($sql);
        $st->bindValue( ":login", $userlogin, \PDO::PARAM_INT );
        $st->execute();
        $useridinnotes = $st->fetch();
        //var_dump($useridinnotes['id']); die();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM notes
                WHERE  user_id=:useridinnotes"; 
        $st = $this->pdo->prepare($sql);
        $st->bindValue( ":useridinnotes",$useridinnotes['id'], \PDO::PARAM_INT );
        $st->execute();
        $useridinnotes = $st->fetch();
        
        
        return  $useridinnotes;
    }
    
    
    
    
    
    public function insert()
    {
        $sql = "INSERT INTO $this->tableName (user_id, content, SDATE, BDate,Checked) VALUES (:user_id, :content,:SDATE,:BDate,:Checked)"; 
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":SDATE", $this->SDATE, \PDO::PARAM_STMT);
        $st->bindValue( ":BDate", $this->BDate, \PDO::PARAM_STMT);
        $st->bindValue( ":user_id", $this->user_id, \PDO::PARAM_STR );
        $st->bindValue( ":content", $this->content, \PDO::PARAM_STR );
        $st->bindValue( ":Checked", $this->Checked, \PDO::PARAM_INT);
        $st->execute();
        $this->id = $this->pdo->lastInsertId();
    }
    
    public function update()
    {
        $sql = "UPDATE $this->tableName SET SDATE=:SDATE,BDate=:BDate, user_id=:user_id, content=:content,Checked:=Checked WHERE id = :id";  
        $st = $this->pdo->prepare ( $sql );   
        $st->bindValue( ":SDATE", $this->SDATE, \PDO::PARAM_STMT);
        $st->bindValue( ":BDate", $this->BDate, \PDO::PARAM_STMT);
        $st->bindValue( ":user_id", $this->user_id, \PDO::PARAM_STR );
        $st->bindValue( ":content", $this->content, \PDO::PARAM_STR );
        $st->bindValue( ":Checked", $this->Checked, \PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
    }
}

