<?php

namespace App\View\Components;

class Head extends Component
{
    protected string $title;

    protected string $charset;

    protected string $viewport;

    protected string $keywords;

    protected string $description;

    protected string $author;

    protected string $robots;

    protected string $favicon;

    protected string $cssApp;

    protected string $jsApp;

    protected string $themeLink;

    protected string $bs_css;

    protected string $bs_js;

    protected string $jquery;

    /**
     * Create a new component instance.
     * 
     * @param ?string $title Название страницы
     *
     * @return void
     */
    public function __construct(?string $title = null, ?string $description = null, ?string $keywords = null)
    {
        parent::__construct();
        
        $this->title = $title ?? config("view.title");
        $this->charset = config("view.charset");
        $this->viewport = config("view.viewport");
        $this->keywords = $keywords ?? config("view.keywords");
        $this->description = $description ?? config("view.description");
        $this->author = config("view.author");
        $this->robots = config("view.robots");
        $this->favicon = url(config("view.favicon"));
        $this->cssApp = config("view.css_app");
        $this->jsApp = config("view.js_app");
        $this->bs_css = config("view.bs_css");
        $this->bs_js = config("view.bs_js");
        $this->jquery = config("view.jquery");

        $this->themeLink = config("theme.directory") . "/" . $this->theme . config("view.css_extension");
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.head', 
        [
            "title" => $this->title, 
            "charset" => $this->charset, 
            "viewport" => $this->viewport, 
            "keywords" => $this->keywords, 
            "description" => $this->description, 
            "author" => $this->author, 
            "robots" => $this->robots, 
            "favicon" => $this->favicon, 
            "css_app" => $this->cssApp, 
            "js_app" => $this->jsApp, 
            "bs_css" => $this->bs_css, 
            "bs_js" => $this->bs_js, 
            "jquery" => $this->jquery, 
            "theme" => $this->themeLink, 
        ]);
    }
}
