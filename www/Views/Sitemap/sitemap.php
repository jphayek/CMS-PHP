<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($pages as $page): ?>
        <url>
            <loc><?php echo htmlspecialchars($page['url']); ?></loc>
            <lastmod><?php echo $page['lastmod']; ?></lastmod>
            <changefreq><?php echo $page['changefreq']; ?></changefreq>
            <priority><?php echo $page['priority']; ?></priority>
        </url>
    <?php endforeach; ?>
</urlset>