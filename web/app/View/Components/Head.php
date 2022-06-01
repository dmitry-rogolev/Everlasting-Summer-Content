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

    protected string $font;

    protected string $cssApp;

    protected string $cssBs;

    protected string $cssBsIntegrity;

    protected string $jq;

    protected string $jqIntegrity;

    protected string $jsBs;

    protected string $jsBsIntegrity;

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
        $this->font = config("view.font");
        $this->cssApp = url(config("view.css_app"));
        $this->cssBs = config("view.css_bs");
        $this->cssBsIntegrity = config("view.css_bs_integrity");
        $this->jq = config("view.jq");
        $this->jqIntegrity = config("view.jq_integrity");
        $this->jsBs = config("view.js_bs");
        $this->jsBsIntegrity = config("view.js_bs_integrity");

        $this->themeLink = url(config("view.theme_directory") . "/" . $this->theme . ".css");
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
            "font" => $this->font, 
            "css_app" => $this->cssApp, 
            "css_bs" => $this->cssBs, 
            "css_bs_integrity" => $this->cssBsIntegrity, 
            "jq" => $this->jq, 
            "jq_integrity" => $this->jqIntegrity, 
            "js_bs" => $this->jsBs, 
            "js_bs_integrity" => $this->jsBsIntegrity, 
            "theme" => $this->themeLink, 
        ]);
    }
}
