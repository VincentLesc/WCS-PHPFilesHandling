<?php

session_start();

include('inc/head.php');

// define actual path

$path = ((isset($_GET['path'])) && ($_GET['path'] != "")) ? $_GET['path'] : 'files';

// display all directory and files of the current directory exclude . and ..

if ($handle = opendir($path)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry!= ".." && is_dir($path.'/'.$entry) === false) {
            echo
                "<div class='row field'>
                    <div class='col-xs-6'>
                        $entry
                    </div>
                    <div class='col-xs-6'>
                        <div class='row'>
                            <div class='col-xs-6'>
                               <a href=\"edit.php?path=$path/$entry\"><button class='btn btn-primary'>Modifier</button></a>
                            </div>
                            <div class='col-xs-6'>
                                <a href='edit.php?delete=$path/$entry'><button class='btn btn-danger'>Supprimer</button></a>
                            </div>
                        </div>
                     </div>
                </div>";
        }
        elseif ($entry != "." && $entry!= ".." && is_dir($path.'/'.$entry) === true) {
            echo
            "<div class='row field'>
                <div class='col-xs-6'>
                    <a href=\"index.php?path=$path/$entry\">$entry</a> 
                </div>
                <div class='col-xs-6'>
                    <div class='row'>
                        <div class='col-xs-6'>
                            <a href=\"index.php?path=$path/$entry\"><button class='btn btn-primary'>Ouvrir le dossier</button></a>
                        </div>
                        <div class='col-xs-6'>
                            <a href='edit.php?delete=$path/$entry'><button class='btn btn-danger'>Supprimer</button></a>
                        </div>
                    </div>
                </div>
            </div>";
        }
    }

    // define the path of the parent directory

    $path= explode('/', $path);
    array_pop($path);
    $path =implode('/', $path);
    if ($path != "") {
        echo "<a href=\"index.php?path=$path\">Retour au dossier parent</a><br/>";
    }
    // close the handle

    closedir($handle);
}

 include('inc/foot.php'); ?>

