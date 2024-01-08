<?php
declare(strict_types=1);

namespace app\core\view_service;

use app\core\StringHelper;
use Exception;

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
        if(!@include ROOT_DIRECTORY . "/views/$viewName.php"){
            ob_get_clean();
            throw new Exception("getViewContent: view \"$viewName\" not found!");
        };
        $fullContent = ob_get_clean();
        $viewContent = $this->stringHelper->getBetween($fullContent, '@content', '@endcontent');

        return $viewContent;
    }

    public function getLayoutContent(string $layoutName): string
    {
        ob_start();
        if(!@include ROOT_DIRECTORY . "/views/layouts/$layoutName.php"){
            ob_get_clean();
            throw new Exception("getLayoutContent: layout \"$layoutName\" not found!");
        };
        $layoutContent = ob_get_clean();
        return $layoutContent;
    }

    public function getRelatedLayoutName($viewName): string
    {
        ob_start();
        if(!@include ROOT_DIRECTORY . "/views/$viewName.php"){
            ob_get_clean();
            throw new Exception("getRelatedLayoutName(): view \"$viewName\" not found!");
        };
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
        $viewContent = $this->getViewContent($viewName);
        $layoutName = $this->getRelatedLayoutName($viewName);
        if (!$layoutName) return $viewContent;
        $layoutContent = $this->getLayoutContent($layoutName);
        $renderContent = $this->injectViewToLayout($viewContent, $layoutContent);
        return $renderContent;
    }
}