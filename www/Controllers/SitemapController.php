<?php

namespace App\Controllers;

use App\Models\Pages as PagesModel;


class SitemapController
{
    public function generate()
    {
        
        $pageModel = PagesModel::getInstance();
        $pages = $pageModel->getAllPages();
        $xmlContent = $this->renderView('sitemap', ['pages' => $pages]);

        header('Content-Type: application/xml');
        echo $xmlContent;
    }


    protected function renderView($viewName, $data)
    {
        ob_start();
        extract($data);
        include(__DIR__ . '/../Views/Sitemap/' . $viewName . '.php');
        return ob_get_clean();
    }
}