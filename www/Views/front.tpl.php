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
            <li class=""><a href="">About</a></li>
            <li class=""><a href="">Contact</a></li>
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
                    
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Register</a></li>
                    <li><a href="/logout">Logout</a></li>
          </ul>
         
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <!-- inclure la vue -->
    <div class="container">
      <?php include $this->view;?>
    </div>
     
    <div class="container" style="min-height:500px;">
    <div class="insert-post-ads1" style="margin-top:20px;">
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>
</html>