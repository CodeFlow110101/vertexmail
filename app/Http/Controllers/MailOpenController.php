<?php

namespace App\Http\Controllers;

use App\Events\MailSeen;
use App\Models\MailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;


class MailOpenController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {

        if (MailLog::find($id)) {
            MailLog::find($id)->update([
                'is_seen' => true,
            ]);
            MailSeen::dispatch($id);
        }

        $pixel = base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII='
        );

        return Response::make($pixel, 200, [
            'Content-Type' => 'image/png',
            'Content-Length' => strlen($pixel),
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
}
