<?php
session_start();
include_once 'inc/header.php';
include_once 'inc/functions.php';
logged();

$allMsgs = checkNotReadMsg();
?>

<div>
    <ul id="myTabs" class="nav nav-tabs" role="tablist">

<?php
// show two common li
if( (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') ||
    (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'edit') ) {
?>
        <li role="presentation" class="active"><a href="#add-article" aria-controls="add-article" role="tab" data-toggle="tab">Ajouter un article</a></li>

<?php
} // end of show two common li
// show li only for admin
if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') {
 ?>
        <li role="presentation"><a href="#user_list" aria-controls="modify-article" role="tab" data-toggle="tab">Liste d'utilisateurs</a></li>
        <li role="presentation"><a href="#modify-header" aria-controls="modify-header" role="tab" data-toggle="tab">Modifier header</a></li>
        <li role="presentation"><a href="#read-messages" aria-controls="read-messages" role="tab" data-toggle="tab">Lire les messages <span id="msg-bell" class="glyphicon glyphicon-bell"></span></a></li>
<?php } // show li only for admin ?>
    </ul>


    <div class="tab-content">
        <?php
        // show common content for editor and amin
        if( (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') ||
            (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'edit') ) {
         ?>
        <div role="tabpanel" class="tab-pane active" id="add-article">
            <?php require_once 'inc/add_recipe.php'; ?>
        </div>

        <?php
        } // end of common
        // admin mode content
        if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') {
        ?>
        <div role="tabpanel" class="tab-pane" id="user_list">
            <?php require_once 'inc/list_users.php'; ?>
        </div>

        <div role="tabpanel" class="tab-pane" id="modify-header">
           <?php require_once 'inc/update_infos.php'; ?>
        </div>

        <div role="tabpanel" class="tab-pane" id="read-messages">
           <?php require_once 'inc/read_messages.php'; ?>
        </div>
        <?php } // end of admin content ?>
    </div>


</div>
<?php
include_once 'inc/footer.php';
 ?>
