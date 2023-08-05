<?php

namespace App\Controllers;

use App\Models\Pages as PagesModel;


class SitemapController
{
    public function generate()
    {
        // Obtenir les données nécessaires pour le sitemap depuis le modèle
        // Par exemple, si vous avez une liste de pages stockée en base de données :
        $pages = PagesModel::getInstance();
        $allPages = $pages->getAll();

        // Générer le contenu du sitemap XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Ajouter chaque page au sitemap
        foreach ($allPages as $page) {
            $xml .= '<url>';
            $xml .= '<loc>' . $page['url'] . '</loc>';
            $xml .= '<lastmod>' . $page['last_modified'] . '</lastmod>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        // Envoyer le contenu XML avec les en-têtes appropriées
        header('Content-Type: application/xml');
        echo $xml;
    }
}