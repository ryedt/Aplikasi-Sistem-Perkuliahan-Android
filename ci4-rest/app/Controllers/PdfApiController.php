<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KrsModel;
use App\Models\UserModel; // Sesuaikan dengan model yang sesuai
use TCPDF;

class PdfApiController extends BaseController
{
    public function generatePdf($user_id)
    {
        // Mengakses model untuk mendapatkan data dari database
        $krsModel = new KrsModel();
        $usersModel = new UserModel(); // Sesuaikan dengan model yang sesuai
        $apiData = $krsModel->getDataByUserId($user_id);

        // Mendapatkan nama dan jurusan berdasarkan user_id
        $user = $usersModel->find($user_id);
        $nama = $user ? $user['fullname'] : '';
        $jurusan = $user ? $user['jurusan'] : '';

        // Buat objek TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Kartu Rencana Studi (KRS)');
        $pdf->SetHeaderData('', 0, 'Kartu Hasil Studi (KHS) - Jurusan: ' . $jurusan, 'Institut Teknologi Sapta Mandiri (ITSM)', array(0, 64, 255), array(0, 64, 128));
        $pdf->setHeaderFont(array('helvetica', '', 12));
        $pdf->setFooterFont(array('helvetica', '', 10));
        $pdf->SetDefaultMonospacedFont('courier');
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->SetFont('helvetica', '', 12);
        $pdf->AddPage();

        // Tampilkan tampilan PDF
        $pdfContent = view('krs_pdf', ['nama' => $nama, 'jurusan' => $jurusan, 'mata_kuliah' => $apiData]);
        $pdf->writeHTML($pdfContent, true, false, true, false, '');

        // Simpan PDF sebagai string
        $pdfOutput = $pdf->Output('krs_example.pdf', 'S');

        // Kirim response dengan PDF sebagai attachment
        return $this->response
            ->setStatusCode(200)
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="krs_example.pdf"')
            ->setBody($pdfOutput);
    }
}
