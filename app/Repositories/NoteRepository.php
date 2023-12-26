<?php

namespace App\Repositories;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteRepository extends Repository
{
    public function model()
    {
        return Note::class;
    }

    public function storeByRequest(Request $request, $model)
    {
        return $this->query()->create([
            'notable_type' => get_class($model),
            'notable_id' => $model->id,
            'note' => $request->get('note')
        ]);
    }
}
