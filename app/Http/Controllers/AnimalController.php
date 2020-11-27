<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Customer;
use App\Models\User;
use App\Http\Requests;
use Session;
use App\Http\Controllers\Controller;

class AnimalController extends Controller
{
    public function __construct(Animal $animals, User $users, Customer $customers){
        $this->animals = $animals;
        $this->customers = $customers;
        $this->users = $users;
    }

    public function index()
    {

        $animals = $this->animals->with('customers')->orderBy("id")->get();
        return response()->json($animals, 200);

    }

    public function show($id)
    {
        $animal = $this->animals->with('customers')->find($id);

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

            $animal = $this->animals->with('customers')->find($id);

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
        $animal = $this->animals->with('customers')->find($id);

        if(!$animal) {
            return response()->json([
                'message'   => 'Registro não encontrado.',
            ], 404);
        }

        $animal->delete();
    }

    public function orderByBreed()
    {

    	$animals = $this->animals->with('customers')->orderBy("breed")->get();
        return response()->json($animals, 200);

    }

    public function orderByAlphabeticOrder()
    {

    	$animals = $this->animals->with('customers')->orderBy("name")->get();
        return response()->json($animals, 200);

    }

    public function setCustomer($animalId, $customerId)
    {

        $customer = $this->customers->find($customerId);
        $animal = $this->animals->with('customers')->find($animalId);

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

        if ($animal->customers()->syncWithoutDetaching([$customer->id])) {
            return response()->json($customer, 200);
        }

        return response()->json([
                'message'   => 'Não foi possível cadastrar cliente.',
            ], 404);

    }

    public function deleteCustomer($animalId, $customerId)
    {

        $customer = $this->customers->find($customerId);
        $animal = $this->animals->with('customers')->find($animalId);

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

        if($animal->customers->contains($customer)){

            $animal->customers()->detach($customer->id);
            return response()->json($animal, 200);

        }

        return response()->json([
                'message'   => 'Não foi possível deletar cliente.',
            ], 404);

    }

}
