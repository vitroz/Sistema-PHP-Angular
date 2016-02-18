<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{

	public function transform(Client $client)
	{
		return [
			'client_id' => $client->id,			
			'client' => $client->name,
			'responsible' => $client->responsible,
			'phone' => $client->phone,
			'email' => $client->email,
			'address' => $client->address,
			'obs' => $client->obs,
		];
	}

}
