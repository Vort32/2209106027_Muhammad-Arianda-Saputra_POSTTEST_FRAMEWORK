<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\ResearchDocument;
use App\Models\ResearchProject;
use App\Models\ResearchRecord;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class ResearchDataSeeder extends Seeder
{
    public function run(): void
    {
        ResearchDocument::query()->delete();
        ResearchRecord::query()->delete();
        ResearchProject::query()->delete();
        Division::query()->delete();

        $userDefinitions = [
            [
                'name' => 'Silence',
                'email' => 'silence@rhine-lab.oripathy',
                'position' => 'Kepala Divisi Biokimia',
                'affiliation' => 'Rhine Lab / Rhodes Island',
                'origin' => 'Columbia',
                'photo_path' => 'images/users/Silence.png',
                'biography' => 'Peneliti biokimia yang menyeimbangkan tugasnya di Rhine Lab dan Rhodes Island, fokus pada terapi Oripathy yang aman.',
            ],
            [
                'name' => 'Ifrit',
                'email' => 'ifrit@rhine-lab.oripathy',
                'position' => 'Subjek Uji Klinis',
                'affiliation' => 'Rhine Lab / Rhodes Island',
                'origin' => 'Rim Billiton',
                'photo_path' => 'images/users/ifrit.png',
                'biography' => 'Operator Rhodes Island dengan kekuatan Arts destruktif yang diteliti untuk mengembangkan pengendalian Originium.',
            ],
            [
                'name' => 'Saria',
                'email' => 'saria@rhine-lab.oripathy',
                'position' => 'Administrator Teknik Energi',
                'affiliation' => 'Rhine Lab',
                'origin' => 'Rim Billiton',
                'photo_path' => 'images/users/saria.png',
                'biography' => 'Eks manajer Rhine Lab yang kini memimpin operasi keamanan dan penelitian energi Originium.',
            ],
            [
                'name' => 'Heidi',
                'email' => 'heidi@rhine-lab.oripathy',
                'position' => 'Peneliti Lapangan',
                'affiliation' => 'Rhine Lab',
                'origin' => 'Laterano',
                'photo_path' => 'images/users/heidi.png',
                'biography' => 'Peneliti muda yang mendokumentasikan dampak Originium di garis depan serta mengoordinasikan rehabilitasi operator.',
            ],
            [
                'name' => 'Mayer',
                'email' => 'mayer@rhine-lab.oripathy',
                'position' => 'Insinyur Perangkat Originium',
                'affiliation' => 'Rhine Lab',
                'origin' => 'Columbia',
                'photo_path' => 'images/users/mayer.png',
                'biography' => 'Insinyur eksentrik spesialis perangkat otomatisasi yang memaksimalkan penggunaan Originium secara aman.',
            ],
            [
                'name' => 'Ptilopsis',
                'email' => 'ptilopsis@rhine-lab.oripathy',
                'position' => 'Administrator Arsip',
                'affiliation' => 'Rhine Lab',
                'origin' => 'Iberia',
                'photo_path' => 'images/users/ptilopsis.png',
                'biography' => 'Supervisor arsip yang mengkoordinasikan distribusi informasi rahasia Rhine Lab dengan presisi mekanis.',
            ],
        ];

        $usersByEmail = [];

        foreach ($userDefinitions as $definition) {
            $usersByEmail[$definition['email']] = User::updateOrCreate(
                ['email' => $definition['email']],
                [
                    'name' => $definition['name'],
                    'password' => bcrypt('secret123'),
                    'photo_path' => $definition['photo_path'],
                    'position' => $definition['position'],
                    'affiliation' => $definition['affiliation'],
                    'origin' => $definition['origin'],
                    'biography' => $definition['biography'],
                ]
            );
        }

        $divisionsData = [
            [
                'code' => 'BIO-01',
                'name' => 'Divisi Biokimia Rhine Lab',
                'lead_scientist' => 'Silence',
                'mission' => 'Mengembangkan terapi Oripathy berbasis reaksi biokimia yang stabil.',
                'established_at' => '1098-02-14',
                'photo_path' => 'images/divisions/bio.svg',
                'projects' => [
                    [
                        'title' => 'Rekayasa Cairan Originium Terkontrol',
                        'reference_code' => 'RL-BIO-001',
                        'status' => 'aktif',
                        'initiated_at' => '1102-05-03',
                        'objective' => 'Mengisolasi efek Originium pada jaringan sensitif untuk terapi klinis.',
                        'records' => [
                            [
                                'user_email' => 'silence@rhine-lab.oripathy',
                                'record_code' => 'REC-BIO-4521',
                                'classification' => 'internal',
                                'status' => 'final',
                                'recorded_at' => '1104-08-17',
                                'summary' => 'Silence menegaskan bahwa penambahan katalis berbasis Ursus menurunkan volatilitas Originium dalam sampel darah pasien percobaan.',
                                'documents' => [
                                    [
                                        'label' => 'Laporan Sintesis Hari Ke-30',
                                        'document_type' => 'laporan',
                                        'access_level' => 'internal',
                                        'storage_path' => 'arsip/bio/lap-30.pdf',
                                    ],
                                    [
                                        'label' => 'Grafik Reaksi Termal',
                                        'document_type' => 'dataset',
                                        'access_level' => 'restricted',
                                        'storage_path' => 'arsip/bio/termal-reaksi.csv',
                                    ],
                                ],
                            ],
                            [
                                'user_email' => 'mayer@rhine-lab.oripathy',
                                'record_code' => 'REC-BIO-4522',
                                'classification' => 'internal',
                                'status' => 'review',
                                'recorded_at' => '1104-09-02',
                                'summary' => 'Mayer melaporkan stabilitas modul otomatis yang mampu mengatur dosis Originium cair secara presisi pada percobaan hewan.',
                                'documents' => [
                                    [
                                        'label' => 'Blueprint Modul Otomatis',
                                        'document_type' => 'desain',
                                        'access_level' => 'restricted',
                                        'storage_path' => 'arsip/bio/blueprint-modul.dwg',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'title' => 'Pemantauan Infeksi Oripathy Anak-anak',
                        'reference_code' => 'RL-BIO-002',
                        'status' => 'aktif',
                        'initiated_at' => '1101-11-21',
                        'objective' => 'Mencari metode pemantauan kontinu untuk pasien anak di Rhodes Island.',
                        'records' => [
                            [
                                'user_email' => 'ifrit@rhine-lab.oripathy',
                                'record_code' => 'REC-BIO-4721',
                                'classification' => 'rahasia',
                                'status' => 'draft',
                                'recorded_at' => '1104-10-11',
                                'summary' => 'Catatan Ifrit mengenai respons Originum Arts miliknya ketika dipasangkan dengan gelang pengawas infeksi terbaru.',
                                'documents' => [
                                    [
                                        'label' => 'Catatan Vital Pasien',
                                        'document_type' => 'log',
                                        'access_level' => 'restricted',
                                        'storage_path' => 'arsip/bio/vital-ifrit.log',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'ENG-03',
                'name' => 'Divisi Teknik Energi Rhine Lab',
                'lead_scientist' => 'Saria',
                'mission' => 'Mengoptimalkan distribusi energi Originium untuk fasilitas industri.',
                'established_at' => '1096-07-09',
                'photo_path' => 'images/divisions/eng.svg',
                'projects' => [
                    [
                        'title' => 'Reaktor Portabel Rhodes Island',
                        'reference_code' => 'RL-ENG-014',
                        'status' => 'aktif',
                        'initiated_at' => '1103-01-12',
                        'objective' => 'Membangun reaktor Originium berukuran lapangan untuk operasi taktis.',
                        'records' => [
                            [
                                'user_email' => 'saria@rhine-lab.oripathy',
                                'record_code' => 'REC-ENG-7711',
                                'classification' => 'rahasia',
                                'status' => 'final',
                                'recorded_at' => '1104-04-22',
                                'summary' => 'Saria menguraikan protokol keamanan baru setelah kecelakaan reaktor eksperimental di Sargon.',
                                'documents' => [
                                    [
                                        'label' => 'Protokol Keamanan Reaktor',
                                        'document_type' => 'manual',
                                        'access_level' => 'restricted',
                                        'storage_path' => 'arsip/eng/protokol-reaktor.pdf',
                                    ],
                                    [
                                        'label' => 'Simulasi Dampak Energi',
                                        'document_type' => 'dataset',
                                        'access_level' => 'internal',
                                        'storage_path' => 'arsip/eng/simulasi-energi.csv',
                                    ],
                                ],
                            ],
                            [
                                'user_email' => 'heidi@rhine-lab.oripathy',
                                'record_code' => 'REC-ENG-7714',
                                'classification' => 'internal',
                                'status' => 'review',
                                'recorded_at' => '1104-07-15',
                                'summary' => 'Heidi menilai performa lapangan prototipe reaktor saat memasok energi ke pos terpencil Lungmen.',
                                'documents' => [
                                    [
                                        'label' => 'Laporan Uji Lapangan',
                                        'document_type' => 'laporan',
                                        'access_level' => 'internal',
                                        'storage_path' => 'arsip/eng/uji-lapangan.pdf',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'title' => 'Jaringan Penyalur Originium Kota Chernobog',
                        'reference_code' => 'RL-ENG-020',
                        'status' => 'arsip',
                        'initiated_at' => '1099-09-01',
                        'objective' => 'Mereplikasi jaringan energi Rhine Lab untuk kota-kota perbatasan.',
                        'records' => [
                            [
                                'user_email' => 'mayer@rhine-lab.oripathy',
                                'record_code' => 'REC-ENG-7990',
                                'classification' => 'internal',
                                'status' => 'final',
                                'recorded_at' => '1100-12-19',
                                'summary' => 'Mayer menyusun laporan akhir penutupan jaringan setelah insiden Chernobog.',
                                'documents' => [
                                    [
                                        'label' => 'Catatan Tambahan Rute Energi',
                                        'document_type' => 'log',
                                        'access_level' => 'restricted',
                                        'storage_path' => 'arsip/eng/rute-energi.log',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'MED-07',
                'name' => 'Divisi Medis Rhine Lab',
                'lead_scientist' => 'Lava the Purgatory',
                'mission' => 'Mengadaptasi seni Originium untuk perawatan pasien Oripathy kronis.',
                'established_at' => '1100-01-05',
                'photo_path' => 'images/divisions/med.svg',
                'projects' => [
                    [
                        'title' => 'Pengembangan Serum Penstabil Sarkaz',
                        'reference_code' => 'RL-MED-031',
                        'status' => 'aktif',
                        'initiated_at' => '1103-09-17',
                        'objective' => 'Menekan reaksi Originium berbahaya pada tubuh Sarkaz.',
                        'records' => [
                            [
                                'user_email' => 'silence@rhine-lab.oripathy',
                                'record_code' => 'REC-MED-8821',
                                'classification' => 'rahasia',
                                'status' => 'review',
                                'recorded_at' => '1104-06-09',
                                'summary' => 'Silence mendokumentasikan efek samping ringan pada pasien Sarkaz fase awal ketika serum diberikan selama tujuh hari berturut-turut.',
                                'documents' => [
                                    [
                                        'label' => 'Rekaman Observasi Klinik',
                                        'document_type' => 'log',
                                        'access_level' => 'restricted',
                                        'storage_path' => 'arsip/med/observasi-klinik.log',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'title' => 'Program Rehabilitasi Operator Rhodes Island',
                        'reference_code' => 'RL-MED-034',
                        'status' => 'aktif',
                        'initiated_at' => '1104-02-27',
                        'objective' => 'Mendesain terapi fisik dan mental bagi operator yang terpapar operasi tinggi.',
                        'records' => [
                            [
                                'user_email' => 'heidi@rhine-lab.oripathy',
                                'record_code' => 'REC-MED-8842',
                                'classification' => 'internal',
                                'status' => 'draft',
                                'recorded_at' => '1104-08-02',
                                'summary' => 'Heidi menyusun modul latihan pernapasan yang terinspirasi dari teknik Guard Rhodes Island.',
                                'documents' => [
                                    [
                                        'label' => 'Modul Latihan Tahap 1',
                                        'document_type' => 'manual',
                                        'access_level' => 'internal',
                                        'storage_path' => 'arsip/med/modul-tahap1.pdf',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'ARC-09',
                'name' => 'Divisi Arsip & Intel Rhine Lab',
                'lead_scientist' => 'Ptilopsis',
                'mission' => 'Mengelola penyimpanan data penelitian dan catatan operasi rahasia.',
                'established_at' => '1095-04-22',
                'photo_path' => 'images/divisions/arc.svg',
                'projects' => [
                    [
                        'title' => 'Metode Enkripsi Arsip Horizon',
                        'reference_code' => 'RL-ARC-008',
                        'status' => 'aktif',
                        'initiated_at' => '1104-01-10',
                        'objective' => 'Mengamankan data proyek Horizon Arc dari kebocoran eksternal.',
                        'records' => [
                            [
                                'user_email' => 'ptilopsis@rhine-lab.oripathy',
                                'record_code' => 'REC-ARC-9911',
                                'classification' => 'rahasia',
                                'status' => 'final',
                                'recorded_at' => '1104-04-30',
                                'summary' => 'Ptilopsis mencatat keberhasilan integrasi pola sinyal Originium sebagai kunci enkripsi berlapis.',
                                'documents' => [
                                    [
                                        'label' => 'Skema Enkripsi',
                                        'document_type' => 'diagram',
                                        'access_level' => 'clearance-2',
                                        'storage_path' => 'arsip/arc/skema-enkripsi.png',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'title' => 'Digitalisasi Catatan Rhodes Island',
                        'reference_code' => 'RL-ARC-011',
                        'status' => 'aktif',
                        'initiated_at' => '1103-06-25',
                        'objective' => 'Mendigitalisasi catatan kolaborasi antara Rhine Lab dan Rhodes Island.',
                        'records' => [
                            [
                                'user_email' => 'silence@rhine-lab.oripathy',
                                'record_code' => 'REC-ARC-9932',
                                'classification' => 'internal',
                                'status' => 'review',
                                'recorded_at' => '1104-05-19',
                                'summary' => 'Silence memverifikasi metadata penelitian lapangan agar mudah dilacak oleh operator Rhodes Island.',
                                'documents' => [
                                    [
                                        'label' => 'Daftar Metadata',
                                        'document_type' => 'dataset',
                                        'access_level' => 'internal',
                                        'storage_path' => 'arsip/arc/metadata-ri.xlsx',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'code' => 'DEV-12',
                'name' => 'Divisi Pengembangan Perangkat Rhine Lab',
                'lead_scientist' => 'Mayer',
                'mission' => 'Merancang perangkat dukungan operator berbasis Originium Arts.',
                'established_at' => '1101-03-14',
                'photo_path' => 'images/divisions/dev.svg',
                'projects' => [
                    [
                        'title' => 'Drone Pengawas Binaural',
                        'reference_code' => 'RL-DEV-041',
                        'status' => 'aktif',
                        'initiated_at' => '1104-03-03',
                        'objective' => 'Mengembangkan drone kecil yang mampu memetakan resonansi Originium secara real-time.',
                        'records' => [
                            [
                                'user_email' => 'mayer@rhine-lab.oripathy',
                                'record_code' => 'REC-DEV-1201',
                                'classification' => 'internal',
                                'status' => 'draft',
                                'recorded_at' => '1104-07-28',
                                'summary' => 'Mayer mencatat respons sensorik drone terhadap serangan Arts operator caster Rhodes Island.',
                                'documents' => [
                                    [
                                        'label' => 'Log Uji Coba Drone',
                                        'document_type' => 'log',
                                        'access_level' => 'internal',
                                        'storage_path' => 'arsip/dev/log-drone.txt',
                                    ],
                                    [
                                        'label' => 'Skema Resonansi',
                                        'document_type' => 'diagram',
                                        'access_level' => 'restricted',
                                        'storage_path' => 'arsip/dev/resonansi.png',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'title' => 'Perisai Medis Originium',
                        'reference_code' => 'RL-DEV-045',
                        'status' => 'aktif',
                        'initiated_at' => '1104-01-19',
                        'objective' => 'Merancang perisai portabel yang mampu menahan flare Originium pada pasien kritis.',
                        'records' => [
                            [
                                'user_email' => 'saria@rhine-lab.oripathy',
                                'record_code' => 'REC-DEV-1207',
                                'classification' => 'rahasia',
                                'status' => 'review',
                                'recorded_at' => '1104-09-09',
                                'summary' => 'Saria menilai efektivitas lapisan penahan Originium berdasarkan standar pertahanan Rhodes Island.',
                                'documents' => [
                                    [
                                        'label' => 'Hasil Uji Tekanan',
                                        'document_type' => 'dataset',
                                        'access_level' => 'restricted',
                                        'storage_path' => 'arsip/dev/uji-tekanan.csv',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($divisionsData as $divisionData) {
            $projects = Arr::pull($divisionData, 'projects', []);
            $division = Division::create($divisionData);

            foreach ($projects as $projectData) {
                $records = Arr::pull($projectData, 'records', []);
                $project = ResearchProject::create(array_merge($projectData, [
                    'division_id' => $division->id,
                ]));

                foreach ($records as $recordData) {
                    $documents = Arr::pull($recordData, 'documents', []);
                    $userEmail = Arr::pull($recordData, 'user_email');
                    $user = $usersByEmail[$userEmail] ?? null;

                    if (!$user) {
                        continue;
                    }

                    $record = ResearchRecord::create([
                        'research_project_id' => $project->id,
                        'user_id' => $user->id,
                        'record_code' => $recordData['record_code'],
                        'classification' => $recordData['classification'],
                        'status' => $recordData['status'],
                        'recorded_at' => Carbon::parse($recordData['recorded_at']),
                        'summary' => $recordData['summary'],
                    ]);

                    foreach ($documents as $documentData) {
                        ResearchDocument::create(array_merge($documentData, [
                            'research_record_id' => $record->id,
                        ]));
                    }
                }
            }
        }
    }
}
