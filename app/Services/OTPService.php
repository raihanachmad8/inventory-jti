<?php

require_once __DIR__ . '/../Exceptions/ValidationException.php';
require_once __DIR__ . '/../../helpers/mailers.php';

class OTPService
{
    private OTPRepository $otpRepository;

    public function __construct(OTPRepository $otpRepository)
    {
        $this->otpRepository = $otpRepository;
    }

    public function createOTP(string $userId, string $Email): bool
    {
        try {
            $otpCode = rand(100000, 999999);
            $success = $this->otpRepository->createOTP($userId, $otpCode);
            if ($success) {
                $subject = "JTI Inventory - Verification Code";
                $this->sendOTP($Email, $subject, $otpCode);
            }
            return $success ? $otpCode : false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function verifyOTP(array $request): bool
    {
        try {
            $otp = $this->otpRepository->getOTP($request['ID_Pengguna'], $request['Kode']);

            if ($otp->Kode !== $request['Kode']) {
                throw new Exception('OTP is invalid.');
            }

            if ($otp->getIDPengguna() !== $request['ID_Pengguna']) {
                throw new Exception('OTP is invalid.');
            }
            if (!$this->deleteOTP($request['ID_Pengguna'])) {
                throw new Exception('Failed to delete OTP.');
            }
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteOTP(string $userId): bool
    {
        try {
            $success = $this->otpRepository->deleteOTP($userId);
            return $success;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getOTPByIdPengguna(string $ID_Pengguna): ?OTP
    {
        try {
            $otp = $this->otpRepository->getOTPByIdPengguna($ID_Pengguna);
            if (!$otp) {
                throw new Exception('OTP not found.');
            }
            return $otp;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function sendOTP(string $recipientEmail, string $subject, string $OTP): bool
    {
        $app_host = env('APP_HOST');
        $message = "<!DOCTYPE html>
        <html lang='en'>

        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Code OTP</title>
        </head>
        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap' rel='stylesheet'>
        <body style='margin: 0; padding: 0; font-family: 'inter' Arial, sans-serif; background-color: #e5e5e5; height: 100vh;'>

            <table role='presentation' cellspacing='0' cellpadding='0' style='width: 100%; height: 100%; background-color: #e5e5e5; padding-top: 50px;'>
                <tr>
                    <td align='center' style='padding: 20px;'>

                        <table role='presentation' cellspacing='0' cellpadding='0' style='max-width: 500px; width: 100%; background-color: #fff; border-radius: 4px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);'>
                        <tr>
                            <td style='padding: 16px 32px; text-align:center;'>
                                <img src='$app_host/public/assets/images/logo.jpeg.jpg' alt='JTI Inventory' style='width: 200px;'>
                            </td>
                        </tr>
                        <tr>
                            <td style='border-top: 2px solid #e5e5e5;'></td>
                        </tr>
                            <tr>
                                <td style='background-color: #fff; padding: 16px 32px;'>
                                    <h1 style='font-weight: 600; font-size: 1.25rem;'>Verify your Email address</h1>
                                    <p style='color: #333; font-weight: 500; font-size: .8rem;'>Thank you for starting the process of creating a new JTI Inventory account. We want to make sure that this is really you. Please enter the following verification code when prompted. If you don't want to create an account, you can ignore this message.</p>

                                    <table role='presentation' cellspacing='0' cellpadding='0' style='width: 100%; text-align: center;'>
                                        <tr>
                                            <td style='font-weight: 600; font-size: 1.125rem; padding: 16px;'>Verification Code</td>
                                        </tr>
                                        <tr>
                                            <td style='font-size: 2rem; font-weight: bold; margin: 10px 0; padding: 16px;'>$OTP</td>
                                        </tr>
                                        <tr>
                                            <td style='font-size: .7rem; padding: 16px;'>(This code is valid for 5 minutes)</td>
                                        </tr>
                                    </table>

                                    <div style='border-top: 2px solid #e5e5e5; padding: 16px;'>
                                        <p style='font-size: .8rem;'>JTI Inventory will never send you an Email asking you to disclose or verify your password, credit card, or banking account number.</p>
                                    </div>

                                </td>
                            </tr>
                        </table>

                        <table role='presentation' cellspacing='0' cellpadding='0' style='max-width: 400px; width: 100%; text-align: center; margin: 0 auto;'>
                            <tr>
                                <td style='padding: 20px;'>
                                    <p style='font-size: .8rem;'>Pesan ini dibuat dan didistribusikan oleh © JTI Inventory 2023. Seluruh hak cipta dilindungi oleh undang-undang.</p>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>

        </body>


        </html>
        ";
        $mailers = new Maillers();
        try {
            $mailers->sendMail($recipientEmail, $subject, $message);
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

}
