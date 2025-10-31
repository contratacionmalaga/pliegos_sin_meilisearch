<?php

namespace App\Filament\Components\Forms;

use Filament\Forms\Components\DatePicker;

class MiDatePicker
{
    /**
     * @param array{
     *     make: string,
     *     label: string,
     *     format?: string,
     *     required?: bool,
     *     maxDate?: string,
     * } $params
     * @param int   $columnSpam
     *
     * @return DatePicker
     */
    public function constructDataPicker(array $params, int $columnSpam): DatePicker
    {

        $defaults = [
            'format' => false,
            'required' => false,
            'maxDate' => false,
        ];

        $params = array_merge($defaults, $params);

        $dataPicker = DatePicker::make($params['make'])
            ->label(fn () => __($params['label']))
            ->columnSpan($columnSpam);

        if ($params['format']) {
            $dataPicker->format(fn () => __($params['format']));
        }

        if ($params['required']) {
            $dataPicker->rule('required', $params['required']);
            $dataPicker->markAsRequired($params['required']);
            $validationMessages = ['required' => fn () => __('form_validation.required')];
            $dataPicker->validationMessages($validationMessages);
        }

        if ($params['maxDate']) {
            $dataPicker->maxDate($params['maxDate']);
        }

        return $dataPicker;
    }
}
