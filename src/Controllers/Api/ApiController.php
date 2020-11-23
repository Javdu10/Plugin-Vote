<?php

namespace Azuriom\Plugin\Vote\Controllers\Api;

use Illuminate\Http\Request;
use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Vote\Models\Pingback;
use Azuriom\Plugin\Vote\Verification\VoteChecker;

class ApiController extends Controller
{
    public function pingback(Request $request, string $site)
    {
        $checker = app(VoteChecker::class);
        $verifier = $checker->getVerificationForSite($site);

        return $verifier->executePingbackCallback($request) ?? response()->noContent();
    }
}
