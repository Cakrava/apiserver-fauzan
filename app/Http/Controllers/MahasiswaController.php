<?php

namespace App\Http\Controllers;

use App\Http\Resources\MahasiswaResource;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mahasiswa::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('nim_2010054', 'LIKE', "%{$search}%")
                ->orWhere('nama_lengkap_2010054', 'LIKE', "%{$search}%");
        }
        $mahasiswa = $query->paginate(10);
        return MahasiswaResource::collection($mahasiswa);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi request
        $data = $request->validate([
            'nim_2010054' => 'required|unique:mahasiswa_2010054,nim_2010054|min:7|max:7',
            'nama_lengkap_2010054' => 'required|max:100',
            'jenis_kelamin_2010054' => 'required|in:L,P',
            'tmp_lahir_2010054' => 'required|max:100',
            'tgl_lahir_2010054' => 'required|date',
            'alamat_2010054' => 'required',
            'notelp_2010054' => 'required|numeric',
        ], [
            'nim_2010054.required' => ':atribut tidak boleh kosong',
            'nim_2010054.unique' => ':atribut sudah ada',
            'nim_2010054.min' => ':Minimal 7 Karakter',
            'nim_2010054.max' => ':Maximal 7 Karakter',
            'nama_lengakap_2010054.required' => ':atribut tidak boleh kosong',
            'jenis_kelamin_2010054.required' => ':atribut tidak boleh kosong',
            'tmp_lahir_2010054.required' => ':atribut tidak boleh kosong',
            'tgl_lahir_2010054.required' => ':atribut tidak boleh kosong',
            'alamat_2010054.required' => ':atribut tidak boleh kosong',
            'notelp_2010054.required' => ':atribut tidak boleh kosong',
        ], [
            'nim_2010054' => 'No.Induk Mahasiswa',
            'nama_lengakap_2010054' => 'No.Induk Mahasiswa',
            'jenis_kelamin_2010054' => 'Jenis Kelamin',
            'tmp_lahir_2010054' => 'Tempat Lahir',
            'tgl_lahir_2010054' => 'Tanggal Lahir',
            'alamat_2010054' => 'Alamat',
            'notelp_2010054' => 'No.Telpon',

        ]);
        $mahasiswa = Mahasiswa::create($data);

        return new MahasiswaResource($mahasiswa);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nim_2010054)
    {
        $mahasiswa = Mahasiswa::find($nim_2010054);
        if (!$mahasiswa) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($mahasiswa);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nim_2010054)
    {
        $mahasiswa = Mahasiswa::find($nim_2010054);
        if (!$mahasiswa) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        $data = $request->validate([
            'nama_lengkap_2010054' => 'required|max:100',
            'jenis_kelamin_2010054' => 'required|in:L,P',
            'tmp_lahir_2010054' => 'required|max:100',
            'tgl_lahir_2010054' => 'required|date',
            'alamat_2010054' => 'required',
            'notelp_2010054' => 'required|numeric',
        ]);

        $mahasiswa->update($data);

        return response()->json($mahasiswa, 200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nim_2010054)
    {
        $mahasiswa = Mahasiswa::find($nim_2010054);

        if (!$mahasiswa) {
            return response()->json(['Message' => 'Data ndak ado'], 404);
        }

        $mahasiswa->delete();

        return response()->json(['message' => 'Data alah tahapuih'], 200);

    }

    public function uploadImage(Request $request, $nim_2010054)
    {
        $mahasiswa = Mahasiswa::find($nim_2010054);
        if (!$mahasiswa) {
            return response()->json([
                'message' => 'Data Tidak Ditemukan'
            ], 404);
        }

        $validateData = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            if ($mahasiswa->foto && file_exists(public_path($mahasiswa->foto))) {
                unlink(public_path($mahasiswa->foto));
                unlink(public_path($mahasiswa->foto_thumb));
            }

            $file = $request->file('foto');
            $fileName = time() . '-' . $file->getClientOriginalName();

            $file->move(public_path('images'), $fileName);

            $filePath = public_path('images') . '/' . $fileName;
            $fileName_thumb = 'thumb-' . $fileName;
            $thumbPath = public_path('images/thumb/' . $fileName_thumb);

            switch ($file->getClientOriginalExtension()) {
                case 'jpeg':
                    $resource = imagecreatefromjpeg($filePath);
                    break;
                case 'jpg':
                    $resource = imagecreatefromjpeg($filePath);
                    break;
                case 'png':
                    $resource = imagecreatefrompng($filePath);
                    break;
                default:
                    return response()->json(['message' => 'Format tidak didukung'], 400);
            }

            if (!$resource) {
                return response()->json(['message' => 'Gagal Memproses Gambar'], 500);
            }

            imagejpeg($resource, $thumbPath, 10);
            imagedestroy($resource);

            $mahasiswa->foto = '/images/' . $fileName;
            $mahasiswa->foto_thumb = '/images/thumb/' . $fileName_thumb;

            $mahasiswa->save();
            return response()->json(['message' => 'Berhasil upload gambar', 'data' => $mahasiswa], 200);

        }

        return response()->json(['message' => 'Gambar kosong'], 400);
    }

}
