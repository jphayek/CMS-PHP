<?php foreach ($articles as $article): ?>
    <div class="article">
        <h2><?= $article->getTitle(); ?></h2>
        <p><?= $article->getContent(); ?></p>
    </div>
<?php endforeach; ?>