@extends('masterBackend')
@section('title', 'DATA | CREATE JADWAL PERNIKAHAN')


@section('backend')
    <style>
        .card-content {
            margin-top: 5rem;
        }
    </style>

    <div class="container card-content">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Jadwal Pernikahan</h6>
            </div>
            <div class="container-fluid mt-4 mb-4">
                <form method="POST" action="{{ route('data-store-jadwal-pernikahan') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label mb-1">Nama Penghulu</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01" name="user_id">
                                        <option selected>Pilih Option</option>
                                        @foreach ($user as $item)
                                            @if ($item->user_role === 'Penghulu')
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label mb-1">Nama Pasangan</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01" name="pasangan_id">
                                        <option selected>Pilih Option</option>
                                        @foreach ($pasangan as $item)
                                            @if ($item->status_pernikahan === 'Belum Menikah')
                                                <option value="{{ $item->id }}" class="text-bold">
                                                    <strong>Pria :</strong> {{ $item->nama_pria }} - <strong>Wanita :
                                                    </strong>{{ $item->nama_wanita }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('pasangan_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Tanggal Pernikahan</label>
                                <input type="date" class="form-control" name="tanggal_pernikahan" required>
                                @error('tanggal_pernikahan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Jam Mulai</label>
                                <input type="time" class="form-control" name="jam_mulai" required>
                                @error('jam_mulai')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Jam Selesai</label>
                                <input type="time" class="form-control" name="jam_selesai" required>
                                @error('jam_selesai')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tempat</label>
                                <textarea name="tempat" id="" class="form-control"cols="30" rows="10" required></textarea>
                                @error('tempat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 disabled">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="status" value="Rejected" required>
                            </div>
                        </div>
                        <div class="col-lg-6 disabled">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="status_arsip" value="-" required>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Data yang di masukan sudah benar ?')">Submit</button>
                        <a href="{{ route('data-jadwal-pasangan') }}" type="submit" class="btn btn-dark">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
