<?php

if (isset($_POST['submit']))
{
    
    $Username = $_POST['Username'];
    $pass = $_POST['pass'];

    $sql = "select * FROM user where Username = '$Username ' ";
    $result = $db->prepare($sql);
    $result->execute();

    if ($result->rowCount() > 0)
    {

    }
    else
    {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT TO user (Username,password) VALUE ('$Username','pass')";
        $req = $dn->prepare($sql);
        $seq->execute();
        echo "Enregistrement effectué";
        }
    }

?>