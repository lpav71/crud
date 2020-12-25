<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Image;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\jsonarr
     */
    public function index()
    {

        //$notes = Note::orderBy('id', 'desc')->paginate(10);
        $notes = Note::all();

        return view('index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     *.;/esd
     * @return \Illuminate\Http\jsonarr
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\jsonarr
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $note = new Note();

        $name = $request->name;
        $artikul = $request->artikul;
        $note->name = $name;
        $note->artikul = $artikul;
        $note->save();
        $note = $note::latest()->first();

        for ($i = 1; $i < 10; $i++)
        {
            $image = new Image();
            $iim = 'image'.$i;
            $file = $request->file($iim);
            if ($file != null) {
                $file->move(public_path() . '/img', $file->getClientOriginalName());
                $img = $file->getClientOriginalName();
                $image->img = $img;
                $note->images()->save($image);
            }
        }

        return redirect('note');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\jsonarr
     */
    public function show($id)
    {
        $note = Note::find($id);

        $images = $note->images;
        return view('show', ['note' => $note, 'images' => $images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\jsonarr
     */
    public function edit($id)
    {
        $note = Note::find($id);
        $images = $note->images;
        return view('edit', ['note' => $note, 'images' => $images]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\jsonarr
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $note = Note::find($id);
        //$image = new Image();
        $note->name = $request->name;
        $note->artikul = $request->artikul;
        $note->save();

        $arr = array();

        for ($i = 1; $i <= $request->summ; $i++) {
            $im = 'image' . $i;
            $id_im = 'id_img' . $i;
            $file = $request->file($im);
            if ($file != null) {
                $file->move(public_path() . '/img', $file->getClientOriginalName());
                $img = $file->getClientOriginalName();
                //$id_image = $request->id_im;

                $a = $request->input();

                $image = Image::find($a[$id_im]);
                $image->img = $img;
                $note->images()->save($image);

            }
        }

        return redirect('note');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\jsonarr
     */
    public function destroy($id)
    {
        $note = Note::find($id);

        $note->delete();

        return redirect('note');
    }

    public function json($id)
    {
        $note = Note::find($id);
        $jsonarr = array(
            'name' => $note->name,
            'artikul' => $note->artikul,
            'imgarr' => array()
        );

        $images = $note->images;
        $i=0;
        foreach($images as $image)
        {
            $jsonarr['imgarr'][$i] = $image->img;
            $i++;
        }

        $json = json_encode($jsonarr, JSON_UNESCAPED_UNICODE);

        header("Content-Type: application/json");
        echo $json;
    }
}
