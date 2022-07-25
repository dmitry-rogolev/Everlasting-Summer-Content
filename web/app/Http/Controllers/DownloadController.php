<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Download;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Russsiq\Zipper\Facades\Zipper;

class DownloadController extends Controller
{
    public function download(Request $request, Folder|Content $model)
    {
        if ($model instanceof Content)
            return $this->downloadContent($model);

        else if ($model instanceof Folder)
            return $this->downloadFolder($model);

        return back();
    }

    public function downloadFavorites(Request $request)
    {
        $favorites = $request->user()->favorites;

        if ($favorites->count())
        {
            $name = Str::random(60);

            $zip = Zipper::create(storage_path("app/tmp/" . $name . ".zip"));

            foreach ($favorites as $favorite)
            {
                $path = $favorite->content->path;

                $path = $path ? $path . "/" : "";

                $zip->addFile(storage_path("app/public/contents/" . $favorite->content->user_id . "/" . $path . $favorite->content->name), $favorite->content->name);
            }

            $zip->close();

            return response()->download(storage_path("app/tmp/" . $name . ".zip"), __("page.favorite.favorite") . ".zip")->deleteFileAfterSend();
        }

        return back();
    }

    private function downloadContent(Content $content)
    {
        Download::create([
            "user_id" => request()->user() ? request()->user()->id : null, 
            "content_id" => $content->id, 
        ]);
        
        $path = $content->path;

        $path = $path ? $path . "/" : "";
        
        return response()->download(storage_path("app/public/contents/" . $content->user_id . "/" . $path . $content->name), $content->name);
    }

    public function downloadFolder(Folder $folder)
    {
        $path = $folder->path;

        $name = Str::random(60);

        $zip = Zipper::create(storage_path("app/tmp/" . $name . ".zip"));

        $zip->addDirectory(storage_path("app/public/contents/" . $folder->user_id . "/" . $path), $folder->title ?: $folder->user->name);

        $zip->close();

        return response()->download(storage_path("app/tmp/" . $name . ".zip"), ($folder->title ?: $folder->user->name) . ".zip")->deleteFileAfterSend();
    }
}
