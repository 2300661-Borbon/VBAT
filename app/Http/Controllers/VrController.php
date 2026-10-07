<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VrController extends Controller
{
    /**
     * Display the requested VR scene.
     */
    public function show($scene)
    {
        // List valid scene slugs
        $validScenes = [
            '1901-battle-of-batangas',
            '1988-the-sublian',
        ];

        // 1. If someone types an invalid URL, trigger a 404
        if (!in_array($scene, $validScenes)) {
            abort(404);
        }

        // 2. WHILE SCENES ARE IN DEVELOPMENT: Force 404 for all scenes
        abort(404);

        // 3. WHEN READY: Comment out abort(404) above and uncomment below:
        // return view('vr.show', ['scene' => $scene]);
    }
}