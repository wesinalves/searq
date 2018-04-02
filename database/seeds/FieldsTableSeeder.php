<?php

use Illuminate\Database\Seeder;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'code',
        	'description'=>'código de referência',
        	'area'=>'identification',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'title',
        	'description'=>'título',
        	'area'=>'identification',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'start_date',
        	'description'=>'data inicial',
        	'area'=>'identification',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'end_date',
        	'description'=>'data final',
        	'area'=>'identification',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'level',
        	'description'=>'nível de identificação',
        	'area'=>'identification',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'dimension',
        	'description'=>'dimensão e suporte',
        	'area'=>'identification',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'producers',
        	'description'=>'nomes dos produtores',
        	'area'=>'context',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'biography',
        	'description'=>'história administrativa/biografia',
        	'area'=>'context',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'history',
        	'description'=>'história arquivística',
        	'area'=>'context',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'origin',
        	'description'=>'procedência',
        	'area'=>'context',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'content',
        	'description'=>'âmbito e conteúdo',
        	'area'=>'contents',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'evaluate',
        	'description'=>'avaliação, eliminação e temporalidade',
        	'area'=>'contents',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'incorporation',
        	'description'=>'incorporações',
        	'area'=>'contents',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'level_system',
        	'description'=>'sistema de arranjo',
        	'area'=>'contents',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'access',
        	'description'=>'condições de acesso',
        	'area'=>'access',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'reproduction',
        	'description'=>'condições de reprodução',
        	'area'=>'access',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'idiom',
        	'description'=>'idioma',
        	'area'=>'access',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'features',
        	'description'=>'características físicas e requisitos técnicos',
        	'area'=>'access',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'tools',
        	'description'=>'instrumentos de pesquisa',
        	'area'=>'access',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'origin_localization',
        	'description'=>'existência e localização de originais',
        	'area'=>'sources',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'copy_localization',
        	'description'=>'existência e localização de cópias',
        	'area'=>'sources',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'unit_description',
        	'description'=>'unidades de descrição relacionadas',
        	'area'=>'sources',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'publish_note',
        	'description'=>'nota sobre publicação',
        	'area'=>'sources',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'conservation_note',
        	'description'=>'notas sobre conservação',
        	'area'=>'notes',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'generals_note',
        	'description'=>'notas gerais',
        	'area'=>'notes',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'professional_note',
        	'description'=>'nota do arquivista',
        	'area'=>'description',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'rules',
        	'description'=>'regras e convenções',
        	'area'=>'description',
        ]);

        DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'description_date',
        	'description'=>'data(s) da(s) descrição(ões)',
        	'area'=>'description',
        ]);

          DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'subject',
        	'description'=>'assunto',
        	'area'=>'subject',
        ]);

          DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'type',
        	'description'=>'tipologia documental',
        	'area'=>'subject',
        ]);

          DB::table('fields')->insert([
        	'created_at'=> date("Y-m-d H:i:s"),
        	'updated_at'=> date("Y-m-d H:i:s"),
        	'name'=> 'local',
        	'description'=>'local',
        	'area'=>'subject',
        ]);




        
    }
}
