<h3>Voici les Articles les plus recent :</h3>

<?php foreach ($articles as $article): ?>
    <article class="article">
        <h3 style="color:green"><?= $article->getTitle(); ?></h3>
        <p style="color:black"><?= $article->getContent(); ?></p>
        <p style="color:black">Author: <?= $article->getAuthor(); ?></p>
        <p style="color:black">Created at: <?= $article->getCreated_at(); ?></p>
        
        <a href="/article/show/?id=<?= $article->getId(); ?>" class="read-more-btn">Voir plus</a>


    </article>
<?php endforeach; ?>

<nav aria-label="Page navigation">
  
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="/article/show/?id=<?= $article->getId(); ?>">1</a></li>
    <li class="page-item"><a class="page-link" href="/article/show/?id=<?= $article->getId(); ?>">2</a></li>
    <li class="page-item"><a class="page-link" href="/article/show/?id=<?= $article->getId(); ?>">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>

<div class="comment-bar">
  <h3>Comments:</h3>
  <!-- Ajoutez ici la structure HTML pour la barre de commentaires -->
</div>
