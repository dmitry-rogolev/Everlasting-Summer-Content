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

    /**
     * Create a new component instance.
     * 
     * @param ?string $title Название страницы
     *
     * @return void
     */
    public function __construct(?string $title = null)
    {
        parent::__construct();
        
        $this->title = $title ?? config("view.title");
        $this->charset = config("view.charset");
        $this->viewport = config("view.viewport");
        $this->keywords = config("view.keywords");
        $this->description = config("view.description");
        $this->author = config("view.author");
        $this->robots = config("view.robots");
        $this->favicon = url(config("view.favicon"));
        $this->cssApp = url(config("view.css_app"));
        $this->jsApp = url(config("view.js_app"));

        $this->themeLink = url(config("theme.directory") . "/" . $this->theme . ".css");
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
            "theme" => $this->themeLink, 
        ]);
    }
}
