<?php
namespace app\core\view_service;

use app\core\StringHelper;

class AppViewService implements ViewService
{
    private $stringHelper;

    public function __construct(StringHelper $stringHelper)
    {
        $this->stringHelper = $stringHelper;
    }

    public function getViewContent(string $viewName): string
    {
        ob_start();
        include ROOT_DIRECTORY . "/views/$viewName.php";
        $fullContent = ob_get_clean();
        $viewContent = $this->stringHelper->getBetween($fullContent, '@content', '@endcontent');
        return $viewContent;
    }

    public function getLayoutContent(string $layoutName): string
    {
        ob_start();
        include ROOT_DIRECTORY . "/views/layouts/$layoutName.php";
        $layoutContent = ob_get_clean();
        return $layoutContent;
    }

    public function getRelatedLayoutName($viewName): string
    {
        ob_start();
        include ROOT_DIRECTORY . "/views/$viewName.php";
        $fullContent = ob_get_clean();
        $layoutName = $this->stringHelper->getBetween($fullContent, '@layout("', '")');
        return $layoutName;
    }

    public function injectViewToLayout($viewContent, $layoutContent): string
    {
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderView($viewName): string
    {
        $layoutName = $this->getRelatedLayoutName($viewName);
        $viewContent = $this->getViewContent($viewName);
        $layoutContent = $this->getLayoutContent($layoutName);
        $renderContent = $this->injectViewToLayout($viewContent, $layoutContent);
        return $renderContent;
    }

    public function renderNotFound(): string
    {
        return $this->renderView('page404');
    }
}