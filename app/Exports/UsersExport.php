<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::all(); // Получаем всех пользователей
    }

    public function headings(): array
    {
        return [
            'ID',                // Заголовок для ID
            'Логин пользователя', // Заголовок для логина
            'Роль', 
            'Email',           // Заголовок для email
        ];
    }
}