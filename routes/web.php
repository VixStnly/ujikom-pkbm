<?php

use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail; // tambahkan ini
use App\Mail\SendEmail; // tambahkan ini
use App\Http\Controllers\GuruController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseSiswaController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\KategoriGaleriController;
use App\Http\Controllers\PendaftaranController;

use App\Http\Controllers\SiswaCreateController;
use App\Http\Controllers\FaceVerificationController;

use App\Http\Controllers\ReviewMateriSiswaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\TugasSiswaController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\KelasUserController;
use App\Http\Controllers\SubmitTugasController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\VisiController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\ViewBlogController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FisologiController;
use App\Http\Controllers\NotificationController;
use App\Models\Blog;
use App\Http\Controllers\ForumController;
// Admin memilih guru dan melihat data kelas si guru
Route::get('/admin/view-guru/{id}/kelas', [\App\Http\Controllers\AdminViewGuruController::class, 'kelasGuru'])->name('admin.viewGuru.kelas');
Route::post('/admin/clear-guru-view', function () {
    session()->forget('view_as_guru_id');
    return redirect('/admin/guru'); // Atau ke halaman yang kamu mau
})->name('admin.clearGuruView');

Route::middleware(['auth'])->group(function () {
    Route::get('/forum/{meeting}', [ForumController::class, 'index'])->name('forum.index');
    Route::put('/forum/{meeting}', [ForumController::class, 'update'])->name('forum.update');
    Route::delete('/forum/{meeting}', [ForumController::class, 'destroy'])->name('forum.destroy');
    Route::post('/forum/{meeting}', [ForumController::class, 'store'])->name('forum.store');
    Route::post('/forums/{id}/like', [ForumController::class, 'like'])->name('forums.like');

    Route::get('/notifications', [NotificationController::class, 'fetch'])->name('notifications');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.read-all');
});



Route::get('/generate', function(){
   \Illuminate\Support\Facades\Artisan::call('storage:link');
   echo 'ok';
});

// Route to impersonate a user
Route::post('/impersonate/{user}', [DataGuruController::class, 'impersonate'])->name('impersonate');
Route::post('/imperson/leave', [DataGuruController::class, 'leaveImpersonation'])->name('imperson.leave');
// routes/web.php
// Route for fetching classes by guru
Route::get('/kelas-by-guru', [SiswaCreateController::class, 'getKelasByGuru'])->name('get.kelas.by.guru');

// Route for fetching subjects by kelas
Route::get('/subjects-by-kelas', [SiswaCreateController::class, 'getSubjectsByKelas'])->name('get.subjects.by.kelas');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::get('users/create-siswa', [SiswaCreateController::class, 'createSiswa'])->name('users.createSiswa');
    Route::post('users/store-siswa', [SiswaCreateController::class, 'storeSiswa'])->name('users.storeSiswa');
});
Route::get('/get-subjects/{kelas_id}', [UserController::class, 'getSubjectsByKelas']);

Route::get('/captcha', [AuthenticatedSessionController::class, 'captcha']);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('guru', DataGuruController::class);

});
Route::get('/get-subjects', [UserController::class, 'getSubjects']);

Route::get('/histori/absen', [HistoriController::class, 'absen']);
Route::get('/histori/tugas', [HistoriController::class, 'tugas']);

// Route untuk menampilkan blog berdasarkan ID
Route::get('/blog/{id}', [ViewBlogController::class, 'show'])->name('viewblog.show');

// web.php
Route::get('/submission/{id}/score', [SubmitTugasController::class, 'getScore']);

Route::get('/download-all/{user_id}', [SubmitTugasController::class, 'downloadAllFiles'])->name('download.all.files');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('announcements', AnnouncementController::class);
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('blogs', BlogsController::class);
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('gallery', GalleryController::class);
});

// routes/web.php
Route::get('/gallery', [GalleryController::class, 'showCategories'])->name('gallery.categories');

Route::get('/Visi&Misi', [VisiController::class, 'index'])->name('Visi');

Route::get('/Profile', [FisologiController::class, 'index'])->name('Profile');


Route::get('/gallery/album/{kategori_id}', [GalleryController::class, 'showAlbum'])->name('gallery.album');

