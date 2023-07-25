<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4">Apprendre plus sur </h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="border-bottom pb-3 mb-4">
                <h2 class="mb-3"><?= $article->getTitle(); ?></h2>
                <p class="lead"><?= $article->getContent(); ?></p>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-5">
                <p class="text-muted m-0">Author: <?= $article->getAuthor(); ?></p>
                <p class="text-muted m-0">Created at: <?= $article->getCreated_at(); ?></p>
            </div>

            <div class="d-grid gap-2">
                <a href="/comment/create?article_id=<?= $article->getId() ?>" class="btn btn-primary">Ajouter un commentaire</a>
                <a href="/comment/show?article_id=<?= $article->getId() ?>" class="btn btn-outline-secondary">Voir les commentaires</a>
            </div>
        </div>
    </div>
</div>
