<?php

# membuat class Animal
class Animal
{
    # property animals
    private $animals;

    # method constructor - mengisi data awal
    # parameter: data hewan (array)
    public function __construct($data) {
        $this->animals = $data; // Mengisi data awal
    }

    # method index - menampilkan data animals
    public function index()
    {
        # gunakan foreach untuk menampilkan data animals (array)
        foreach ($this->animals as $animal) {
            echo $animal . "<br>"; // Menampilkan setiap hewan
        }
    }

    # method store - menambahkan hewan baru
    # parameter: hewan baru
    public function store($data)
    {
        # gunakan method array_push untuk menambahkan data baru
        array_push($this->animals, $data); // Menambahkan hewan baru ke dalam array
    }

    # method update - mengupdate hewan
    # parameter: index dan hewan baru
    public function update($index, $data) {
        if (isset($this->animals[$index])) {
            $this->animals[$index] = $data; // Mengupdate hewan pada index yang ditentukan
        } else {
            echo "Hewan tidak ditemukan pada index $index.<br>"; // Pesan jika index tidak ada
        }
    }

    # method delete - menghapus hewan
    # parameter: index
    public function destroy($index)
    {
        # gunakan method unset atau array_splice untuk menghapus data array
        if (isset($this->animals[$index])) {
            unset($this->animals[$index]); // Menghapus hewan pada index yang ditentukan
            $this->animals = array_values($this->animals); // Mengatur ulang indeks array
        } else {
            echo "Hewan tidak ditemukan pada index $index.<br>"; // Pesan jika index tidak ada
        }
    }
}

# membuat object
# kirimkan data hewan (array) ke constructor
$animal = new Animal(['Kucing', 'Anjing']);

echo "Index - Menampilkan seluruh hewan <br>";
$animal->index();
echo "<br>";

echo "Store - Menambahkan hewan baru <br>";
$animal->store('Burung');
$animal->index();
echo "<br>";

echo "Update - Mengupdate hewan <br>";
$animal->update(0, 'Kucing Anggora');
$animal->index();
echo "<br>";

echo "Destroy - Menghapus hewan <br>";
$animal->destroy(1); // Menghapus 'Anjing'
$animal->index();
echo "<br>";
?>
