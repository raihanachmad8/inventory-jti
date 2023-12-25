<?php
class MaintainerInventaris
{
    public string $ID_Maintainer;
    public string $ID_Inventaris;

    // Relation
    public Inventaris $Inventaris;
    public Maintainer $Maintainer;
    public array $MaintainerList;


}
