<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return [
            'siswa' => [
                'nis' => '303119020',
                'name' => 'Ammar Muhammad K. A.',
                'phone' => '081227641418',
                'class' => 'XII RPL 1'
            ]
        ];
    }

}
