<?php
namespace app\core\view_service;

class TestViewService implements ViewService
{
    public function getViewContent(string $viewName): string
    {
        return 'view content';
    }

    public function getLayoutContent(string $layoutName): string
    {
        return 'layout content';
    }

    public function getRelatedLayoutName($viewName): string
    {
        return 'layout name';
    }

    public function injectViewToLayout($viewContent, $layoutContent): string
    {
        return 'layout with view injected';
    }

    public function renderView($viewName): string
    {
        return 'render content';
    }

    public function renderNotFound(): string
    {
        return '404: Not Found';
    }
}