<?php

namespace App\Filament\Resources\PLACSP\Anuncios\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\PLACSP\Anuncios\Schemas\AnuncioInfolist;
use Filament\Schemas\Schema;

class ViewAnuncio extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_ANUNCIO;


    /**
     * @param Schema $schema
     *
     * @return Schema
     */
    public function infolist(Schema $schema): Schema
    {

        return new AnuncioInfolist()->getSchema($schema);
    }
}
