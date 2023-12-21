<?php

require_once __DIR__ . '/../Repository/PenggunaRepository.php';

class ProfileService
{
    private PenggunaRepository $penggunaRepository;

    public function __construct()
    {
        $this->penggunaRepository = new PenggunaRepository();
    }

    public function getProfile(string $ID_Pengguna): Pengguna
    {
        $result = $this->penggunaRepository->getPenggunaById($ID_Pengguna);
        return $result;
    }

    public function updateUserProfile(array $request) : bool {
        try {
            $pengguna = $this->penggunaRepository->getPenggunaById($request['ID_Pengguna']);
            if ($pengguna === null) {
                throw new Exception('User not found.');
            }
            $pengguna->ID_Pengguna = $request['ID_Pengguna'];
            $pengguna->Nama_Pengguna = $request['Nama_Pengguna'];
            $pengguna->Foto = $request['Foto'];
            $result = $this->penggunaRepository->updateProfile($pengguna);

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function updateAccountInformation(array $request) : bool {
        try {
            $pengguna = $this->penggunaRepository->getPenggunaById($request['ID_Pengguna']);
            if ($pengguna === null) {
                throw new Exception('User not found.');
            }
            $pengguna->ID_Pengguna = $request['ID_Pengguna'];
            $pengguna->Email = $request['Email'];
            $pengguna->Nomor_HP = $request['Nomor_HP'];
            $result = $this->penggunaRepository->updateAccountInformation($pengguna);

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }
    public function updateAccountSecurity(array $request) : bool {
        try {
            $pengguna = $this->penggunaRepository->getPenggunaById($request['ID_Pengguna']);
            if ($pengguna === null) {
                throw new Exception('User not found.');
            }
            $pengguna->ID_Pengguna = $request['ID_Pengguna'];
            $pengguna->Salt = base64_encode(random_bytes(8));
            $password = $request['Password'] . $pengguna->Nomor_Identitas . $pengguna->Salt;
            $pengguna->Password = password_hash( $password, PASSWORD_BCRYPT);
            $result = $this->penggunaRepository->updateAccountSecurity($pengguna);

            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public function deleteAccount(string $ID_Pengguna) : bool  {
        try {
            $pengguna = $this->penggunaRepository->getPenggunaById($ID_Pengguna);

            if ($pengguna === null) {
                throw new Exception('User not found.');
            }
            $pengguna = $this->penggunaRepository->updateStatus($ID_Pengguna, "TIDAK AKTIF");

            if (!$pengguna) {
                throw new Exception('Failed to delete account.');
            }

            return true;
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }
}
