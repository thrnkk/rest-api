<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\User;
use App\Http\Requests;
use Session;
use App\Http\Controllers\Controller;

class AnimalController extends Controller
{

    public function __construct(Animal $animals, User $users){
        $this->animals = $animals;
        $this->users = $users;
    }

    public function index()
    {

        $animals = $this->animals->orderBy("id")->get();
        return response()->json($animals, 200);

    }

    public function show($id)
    {
        $animal = $this->animals->find($id);

        if(!$animal) {
            return response()->json(['message' => 'Registro não encontrado.'], 404);
        }

        return response()->json($animal, 200);
    }

    public function store(Request $request)
    {

        if (Session::get('user')) {

            $animal = new Animal();
            $animal->fill($request->all());
            $animal->save();

            return response()->json($animal, 201);

        } else {

            return response()->json([
                'message'   => 'Sem permissão.',
            ], 404);

        }

        
    }

    public function update(Request $request, $id)
    {

        if (Session::get('user')) {

            $animal = $this->animals->find($id);

            if(!$animal) {
                return response()->json([
                    'message'   => 'Registro não encontrado.',
                ], 404);
            }

            $animal->fill($request->all());
            $animal->save();

            return response()->json($animal, 200);

        } else {

            return response()->json([
                'message'   => 'Sem permissão.',
            ], 404);

        }

    }

    public function destroy($id)
    {
        $animal = $this->animals->find($id);

        if(!$animal) {
            return response()->json([
                'message'   => 'Registro não encontrado.',
            ], 404);
        }

        $animal->delete();
    }

    public function orderByBreed()
    {

    	$animals = $this->animals->orderBy("breed")->get();
        return response()->json($animals, 200);

    }

    public function orderByAlphabeticOrder()
    {

    	$animals = $this->animals->orderBy("name")->get();
        return response()->json($animals, 200);

    }

    public function setCustomers($animalId, $customerId)
    {

        $customer = $this->customers->find($customerId);
        $animal = $this->animals->find($animalId);

        if(!$customer) {
            return response()->json([
                'message'   => 'Cliente não encontrado.',
            ], 404);
        }

        if(!$animal) {
            return response()->json([
                'message'   => 'Animal não encontrado.',
            ], 404);
        }

        $animal->animals()->attach($customer);

        return response()->json($animal, 200);

    }

}
