<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    private $animals = [];

    public function __construct()
    {
        $this->animals = ['Kucing', 'Ayam', 'Ikan'];
    }

    public function index()
    {
        $output = "";
        foreach ($this->animals as $animal) {
            $output .= $animal . "\n";
        }
        return $output;
    }

    public function store(Request $request)
    {
        $newAnimal = $request->name;
        array_push($this->animals, $newAnimal);
        
        $output = "";
        foreach ($this->animals as $animal) {
            $output .= $animal . "\n";
        }
        return $output;
    }

    public function update(Request $request, $id)
    {
    $newName = $request->get('name');

    
    if (isset($this->animals[$id])) {
        
        $this->animals[$id] = $newName;

        $output = "";
        foreach ($this->animals as $animal) {
            $output .= $animal . "\n";
        }

        return $output;
        }
    }


    public function destroy($id)
    {
    if (isset($this->animals[$id])) {
        unset($this->animals[$id]);
        $this->animals = array_values($this->animals);

        $output = "";
        foreach ($this->animals as $animal) {
            $output .= $animal . "\n";
        }
        return $output;
        }
    }

}