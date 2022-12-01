<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithMapping, WithHeadings
{

    protected $name;
    protected $email;
    protected $phone;
    protected $age;
    protected $country;

    /**
     * UserExport constructor
     */
    public function __construct($name, $email, $phone, $age, $country)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->age = $age;
        $this->country = $country;
    }

    /**
     * @param mixed $user
     *
     * @return array
     */
    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->phone,
            $user->age,
            $user->country
        ];
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Age',
            'Country'
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $users = User::orderBy('id', 'desc');

        if ($this->name != '') {
            $users = $users->where('name', 'like', '%' . $this->name . '%');
        }

        if ($this->email != '') {
            $users = $users->where('email', 'like', '%' . $this->email . '%');
        }

        if ($this->phone != '') {
            $users = $users->where('phone', 'like', '%' . $this->phone . '%');
        }

        if ($this->age != '') {
            $users = $users->where('age', 'like', '%' . $this->age . '%');
        }

        if ($this->country != '') {
            $users = $users->where('country ', 'like', '%' . $this->country . '%');
        }

        return $users->get();
    }
}
