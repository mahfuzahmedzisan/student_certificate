<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use TCPDF;

/**
 * Certificate Service using TCPDF (Pure PHP Solution)
 * No Python or external dependencies required
 * 
 * Installation: composer require tecnickcom/tcpdf
 */
class CertificateService
{
    protected $imagesPath;

    public function __construct()
    {
        $this->imagesPath = storage_path('app/certificate-images');
    }

    /**
     * Download certificate for a student
     * 
     * @param mixed $student Student model instance
     * @return string PDF binary content
     */
    public function downloadCertificate($student): string
    {
        Log::info('Generating certificate for student', [
            'student_id' => $student->id,
            'student_name' => $student->name,
        ]);

        return $this->generatePdfWithTCPDF($student);
    }

    /**
     * Generate PDF using TCPDF
     */
    protected function generatePdfWithTCPDF($student): string
    {
        // Suppress PNG warnings by temporarily disabling error reporting for GD
        $oldErrorLevel = error_reporting();
        error_reporting($oldErrorLevel & ~E_WARNING);

        // Create new PDF document (Landscape, pixels, custom size)
        $pdf = new TCPDF('L', 'px', [860, 610], true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Espresso Express Cafe');
        $pdf->SetAuthor('Training Center');
        $pdf->SetTitle('Training Certificate - ' . $student->name);
        $pdf->SetSubject('Barista Professional Training Certificate');

        // Remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Set margins to 0 for full control
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetAutoPageBreak(false, 0);

        // Add a page
        $pdf->AddPage();

        // ============ BACKGROUND IMAGE ============
        $bgImage = $this->getImagePath('main-bg-2.png');
        if ($bgImage) {
            $pdf->Image($bgImage, 0, 0, 860, 610, '', '', '', false, 300, '', false, false, 0);
        } else {
            // Fallback: white background
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Rect(0, 0, 860, 610, 'F');
        }

        // ============ WATERMARK LOGO (BACKGROUND) ============
        $bgLogo = $this->getImagePath('bg-logo.png');
        if ($bgLogo) {
            // Set alpha for transparency
            $pdf->SetAlpha(0.15);
            $pdf->Image($bgLogo, 180, 180, 500, 250, '', '', '', false, 300, '', false, false, 0);
            $pdf->SetAlpha(1); // Reset alpha
        }

        // ============ TOP LEFT QR CODE ============
        $qrImage = $this->getImagePath('scan.jpg');
        if ($qrImage) {
            $pdf->Image($qrImage, 40, 50, 80, 80, '', '', '', false, 300);
        }

        // ============ CERTIFICATE TEXT IMAGE (CENTER TOP) ============
        $textImage = $this->getImagePath('text.png');
        if ($textImage) {
            $pdf->SetAlpha(1);
            $pdf->Image($textImage, 180, 50, 500, 100, '', '', '', false, 300, '', false, false, 0);
        }

        // ============ TOP RIGHT LOGO ============
        $logoImage = $this->getImagePath('logo.png');
        if ($logoImage) {
            $pdf->Image($logoImage, 660, 50, 160, 160, '', '', '', false, 300);
        }

        // ============ STUDENT NAME (GOLD COLOR) ============
        $pdf->SetFont('helvetica', 'B', 29);
        $pdf->SetTextColor(212, 160, 23); // Gold color #D4A017
        $pdf->SetXY(0, 220);
        $studentName = strtoupper($student->name ?? 'STUDENT NAME');
        $pdf->Cell(860, 40, $studentName, 0, 0, 'C');

        // ============ LINE UNDER NAME ============
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(2);
        $pdf->Line(110, 258, 750, 258);

        // ============ CERTIFICATE TEXT ============
        $pdf->SetFont('helvetica', '', 24);
        $pdf->SetTextColor(17, 17, 17);

        // First line
        $pdf->SetXY(60, 275);
        $line1 = 'Has Successfully Completed Barista Professional Training at';
        $pdf->Cell(740, 10, $line1, 0, 0, 'C');

        // Second line (bold)
        $pdf->SetFont('helvetica', 'B', 26);
        $pdf->SetXY(60, 305);
        $line2 = 'Espresso Express Cafe,';
        $pdf->Cell(740, 10, $line2, 0, 0, 'C');

        // Third line
        $pdf->SetFont('helvetica', '', 24);
        $pdf->SetXY(60, 335);
        $line3 = 'Coffee Training Center at BD.';
        $pdf->Cell(740, 10, $line3, 0, 0, 'C');

        // ============ PASSPORT INFO BOX ============
        $boxX = 230;
        $boxY = 375;
        $boxWidth = 400;
        $boxHeight = 50;

        // Draw rounded rectangle border
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(2.8);
        $pdf->SetFillColor(255, 255, 255); // White background
        $pdf->RoundedRect($boxX, $boxY, $boxWidth, $boxHeight, 12, '1111', 'D');

        // Passport info text
        $pdf->SetFont('helvetica', 'B', 18);
        $pdf->SetTextColor(0, 0, 0);

        $passportNum = $student->passport_id ?? 'N/A';
        $pdf->SetXY($boxX + 20, $boxY + 12);
        $pdf->Cell($boxWidth - 40, 10, 'Passport Number : ' . $passportNum, 0, 0, 'L');

        $pdf->SetXY($boxX + 20, $boxY + 32);
        $pdf->Cell($boxWidth - 40, 10, 'Nationality : Bangladeshi', 0, 0, 'L');

        // ============ BOTTOM RIGHT QR CODE ============
        if ($qrImage) {
            $pdf->Image($qrImage, 660, 360, 80, 80, '', '', '', false, 300);
        }

        // ============ DATE SECTION (BOTTOM LEFT) ============
        $pdf->SetFont('helvetica', '', 18);
        $pdf->SetTextColor(0, 0, 0);

        $dateText = strtoupper(now()->format('jS F, Y'));
        $pdf->SetXY(100, 500);
        $pdf->Cell(180, 10, $dateText, 0, 0, 'C');

        // Date underline
        $pdf->SetDrawColor(168, 168, 168);
        $pdf->SetLineWidth(2);
        $pdf->Line(140, 515, 250, 515);

        // "DATE" label
        $pdf->SetXY(100, 520);
        $pdf->Cell(180, 10, 'DATE', 0, 0, 'C');

        // ============ SIGNATURE SECTION (BOTTOM RIGHT) ============
        $sigImage = $this->getImagePath('signature.png');
        if ($sigImage) {
            $pdf->Image($sigImage, 617, 498, 65, 22, '', '', '', false, 300);
        }

        // Signature underline
        $pdf->Line(600, 515, 710, 515);

        // Signature name
        $pdf->SetXY(580, 520);
        $pdf->Cell(180, 10, 'MD AL AMIN', 0, 0, 'C');

        // Restore error reporting
        error_reporting($oldErrorLevel);

        // Output PDF as string
        return $pdf->Output('', 'S');
    }

    /**
     * Get image path if it exists
     * 
     * @param string $filename
     * @return string|null
     */
    protected function getImagePath(string $filename): ?string
    {
        $path = $this->imagesPath . '/' . $filename;
        return file_exists($path) ? $path : null;
    }
}
