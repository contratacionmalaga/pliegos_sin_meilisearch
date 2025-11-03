<?php

namespace App\Filament\Components\Forms;

use App\Enums\MunicipiosSegunPoblacion;
use App\Enums\PuestosDeTrabajo;
use App\Repositories\AreaOldRepository;
use App\Repositories\ComarcaOldRepository;
use App\Repositories\ComunidadAutonomaRepository;
use App\Repositories\DelegacionRepository;
use App\Repositories\EntidadRepository;
use App\Repositories\MunicipioRepository;
use App\Repositories\OrganismoRepository;
use App\Repositories\OrganoContratacionRepository;
use App\Repositories\PersonalActivoRepository;
use App\Repositories\ProvinciaRepository;
use App\Repositories\UnidadOrganicaRepository;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use InvalidArgumentException;

class MiSelect
{

    /**
     * @param string $make
     * @param bool $required
     * @param string $class  // Nombre completo de la clase del Enum
     * @param int $columnSpam
     *
     * @return Select
     * @throws InvalidArgumentException
     */
    public function getSelectEnum(string $make, bool $required, string $class, int $columnSpam): Select
    {
        if (!class_exists($class)) {
            throw new InvalidArgumentException("La clase '$class' no existe.");
        }

        if (!method_exists($class, 'ordenar')) {
            throw new InvalidArgumentException("La clase '$class' no tiene el método 'ordenar'.");
        }

        return $this->constructSelect($make, $required, $columnSpam)
            ->options($class::ordenar());
    }

    /**
     * @param string      $make
     * @param bool        $required
     * @param int         $columnSpam
     * @param string|null $label
     *
     * @return Select
     */
    public function getSelectPuestoTrabajo(string $make, bool $required, int $columnSpam, ?string $label = null): Select
    {
        return $this->constructSelect($make, $required, $columnSpam, $label)
            ->options(PuestosDeTrabajo::ordenar());
    }

    /**
     * @param string $make
     * @param bool $required
     * @param int $columnSpam
     *
     * @return Select
     */
    public function getSelectMunicipioSegunPoblacion(string $make, bool $required, int $columnSpam): Select
    {
        return $this->constructSelect($make, $required, $columnSpam)
            ->options(MunicipiosSegunPoblacion::ordenar());
    }

    /**
     * @param string $make
     * @param bool $required
     * @param int $columnSpam
     *
     * @return Select
     */
    public function getSelectMunicipios(string $make, bool $required, int $columnSpam): Select
    {
        return $this->constructSelect($make, $required, $columnSpam)
            ->options(new MunicipioRepository()->getArrayMunicipios());
    }

    /**
     * @param string      $make
     * @param bool        $required
     * @param bool        $activo
     * @param int         $columnSpam
     *
     * @param string|null $make_padre
     *
     * @return Select
     */
    public function getSelectOrganismos(string $make, bool $required, bool $activo, int $columnSpam, ?string $make_padre = null): Select
    {
        return $this->constructSelect($make, $required, $columnSpam)
            ->options(new OrganismoRepository()->getArrayOrganismos($activo));
    }

    /**
     * @param string $make
     * @param bool   $required
     * @param bool   $activo
     * @param int    $columnSpam
     *
     * @return Select
     */
    public function getSelectPersonalActivo(string $make, bool $required, bool $activo, int $columnSpam): Select
    {
        return $this->constructSelect($make, $required, $columnSpam)
            ->options(new PersonalActivoRepository()->getArrayPersonalActivo($activo));
    }

    /**
     * @param string $make
     * @param bool $required
     * @param bool $activo
     * @param int $columnSpam
     *
     * @return Select
     */
    public function getSelectAreas(string $make, bool $required, bool $activo, int $columnSpam): Select
    {
        return $this->constructSelect($make, $required, $columnSpam)
            ->options(new AreaOldRepository()->getArrayAreas($activo));
    }

    /**
     * @param string $make
     * @param bool $required
     * @param bool $activo
     * @param int $columnSpam
     *
     * @return Select
     */
    public function getSelectDelegaciones(string $make, bool $required, bool $activo, int $columnSpam): Select
    {
        return $this->constructSelect($make, $required, $columnSpam)
            ->options(new DelegacionRepository()->getArrayDelegaciones($activo));
    }

