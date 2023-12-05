<?php

require_once __DIR__ . '/Maintaner.php';
require_once __DIR__ . '/Inventaris.php';

class MaintanerInventaris
{
    public Maintaner $maintaner;
    public Inventaris $inventaris;
    public function __construct(Maintaner $maintaner, Inventaris $inventaris)
    {
        $this->maintaner = $maintaner;
        $this->inventaris = $inventaris;
    }

    public function toArray(): array
    {
        return [
            'ID_Maintaner' => $this->maintaner->getID(),
            'ID_Inventaris' => $this->inventaris->getID()
        ];
    }

}
