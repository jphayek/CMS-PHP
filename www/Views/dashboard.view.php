<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord</title>
  <!-- Inclure les fichiers CSS Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <!-- Inclure la bibliothèque Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .overview-card {
      padding: 20px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Tableau de bord</h1>
    <div class="row">
        
    </div>


    <div class="panel-body">
        <div class="col-md-3">
            <div class="well dash-box">
                <h2><span class="glyphicon glyphicon-user" aria-hidden="true">
                    <a href="/users"></span> <?php echo $userCount; ?></h2>
                        <h4>Users</h4>
                    </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well dash-box">
                <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                <a href="/articles"> <?php echo $articleCount; ?></h2>
                    <h4>Article</h4>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="well dash-box">
                <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 
                <a href="/articles"><?php echo $pagesCount; ?></h2>
                    <h4>Pages</h4>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="well dash-box">
                <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 
                <a href="/comments"><?php echo $commentCount; ?></h2>
                    <h4>Comments</h4>
                </a>
            </div>
        </div>
   
    </div>   
  

    









    <div class="row">
      <div class="col-md-6">
        <canvas id="usersChart"></canvas>
      </div>
      <div class="col-md-6">
        <canvas id="articlesChart"></canvas>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <canvas id="pagesChart"></canvas>
      </div>
      <div class="col-md-6">
        <canvas id="visitorsChart"></canvas>
      </div>
    </div>

    
    <div class="row">
      <div class="col-md-12">
        <h3>Messages d'alerte</h3>
        <div class="alert alert-danger" role="alert">
          Erreur lors du traitement de la demande.
        </div>
      </div>
    </div>

  </div>

  <script>
    // Données factices pour les graphiques

    var userCount = <?php echo $userCount; ?>;
    var articleCount = <?php echo $articleCount; ?>;
    var userData = {
      labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
      datasets: [{
        label: 'Nombre d\'utilisateurs',
        data: [userCount, 100 - userCount],
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    };

    var articleData = {
      labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
      datasets: [{
        label: 'Nombre d\'articles',
        data: [articleCount],
        backgroundColor: 'rgba(255, 99, 132, 0.5)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
      }]
    };

    var pageData = {
      labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
      datasets: [{
        label: 'Nombre de pages',
        data: [10, 15, 20, 25, 30, 35],
        backgroundColor: 'rgba(75, 192, 192, 0.5)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    };

    var visitorData = {
      labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
      datasets: [{
        label: 'Nombre de visiteurs',
        data: [1000, 1200, 900, 1500, 1800, 2000],
        backgroundColor: 'rgba(255, 205, 86, 0.5)',
        borderColor: 'rgba(255, 205, 86, 1)',
        borderWidth: 1
      }]
    };

    // Configuration des options du graphique
    var options = {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    };

    // Création des graphiques
    var usersChart = new Chart(document.getElementById('usersChart'), {
      type: 'bar',
      data: userData,
      options: options
    });

    var articlesChart = new Chart(document.getElementById('articlesChart'), {
      type: 'bar',
      data: articleData,
      options: options
    });

    var pagesChart = new Chart(document.getElementById('pagesChart'), {
      type: 'bar',
      data: pageData,
      options: options
    });

    var visitorsChart = new Chart(document.getElementById('visitorsChart'), {
      type: 'line',
      data: visitorData,
      options: options
    });
  </script>
</body>
</html>
