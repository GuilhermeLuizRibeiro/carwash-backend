<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Somente desenvolvimento/QA: cria um funcionário para testar o perfil "equipe".
 * Rodar com: php artisan db:seed --class=DevFuncionarioSeeder
 */
class DevFuncionarioSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('production')) {
            $this->command->error('Seeder de desenvolvimento: não roda em produção.');

            return;
        }

        $email = 'funcionario@teste.local';

        if (DB::table('usuario')->where('email', $email)->exists()) {
            return;
        }

        DB::table('usuario')->insert([
            'nome' => 'Funcionario QA',
            'email' => $email,
            'senha_hash' => Hash::make('Funcionario#2026'),
            'perfil' => 'funcionario',
        ]);
    }
}
