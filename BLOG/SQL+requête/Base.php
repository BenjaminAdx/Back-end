<?php

function User_select($connex) {
    $res = array() ;
    $req = $connex->prepare("select ID, username, password, email, avatar, code, ID_Role from User") ;
    $req->execute() ;
    $c = 0 ;
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $res[$c] = $row ;
        $c = $c+1 ;
    }
    $req->closeCursor() ;
    return $res ;
}


function User_select_PK($connex, $User) {
    $res = array() ;
    $req = $connex->prepare("select ID, username, password, email, avatar, code, ID_Role from User where ID = ?") ;
    $req->bindParam(1, $User["ID"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}


function User_insert($connex, $User) {
    $res = array() ;
    $req = $connex->prepare("insert into User (ID, username, password, email, avatar, code, ID_Role) values (?, ?, ?, ?, ?, ?, ?)") ;
    $req->bindParam(1, $User["ID"]) ;
    $req->bindParam(2, $User["username"]) ;
    $req->bindParam(3, $User["password"]) ;
    $req->bindParam(4, $User["email"]) ;
    $req->bindParam(5, $User["avatar"]) ;
    $req->bindParam(6, $User["code"]) ;
    $req->bindParam(7, $User["ID_Role"]) ;
    $req->execute() ;
    $req->closeCursor() ;
}


function User_update_PK($connex, $User) {
    $res = array() ;
    $req = $connex->prepare("update User set username = ?, set password = ?, set email = ?, set avatar = ?, set code = ?, set ID_Role = ? where ID = ?") ;
    $req->bindParam(1, $User["username"]) ;
    $req->bindParam(2, $User["password"]) ;
    $req->bindParam(3, $User["email"]) ;
    $req->bindParam(4, $User["avatar"]) ;
    $req->bindParam(5, $User["code"]) ;
    $req->bindParam(6, $User["ID_Role"]) ;
    $req->bindParam(7, $User["ID"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}


function User_delete_PK($connex, $User) {
    $res = array() ;
    $req = $connex->prepare("delete from User where ID = ?") ;
    $req->bindParam(1, $User["ID"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}
function Article_select($connex) {
    $res = array() ;
    $req = $connex->prepare("select ID, title, content, image, date, auteur, ID_User from Article") ;
    $req->execute() ;
    $c = 0 ;
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $res[$c] = $row ;
        $c = $c+1 ;
    }
    $req->closeCursor() ;
    return $res ;
}


function Article_select_PK($connex, $Article) {
    $res = array() ;
    $req = $connex->prepare("select ID, title, content, image, date, auteur, ID_User from Article where ID = ?") ;
    $req->bindParam(1, $Article["ID"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}


function Article_insert($connex, $Article) {
    $res = array() ;
    $req = $connex->prepare("insert into Article (ID, title, content, image, date, auteur, ID_User) values (?, ?, ?, ?, ?, ?, ?)") ;
    $req->bindParam(1, $Article["ID"]) ;
    $req->bindParam(2, $Article["title"]) ;
    $req->bindParam(3, $Article["content"]) ;
    $req->bindParam(4, $Article["image"]) ;
    $req->bindParam(5, $Article["date"]) ;
    $req->bindParam(6, $Article["auteur"]) ;
    $req->bindParam(7, $Article["ID_User"]) ;
    $req->execute() ;
    $req->closeCursor() ;
}


function Article_update_PK($connex, $Article) {
    $res = array() ;
    $req = $connex->prepare("update Article set title = ?, set content = ?, set image = ?, set date = ?, set auteur = ?, set ID_User = ? where ID = ?") ;
    $req->bindParam(1, $Article["title"]) ;
    $req->bindParam(2, $Article["content"]) ;
    $req->bindParam(3, $Article["image"]) ;
    $req->bindParam(4, $Article["date"]) ;
    $req->bindParam(5, $Article["auteur"]) ;
    $req->bindParam(6, $Article["ID_User"]) ;
    $req->bindParam(7, $Article["ID"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}


function Article_delete_PK($connex, $Article) {
    $res = array() ;
    $req = $connex->prepare("delete from Article where ID = ?") ;
    $req->bindParam(1, $Article["ID"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}
function Role_select($connex) {
    $res = array() ;
    $req = $connex->prepare("select ID, nom from Role") ;
    $req->execute() ;
    $c = 0 ;
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $res[$c] = $row ;
        $c = $c+1 ;
    }
    $req->closeCursor() ;
    return $res ;
}


function Role_select_PK($connex, $Role) {
    $res = array() ;
    $req = $connex->prepare("select ID, nom from Role where ID = ?") ;
    $req->bindParam(1, $Role["ID"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}


function Role_insert($connex, $Role) {
    $res = array() ;
    $req = $connex->prepare("insert into Role (ID, nom) values (?, ?)") ;
    $req->bindParam(1, $Role["ID"]) ;
    $req->bindParam(2, $Role["nom"]) ;
    $req->execute() ;
    $req->closeCursor() ;
}


function Role_update_PK($connex, $Role) {
    $res = array() ;
    $req = $connex->prepare("update Role set nom = ? where ID = ?") ;
    $req->bindParam(1, $Role["nom"]) ;
    $req->bindParam(2, $Role["ID"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}


function Role_delete_PK($connex, $Role) {
    $res = array() ;
    $req = $connex->prepare("delete from Role where ID = ?") ;
    $req->bindParam(1, $Role["ID"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}
function Jaime_select($connex) {
    $res = array() ;
    $req = $connex->prepare("select ID_User, ID_Article from Jaime") ;
    $req->execute() ;
    $c = 0 ;
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $res[$c] = $row ;
        $c = $c+1 ;
    }
    $req->closeCursor() ;
    return $res ;
}


function Jaime_select_PK($connex, $Jaime) {
    $res = array() ;
    $req = $connex->prepare("select ID_User, ID_Article from Jaime where ID_User = ? and ID_Article = ?") ;
    $req->bindParam(1, $Jaime["ID_User"]) ;
    $req->bindParam(2, $Jaime["ID_Article"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}


function Jaime_insert($connex, $Jaime) {
    $res = array() ;
    $req = $connex->prepare("insert into Jaime (ID_User, ID_Article) values (?, ?)") ;
    $req->bindParam(1, $Jaime["ID_User"]) ;
    $req->bindParam(2, $Jaime["ID_Article"]) ;
    $req->execute() ;
    $req->closeCursor() ;
}


function Jaime_update_PK($connex, $Jaime) {
    $res = array() ;
    $req = $connex->prepare("update Jaime  where ID_User = ? and ID_Article = ?") ;
    $req->bindParam(1, $Jaime["ID_User"]) ;
    $req->bindParam(2, $Jaime["ID_Article"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}


function Jaime_delete_PK($connex, $Jaime) {
    $res = array() ;
    $req = $connex->prepare("delete from Jaime where ID_User = ? and ID_Article = ?") ;
    $req->bindParam(1, $Jaime["ID_User"]) ;
    $req->bindParam(2, $Jaime["ID_Article"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}
function Favoris_select($connex) {
    $res = array() ;
    $req = $connex->prepare("select ID_User, ID_Article from Favoris") ;
    $req->execute() ;
    $c = 0 ;
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $res[$c] = $row ;
        $c = $c+1 ;
    }
    $req->closeCursor() ;
    return $res ;
}


function Favoris_select_PK($connex, $Favoris) {
    $res = array() ;
    $req = $connex->prepare("select ID_User, ID_Article from Favoris where ID_User = ? and ID_Article = ?") ;
    $req->bindParam(1, $Favoris["ID_User"]) ;
    $req->bindParam(2, $Favoris["ID_Article"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}


function Favoris_insert($connex, $Favoris) {
    $res = array() ;
    $req = $connex->prepare("insert into Favoris (ID_User, ID_Article) values (?, ?)") ;
    $req->bindParam(1, $Favoris["ID_User"]) ;
    $req->bindParam(2, $Favoris["ID_Article"]) ;
    $req->execute() ;
    $req->closeCursor() ;
}


function Favoris_update_PK($connex, $Favoris) {
    $res = array() ;
    $req = $connex->prepare("update Favoris  where ID_User = ? and ID_Article = ?") ;
    $req->bindParam(1, $Favoris["ID_User"]) ;
    $req->bindParam(2, $Favoris["ID_Article"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}


function Favoris_delete_PK($connex, $Favoris) {
    $res = array() ;
    $req = $connex->prepare("delete from Favoris where ID_User = ? and ID_Article = ?") ;
    $req->bindParam(1, $Favoris["ID_User"]) ;
    $req->bindParam(2, $Favoris["ID_Article"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}
function Commentaires_select($connex) {
    $res = array() ;
    $req = $connex->prepare("select ID_User, ID_Article, ID, commentaire from Commentaires") ;
    $req->execute() ;
    $c = 0 ;
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $res[$c] = $row ;
        $c = $c+1 ;
    }
    $req->closeCursor() ;
    return $res ;
}


function Commentaires_select_PK($connex, $Commentaires) {
    $res = array() ;
    $req = $connex->prepare("select ID_User, ID_Article, ID, commentaire from Commentaires where ID_User = ? and ID_Article = ? and ID = ?") ;
    $req->bindParam(1, $Commentaires["ID_User"]) ;
    $req->bindParam(2, $Commentaires["ID_Article"]) ;
    $req->bindParam(3, $Commentaires["ID"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}


function Commentaires_insert($connex, $Commentaires) {
    $res = array() ;
    $req = $connex->prepare("insert into Commentaires (ID_User, ID_Article, ID, commentaire) values (?, ?, ?, ?)") ;
    $req->bindParam(1, $Commentaires["ID_User"]) ;
    $req->bindParam(2, $Commentaires["ID_Article"]) ;
    $req->bindParam(3, $Commentaires["ID"]) ;
    $req->bindParam(4, $Commentaires["commentaire"]) ;
    $req->execute() ;
    $req->closeCursor() ;
}


function Commentaires_update_PK($connex, $Commentaires) {
    $res = array() ;
    $req = $connex->prepare("update Commentaires set commentaire = ? where ID_User = ? and ID_Article = ? and ID = ?") ;
    $req->bindParam(1, $Commentaires["commentaire"]) ;
    $req->bindParam(2, $Commentaires["ID_User"]) ;
    $req->bindParam(3, $Commentaires["ID_Article"]) ;
    $req->bindParam(4, $Commentaires["ID"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}


function Commentaires_delete_PK($connex, $Commentaires) {
    $res = array() ;
    $req = $connex->prepare("delete from Commentaires where ID_User = ? and ID_Article = ? and ID = ?") ;
    $req->bindParam(1, $Commentaires["ID_User"]) ;
    $req->bindParam(2, $Commentaires["ID_Article"]) ;
    $req->bindParam(3, $Commentaires["ID"]) ;
    $req->execute() ;
    $res = $req->fetch(PDO::FETCH_ASSOC) ;
    $req->closeCursor() ;
    return $res ;
}
?>