//Contact
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');

// Rute untuk mengirim email
Route::post('/contact/send', [ContactController::class, 'sendEmail'])->name('contact.send');


Route::middleware('auth')->group(function () {
    Route::resource('subjects', SubjectController::class);
});

// Rute untuk menampilkan semua pertemuan berdasarkan subject_id
Route::get('/subjects/{subject_id}/meetings', [MeetingController::class, 'showMeetings'])->name('meetings.index');

// Rute untuk menampilkan detail pertemuan tertentu
Route::get('/meetings/{id}', [MeetingController::class, 'show'])->name('meetings.show');

Route::resource('kelas_user', KelasUserController::class);

Route::get('/kelas/{grade}', function ($grade) {
    $kelas = Kelas::where('grade', $grade)->get();
    return response()->json($kelas);
});

// Index route
Route::get('admin/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');

// Create route
Route::get('admin/kelas/create', [KelasController::class, 'create'])->name('admin.kelas.create');

// Store route
Route::post('admin/kelas', [KelasController::class, 'store'])->name('admin.kelas.store');

// Show route
Route::get('admin/kelas/{kelas}', [KelasController::class, 'show'])->name('admin.kelas.show');

// Edit route
Route::get('admin/kelas/{kelas}/edit', [KelasController::class, 'edit'])->name('admin.kelas.edit');

// Update route
Route::put('admin/kelas/{kelas}', [KelasController::class, 'update'])->name('admin.kelas.update');

// Destroy route
Route::delete('admin/kelas/{kelas}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy');

Route::resource('kelas_user', KelasUserController::class);

// Rute untuk menyimpan komentar
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

// Rute untuk membalas komentar
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');

Route::resource('tasks', TasksController::class);

// Tugas Siswa
Route::middleware('auth')->group(function () {
    Route::resource('tugas', TugasSiswaController::class);
});

// Route to display the list of absensi
Route::get('/admin/absensi', [AbsensiController::class, 'index'])->name('admin.absensi.index');

// Route to show the form for creating a new absensi
Route::get('/admin/absensi/create', [AbsensiController::class, 'create'])->name('admin.absensi.create');

// Route to store a new absensi
Route::post('/admin/absensi', [AbsensiController::class, 'store'])->name('admin.absensi.store');

// Route to show a specific absensi
Route::get('/admin/absensi/{absensi}', [AbsensiController::class, 'show'])->name('admin.absensi.show');

// Route to show the form for editing a specific absensi
Route::get('/admin/absensi/{absensi}/edit', [AbsensiController::class, 'edit'])->name('admin.absensi.edit');

// Route to update a specific absensi
Route::put('/admin/absensi/{absensi}', [AbsensiController::class, 'update'])->name('admin.absensi.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/absence', [AbsensiController::class, 'showAbsenceForm'])->name('absence.form');
    Route::post('/absence', [AbsensiController::class, 'processAbsence'])->name('absence.process');

    // Real-time API hit Face++ buat deteksi persentase
    Route::post('/api/compare-face', [AbsensiController::class, 'compareFace'])->name('api.face.compare');
});
// Route to delete a specific absensi
Route::delete('/admin/absensi/{absensi}', [AbsensiController::class, 'destroy'])->name('admin.absensi.destroy');

Route::middleware('auth')->group(function () {
    Route::get('submit/tugas/{id}', [SubmitTugasController::class, 'show'])->name('submit.tugas.show');
    Route::post('submit/tugas/{id}', [SubmitTugasController::class, 'store'])->name('submit.tugas.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/siswa/absensi/{meeting}', [AbsensiController::class, 'SiswaAbsensiForm'])->name('siswa.absensi');
    Route::post('/siswa/absensi/{meeting}', [AbsensiController::class, 'siswaAbsensiStore'])->name('siswa.absensi.store');
});
Route::post('/verify-face', [FaceVerificationController::class, 'verifyFace']);


Route::resource('kategori_galeri', KategoriGaleriController::class);


Route::get('admin/users/{id}', [UserController::class, 'show'])->name('admin.users.show');


