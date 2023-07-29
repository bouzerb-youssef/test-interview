<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactCollection;
use App\Models\Contact;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all contacts and return a collection resource
        $contacts = Contact::with("organisation")->paginate(10);
       
        return view("welcome",compact("contacts"));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
       $validated = $request->validate([
            'prenom' => 'required|string|regex:/^[a-zA-Z]+$/',
            'nom' => 'required|string|regex:/^[a-zA-Z]+$/',
            'email' => 'required|email',
            'entreprise' => 'required',
            "adresse"=>'required',
            'code_postal' => 'nullable|numeric',
            'ville' => 'nullable|string|alpha',
            'statut' =>'required'
        ]);
 
      $organisation=  Organisation::create([

            "nom"=>$request->entreprise,
            
            "adresse"=>$request->adresse,
            "code_postal"=>$request->code_postal,
            "ville"=>$request->ville,
            "statut"=>$request->statut,
            "cle" =>Str::uuid()

        ]);
       
     $contact=   Contact::create([

            "nom"=>$request->nom,
            "prenom"=>$request->prenom,
            "email"=>$request->email,
            "organisation_id"=> $organisation->id,
            "cle" =>Str::uuid()

        ]);
        
        return response()->json(['message' => 'Contact created successfully!'], 200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function search(Request $request)
{
    
   $query = $request->get('q');
   $results = Contact::with("organisation")->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('nom', 'like', '%' . $query . '%')
                            ->orWhere('prenom', 'like', '%' . $query . '%');
                            
                })->paginate(10);
    return response()->json($results);
}
}
