<ul>
    <?php foreach ($pages as $page) : ?>
        <h1><?= $page->getTitle() ?></h1>

        <p>Slug : <?= $page->getSlug() ?></p>
    <div><?= $page->getContent() ?></div>

    <p>Author: <?= $page->getCreated_by() ?></p>

    <p>Created at: <?= $page->getCreated_at() ?></p>
    <?php endforeach; ?>
</ul>
