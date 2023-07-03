<?php

namespace App\Http\Requests\Playlist;

use App\Http\Requests\ApiRequest;

class ShowPlaylistRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'with' => ['nullable'],
        ];
    }
}
