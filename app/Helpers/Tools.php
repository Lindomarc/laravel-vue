<?php
if (!function_exists('onlyNumber')) {
    function listUfs()
    {
        return [
            '12' => 'AC',
            '27' => 'AL',
            '13' => 'AM',
            '16' => 'AP',
            '29' => 'BA',
            '23' => 'CE',
            '53' => 'DF',
            '32' => 'ES',
            '52' => 'GO',
            '21' => 'MA',
            '31' => 'MG',
            '50' => 'MS',
            '51' => 'MT',
            '15' => 'PA',
            '25' => 'PB',
            '26' => 'PE',
            '22' => 'PI',
            '41' => 'PR',
            '33' => 'RJ',
            '24' => 'RN',
            '11' => 'RO',
            '14' => 'RR',
            '43' => 'RS',
            '28' => 'SE',
            '42' => 'SC',
            '35' => 'SP',
            '17' => 'TO'
        ];
    }
}

if (!function_exists('minusDays')){

    /**
     *  Return date with subtracting the number of days
     * informed in the initial will always be 'today'
     * @param int $days
     * @return string
     */
    function minusDays(int $days = 30)
    {
        return date('d-m-Y', strtotime("-{$days} days",strtotime(date('Y-m-d'))));
    }
}
