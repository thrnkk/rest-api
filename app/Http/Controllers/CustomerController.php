<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Animal;
use App\Models\User;
use App\Http\Requests;
use Session;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function __construct(Customer $customers, User $users, Animal $animals){
        $this->customers = $customers;
        $this->animals = $animals;
        $this->users = $users;
    }

    public function index()
    {

        $customers = $this->customers->with('animals')->orderBy("id")->get();
        return response()->json($customers, 200);

    }

    public function show($id)
    {
        $customer = $this->customers->with('animals')->find($id);

        if(!$customer) {
            return response()->json(['message' => 'Registro não encontrado.'], 404);
        }

        return response()->json($customer, 200);
    }

    public function store(Request $request)
    {

        if (Session::get('user')) {

            $customer = new Customer();
            $customer->fill($request->all());
            $customer->save();

            return response()->json($customer, 201);

        } else {

            return response()->json([
                'message'   => 'Sem permissão.',
            ], 404);

        }

    }

    public function update(Request $request, $id)
    {

        if (Session::get('user')) {

            $customer = $this->customers->with('animals')->find($id);

            if(!$customer) {
                return response()->json([
                    'message'   => 'Registro não encontrado.',
                ], 404);
            }

            $customer->fill($request->all());
            $customer->save();

            return response()->json($customer, 200);

        } else {

            return response()->json([
                'message'   => 'Sem permissão.',
            ], 404);

        }
        
    }

    public function destroy($id)
    {
        $customer = $this->customers->with('animals')->find($id);

        if(!$customer) {
            return response()->json([
                'message'   => 'Registro não encontrado.',
            ], 404);
        }

        $customer->delete();
    }

    public function orderByAge()
    {

        $customers = $this->customers->orderBy("age")->get();
        return response()->json($customers, 200);

    }

    public function orderByAlphabeticOrder()
    {

        $customers = $this->customers->orderBy("name")->get();
        return response()->json($customers, 200);

    }

    public function setAnimal($customerId, $animalId)
    {

        $customer = $this->customers->with('animals')->find($customerId);
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

        if ($customer->animals()->syncWithoutDetaching([$animal->id])) {
            return response()->json($animal, 200);
        }

        return response()->json([
                'message'   => 'Não foi possível cadastrar animal.',
            ], 404);

    }

    public function deleteAnimal($customerId, $animalId)
    {

        $customer = $this->customers->with('animals')->find($customerId);
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

        if($customer->animals->contains($animal)){

            $customer->animals()->detach($animal->id);
            return response()->json($customer, 200);

        }

        return response()->json([
                'message'   => 'Não foi possível deletar animal.',
            ], 404);

    }

}
