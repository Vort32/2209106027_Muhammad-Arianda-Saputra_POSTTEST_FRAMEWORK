<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('rhine-lab');
});

Route::get('/rhineinfo', function () {
    return view('rhineinfo'); // nama file blade baru
});

Route::get('/rhineinfo', function () {
    $files = [
        ['name' => 'Experiment_Report.pdf', 'size' => '2 MB', 'type' => 'PDF'],
        ['name' => 'Cell_Structure.png', 'size' => '1.2 MB', 'type' => 'Image'],
        ['name' => 'Analysis_Data.xlsx', 'size' => '800 KB', 'type' => 'Excel'],

        // Arknights Materials (Rhine Lab style)
        ['name' => 'Orirock_Cube.docx', 'size' => '350 KB', 'type' => 'Document'],
        ['name' => 'Orirock_Cluster.pdf', 'size' => '420 KB', 'type' => 'PDF'],
        ['name' => 'Device_Chipset.png', 'size' => '1.1 MB', 'type' => 'Image'],
        ['name' => 'Integrated_Device.xlsx', 'size' => '920 KB', 'type' => 'Excel'],
        ['name' => 'Polyester_Pack.pptx', 'size' => '2.4 MB', 'type' => 'Presentation'],
        ['name' => 'Grindstone_Compound.pdf', 'size' => '780 KB', 'type' => 'PDF'],
        ['name' => 'Sugar_Substitute.png', 'size' => '1.6 MB', 'type' => 'Image'],
        ['name' => 'Loxic_Kohl_Analysis.docx', 'size' => '1.3 MB', 'type' => 'Document'],
        ['name' => 'Aketon_Sample.jpg', 'size' => '950 KB', 'type' => 'Image'],
        ['name' => 'Oriron_Cluster.xlsx', 'size' => '600 KB', 'type' => 'Excel'],
        ['name' => 'D32_Steel_Report.pdf', 'size' => '2.7 MB', 'type' => 'PDF'],
        ['name' => 'Bipolar_Nano_Flake.png', 'size' => '3.1 MB', 'type' => 'Image'],
        ['name' => 'White_Horse_Kohl.docx', 'size' => '1.8 MB', 'type' => 'Document'],
        ['name' => 'Incandescent_Alloy_Data.xlsx', 'size' => '1.9 MB', 'type' => 'Excel'],
        ['name' => 'RMA70-24_Test.pptx', 'size' => '2.6 MB', 'type' => 'Presentation'],
        ['name' => 'Optimized_Device.pdf', 'size' => '1.4 MB', 'type' => 'PDF'],
        ['name' => 'Orirock_Concentration.png', 'size' => '1.0 MB', 'type' => 'Image'],
    ];

    return view('rhineinfo', compact('files'));
});

