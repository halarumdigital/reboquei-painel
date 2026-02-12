<?php

namespace Database\Seeders;

use App\Models\Master\GoodsType;
use Illuminate\Database\Seeder;
use App\Models\Admin\Driver;

class GoodsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $goods_type = [
        ['goods_type_name' => 'Madeira/Compensado/Laminado',
            'active' => 1,
        ],
        ['goods_type_name' => 'Elétricos/Eletrônicos/Eletrodomésticos',
            'active' => 1,
        ],
        ['goods_type_name' => 'Construção Civil',
            'active' => 1,
        ],
        ['goods_type_name' => 'Catering/Restaurante/Gestão de Eventos',
            'active' => 1,
        ],
        ['goods_type_name' => 'Máquinas/Equipamentos/Peças de Reposição/Metais',
            'active' => 1,
        ],
        ['goods_type_name' => 'Têxtil/Vestuário/Acessórios de Moda',
            'active' => 1,
        ],
        ['goods_type_name' => 'Mobiliário/Decoração de Casa',
            'active' => 1,
        ],
        ['goods_type_name' => 'Mudança Residencial',
            'active' => 1,
        ],
        ['goods_type_name' => 'Cerâmica/Artigos Sanitários/Artigos Duros',
            'active' => 1,
        ],
        ['goods_type_name' => 'Papel/Embalagem/Material Impresso',
            'active' => 1,
        ],
        ['goods_type_name' => 'Químicos/Tintas',
            'active' => 1,
        ],
        ['goods_type_name' => 'Prestador de serviços logísticos/Mudanceiros',
            'active' => 1,
        ],
        ['goods_type_name' => 'Itens Alimentícios Perecíveis',
            'active' => 1,
        ],
        ['goods_type_name' => 'Farmácia/Médico?Equipamentos de Saúde e Fitness',
            'active' => 1,
        ],
        ['goods_type_name' => 'FMCG/Produtos Alimentícios',
            'active' => 1,
        ],
        ['goods_type_name' => 'Plástico/Borracha',
            'active' => 1,
        ],
        ['goods_type_name' => 'Livros/Papelaria/Brinquedos/Presentes',
            'active' => 1,
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $created_params = $this->goods_type;

        $value = GoodsType::first();
        if(is_null($value))
        {
          foreach ($created_params as $goods) 
          {
            GoodsType::create($goods);
          }
        }else {
          foreach ($created_params as $goods) 
          {
            $value->update($goods);
          }
        }

        $users = Driver::whereNotNull('car_make')->orWhereNotNull('car_model')->get();

        foreach ($users as $key => $user_data) {
            if($user_data->car_make){
                $update_params['car_make']=null;
                $update_params['custom_make']= $user_data->custom_make ?? $user_data->car_make_name;
            }
            if($user_data->car_model){
                $update_params['car_model']=null;
                $update_params['custom_model']= $user_data->custom_model ?? $user_data->car_model_name;
            }
            $user_data->update($update_params);
        }

    }
}
