<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['id' => 1, 'sub_region_id' => 1, 'name' => '79 Paci Cañete'],
            ['id' => 2, 'sub_region_id' => 1, 'name' => '79 Paci Mala'],
            ['id' => 3, 'sub_region_id' => 2, 'name' => '33 Paci Villa el Salvador'],
            ['id' => 4, 'sub_region_id' => 2, 'name' => '33 Paci Chorrillos'],
            ['id' => 5, 'sub_region_id' => 2, 'name' => 'I1 Ecobesa Callao'],
            ['id' => 6, 'sub_region_id' => 2, 'name' => 'I1 Ecobesa Dueñas'],
            ['id' => 7, 'sub_region_id' => 2, 'name' => '78 M. Ventanilla'],
            ['id' => 8, 'sub_region_id' => 2, 'name' => 'I9 Ecobesa Comas'],
            ['id' => 9, 'sub_region_id' => 2, 'name' => 'I9 Ecobesa Los Olivos'],
            ['id' => 10, 'sub_region_id' => 2, 'name' => 'IA Ecobesa San Juan'],
            ['id' => 11, 'sub_region_id' => 2, 'name' => 'IA Ecobesa Ate'],
            ['id' => 12, 'sub_region_id' => 2, 'name' => 'IA Ecobesa Chosica'],
            ['id' => 13, 'sub_region_id' => 3, 'name' => 'I7 Ecobesa Chiclayo'],
            ['id' => 14, 'sub_region_id' => 3, 'name' => '94 ALPER JAEN'],
            ['id' => 15, 'sub_region_id' => 3, 'name' => '59 IMPERIOS CAJAMARCA'],
            ['id' => 16, 'sub_region_id' => 3, 'name' => '45 Diaz Ruiz Chota'],
            ['id' => 17, 'sub_region_id' => 4, 'name' => 'ECOBESA PIURA'],
            ['id' => 18, 'sub_region_id' => 4, 'name' => 'ECOBESA TUMBES'],
            ['id' => 19, 'sub_region_id' => 5, 'name' => '68 PMA CHIMBOTE'],
            ['id' => 20, 'sub_region_id' => 5, 'name' => '61 BAJOPONTINA HUARAZ'],
            ['id' => 21, 'sub_region_id' => 6, 'name' => '43 PMA TRUJILLO'],
            ['id' => 22, 'sub_region_id' => 6, 'name' => 'JE PMA PACASMAYO'],
            ['id' => 23, 'sub_region_id' => 6, 'name' => 'JF PMA CHOCOPE'],
            ['id' => 24, 'sub_region_id' => 6, 'name' => 'B1 HUAMACHUCO'],
            ['id' => 25, 'sub_region_id' => 7, 'name' => '07 DISTRAROJ TARMA'],
            ['id' => 26, 'sub_region_id' => 7, 'name' => '08 TRAHIS PICHANAKI'],
            ['id' => 27, 'sub_region_id' => 7, 'name' => '27 HUALLPA PASCO'],
            ['id' => 28, 'sub_region_id' => 7, 'name' => '47 TRAHIS LA MERCED'],
            ['id' => 29, 'sub_region_id' => 7, 'name' => '57 BAJOPONTINA HUANCAVELICA'],
            ['id' => 30, 'sub_region_id' => 7, 'name' => '71 BAJOPONTINA HUANCAYO'],
            ['id' => 31, 'sub_region_id' => 7, 'name' => '97 TRAHIS SATIPO'],
            ['id' => 32, 'sub_region_id' => 8, 'name' => '24 IMPERIOS HUACHO'],
            ['id' => 33, 'sub_region_id' => 8, 'name' => '28 IMPERIOS HUARAL'],
            ['id' => 34, 'sub_region_id' => 9, 'name' => '63 SANTA MÓNICA TARAPOTO'],
            ['id' => 35, 'sub_region_id' => 9, 'name' => '72 TRAHIS PUCALLPA'],
            ['id' => 36, 'sub_region_id' => 9, 'name' => '76 TRAHIS HUANUCO'],
            ['id' => 37, 'sub_region_id' => 9, 'name' => 'JC O.L. IQUITOS'],
            ['id' => 38, 'sub_region_id' => 9, 'name' => '74 DISELVA TINGO MARIA'],
            ['id' => 39, 'sub_region_id' => 9, 'name' => 'E5 SANTA MÓNICA MOYOBAMBA'],
            ['id' => 40, 'sub_region_id' => 10, 'name' => '46 DISTRAROJ AYACUCHO'],
            ['id' => 41, 'sub_region_id' => 10, 'name' => '83 CONSUELO CANALES PUQUIO'],
            ['id' => 42, 'sub_region_id' => 10, 'name' => 'I3 ECOBESA ICA'],
            ['id' => 43, 'sub_region_id' => 10, 'name' => 'I4 ECOBESA NAZCA'],
            ['id' => 44, 'sub_region_id' => 10, 'name' => 'I5 ECOBESA PISCO'],
            ['id' => 45, 'sub_region_id' => 10, 'name' => 'I6 ECOBESA CHINCHA'],
            ['id' => 46, 'sub_region_id' => 11, 'name' => 'IC ECOBESA Arequipa'],
            ['id' => 47, 'sub_region_id' => 11, 'name' => '06 AYA EL PEDREGAL'],
            ['id' => 48, 'sub_region_id' => 11, 'name' => '38 AYA ATICO'],
            ['id' => 49, 'sub_region_id' => 11, 'name' => '40 AYA CHALA'],
            ['id' => 50, 'sub_region_id' => 11, 'name' => '88 AYA CAMANA'],
            ['id' => 51, 'sub_region_id' => 11, 'name' => '93 COM. SAN JOSE ESPINAR'],
            ['id' => 52, 'sub_region_id' => 12, 'name' => 'ID ECOBESA MOLLENDO'],
            ['id' => 53, 'sub_region_id' => 12, 'name' => '18 SALAZAR ANDAHUAYLAS'],
            ['id' => 54, 'sub_region_id' => 12, 'name' => '91 SALAZAR ABANCAY'],
            ['id' => 55, 'sub_region_id' => 12, 'name' => '95 INTICHAY QUILLABAMBA'],
            ['id' => 56, 'sub_region_id' => 12, 'name' => '25 ANDINO URUBAMBA'],
            ['id' => 57, 'sub_region_id' => 12, 'name' => '84 JHOSELIN PTO MALDONADO'],
            ['id' => 58, 'sub_region_id' => 12, 'name' => '92 ANDINO SICUANI'],
            ['id' => 59, 'sub_region_id' => 12, 'name' => 'A0 ANDINO MACHUPICCHU'],
            ['id' => 60, 'sub_region_id' => 12, 'name' => 'C6 JHOSELIN HUEPETUHE'],
            ['id' => 61, 'sub_region_id' => 12, 'name' => '32 ANDINO CUSCO'],
            ['id' => 62, 'sub_region_id' => 13, 'name' => '15 EMBID AYAVIRI'],
            ['id' => 63, 'sub_region_id' => 13, 'name' => '23 EMBID YUNGUYO'],
            ['id' => 64, 'sub_region_id' => 13, 'name' => '50 EMBID ILAVE'],
            ['id' => 65, 'sub_region_id' => 13, 'name' => '60 EMBID DESAGUADERO'],
            ['id' => 66, 'sub_region_id' => 13, 'name' => '89 EMBID JULIACA'],
            ['id' => 67, 'sub_region_id' => 14, 'name' => 'AC RUTA SUR MOQUEGUA'],
            ['id' => 68, 'sub_region_id' => 14, 'name' => 'BC LONCCOS Y CCALAS SAC'],
            ['id' => 69, 'sub_region_id' => 14, 'name' => 'AA RUTAS DEL SUR TACNA'],
        ];

        DB::table('locations')->insert($locations);
    }
}
