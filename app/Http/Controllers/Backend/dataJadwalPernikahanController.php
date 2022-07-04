<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\http\Models\dataJadwalPernikahan;
use App\User;
use Illuminate\Http\Request;

class dataJadwalPernikahanController extends Controller
{
    public function index()
    {
        $jadwalPernikahan = dataJadwalPernikahan::all();
        return view('page.dataJadwalPernikahan.index', compact('jadwalPernikahan'));
    }

    public function create()
    {
        $user = User::all();
        return view('page.dataJadwalPernikahan.create',  compact('user'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'user_id' => 'required|max:10',
            'tanggal_pernikahan' => 'required|max:10',
            'jam_pernikahan' => 'required|max:10',
            'tempat' => 'required|max:30',
        ]);

        $jadwalPernikahan = dataJadwalPernikahan::create($request->all());
        $jadwalPernikahan->user_id = $validate['user_id'];
        $jadwalPernikahan->tanggal_pernikahan = $validate['tanggal_pernikahan'];
        $jadwalPernikahan->jam_pernikahan = $validate['jam_pernikahan'];
        $jadwalPernikahan->tempat = $validate['tempat'];
        if (!$jadwalPernikahan) {
            toastr()->error('Data has been not saved');
            return redirect('/dashboard/data/jadwal-pasangan');
        } else {
            toastr()->success('Data has been saved successfully!');
            return redirect('/dashboard/data/jadwal-pasangan');
        }
    }

    public function delete($id)
    {
        if (!$id) {
            toastr()->error('Data not found');

        } else {
            $jadwalPernikahan = dataJadwalPernikahan::where('id', $id)->first();
            if ($jadwalPernikahan) {
                $jadwalPernikahan->delete();
                toastr()->success('Data has been delete successfully!');
                return redirect()->back();
            }
        }
    }
}
