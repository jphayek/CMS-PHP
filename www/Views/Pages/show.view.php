
<!DOCTYPE html>
<html>
<head>
    <title><?= $page->getTitle() ?></title>
    <!-- vous pouvez ajouter vos feuilles de style CSS ici -->
</head>
<body>
    <h1><?= $page->getTitle() ?></h1>

    <div><?= $page->getContent() ?></div>

    <p>Author: <?= $page->getCreated_by() ?></p>

    <p>Created at: <?= $page->getCreated_at() ?></p>

    <!-- vous pouvez ajouter d'autres détails ici -->
</body>
</html>
