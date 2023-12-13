<?php

require_once __DIR__ . '/../Repository/MaintainerRepository.php';

class MaintainerService
{
    private MaintainerRepository $maintainerRepository;

    public function __construct()
    {
        $this->maintainerRepository = new MaintainerRepository();
    }

    public function getListMaintainers() : array
    {
        return $this->maintainerRepository->getListMaintainers();
    }

    public function getMaintainerById($id) : Maintainer
    {
        return $this->maintainerRepository->getMaintainerById($id);
    }

    public function create(Maintainer $maintainer) : bool
    {
        return $this->maintainerRepository->create($maintainer);
    }

    public function update(Maintainer $maintainer) : bool
    {
        return $this->maintainerRepository->update($maintainer);
    }

    public function delete($id) : bool
    {
        return $this->maintainerRepository->delete($id);
    }

    public function getMaintainerByNamaLike($nama) : array
    {
        return $this->maintainerRepository->search($nama);
    }


}
