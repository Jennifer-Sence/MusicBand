<?php

namespace App\Http\Controllers;

use App\Models\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    public function index()
    {

        $bandas = Band::all();
        //dd($bandas);
        foreach ($bandas as $band) {

            $band->albums_count = DB::table('albuns')->where('albuns.band_id', $band->id)->count();
        }

        return view('bands', ['bandas' => $bandas]);
    }

    public function create()
    {
        return view('bands.createbands');
    }

    public function store(Request $request)
    {
        // Validar os dados de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = Storage::putFile('uploadImages', $request->photo);
        }

        $banda = new Band;
        $banda->name = $request->name;
        $banda->photo = $photo;
        $banda->save();

        return redirect('/home')->with('msg', 'Banda criada com sucesso!');
    }


    public function editOrUpdate(Request $request, $id)
    {
        $banda = Band::findOrFail($id);

        if ($request->isMethod('post')) {

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($request->hasFile('photo')) {
                // Apagar a imagem antiga se existir
                if ($banda->photo) {
                    Storage::disk('public')->delete($banda->photo);
                }

                // Fazer upload da nova imagem
                $photoPath = $request->file('photo')->store('band_photos', 'public');
                $banda->photo = $photoPath;
            }

            $banda->name = $request->name;
            $banda->albums_count = $request->albums_count;
            $banda->save();

            return redirect('/home')->with('msg', 'Banda atualizada com sucesso!');
        }

        return view('bands.editbands', compact('banda'));
    }

    public function deleteBand($id)
    {
        DB::table('albuns')->where('band_id', $id)->delete();
        DB::table('bandas')->where('id', $id)->delete();

        return redirect()->route('band.index');

    }


}
