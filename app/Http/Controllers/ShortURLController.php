<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessUrl;
use App\Models\Url;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShortURLController extends Controller
{
    //
    public function shortURL(Request $request)
    {
        $userUrl = $request->input('url');
        // generate string
        // save it to db
        $url = new Url();
        $url->address = $userUrl;
        $url->shortName = $this->randonStringGenerator(6);
        $url->save();
        // @TODO send the job (crawls html title) to the background
        ProcessUrl::dispatch($url);

        // returns to the user
        return config('app.url') . '/' . $url->shortName;

    }

    public function routeUrl($shortname, Request $request)
    {
        // find or fail
        $url = Url::where('shortName', '=', $shortname)->firstOrFail();
        $url->increment('visits');
        // redirect
        return new RedirectResponse($url->address);

    }

    public function topUrl()
    {
        $urls = Url::orderBy('visits', 'DESC')->take(100)->get();
        return view('topurl', ['urls' => $urls]);
    }

    private function randonStringGenerator($size)
    {
        return substr(md5(uniqid(mt_rand(), true)), 0, $size);
    }
}
