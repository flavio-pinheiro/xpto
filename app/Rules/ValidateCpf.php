<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateCpf implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $cpf = preg_replace('/[^0-9]/', "", $value);

        if (strlen($cpf) != 11) {
            return false;
        }

        if (strlen($cpf) != 11 || preg_match('/([0-9])\1{10}/', $cpf)) {
            return false;
        }

        $sum = 0;
        $number_to_multiplicate = 10;

        for ($index = 0; $index < 9; $index++) {
            $sum += $cpf[$index] * ($number_to_multiplicate--); 
        }

        $result = (($sum * 10) % 11);

        $number_quantity_to_loop = [9, 10];

        foreach ($number_quantity_to_loop as $item) {

            $sum = 0;
            $number_to_multiplicate = $item + 1;
          
            for ($index = 0; $index < $item; $index++) {

                $sum += $cpf[$index] * ($number_to_multiplicate--);
          
            }

            $result = (($sum * 10) % 11);

        }

        if ($cpf[$item] != $result) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Por favor, insira um CPF válido!';
    }
}
