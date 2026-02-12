<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\ComplaintTitle;

class ComplaintTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $complaint_title = [
    ['user_type' => 'User',
    'title' => 'Direção Perigosa do Motorista',
    'complaint_type' => 'request_help',
    'active' => 1,
    ],
    ['user_type' => 'User',
    'title' => 'Veículo Não Está Limpo',
    'complaint_type' => 'general',
    'active' => 1,
    ],
    ['user_type' => 'User',
    'title' => 'Veículo Não Está Limpo',
    'complaint_type' => 'general',
    'active' => 1,
    ],
    ['user_type' => 'User',
    'title' => 'Direção Perigosa do Motorista',
    'complaint_type' => 'request_help',
    'active' => 1,
    ],
    ['user_type' => 'Driver',
    'title' => 'Usuário Não Atende Chamadas',
    'complaint_type' => 'general',
    'active' => 1,
    ],
    ['user_type' => 'Driver',
    'title' => 'Usuário Não Atende Chamadas',
    'complaint_type' => 'general',
    'active' => 1,
    ],
    ['user_type' => 'Driver',
    'title' => 'Usuário Não Está no Ponto de Busca',
    'complaint_type' => 'request_help',
    'active' => 1,
    ],
    ['user_type' => 'Driver',
    'title' => 'Usuário Não Está no Ponto de Busca',
    'complaint_type' => 'request_help',
    'active' => 1,
    ],
    //
    ['user_type' => 'Driver',
    'title' => 'Preocupações com a Experiência do Usuário',
    'complaint_type' => 'general',
    'active' => 1,
    ],
    ['user_type' => 'User',
    'title' => 'Preocupações com a Experiência do Usuário',
    'complaint_type' => 'general',
    'active' => 1,
    ],

    ['user_type' => 'Driver',
    'title' => 'Problemas de Pagamento',
    'complaint_type' => 'general',
    'active' => 1,
    ],
    ['user_type' => 'User',
    'title' => 'Problemas de Pagamento',
    'complaint_type' => 'general',
    'active' => 1,
    ],

    ['user_type' => 'User',
    'title' => 'Assistência de Pagamento',
    'complaint_type' => 'request_help',
    'active' => 1,
    ],

    ['user_type' => 'User',
    'title' => 'Problemas de Acesso à Conta',
    'complaint_type' => 'request_help',
    'active' => 1,
    ],
    ['user_type' => 'Driver',
    'title' => 'Problemas de Acesso à Conta',
    'complaint_type' => 'request_help',
    'active' => 1,
    ],
    ['user_type' => 'User',
    'title' => 'Preocupações com Segurança',
    'complaint_type' => 'request_help',
    'active' => 1,
    ],
    ['user_type' => 'User',
    'title' => 'Preocupações com Privacidade de Dados',
    'complaint_type' => 'request_help',
    'active' => 1,
    ],
    ['user_type' => 'User',
    'title' => 'Solicitações de Recursos',
    'complaint_type' => 'request_help',
    'active' => 1,
    ],
    ['user_type' => 'Driver',
    'title' => 'Solicitações de Recursos',
    'complaint_type' => 'request_help',
    'active' => 1,
    ],

    ];


    public function run()
    {

     $created_params = $this->complaint_title;


       foreach ($created_params as $title)
       {
        ComplaintTitle::firstOrCreate($title);
       }
  }
}
