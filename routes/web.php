<?php

use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/frontend.php';
// require __DIR__ . '/fortify-admin.php';


// Temporary test route - remove after testing!
Route::get('/test-certificate/{student}', function (App\Models\Student $student) {
    $service = app(App\Services\CertificateService::class);
    $pdf = $service->downloadCertificate($student);

    return response($pdf)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="certificate-' . $student->name . '.pdf"');
});
