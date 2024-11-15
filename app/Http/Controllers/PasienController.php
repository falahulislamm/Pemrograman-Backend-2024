<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
// SHOW
    // Menampilkan detail pasien berdasarkan ID
    public function show($id) {
        $pasien = Pasien::find($id); // Mencari pasien berdasarkan ID

        if ($pasien) {
            $data = [
                'message' => 'Get Detail Pasien', // Pesan sukses
                'data' => $pasien, // Data pasien yang ditemukan
            ];

            return response()->json($data, 200); // Mengembalikan respons JSON dengan status 200
        }

        else {
            $data = [
                'message' => 'Pasien not found', // Pesan jika pasien tidak ditemukan
            ];

            return response()->json($data, 404); // Respons JSON dengan status 404
        }
    }



// INDEX
    // Menampilkan semua data pasien
    public function index() {
        $pasiens = Pasien::all(); // Mengambil semua data pasien dari database

        if ($pasiens) {
            $data = [
                'message' => 'Get all pasiens', // Pesan sukses
                'data' => $pasiens, // Data semua pasien
            ];

        } else {
            $data = [
                'message' => 'Data is empty', // Pesan jika tidak ada data pasien
            ];
        }

        return response()->json($data, 200); // Mengembalikan respons JSON dengan status 200
    }



// STORE 
    // Menambahkan data pasien baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ // Validasi data input
            'name' => 'required', // Kolom name harus diisi
            'phone' => 'numeric|required', // Kolom phone harus angka dan wajib diisi
            'address' => 'required', // Kolom address harus diisi
            'status' => 'required', // Kolom status harus diisi
            'in_date_at' => 'date|required', // Kolom in_date_at harus berupa tanggal dan wajib diisi
            'out_date_at' => 'date|required' // Kolom out_date_at harus berupa tanggal dan wajib diisi
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors', // Pesan error jika validasi gagal
                'errors' => $validator->errors() // Detail error validasi
            ], 422);
        }

        $pasien = Pasien::create($request->all()); // Menyimpan data pasien baru ke database

        $data = [
            'message' => 'Pasien is added successfully', // Pesan sukses
            'data' => $pasien // Data pasien yang baru ditambahkan
        ];
        return response()->json($data, 201); // Respons JSON dengan status 201 (created)
    }



// UPDATE 
    // Mengupdate data pasien berdasarkan ID
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([ // Validasi data input yang akan diupdate
            'name' => 'sometimes|string|max:255', // Kolom name opsional, harus string, max 255 karakter
            'phone' => 'sometimes|string|max:15', // Kolom phone opsional, harus string, max 15 karakter
            'address' => 'sometimes|string|max:255', // Kolom address opsional, harus string, max 255 karakter
            'status' => 'sometimes|string|max:100', // Kolom status opsional, harus string, max 100 karakter
            'in_date_at' => 'sometimes|date', // Kolom in_date_at opsional, harus berupa tanggal
            'out_date_at' => 'sometimes|date|after_or_equal:in_date_at', // Kolom out_date_at opsional, harus tanggal setelah atau sama dengan in_date_at
        ]);

        $pasien = Pasien::find($id); // Mencari pasien berdasarkan ID

        if (!$pasien) {
            return response()->json(['message' => 'Pasien not found'], 404); // Respons jika pasien tidak ditemukan
        }

        $pasien->update($validatedData); // Update data pasien

        $data = [
            'message' => 'Pasien is updated successfully', // Pesan sukses
            'data' => $pasien, // Data pasien yang sudah diupdate
        ];

        return response()->json($data, 200); // Respons JSON dengan status 200
    }



// DESTROY
    // Menghapus data pasien berdasarkan ID
    public function destroy($id)
    {
        $pasien = Pasien::find($id); // Mencari pasien berdasarkan ID

        if (!$pasien) {
            return response()->json(['message' => 'Pasien not found'], 404); // Respons jika pasien tidak ditemukan
        }

        $pasien->delete(); // Menghapus data pasien

        return response()->json(['message' => 'Pasien is delete successfully'], 200); // Respons sukses
    }



// SEARCH BY NAME
    // Mencari pasien berdasarkan nama
    public function search_name($name) {
        $pasien = Pasien::where('name', $name)->first(); // Mencari pasien dengan nama yang cocok

        if ($pasien) {
            $data = [
                'message' => 'Get searched name', // Pesan sukses
                'data' => $pasien, // Data pasien yang ditemukan
            ];

            return response()->json($data, 200); // Respons sukses
        }

        else {
            $data = [
                'message' => 'Name not found', // Pesan jika nama tidak ditemukan
            ];

            return response()->json($data, 404); // Respons jika tidak ditemukan
        }
    }



    // Mengambil data pasien dengan status "Positive"
    public function getPositiveResources()
    {
        $positives = Pasien::where('status', 'Positive')->get(); // Ambil semua pasien dengan status Positive
    
        $total = $positives->count(); // Hitung jumlah pasien Positive
    
        $data = [
            'message' => 'Get positive pasien', // Pesan sukses
            'total' => $total, // Total pasien Positive
            'data' => $positives, // Data pasien Positive
        ];
    
        return response()->json($data, 200); // Respons sukses
    }


    // Mengambil data pasien dengan status "Recovered"
    public function getRecoveredResources()
    {
        $recovered = Pasien::where('status', 'Recovered')->get(); // Ambil semua pasien dengan status Recovered
    
        $total = $recovered->count(); // Hitung jumlah pasien Recovered
    
        $data = [
            'message' => 'Get recovered pasien', // Pesan sukses
            'total' => $total, // Total pasien Recovered
            'data' => $recovered, // Data pasien Recovered
        ];
    
        return response()->json($data, 200); // Respons sukses
    }



    // Mengambil data pasien dengan status "Dead"
    public function getDeadResources()
    {
        $Deads = Pasien::where('status', 'Dead')->get(); // Ambil semua pasien dengan status Dead
    
        $total = $Deads->count(); // Hitung jumlah pasien Dead
    
        $data = [
            'message' => 'Get dead pasien', // Pesan sukses
            'total' => $total, // Total pasien Dead
            'data' => $Deads, // Data pasien Dead
        ];
    
        return response()->json($data, 200); // Respons sukses
    }
}