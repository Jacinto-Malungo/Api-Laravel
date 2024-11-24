<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class InvoiceResource extends JsonResource
{
    

    private array $types = ['C' => 'Cartão', 'B' => 'Boleto', 'P' => 'Pix'];

    public function toArray(Request $request): array
    {
        //Quem esta a consumir os Dados não precisa saber do ID da pessoa
        // Ou ID do registro
        $paid = $this->paid;
        return [
            'user' => [ 
                'firstName' => $this->user->firstName,
                'lastName' => $this->user->lastName,
                'fullName' => $this->user->firstName . ' ' . $this->user->lastName,
                'email' => $this->user->email,
            ],

            'type' => $this->types[$this->type],
            'value' => 'R$ ' . number_format($this->value,2,',','.'),
            'Paid' => $paid ? 'Pago': 'Não Pago',
            'PaymentDate' => $paid ? Carbon::parse($this->payment_date)->format('d/m/Y') : Null,

            //Mostrar a quanto tempo foi pago po Invoice
            'PaymentSince' => $paid ? Carbon::parse($this->payment_date)->diffForHumans() : Null,
        ];
    }
}