Route::get('/materi/{id}/download', [ReviewMateriSiswaController::class, 'download'])->name('materi.download');

Route::get('/materi/{id}', [ReviewMateriSiswaController::class, 'show'])->name('materi.show');



Route::middleware('auth')->group(function () {
    Route::resource('course', CourseSiswaController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('courses', CourseController::class);
    Route::resource('kelas', KelasController::class);
});


Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('admin/add/user', [UserController::class, 'create'])->name('admin.users.create');
Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');
Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::put('admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');


// web.php

Route::get('admin/gurus', [UserController::class, 'gurus'])->name('admin.gurus.index');
// web.php

Route::get('admin/admins', [UserController::class, 'admins'])->name('admin.admins.index');
Route::get('admin/siswas', [UserController::class, 'siswas'])->name('admin.siswas.index');


Route::get('/', [WelcomeController::class, 'showContent'])->name('welcome');






// routes/web.php
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/akses', [ErrorController::class, 'index'])->name('akses');

// web.php



Route::middleware(['auth'])->group(function () {
    Route::get('/profileGuru', [UserProfileController::class, 'editGuru'])->name('profile.editGuru');
    Route::get('/profileAdmin', [UserProfileController::class, 'editAdmin'])->name('profile.editAdmin');
    Route::post('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
});



//pengumpulan tugas
Route::get('/tugas/{id}/review', [TugasController::class, 'reviewTugas'])->name('guru.tugas.review');
Route::post('tugas/beriNilai/{submissionId}', [TugasController::class, 'storeOrUpdateScore'])->name('guru.tugas.beriNilai');


//meeting klik
Route::get('/guru/meetings/{meeting}', [MeetingController::class, 'show'])->name('guru.meetings.show');
Route::get('/guru/meetings/{meeting}/tugas/create', [TugasController::class, 'create'])->name('guru.tugas.create');
Route::post('/guru/meetings/{meeting}/tugas', [TugasController::class, 'store'])->name('guru.tugas.store');
Route::get('guru/materi/create/{meeting_id}', [MateriController::class, 'createM'])->name('guru.materi.createM');
Route::get('guru/materi/create/', [MateriController::class, 'create'])->name('guru.materi.create');
Route::get('guru/meetings/create/{subject_id}', [MeetingController::class, 'createS'])->name('guru.meeting.createS');


Route::get('/guru/kelas', [KelasController::class, 'indexGuru'])->name('guru.kelas.index');
Route::get('/guru/kelas/pelajaran', [KelasController::class, 'pelajaran'])->name('guru.kelas.pelajaran');
Route::get('/guru/kelas/{kelas}/siswa', [KelasController::class, 'getSiswa']);
Route::get('/kelas/{kelas}/siswa/{meetingId}', [KelasController::class, 'showSiswa'])->name('guru.kelas.siswa');
// routes/web.php
Route::get('/guru/kelas/{kelas}/subject/{subject}/meeting', [KelasController::class, 'showMeeting'])->name('guru.kelas.meeting');
Route::get('/guru/kelas/{kelas}/subject', [KelasController::class, 'subject'])->name('guru.kelas.pelajaran');
// Di routes/web.php
Route::get('/guru/siswa/export', [KelasController::class, 'exportSiswa'])->name('guru.siswa.export');


// Route untuk halaman utama yang menampilkan daftar kelas
Route::get('guru/report', [ReportController::class, 'index'])->name('guru.reports.index');
Route::get('guru/report/siswa/{kelasId}', [ReportController::class, 'report'])->name('guru.reports.siswa');

// File routes/web.php
Route::get('guru/reports/laporan/create/{studentId}/{kelasId}', [ReportController::class, 'create'])->name('guru.reports.laporan.create');
// Rute untuk menyimpan nilai yang dimasukkan
Route::post('guru/reports/laporan/store/{studentId}/{kelasId}', [ReportController::class, 'store'])->name('guru.reports.laporan.store');
// Rute untuk melihat semua laporan nilai siswa
Route::get('/guru/reports/{studentId}/{kelasId}/export-pdf', [ReportController::class, 'exportPDF'])->name('guru.reports.export.pdf');

Route::get('guru/reports/laporan{studentId}/{kelasId}', [ReportController::class, 'indexL'])->name('guru.reports.laporan.index');
Route::delete('/guru/reports/{reportId}/destroy/{studentId}/{kelasId}', [ReportController::class, 'destroy'])->name('guru.reports.laporan.destroy');

Route::get('/guru/get-meetings/{subjectId}', [MeetingController::class, 'getMeetings']);


Route::get('guru/history/siswa/{kelasId}', [HistoriController::class, 'history'])->name('guru.history.siswa');
Route::get('guru/history', [HistoriController::class, 'index'])->name('guru.history.index');
Route::get('guru/history/detail/{studentId}/{kelasId}', [HistoriController::class, 'indexH'])->name('guru.history.siswa.index');


// Route untuk melihat detail absensi siswa
Route::get('guru/absensi/detail/{id}', [AbsensiController::class, 'detail'])->name('guru.absensi.detail');
Route::get('absensi/siswa/{siswa}', [AbsensiController::class, 'absensiPerSiswa'])->name('absensi.siswa');

//Guru
Route::prefix('guru')->name('guru.')->group(function () {
    Route::resource('meeting', MeetingController::class);
});

Route::get('guru/materi', [MateriController::class, 'index'])->name('guru.materi.index');
Route::get('guru/materi/pelajaran', [MateriController::class, 'pelajaran'])->name('guru.materi.pelajaran');
Route::post('guru/materi', [MateriController::class, 'store'])->name('guru.materi.store');
Route::get('guru/materi/{materi}/edit', [MateriController::class, 'edit'])->name('guru.materi.edit');
Route::put('guru/materi/{materi}', [MateriController::class, 'update'])->name('guru.materi.update');
Route::delete('guru/materi/{materi}', [MateriController::class, 'destroy'])->name('guru.materi.destroy');
Route::post('/siswa/save-face', [AbsensiController::class, 'saveFace'])->name('siswa.saveFace');
Route::post('/siswa/verify-face', [AbsensiController::class, 'verifyFace'])->name('siswa.verifyFace');

// Mengubah nama parameter resource dari {tuga} ke {tugas}
Route::resource('guru/tugas', TugasController::class)
    ->parameters(['tugas' => 'tugas'])
    ->except(['show']);

Route::get('guru/tugas', [TugasController::class, 'index'])->name('guru.tugas.index');
Route::get('guru/tugas/pelajaran', [TugasController::class, 'pelajaran'])->name('guru.tugas.pelajaran');
Route::get('guru/tugas/create/{meeting}', [TugasController::class, 'createM'])->name('guru.tugas.createM');
Route::get('guru/tugas/create', [TugasController::class, 'create'])->name('guru.tugas.create');
Route::post('guru/tugas', [TugasController::class, 'store'])->name('guru.tugas.store');
Route::get('guru/tugas/{tugas}/edit', [TugasController::class, 'edit'])->name('guru.tugas.edit');
Route::put('guru/tugas/{tugas}', [TugasController::class, 'update'])->name('guru.tugas.update');
Route::delete('guru/tugas/{tugas}', [TugasController::class, 'destroy'])->name('guru.tugas.destroy');


//route tampilan depan
Route::get('/paketA-SD', function () {
    return view('landing.Program_Sd');
});

Route::get('/paketB-SMP', function () {
    return view('landing.Program_Smp');
});

Route::get('/paketC-SMA', function () {
    return view('landing.Program_Sma');
});


Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.form');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/admin/pendaftaran', [PendaftaranController::class, 'adminView'])->name('admin.pendaftaran.index');
Route::delete('admin/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('admin.pendaftaran.destroy');
Route::get('/admin/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('admin.pendaftaran.show');
Route::get('pendaftaran/{id}/edit', [PendaftaranController::class, 'edit'])->name('admin.pendaftaran.edit');
Route::put('pendaftaran/{id}', [PendaftaranController::class, 'update'])->name('admin.pendaftaran.update');


Route::get('/bloglist', function () {
    return view('landing.Bloglist');
});
Route::get('/bloglist', [BlogsController::class, 'landing'])->name('landing.Bloglist');




require __DIR__ . '/auth.php';
