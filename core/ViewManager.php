<?php
namespace app\core;

class ViewManager 
{
    private $stringHelper;

    public function __construct(StringHelper $stringHelper)
    {
        $this->stringHelper = $stringHelper;
    }

    public function getViewContent(string $viewName)
    {
        ob_start();
        include ROOT_DIRECTORY . "/views/$viewName.php";
        $fullContent = ob_get_clean();
        $viewContent = $this->stringHelper->getBetween($fullContent, '@content', '@endcontent');
        return $viewContent;
    }

    public function getLayoutContent(string $layoutName)
    {
        ob_start();
        include ROOT_DIRECTORY . "/views/layouts/$layoutName.php";
        $layoutContent = ob_get_clean();
        return $layoutContent;
    }

    public function getRelatedLayoutName($viewName)
    {
        ob_start();
        include ROOT_DIRECTORY . "/views/$viewName.php";
        $fullContent = ob_get_clean();
        $layoutName = $this->stringHelper->getBetween($fullContent, '@layout("', '")');
        return $layoutName;
    }

    public function injectViewToLayout($viewContent, $layoutContent)
    {
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderView($viewName)
    {
        $layoutName = $this->getRelatedLayoutName($viewName);
        $viewContent = $this->getViewContent($viewName);
        $layoutContent = $this->getLayoutContent($layoutName);
        $renderContent = $this->injectViewToLayout($viewContent, $layoutContent);
        return $renderContent;
    }
}