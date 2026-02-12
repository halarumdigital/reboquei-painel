<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\MailTemplate;

class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $mailTemplate = [
 
    /*Welcome Mail*/
        [  'mail_type' => 'welcome_mail',
            'active' => 1,
            'description' => '<p>Olá $user_name</p>
 
            <p>Obrigado por se juntar à MI Softwares! Estamos emocionados em tê-lo como parte da nossa comunidade.</p>
 
            <p>Nossa missão é mobilidade. Esperamos que você encontre nossos produtos/serviços úteis e agradáveis.</p>
 
            <p>Para começar, por favor, reserve alguns momentos para explorar nosso site e familiarizar-se com nossas ofertas. Se você tiver alguma dúvida ou preocupação, nossa equipe de suporte ao cliente está sempre aqui para ajudar.</p>
 
            <p>Esperamos trabalhar com você e fornecer-lhe uma experiência de primeira classe.</p>
 
            <p>Atenciosamente,</p>
 
            <p>MI Softwares</p>',
        ],
    /*Welcome Mail*/
        [  'mail_type' => 'welcome_mail_driver',
            'active' => 1,
            'description' => '<p>Prezado $user_name,</p>
 
        <p>Parabéns por se tornar um motorista recém-registrado! Estamos animados em recebê-lo no mundo da direção e queríamos aproveitar a oportunidade para estender nossas mais calorosas saudações.</p>
 
        <p>Como motorista registrado, você agora tem a oportunidade de explorar novos destinos, abraçar a independência e vivenciar as alegrias da estrada aberta. Esperamos que este novo capítulo traga muitas aventuras e experiências memoráveis.</p>
 
        <p>Por favor, lembre-se de priorizar a segurança ao embarcar em sua jornada de direção. Observe as leis de trânsito, use o cinto de segurança e permaneça atento a todo momento. A direção segura não apenas protege você, mas também garante o bem-estar dos outros ao seu redor.</p>
 
        <p>Se você alguma vez tiver alguma dúvida ou precisar de assistência ao longo do caminho, nossa equipe está aqui para apoiá-lo. Não hesite em entrar em contato conosco; estamos mais do que felizes em ajudar.</p>
 
        <p>Mais uma vez, parabéns pelo seu registro! Aproveite a liberdade e empolgação que a direção oferece. Desejamos a você viagens seguras e uma jornada incrível à frente.</p>
 
        <p>Atenciosamente,</p>
 
        <p>Tagxi</p>',
        ],


    /*trip start alert Mail Mail*/

        // [  'mail_type' => 'trip_start_mail',
        //     'active' => 1,
        //     'description' => '<p>Dear $user_name,</p>
        //                     <p>We are excited to inform you that your taxi trip has officially started! Your driver, $driver_name, has been dispatched and is on their way to pick you up at your specified location, $pickup_address.</p>

        //                     <p>To ensure a smooth and comfortable ride, please make sure that you are ready and waiting at the pickup location. If there are any changes to your pickup location or any other special requests, please contact your driver directly through the phone number provided in the confirmation message.</p>

        //                     <p>We hope you have a safe and enjoyable trip with us. If you have any questions or concerns, please don&#39;t hesitate to contact our customer support team.</p>

        //                     <p>Thank you for choosing our taxi service!</p>

        //                     <p>Best regards,</p>

        //                     <p>$app_name</p>',
        // ],
    /*Bill mail*/

        // [  'mail_type' => 'invoice_maill',
        //     'active' => 1,
        //     'description' => '<p>Thank you for using our taxi service for your recent trip. Please find below the details of your taxi bill for the trip that you took on $date:</p>
        //         <table>
        //             <thead>
        //                 <tr>
        //                     <th>Trip Details</th>
        //                     <th>Amount</th>
        //                 </tr>
        //             </thead>
        //             <tbody>
        //                 <tr>
        //                     <td>Pickup Address</td>
        //                     <td>$pickup_address</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Dropoff Address</td>
        //                     <td>$dropoff_address</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Base fair</td>
        //                     <td>$base_price</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Additional Distance Price Per Km</td>
        //                     <td>$additional_distance_price_per_Km</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Additional Time Price Per Min</td>
        //                     <td>$additional_time_price_per_min</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Waiting Charge Per Minutes</td>
        //                     <td>$waiting_Charge_per_minutes</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Cancellation Fee</td>
        //                     <td>$cancellation_fee</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Service Tax</td>
        //                     <td>$service_tax</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Promo Discount</td>
        //                     <td>$promo_discount</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Admin Commission</td>
        //                     <td>$admin_commision</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Driver Commission</td>
        //                     <td>$driver_commission</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Total Amount</td>
        //                     <td>$total_amount</td>
        //                 </tr>
        //             </tbody>
        //         </table>

        //         <p>Please note that the fare includes all taxes and fees. If you have any questions or concerns regarding this bill, please feel free to contact our customer support team at any time.</p>

        //         <p>Thank you for choosing our taxi service. We hope to see you again soon.</p>

        //         <p>Best regards,</p>

        //         <p>$taxi_service_name</p>',
        // ],

    ];




    public function run()
    {
       $created_params = $this->mailTemplate;

            $value = MailTemplate::first();

                foreach ($created_params as $mailTemplate)
                {
                    MailTemplate::firstorcreate($mailTemplate);
                }


        }    
    }
