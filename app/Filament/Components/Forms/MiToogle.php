<?php

namespace App\Filament\Components\Forms;

use App\DTOs\ToogleConfig;
use App\Enums\Flags\BooleanEnum;
use Filament\Forms\Components\Toggle;

class MiToogle
{
    /**
     * @param string      $make
     * @param bool|null   $default
     * @param int         $columnSpam
     *
     * @return Toggle
     */
    public function getToggle(string $make, ?bool $default, int $columnSpam): Toggle
    {

        return $this->create(
                        new ToogleConfig(
                            make: $make,
                            columnSpan: $columnSpam,
                            default: $default,
                        ));
    }

    /**
     * @param ToogleConfig $config
     *
     * @return Toggle
     */
    public function create(ToogleConfig $config): Toggle
    {

        $toggle = Toggle::make($config->make)
            ->label($config->label ? __('etiquetas.toogle_' . $config->make) : null)
            ->reactive()
            ->columnSpan($config->columnSpan)
            ->onColor(BooleanEnum::TRUE->getColor())
            ->offColor(BooleanEnum::FALSE->getColor())
            ->offIcon(BooleanEnum::TRUE->getIcon())
            ->onIcon(BooleanEnum::FALSE->getIcon())
            ->inline();

        if ($config->default) {
            $toggle->default($config->default);
        }

        return $toggle;
    }
}
