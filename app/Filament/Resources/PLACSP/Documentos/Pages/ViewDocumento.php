<?php

namespace App\Filament\Resources\PLACSP\Documentos\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\PLACSP\Documentos\Schemas\DocumentoInfolist;
use Filament\Schemas\Schema;

class ViewDocumento extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_DOCUMENTO;


    /**
     * @param Schema $schema
     *
     * @return Schema
     */
    public function infolist(Schema $schema): Schema
    {

        return new DocumentoInfolist()->getSchema($schema);
    }
}
