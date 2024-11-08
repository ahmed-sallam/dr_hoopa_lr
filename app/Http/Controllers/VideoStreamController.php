<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class VideoStreamController extends Controller
{
    public function stream(Request $request, $videoId)
    {
        //        if (!$request->hasValidSignature()) {
        //            abort(403, 'Unauthorized access');
        //        }

        //        $botToken = config('telegram.bot_token');
        $botToken = "7791850251:AAFR1qDGi0xIc6-hyJJrgaC5OWmiDEdiV5w";

        //        $fileInfo = Cache::remember("video_{$videoId}", 3600, function () use ($botToken, $videoId) {
        //            $response = Http::get("https://api.telegram.org/bot{$botToken}/getFile", [
        //                'file_id' => $videoId,
        //            ]);
        $response1 = Http::get("https://api.telegram.org/bot{$botToken}/getFile", [
            'file_id' => $videoId,
        ]);
        //        $response1 = Http::get("https://web.telegram.org/k/stream/%7B%22dcId%22%3A4%2C%22location%22%3A%7B%22_%22%3A%22inputDocumentFileLocation%22%2C%22id%22%3A%225852763942987765217%22%2C%22access_hash%22%3A%223666177878076749433%22%2C%22file_reference%22%3A%5B3%2C0%2C0%2C11%2C145%2C103%2C38%2C95%2C193%2C168%2C9%2C216%2C243%2C94%2C32%2C47%2C187%2C118%2C108%2C114%2C131%2C88%2C39%2C81%2C10%5D%7D%2C%22size%22%3A4986060%2C%22mimeType%22%3A%22video%2Fmp4%22%2C%22fileName%22%3A%22Mawjou%20from%20Al-Bala.mp4%22%7D");
        ////        https://api.telegram.org/bot7791850251:AAFR1qDGi0xIc6-hyJJrgaC5OWmiDEdiV5w/getFile?file_id=BAACAgQAAxkBAAMCZydEgwWT-lT-mDf2iNf7j-AbqCAAAuEVAALMMTlRFmJ8L-kTlyw2BA

        $fileInfo = $response1->successful() ? $response1->json()['result'] : null;

        if (!$fileInfo) {
            abort(404, 'Video not found');
        }

        $videoUrl = "https://api.telegram.org/file/bot{$botToken}/{$fileInfo['file_path']}";


        $response = Http::withOptions([
            'stream' => true,
            'verify' => true
        ])->get($videoUrl);

        return response()->stream(
            function () use ($response) {
                while ($chunk = $response->getBody()->read(1024)) {
                    echo $chunk;
                }
            },
            200,
            [
                'Content-Type' => 'video/mp4',
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Content-Disposition' => 'inline',
            ]
        );
    }
}
