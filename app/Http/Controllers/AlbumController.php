<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function showAlbums(Band $band)
    {
        $albums = Album::where('band_id', $band->id)->get();
        return view('albuns', compact('band', 'albums'));
    }

    public function createAlbum(Band $band)
    {
        return view('albuns.createalbuns', compact('band'));
    }

    public function storeAlbum(Request $request)
    {
        // Validar os dados de entrada
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'band_id' => 'required|integer',
            'cover_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $cover_url = null;
        if ($request->hasFile('cover_url')) {
            $cover_url = Storage::putFile('uploadImagesAlbum', $request->cover_url);
        }

        $album = new Album();
        $album->title = $request->title;
        $album->band_id = $request->band_id;
        $album->cover_url = $cover_url;
        $album->save();

        return redirect('/home')->with('msg', 'Album criado com sucesso!');
    }


    public function deleteAlbum($id)
    {
        $album = Album::findOrFail($id);
        if ($album->cover_url) {
            Storage::disk('public')->delete($album->cover_url);
        }
        $bandId = $album->band_id;
        $album->delete();

        return redirect()->route('albuns.show', $bandId)->with('msg', 'Álbum apagado com sucesso!');
    }


    public function editOrUpdate(Request $request, $id)
{
    $album = Album::findOrFail($id);

    if ($request->isMethod('post')) {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'band_id' => 'required|integer',
            'cover_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'release_date'=>'nullable'
        ]);

        if ($request->hasFile('cover_url')) {
            // Apagar a imagem antiga se existir
            if ($album->cover_url) {
                Storage::disk('public')->delete($album->cover_url);
            }

            // Fazer upload da nova imagem
            $coverPath = $request->file('cover_url')->store('band_photos', 'public');
            $album->cover_url = $coverPath;
        }

        $album->title = $request->title;
        $album->band_id = $request->band_id;
        $album->release_date = $request->release_date;
        $album->save();

        return redirect('/home')->with('msg', 'Álbum atualizado com sucesso!');
    }

    return view('albuns.editaalbuns', compact('album'));

}



}




