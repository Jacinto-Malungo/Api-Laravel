<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Validator;

class InvoiceController extends Controller
{
    use HttpResponses;// Para mensagens personalizadas
   
    public function index()
    {
        //
        return InvoiceResource::collection(Invoice::with('user')->get());
    }

   

    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), 
        [
            'user_id' => 'required',
            'type' => 'required|max:1',
            'paid' => 'required|numeric|between:0,1',
            'payment_date' => 'nullable',
            'value' => 'required|numeric|between:1,9999.99'
        ]);

        if($validator->fails()){
            return $this->error('Data Invalid', 422, $validator->errors());
        }

        $created = Invoice::create($validator->validated());

        if($created)
    {
            return $this->response('Invoice created', 200, new InvoiceResource
            ($created->load('user'))// Usamos o load para cadastrar o invoices e chamar com o relacionamento
        );
    }
        
        return $this->error('Invoice not created', 400, );
    }

    
    public function show(string $id)
    {
        //
        return new InvoiceResource(Invoice::where('id', $id)->first());
    }

    

   
    public function update(Request $request, string $id)
    {
        //
    }

  
    public function destroy(string $id)
    {
        //
    }
}
