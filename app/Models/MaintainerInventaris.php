<?php

require_once __DIR__ . '/Maintainer.php';
require_once __DIR__ . '/Inventaris.php';

class MaintainerInventaris
{
    public Maintainer $maintainer;
    public Inventaris $inventaris;
    public function __construct(Maintainer $maintainer, Inventaris $inventaris)
    {
        $this->maintainer = $maintainer;
        $this->inventaris = $inventaris;
    }

    public function toArray(): array
    {
        return [
            'ID_Maintaner' => $this->maintainer->getID(),
            'ID_Inventaris' => $this->inventaris->getID()
        ];
    }

}
