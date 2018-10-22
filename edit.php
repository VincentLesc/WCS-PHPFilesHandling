<?php include 'inc/head.php';



if (isset($_POST['content'])){
    $file=$_GET['path'];
    $fichier = fopen($file, "w");
    fwrite($fichier, $_POST['content']);
    $content = file_get_contents($file);
    fclose($fichier);

    ?>
    <div class="alert-success">Votre fichier a été modifié ! <a href="index.php"><button class="btn btn-primary">Revenir à la liste des fichiers</button></a></div>
    <?php


}
else if (isset($_GET['path'])){
    $file=$_GET['path'];
    $content = file_get_contents($file);
}

else if (isset($_GET['delete'])){
    $file=$_GET['delete'];
    if (is_dir($file)){
        $strDirectory = $file;
        $handle = opendir($strDirectory);
        while(false !== ($entry = readdir($handle))){
            if($entry != '.' && $entry != '..'){
                if(is_dir($strDirectory.'/'.$entry)){
                    rmAllDir($strDirectory.'/'.$entry);
                }
                elseif(is_file($strDirectory.'/'.$entry)){
                    unlink($strDirectory.'/'.$entry);
                }
            }
        }
        rmdir($strDirectory.'/'.$entry);
        closedir($handle);
    }
    else{
        unlink($file);
    }
    header('Location: index.php');
}

?>

    <form action="edit.php?path=<?=$file?>"  method="POST">
        <div class="row">
            <label for="content"></label>
            <textarea id="content" name="content" style="width: 100%;" rows="20"><?= $content ?></textarea>
        </div>
        <div class="row">
            <input type="submit" style="width: 100%;" value="Enregistrer les modifications">
        </div>
    </form>
<div class="row">
    <a href="index.php"><button class="btn btn-primary">Back to the field list</button></a>
</div>



<?php include 'inc/foot.php';
