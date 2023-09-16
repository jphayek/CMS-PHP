<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blog ESGI</title>
    <meta name="description" content="ceci est un super site">
    <link rel="stylesheet" href=css/style.css> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    
</head>
<body>
    <div role="navigation" class="navbar navbar-default navbar-static-top" style="background-color: lightgreen;">
      <div class="container">
        <div class="navbar-header">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="/" class="navbar-brand" style="color: black; font-size:20px;">ESGI</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          
            <li class="active"><a href="/">Home</a></li>
            
            <li><a href="/pages/toutes-les-pages">Toutes les Pages</a></li>


            <?php if (isset($pages) && is_array($pages)) : ?>
            <?php foreach ($pages as $page) : ?>
            
              <li><a href="/pages/<?= $page->getSlug(); ?>"><?= $page->getTitle(); ?></a></li>
              <?php endforeach; ?>
            <?php endif; ?>
              
          

            <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin'): ?>
                <li><a href="/dashboard">Dashboard</a></li>
            <?php endif; ?> 
            
          </ul>  

          <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION['user_id'])) : ?>
              <li><a href="/user/profile/edit">Modifier le profil</a></li>
            <?php endif; ?>
          <?php
            $currentUrl = $_SERVER['REQUEST_URI'];
            $isLoginPage = strpos($currentUrl, '/login') !== false;
          ?>
            <?php if (!isset($_SESSION['user_id'])) : ?>
                <!-- Afficher les liens "Login" et "Register" uniquement si l'utilisateur n'est pas connecté -->
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
            <?php else : ?>
                <!-- Afficher le lien "Logout" si l'utilisateur est connecté -->
                <li><a href="/logout">Logout</a></li>
            <?php endif; ?>
          </ul>
         
        </div>
      </div>
    </div>
    <!-- inclure la vue -->
    <div class="container">
      <!-- Affichage de la liste des catégories -->
      <?php
        if (!in_array($_SERVER['REQUEST_URI'], ['/login', '/register', '/user/profile/edit', '/pages/toutes-les-pages', '/pages/{slug}'])) {
      ?>
      <div class="filter">
        <label for="category_id">Filtrer par Category:</label>

          <select id="category_id" class="form-control" required>
            <option value="0">All Articles</option>
            <option value="1">SPORT</option>
            <option value="2">BLOG</option>
            <option value="3">OTHER</option>
          
          </select>
            </div>
            <?php
}
?>
    
    <div id="filteredArticles">
        <!-- Le contenu des articles filtrés sera affiché ici -->

      <?php include $this->view;?>

    </div>
     
    <div class="container" style="min-height:500px;">
    <div class="insert-post-ads1" style="margin-top:20px;">
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        
        var categoryFilter = $('#category_id');
        var filteredArticles = $('#filteredArticles');
    
        categoryFilter.on('change', function () {
            var selectedCategoryId = categoryFilter.val();
            //alert(selectedCategoryId);
            $.ajax({
              method: 'GET',
              url: '/getArticlesByCategory?category_id='+selectedCategoryId, 
              success: function (data) {
                  // Mettez à jour le contenu de l'élément avec les articles filtrés
                  filteredArticles.html(data);
              },
              error: function () {
                  // Gérez les erreurs en conséquence
                  alert('Une erreur s\'est produite lors du filtrage des articles.');
              }
          });
        });
    });
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            
</body>
</html>