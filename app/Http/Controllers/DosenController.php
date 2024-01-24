<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Http\Resources\DosenResource;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Dosen::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('nidn2010054', 'LIKE', "%{$search}%")
                ->orWhere('namalengkap2010054', 'LIKE', "%{$search}%");
        }
        $dosen = $query->paginate(10);
        return DosenResource::collection($dosen);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nidn2010054' => 'required|unique:dosen2010054,nidn2010054|min:7|max:7',
            'namalengkap2010054' => 'required|max:100',
            'jenkel2010054' => 'required|in:L,P',
            'tmp_lahir2010054' => 'required|max:100',
            'tgl_lahir2010054' => 'required|date',
            'alamat2010054' => 'required',
            'notelp2010054' => 'required|numeric',
        ], [
            'nidn2010054.required' => ':atribut tidak boleh kosong',
            'nidn2010054.unique' => ':atribut sudah ada',
            'nidn2010054.min' => ':Minimal 7 Karakter',
            'nidn2010054.max' => ':Maximal 7 Karakter',
            'namalengkap2010054.required' => ':atribut tidak boleh kosong',
            'jenkel2010054.required' => ':atribut tidak boleh kosong',
            'tmp_lahir2010054.required' => ':atribut tidak boleh kosong',
            'tgl_lahir2010054.required' => ':atribut tidak boleh kosong',
            'alamat2010054.required' => ':atribut tidak boleh kosong',
            'notelp2010054.required' => ':atribut tidak boleh kosong',
        ], [
            'nidn2010054' => 'No.Induk Dosen',
            'namalengkap2010054' => 'No.Induk Dosen',
            'jenkel2010054' => 'Jenis Kelamin',
            'tmp_lahir2010054' => 'Tempat Lahir',
            'tgl_lahir2010054' => 'Tanggal Lahir',
            'alamat2010054' => 'Alamat',
            'notelp2010054' => 'No.Telpon',

        ]);
        $dosen = Dosen::create($data);

        return new DosenResource($dosen);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $nidn2010054)
    {
        $dosen = Dosen::find($nidn2010054);
        if (!$dosen) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($dosen);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nidn2010054)
    {
        $dosen = Dosen::find($nidn2010054);
        if (!$dosen) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        $data = $request->validate([
            'namalengkap2010054' => 'required|max:100',
            'jenkel2010054' => 'required|in:L,P',
            'tmp_lahir2010054' => 'required|max:100',
            'tgl_lahir2010054' => 'required|date',
            'alamat2010054' => 'required',
            'notelp2010054' => 'required|numeric',
        ]);

        $dosen->update($data);

        return response()->json($dosen, 200);


    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nidn2010054)
    {
        $dosen = Dosen::find($nidn2010054);

        if (!$dosen) {
            return response()->json(['Message' => 'Data ndak ado'], 404);
        }

        $dosen->delete();

        return response()->json(['message' => 'Data alah tahapuih'], 200);

    }

    public function uploadImage(Request $request, $nidn2010054)
    {
        $dosen = Dosen::find($nidn2010054);
        if (!$dosen) {
            return response()->json([
                'message' => 'Data Tidak Ditemukan'
            ], 404);
        }

        $validateData = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            if ($dosen->foto && file_exists(public_path($dosen->foto))) {
                unlink(public_path($dosen->foto));
                unlink(public_path($dosen->foto_thumb));
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

            $dosen->foto = '/images/' . $fileName;
            $dosen->foto_thumb = '/images/thumb/' . $fileName_thumb;

            $dosen->save();
            return response()->json(['message' => 'Berhasil upload gambar', 'data' => $dosen], 200);

        }

        return response()->json(['message' => 'Gambar kosong'], 400);
    }
}
