<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\http\Models\dataJadwalPernikahan;
use App\Http\Models\dataPasangan;
use App\User;
use Exception;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $pasangan = dataPasangan::all();
        $jadwal = dataJadwalPernikahan::all();

        return view('page.dataJadwalPernikahan.create',  compact('user', 'pasangan'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'user_id' => 'required|max:10',
            'pasangan_id' => 'required|max:50',
            'tanggal_pernikahan' => 'required|max:10',
            'jam_mulai' => 'required|max:10',
            'jam_selesai' => 'required|max:10',
            'tempat' => 'required|max:100',
            'status' => 'required|max:40',
            'status_arsip' => 'required|max:10',
        ]);
        $check = dataJadwalPernikahan::where('user_id', $request->user_id)
            ->where('tanggal_pernikahan', [$request->tanggal_pernikahan])
            ->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])->count();

        $check1 = dataJadwalPernikahan::where('user_id', $request->user_id)
            ->where('tanggal_pernikahan', [$request->tanggal_pernikahan])
            ->whereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])->count();

        if ($check != 0 || $check1 != 0) {
            toastr()->error('Jadwal Bentrok');
            return redirect('/dashboard/data/jadwal-pasangan');
        }

        $jadwalPernikahan = dataJadwalPernikahan::create($request->all());
        $jadwalPernikahan->user_id = $validate['user_id'];
        $jadwalPernikahan->tanggal_pernikahan = $validate['tanggal_pernikahan'];
        $jadwalPernikahan->jam_mulai = $validate['jam_mulai'];
        $jadwalPernikahan->jam_selesai = $validate['jam_selesai'];
        $jadwalPernikahan->tempat = $validate['tempat'];
        $jadwalPernikahan->pasangan_id = $validate['pasangan_id'];
        $jadwalPernikahan->status = $validate['status'];
        $jadwalPernikahan->status_arsip = $validate['status_arsip'];
        if (!$jadwalPernikahan) {
            toastr()->error('Data has been not saved');
            return redirect('/dashboard/data/jadwal-pasangan');
        } else {
            toastr()->success('Data has been saved successfully!');
            return redirect('/dashboard/data/jadwal-pasangan');
        }
    }

    public function edit($id)
    {
        $data = dataJadwalPernikahan::find($id);
        $user = User::all();
        $pasangan = dataPasangan::all();
        return View('page.dataJadwalPernikahan.edit', compact('data', 'user', 'pasangan'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'user_id' => 'required|max:10',
            'pasangan_id' => 'required|max:50',
            'tanggal_pernikahan' => 'required|max:10',
            'jam_mulai' => 'required|max:10',
            'jam_selesai' => 'required|max:10',
            'tempat' => 'required|max:100',
            'status' => 'required|max:40',
            'status_arsip' => 'required|max:10',
        ]);
        $check = dataJadwalPernikahan::where('user_id', $request->user_id)
            ->where('tanggal_pernikahan', [$request->tanggal_pernikahan])
            ->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])->count();

        $check1 = dataJadwalPernikahan::where('user_id', $request->user_id)
            ->where('tanggal_pernikahan', [$request->tanggal_pernikahan])
            ->whereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])->count();

        if ($check != 0 || $check1 != 0) {
            toastr()->error('Jadwal Bentrok');
            return redirect('/dashboard/data/jadwal-pasangan');
        }
        $id = $request->id;
        $data = dataJadwalPernikahan::find($id);
        $data->user_id = $validate['user_id'];
        $data->tanggal_pernikahan = $validate['tanggal_pernikahan'];
        $data->jam_mulai = $validate['jam_mulai'];
        $data->jam_selesai = $validate['jam_selesai'];
        $data->tempat = $validate['tempat'];
        $data->pasangan_id = $validate['pasangan_id'];
        $data->status = $validate['status'];
        $data->status_arsip = $validate['status_arsip'];
        $data->save();
        if (!$data) {
            toastr()->error('Data has been not saved');
            return redirect('/dashboard/data/jadwal-pasangan');
        } else {
            toastr()->success('Data has been saved successfully!');
            return redirect('/dashboard/data/jadwal-pasangan');
        }
    }

    public function approved(Request $request, $id)
    {
        $jadwal = dataJadwalPernikahan::find($id);
        DB::transaction(function () use ($jadwal) {
            try {
                $jadwal->no_akta = '-';
                $jadwal->status = 'Approved';
                $jadwal->status_arsip = 'Data Belum di arsip';
                $jadwal->save();

                $data = dataPasangan::find($jadwal->pasangan_id);
                $data->status_pernikahan = 'Sudah Menikah';
                $data->save();
            } catch (Exception $e) {
                $e->getMessage();
            }
        });

        toastr()->success('Data has been Approved successfully!');
        return redirect()->back();
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