    /**
     * @param string $make
     * @param bool $required
     * @param bool $activo
     * @param int $columnSpam
     *
     * @return Select
     */
    public function getSelectEntidades(string $make, bool $required, bool $activo, int $columnSpam): Select
    {
        return $this->constructSelect($make, $required, $columnSpam)
            ->options(new EntidadRepository()->getArrayEntidades($activo));
    }

    /**
     * @param string $make
     * @param string $nif_make
     * @param bool   $required
     * @param bool   $activo
     * @param int    $columnSpam
     *
     * @return Select
     */
    public function getSelectOrganosContratacionByNifEntidad(string $make, string $nif_make, bool $required, bool $activo, int $columnSpam): Select
    {
        return $this->constructSelect($make, $required, $columnSpam)
            ->options(
                function (Get $get) use ($nif_make, $activo) {
                    $nif = $get($nif_make);
                    if(!$nif) {
                        return [];
                    }
                    return new OrganoContratacionRepository()->getArrayOrganosContratacion($activo, $nif);
                });
    }

    /**
     * @param string $make
     * @param string $id_plataforma_make
     * @param bool   $required
     * @param bool   $activo
     * @param int    $columnSpam
     *
     * @return Select
     */
    public function getSelectUnidadOrganicaByIdPlataforma(string $make, string $id_plataforma_make, bool $required, bool $activo, int $columnSpam): Select
    {
        return $this->constructSelect($make, $required, $columnSpam)
            ->options(
                function (Get $get) use ($id_plataforma_make, $activo) {
                    $id_plataforma = $get($id_plataforma_make);
                    if(!$id_plataforma) {
                        return [];
                    }
                    return new UnidadOrganicaRepository()->getArrayUnidadesOrganicas($activo, $id_plataforma);
                });
    }

    /**
     * @param string $make
     * @param bool   $required
     * @param int    $columnSpam
 *
     * @return Select
     */
    public function getSelectComunidadesAutonomas(string $make, bool $required, int $columnSpam): Select
    {
        return $this->constructSelect($make, $required, $columnSpam)
            ->options(new ComunidadAutonomaRepository()->getArrayComunidadesAutonomas());
    }

    /**
     * @param string      $make
     * @param bool        $required
     * @param int         $columnSpam
     * @param string|null $make_padre
     *
     * @return Select
     */
    public function getSelectProvincias(string $make, bool $required, int $columnSpam, ?string $make_padre = null): Select
    {
        return $this->constructSelect($make, $required, $columnSpam)
            ->options(
                function(Get $get) use ($make_padre) {
                    if (!is_null($make_padre)) {
                        $comunidad_autonoma = $get($make_padre);
                        if (!$comunidad_autonoma) {
                            return [];
                        }
                        return new ProvinciaRepository()->getArrayProvincias($comunidad_autonoma);
                    }
                    return new ProvinciaRepository()->getArrayProvincias();
            });
    }

    /**
     * @param string      $make
     * @param bool        $required
     * @param int         $columnSpam
     * @param string|null $make_padre
     *
     * @return Select
     */
    public function getSelectComarcas(string $make, bool $required, int $columnSpam, ?string $make_padre = null): Select
    {
        return $this->constructSelect($make, $required, $columnSpam)
            ->options(
                function(Get $get) use ($make_padre) {
                    if(!is_null($make_padre)) {
                        $provincia = $get($make_padre);
                        if(!$provincia) {
                            return [];
                        }
                        return new ComarcaOldRepository()->getArrayComarcas($provincia);
                    }
                    return new ComarcaOldRepository()->getArrayComarcas();
                });
    }

    /**
     * @param string      $make
     * @param int         $columnSpam
     * @param bool        $required
     * @param string|null $label
     *
     * @return Select
     */
    public function constructSelect(string $make, bool $required, int $columnSpam, ?string $label = null): Select
    {

        $select = Select::make($make)
            ->label(($label ?? __('etiquetas.select_' . $make)))
            ->preload()
            ->columnSpan($columnSpam)
            ->reactive();

        if($required) {
            $select->markAsRequired()
                ->rules(['required'])
                ->validationMessages([
                    'required' => fn() => __('etiquetas.validation_required'),
                ]);
        }

        return $select;
    }
}
