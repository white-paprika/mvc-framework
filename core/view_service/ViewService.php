<?php
namespace app\core\view_service;

interface ViewService
{
    public function getViewContent(string $viewName): string;


    public function getLayoutContent(string $layoutName): string;


    public function getRelatedLayoutName($viewName): string;


    public function injectViewToLayout($viewContent, $layoutContent): string;


    public function renderView($viewName): string;
    
}