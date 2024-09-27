<?php
require '../app/controllers/ArticleController.php';
require '../app/controllers/CategoryController.php';

require '../app/controllers/AuthorController.php';

$controller_article = new ArticleController();
$controller_category = new CategoryController(); 
$controller_author = new AuthorController();


$controller->index(); 
    //add_article
   
// CATEGORY.PHP
$action = $_GET['action'] ?? 'index'; 

switch ($action) {
    case 'add':
        $controller_category->addCategory(); 
        break;
    case 'edit':
        $controller_category->edit($catId); 
        break;
    case 'index':
    default:
        $controller_category->index();
        break;
}
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $controller = new CategoryController();
    $controller->delete($_GET['id']);
} else {
    header("Location: ../views/category.php?error=Yêu cầu không hợp lệ.");
}
//AUTHOR.PHP
$controller_author = new AuthorController();
$controller->index(); 
?>
