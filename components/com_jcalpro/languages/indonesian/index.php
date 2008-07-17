<?PHP
/*
**********************************************
JCal Pro v1.5.3
Copyright (c) 2006-2007 Anything-Digital.com
**********************************************
JCal Pro is a fork of the existing Extcalendar component for Joomla!
(com_extcal_0_9_2_RC4.zip from mamboguru.com). 
Extcal (http://sourceforge.net/projects/extcal) was renamed 
and adapted to become a Mambo/Joomla! component by 
Matthew Friedman, and further modified by David McKinnis
(mamboguru.com) to repair some security holes. 

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: index.php - Indonesian language file$

Revision date: 03/14/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com//
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

// New language structure
$lang_info = array (
	'name' => 'Indonesian'
	,'nativename' => 'Indonesia' // Language name in native language. E.g: 'Français' for 'French'
	,'locale' => array('id_ID','indonesian') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'idNGO.NET'
	,'author_email' => 'admin@idngo.net'
	,'author_url' => 'http://www.idngo.net/'
	,'transdate' => '09/03/2007'
);

$lang_general = array (
	'yes' => 'Ya'
	,'no' => 'Tidak'
	,'back' => 'Kembali'
	,'continue' => 'Lanjutkan'
	,'close' => 'Tutup'
	,'errors' => 'Error'
	,'info' => 'Keterangan'
	,'day' => 'Hari'
	,'days' => 'Hari'
	,'month' => 'Bulan'
	,'months' => 'Bulan'
	,'year' => 'Tahun'
	,'years' => 'Tahun'
	,'hour' => 'Jam'
	,'hours' => 'Jam'
	,'minute' => 'Menit'
	,'minutes' => 'Menit'
	,'everyday' => 'Setiap hari'
	,'everymonth' => 'Setiap bulan'
	,'everyyear' => 'Setiap tahun'
	,'active' => 'Aktif'
	,'not_active' => 'Tidak aktif'
	,'today' => 'Hari ini'
	,'signature' => 'Memakai'
	,'expand' => 'Kembangkan'
	,'collapse' => 'Kuncupkan'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %d %B %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '%A, %d %B %Y %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%A, %d %B %Y %I:%M' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a, %d %b %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')
 	,'months' => array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember')
);

$lang_system = array (
	'system_caption' => 'Pesan sistem'
  ,'page_access_denied' => 'Anda tidak memiliki kewenangan yang cukup untuk mengakses halaman ini.'
  ,'page_requires_login' => 'Anda harus login sebelum mengakses halaman ini.'
  ,'operation_denied' => 'Anda tidak memiliki kewenangan yang cukup untuk menjalankan perintah ini.'
	,'section_disabled' => 'Bagian ini ditutup sementara !'
  ,'non_exist_cat' => 'Kategori yang diinginkan tidak tersedia !'
  ,'non_exist_event' => 'Kegiatan yang diinginkan tidak tersedia !'
  ,'param_missing' => 'Parameter yang disediakan tidak tepat.'
  ,'no_events' => 'Tidak ada kegiatan untuk ditampilkan'
  ,'config_string' => 'Anda menggunakan \'%s\' dengan %s, %s dan %s.'
  ,'no_table' => 'Tabel \'%s\' tidak tersedia !'
  ,'no_anonymous_group' => 'Tabel %s tidak mengandung kelompok \'Anonim\' !'
  ,'calendar_locked' => 'Layanan ini sementara tidak tersedia karena sedang dalam pemeliharaan. Maaf atas gangguan ini !'
	,'new_upgrade' => 'Sistem mendeteksi adanya versi baru. Direkomendasikan untuk melakukan upgrade sekarang. Klik "Lanjutkan" untuk meluncurkan fungsi upgrade.'
	,'no_profile' => 'Sebuah error terjadi sewaktu informasi profil anda sedang diambil'
	,'unknown_component' => 'Komponen tidak dikenal'
// Mail messages
	,'new_event_subject' => 'Kegiatan Menunggu Persetujuan di %s'
	,'event_notification_failed' => 'Sebuah error terjadi sewaktu mengirim email notifikasi !'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
Kegiatan di bawah ini baru saja diajukan ke {CALENDAR_NAME} dan membutuhkan persetujuan:

Judul   : "{TITLE}"
Tanggal : "{DATE}"
Durasi  : "{DURATION}"

Anda dapat mengakses kegiatan ini dengan mengikuti link di bawah 
atau dengan copy-paste ke browser anda.

{LINK}

Salam,

Administrator {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Login'
	,'register' => 'pendaftaran'
  ,'logout' => 'Logout <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Profilku'
	,'admin_events' => 'Kegiatan'
  ,'admin_categories' => 'Kategori'
  ,'admin_groups' => 'Kelompok'
  ,'admin_users' => 'Pengguna'
  ,'admin_settings' => 'Setting'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Tambahkan'
	,'cal_view' => 'Bulanan'
  ,'flat_view' => 'Senarai'
  ,'weekly_view' => 'Mingguan'
  ,'daily_view' => 'Harian'
  ,'yearly_view' => 'Tahunan'
  ,'categories_view' => 'Kategori'
  ,'search_view' => 'Pencarian'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Menambahkan Kegiatan'
	,'edit_event' => 'Edit kegiatan [id%d] \'%s\''
	,'update_event_button' => 'Perbaharu'

// Event details
	,'event_details_label' => 'Detil Kegiatan'
	,'event_title' => 'Judul Kegiatan'
	,'event_desc' => 'Deskripsi Kegiatan'
	,'event_cat' => 'Kategori'
	,'choose_cat' => 'Pilih kategori'
	,'event_date' => 'Tanggal Kegiatan'
	,'day_label' => 'Hari'
	,'month_label' => 'Bulan'
	,'year_label' => 'Tahun'
	,'start_date_label' => 'Waktu Mulai'
	,'start_time_label' => 'Pada'
	,'end_date_label' => 'Durasi'
	,'all_day_label' => 'Sepanjang Hari'
// Contact details
	,'contact_details_label' => 'Detil Kontak'
	,'contact_info' => 'Info Kontak'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Kegiatan Berulang'
	,'repeat_method_label' => 'Metode Pengulangan'
	,'repeat_none' => 'Jangan mengulangi kegiatan ini'
	,'repeat_every' => 'Ulangi setiap'
	,'repeat_days' => 'Hari'
	,'repeat_weeks' => 'Minggu'
	,'repeat_months' => 'Bulan'
	,'repeat_years' => 'Tahun'
	,'repeat_end_date_label' => 'Tanggal akhir pengulangan'
	,'repeat_end_date_none' => 'Tanpa tanggal akhir'
	,'repeat_end_date_count' => 'Akhiri setelah %s pengulangan'
	,'repeat_end_date_until' => 'Ulangi sampai'
// Other details
	,'other_details_label' => 'Detil lain'
	,'picture_file' => 'File Gambar'
	,'file_upload_info' => '(Batas %d KBytes - Extension yang diterima : %s )' 
	,'del_picture' => 'Hapus gambar ini ?'
// Administrative options
	,'admin_options_label' => 'Opsi Administrasi'
	,'auto_appr_event' => 'Kegiatan Disetujui'

// Error messages
	,'no_title' => 'Anda harus memberi judul kegiatan !'
	,'no_desc' => 'Anda harus memberi deskripsi untuk kegiatan ini !'
	,'no_cat' => 'Anda harus memilih kategori dari menu dropdown !'
	,'date_invalid' => 'Anda harus memberikan tanggal yang absah untuk kegiatan ini !'
	,'end_days_invalid' => 'Isian pada bagian \'Hari\' tidak absah !'
	,'end_hours_invalid' => 'Isian pada bagian \'Jam\' tidak absah !'
	,'end_minutes_invalid' => 'Isian pada bagian \'Menit\' tidak absah !'

	,'non_valid_extension' => 'Format file gambar yang dilampirkan tidak didukung ! (Extension yang diterima : %s)'

	,'file_too_large' => 'File yang dilampirkan terlalu besar ! (Maksimum %d KB)'
	,'move_image_failed' => 'Sistem gagal memindahkan file gambar !'
	,'non_valid_dimensions' => 'Panjang atau lebar gambar lebih besar dari %s pixel !'

	,'recur_val_1_invalid' => 'Isian \'interval pengulangan\' tidak absah. Nilai ini harus lebih besar dari \'0\' !'
	,'recur_end_count_invalid' => 'Isian \'jumlah pengulangan\' tidak valid. Nilai ini harus lebih besar dari \'0\' !'
	,'recur_end_until_invalid' => 'Tanggal \'ulangi sampai\' harus setelah tanggal mulai kegiatan !'
// Misc. messages
	,'submit_event_pending' => 'Kegiatan anda telah dikirimkan! Masukan anda baru akan tampil dalam kalender SETELAH disetujui administrator. Terima kasih atas partisipasinya!'
	,'submit_event_approved' => 'Kegiatan anda otomatis disetujui. Terima kasih atas masukannya!'
	,'event_repeat_msg' => 'Kegiatan ini berulang'
	,'event_no_repeat_msg' => 'Kegiatan ini tidak berulang'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Harian'
	,'next_day' => 'Hari Berikutnya'
	,'previous_day' => 'Hari Sebelumnya'
	,'no_events' => 'Tidak ada kegiatan untuk hari ini.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Mingguan'
	,'week_period' => '%s - %s'
	,'next_week' => 'Minggu Berikutnya'
	,'previous_week' => 'Minggu Sebelumnya'
	,'selected_week' => 'Minggu %d'
	,'no_events' => 'Tidak ada kegiatan untuk minggu ini.'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Bulanan'
	,'next_month' => 'Bulan Berikutnya'
	,'previous_month' => 'Bulan Sebelumnya'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Senarai'
	,'week_period' => '%s - %s'
	,'next_month' => 'Bulan Berikutnya'
	,'previous_month' => 'Bulan Sebelumnya'
	,'contact_info' => 'Info Kontak'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_events' => 'Tidak ada kegiatan untuk bulan ini.'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Rincian Kegiatan'
	,'display_event' => 'Kegiatan: \'%s\''
	,'cat_name' => 'Kategori'
	,'event_start_date' => 'Tanggal'
	,'event_end_date' => 'Sampai dengan'
	,'event_duration' => 'Durasi'
	,'contact_info' => 'Info Kontak'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_event' => 'Tidak ada kegiatan untuk ditampilkan.'
	,'stats_string' => 'Total <strong>%d</strong> Kegiatan'
	,'edit_event' => 'Edit Kegiatan'
	,'delete_event' => 'Hapus Kegiatan'
	,'delete_confirm' => 'Apakah anda yakin ingin menghapus kegiatan ini ?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Berdasarkan Kategori'
	,'cat_name' => 'Nama Kategori'
	,'total_events' => 'Total Kegiatan'
	,'upcoming_events' => 'Kegiatan Akan Datang'
	,'no_cats' => 'Tidak ada kategori untuk ditampilkan.'
	,'stats_string' => 'Terdapat <strong>%d</strong> Kegiatan dalam <strong>%d</strong> Kategori'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Kegiatan dalam \'%s\''
	,'event_name' => 'Nama Kegiatan'
	,'event_date' => 'Tanggal'
	,'no_events' => 'Tidak ada kegiatan dalam kategori ini.'
	,'stats_string' => 'Total <strong>%d</strong> Kegiatan'
	,'stats_string1' => '<strong>%d</strong> kegiatan dalam <strong>%d</strong> halaman'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Cari di Kalender',
	'search_results' => 'Hasil Pencarian',
	'category_label' => 'Kategori',
	'date_label' => 'Tanggal',
	'no_events' => 'Tidak ada kegiatan dalam Kategori ini.',
	'search_caption' => 'Masukkan kata kunci...',
	'search_again' => 'Cari Lagi',
	'search_button' => 'Cari',
// Misc.
	'no_results' => 'Tidak ada yang ditemukan',	
// Stats
	'stats_string1' => 'Ditemukan <strong>%d</strong> kegiatan',
	'stats_string2' => '<strong>%d</strong> Kegiatan dalam <strong>%d</strong> halaman'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Profilku',
	'edit_profile' => 'Edit Profilku',
	'update_profile' => 'Perbaharui Profilku',
	'actions_label' => 'Aksi',
// Account Info
	'account_info_label' => 'Informasi Akun',
	'user_name' => 'Nama Pengguna',
	'user_pass' => 'Kata Sandi',
	'user_pass_confirm' => 'Konfirmasi Sandi',
	'user_email' => 'Alamat E-mail',
	'group_label' => 'Keanggotaan Kelompok',
// Other Details
	'other_details_label' => 'Detil Lain',
	'first_name' => 'Nama Depan',
	'last_name' => 'Nama Belakang',
	'full_name' => 'Nama Penuh',
	'user_website' => 'Situs',
	'user_location' => 'Lokasi',
	'user_occupation' => 'Pekerjaan',
// Misc.
	'select_language' => 'Pilih Bahasa',
	'edit_profile_success' => 'Profil berhasil diperbaharui',
	'update_pass_info' => 'Biarkan bagian kata sandi kosong jika anda tidak ingin mengubahnya',
// Error messages
	'invalid_password' => 'Harap masukkan kata sandi yang hanya terdiri dari huruf dan angka, sepanjang 4 sampai 16 karakter !',
	'password_is_username' => 'Kata Sandi harus berbeda dengan Nama Pengguna !',
	'password_not_match' =>'Kata Sandi yang dimasukkan tidak cocok dengan \'konfirmasi sandi\'',
	'invalid_email' => 'Anda harus memberikan alamat email yang absah !',
	'email_exists' => 'Alamat email yang anda berikan sudah didaftarkan oleh pengguna lain. Silakan masukkan email lain !',
	'no_email' => 'Anda harus memberikan alamat email yang absah !',
	'invalid_email' => 'Anda harus memberikan alamat email yang absah !',
	'no_password' => 'Anda harus memberikan Kata Sandi untuk akun baru ini !'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Pendaftaran Pengguna',
// Step 1: Terms & Conditions
	'terms_caption' => 'Peraturan dan Syarat',
	'terms_intro' => 'Sebelum melanjutkan, anda harus menyetujui yang berikut:',
	'terms_message' => 'Harap meluangkan waktu untuk membaca peraturan di bawah. Jika anda setuju dan ingin melanjutkan pendaftaran silakan klik tombol "Saya Setuju" di bawah. Untuk membatalkan pendaftaran, silakan klik tombol \'back\' pada browser anda.<br /><br />Situs ini tidak bertanggung jawab atas kegiatan yang diumumkan oleh para pengguna kalender ini. Situs ini tidak menjamin ketepatan, kelengkapan maupun kegunaan dari kegiatan yang diumumkan, dan tidak bertanggung jawab atas isi dari kegiatan yang diumumkan.<br /><br />Pengumuman tersebut merepresentasikan pandangan dari penulis yang mengumumkan kegiatan, dan belum tentu sejalan dengan pandangan pengelola. Setiap pengguna yang merasa terganggu dengan kegiatan yang diumumkan dipersilakan untuk segera menghubungi pengelola melalui email. Pengelola memiliki kemampuan untuk menghapus pengumuman yang isinya menurut pengelola patut ditolak dan akan berusaha untuk melakukannya sesegera mungkin.<br /><br />Dengan menggunakan layanan ini, Anda setuju untuk tidak menggunakan aplikasi kalender ini untuk memasang materi-materi yang diketahui tidak benar dan/atau bersifat memfitnah, menghina, melecehkan, mengundang kebencian, mengancaman, berorientasi seksual, tidak sopan, kasar, mengganggu privasi seseorang, atau perbuatan melanggar hukum lainnya.<br /><br />Anda setuju untuk tidak memasang materi yang hak ciptanya tidak dipegang oleh anda atau oleh %s atau tanpa seizin pemegang hak cipta.',
	'terms_button' => 'Saya setuju',
	
// Account Info
	'account_info_label' => 'Informasi Akun',
	'user_name' => 'Nama Pengguna',
	'user_pass' => 'Kata Sandi',
	'user_pass_confirm' => 'Konfirmasi Sandi',
	'user_email' => 'Alamat E-mail',
// Other Details
	'other_details_label' => 'Detil Lain',
	'first_name' => 'Nama Depan',
	'last_name' => 'Nama Belakang',
	'user_website' => 'Situs',
	'user_location' => 'Lokasi',
	'user_occupation' => 'Pekerjaan',
	'register_button' => 'Kirim Pendaftaran',

// Stats
	'stats_string1' => '<strong>%d</strong> pengguna',
	'stats_string2' => '<strong>%d</strong> pengguna di <strong>%d</strong> halaman',
// Misc.
	'reg_nomail_success' => 'Terima kasih telah mendaftar.',
	'reg_mail_success' => 'Sebuah email berisi keterangan cara mengaktifkan akun anda telah dikirimkan ke alamat email yang anda berikan.',
	'reg_activation_success' => 'Selamat! Akun anda telah diaktifkan dan anda kini dapat melakukan login dengan Nama Pengguna dan Kata Sandi yang telah dipilih. Terima kasih telah mendaftar.',
// Mail messages
	'reg_confirm_subject' => 'Pendaftaran untuk %s',
	
// Error messages
	'no_username' => 'Anda harus memberikan Nama Pengguna !',
	'invalid_username' => 'Harap masukkan Nama Pengguna yang hanya terdiri dari huruf dan angka, dengan panjang antara 4 sampai 30 karakter !',
	'username_exists' => 'Nama Pengguna yang anda masukkan tidak tersedia. Silakan memilih Nama Pengguna lain !',
	'no_password' => 'Anda harus memberikan Kata Sandi !',
	'invalid_password' => 'Harap masukkan Kata Sandi yang hanya terdiri dari huruf dan angka, dengan panjang antara 4 sampai 16 karakter !',
	'password_is_username' => 'Kata Sandi harus berbeda dengan Nama Pengguna !',
	'password_not_match' =>'Kata Sandi yang anda masukkan tidak cocok dengan \'konfirmasi sandi\'',
	'no_email' => 'Anda harus memberikan alamat email !',
	'invalid_email' => 'Anda harus memberikan alamat email yang absah !',
	'email_exists' => 'Alamat email yang anda berikan sudah didaftarkan oleh pengguna lain. Silakan masukkan email lain !',
	'delete_user_failed' => 'Akun pengguna ini tidak bisa dihapus',
	'no_users' => 'Tidak ada akun pengguna untuk ditampilkan !',
	'already_logged' => 'Anda telah login sebagai anggota !',
	'registration_not_allowed' => 'Pendaftaran anggota sementara tidak aktif !',
	'reg_email_failed' => 'Sebuah error terjadi saat mencoba mengirim email aktivasi !',
	'reg_activation_failed' => 'Sebuah error terjadi saat memproses aktivasi !'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Terima kasih telah mendaftar di {CALENDAR_NAME}

Nama Pengguna anda : "{USERNAME}"
Kata Sandi anda    : "{PASSWORD}"

Untuk mengaktifkan akun anda, silakan mengikuti link di bawah 
atau copy-paste ke browser anda.

{REG_LINK}

Salam,

Pengelola {CALENDAR_NAME}

EOT;

// ======================================================
// theme.php
// ======================================================

// To Be Done

// ======================================================
// functions.inc.php
// ======================================================

// To Be Done

// ======================================================
// dblib.php
// ======================================================

// To Be Done

// ======================================================
// admin_events.php
// ======================================================

if (defined('ADMIN_EVENTS_PHP')) 

$lang_event_admin_data = array(
	'section_title' => 'Administrasi Kegiatan',
	'events_to_approve' => 'Administrasi Kegiatan: Menunggu Persetujuan',
	'upcoming_events' => 'Administrasi Kegiatan: Akan Datang',
	'past_events' => 'Administrasi Kegiatan: Kegiatan Lalu',
	'add_event' => 'Tambahkan Kegiatan Baru',
	'edit_event' => 'Edit Kegiatan',
	'view_event' => 'Lihat Kegiatan',
	'approve_event' => 'Setujui Kegiatan',
	'update_event' => 'Perbarui Info Kegiatan',
	'delete_event' => 'Hapus Kegiatan',
	'events_label' => 'Kegiatan',
	'auto_approve' => 'Otomatis Setujui',
	'date_label' => 'Tanggal',
	'actions_label' => 'Perintah',
	'events_filter_label' => 'Filter Kegiatan',
	'events_filter_options' => array('Semua kegiatan','Yang memerlukan persetujuan saja','Yang akan datang saja','Yang lalu saja'),
	'picture_attached' => 'Gambar terlampir',
// View Event
	'view_event_name' => 'Kegiatan: \'%s\'',
	'event_start_date' => 'Tanggal',
	'event_end_date' => 'Sampai',
	'event_duration' => 'Durasi',
	'contact_info' => 'Info Kontak',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Kegiatan: \'%s\'',
	'cat_name' => 'Kategori',
	'event_start_date' => 'Tanggal',
	'event_end_date' => 'Sampai',
	'contact_info' => 'Info Kontak',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'Tidak ada kegiatan untuk ditampilkan.',
	'stats_string' => 'Total <strong>%d</strong> Kegiatan',
// Stats
	'stats_string1' => '<strong>%d</strong> Kegiatan',
	'stats_string2' => 'Total: <strong>%d</strong> Kegiatan dalam <strong>%d</strong> halaman',
// Misc.
	'add_event_success' => 'Kegiatan baru berhasil ditambahkan',
	'edit_event_success' => 'Kegiatan berhasil diperbarui',
	'approve_event_success' => 'Kegiatan berhasil disetujui',
	'delete_confirm' => 'Apakah anda yakin ingin menghapus kegiatan ini ?',
	'delete_event_success' => 'Kegiatan berhasil dihapus',
	'active_label' => 'Aktif',
	'not_active_label' => 'Tidak Aktif',
// Error messages
	'no_event_name' => 'Anda harus memberikan nama untuk kegiatan ini !',
	'no_event_desc' => 'Anda harus memberikan deskripsi untuk kegiatan ini !',
	'no_cat' => 'Anda harus memilih kategori untuk kegiatan ini !',
	'no_day' => 'Anda harus memilih hari !',
	'no_month' => 'Anda harus memilih bulan !',
	'no_year' => 'Anda harus memilih tahun !',
	'non_valid_date' => 'Harap masukkan tanggal yang absah !',
	'end_days_invalid' => 'Harap pastikan bagian \'Hari\' pada \'Durasi\' hanya mengandung angka !',
	'end_hours_invalid' => 'Harap pastikan bagian \'Jam\' pada \'Durasi\' hanya mengandung angka !',
	'end_minutes_invalid' => 'Harap pastikan bagian \'Menit\' pada \'Durasi\' hanya mengandung angka !',
	'file_too_large' => 'Gambar yang dilampirkan lebih besar dari %s KB !',
	'non_valid_extension' => 'Format file yang dilampirkan tidak didukung !',
	'delete_event_failed' => 'Kegiatan ini tidak bisa dihapus',
	'approve_event_failed' => 'Kegiatan ini tidak bisa disetujui',
	'no_events' => 'Tidak ada kegiatan untuk ditampilkan !',
	'move_image_failed' => 'Sistem gagal memindahkan gambar !',
	'non_valid_dimensions' => 'Ukuran gambar lebih besar dari %s pixel !',
	'recur_val_1_invalid' => 'Masukan \'interval pengulangan\' tidak absah. Nilai ini harus lebih besar dari \'0\' !',
	'recur_end_count_invalid' => 'Masukan \'jumlah pengulangan\' tidak absah. Nilai ini harus lebih besar dari \'0\' !',
	'recur_end_until_invalid' => 'Tanggal \'ulangi sampai\' harus sesudah tanggal mulai kegiatan !'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Administrasi Kategori',
	'add_cat' => 'Tambah Kategori Baru',
	'edit_cat' => 'Edit Kategori',
	'update_cat' => 'Perbarui Info Kategori',
	'delete_cat' => 'Hapus Kategori',
	'events_label' => 'Kegiatan',
	'visibility' => 'Visibility',
	'actions_label' => 'Operasi',
	'users_label' => 'Pengguna',
	'admins_label' => 'Admin',
// General Info
	'general_info_label' => 'Informasi Umum',
	'cat_name' => 'Nama Kategori',
	'cat_desc' => 'Deskripsi Kategori',
	'cat_color' => 'Warna',
	'pick_color' => 'Pilih Warna!',
	'status_label' => 'Status',
// Administrative Options
	'admin_label' => 'Opsi Administrasi',
	'auto_admin_appr' => 'Otomatis setujui pemasangan kegiatan oleh administrator',
	'auto_user_appr' => 'Otomatis setujui pemasangan kegiatan oleh pengguna',
// Stats
	'stats_string1' => '<strong>%d</strong> kategori',
	'stats_string2' => 'Aktif: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Total: <strong>%d</strong>&nbsp;&nbsp;&nbsp;dalam <strong>%d</strong> halaman',
// Misc.
	'add_cat_success' => 'Kategori baru berhasil ditambahkan',
	'edit_cat_success' => 'Kategori berhasil diperbarui',
	'delete_confirm' => 'Apakah anda yakin ingin menghapus kategori ini ?',
	'delete_cat_success' => 'Kategori berhasil dihapus',
	'active_label' => 'Aktif',
	'not_active_label' => 'Tidak Aktif',
// Error messages
	'no_cat_name' => 'Anda harus memberikan nama untuk kategori ini !',
	'no_cat_desc' => 'Anda harus memberikan deskripsi untuk kategori ini !',
	'no_color' => 'Anda harus memberikan warna untuk kategori ini !',
	'delete_cat_failed' => 'Kategori ini tidak bisa dihapus',
	'no_cats' => 'Tidak ada kategori untuk ditampilkan !',
	'cat_has_events' => 'Ada %d kegiatan dalam Kategori ini sehingga tidak bisa dihapus!<br>Silakan hapus kegiatan yang ada terlebih dahulu dan coba lagi!',

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Administrasi Pengguna',
	'add_user' => 'Tambahkan Pengguna Baru',
	'edit_user' => 'Edit Info Pengguna',
	'update_user' => 'Perbarui Info Pengguna',
	'delete_user' => 'Hapus Akun Pengguna',
	'last_access' => 'Akses Terakhir',
	'actions_label' => 'Aksi',
	'active_label' => 'Aktif',
	'not_active_label' => 'Tidak Aktif',
// Account Info
	'account_info_label' => 'Informasi Akun',
	'user_name' => 'Nama Pengguna',
	'user_pass' => 'Kata Sandi',
	'user_pass_confirm' => 'Konfirmasi Sandi',
	'user_email' => 'Alamat E-mail',
	'group_label' => 'Keanggotaan Kelompok',
	'status_label' => 'Status Akun',
// Other Details
	'other_details_label' => 'Detil Lain',
	'first_name' => 'Nama Depan',
	'last_name' => 'Nama Belakang',
	'user_website' => 'Situs',
	'user_location' => 'Lokasi',
	'user_occupation' => 'Pekerjaan',
// Stats
	'stats_string1' => '<strong>%d</strong> pengguna',
	'stats_string2' => '<strong>%d</strong> pengguna dalam <strong>%d</strong> halaman',
// Misc.
	'select_group' => 'Pilih satu...',
	'add_user_success' => 'Akun Pengguna berhasil dibuat',
	'edit_user_success' => 'Akun Pengguna berhasil diperbarui',
	'delete_confirm' => 'Apakah anda yakin ingin menghapus akun ini?',
	'delete_user_success' => 'Akun Pengguna berhasil dihapus',
	'update_pass_info' => 'Biarkan bagian Kata Sandi kosong jika tidak ingin merubahnya',
	'access_never' => 'Belum Pernah',
// Error messages
	'no_username' => 'Anda harus memberikan Nama Pengguna !',
	'invalid_username' => 'Harap masukkan Nama Pengguna yang hanya terdiri dari huruf dan angka, sepanjang 4 sampai 30 karakter !',
	'invalid_password' => 'Harap masukkan Kata Sandi yang hanya terdiri dari huruf dan angka, sepanjang 4 sampai 16 karakter !',
	'password_is_username' => 'Kata Sandi harus berbeda dengan Nama Pengguna !',
	'password_not_match' =>'Kata Sandi yang dimasukkan tidak cocok dengan  \'konfirmasi sandi\'',
	'invalid_email' => 'Anda harus memberikan alamat email yang absah !',
	'email_exists' => 'Alamat email yang diberikan sudah terdaftar sebelumnya. Silakan masukkan email lain !',
	'username_exists' => 'Nama Pengguna yang dipilih tidak tersedia. Silakan pilih Nama Pengguna lain !',
	'no_email' => 'Anda harus memberikan alamat email !',
	'invalid_email' => 'Anda harus memberikan alamat email yang absah !',
	'no_password' => 'Anda harus memberikan Kata Sandi untuk akun baru ini !',
	'no_group' => 'Harap pilih keanggotaan kelompok dari Pengguna ini !',
	'delete_user_failed' => 'Akun pengguna ini tidak dapat dihapus',
	'no_users' => 'Tidak ada akun pengguna untuk ditampilkan !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Administrasi Kelompok',
	'add_group' => 'Tambahkan Kelompok Baru',
	'edit_group' => 'Edit Kelompok',
	'update_group' => 'Perbarui Info Kelompok',
	'delete_group' => 'Hapus Kelompok',
	'view_group' => 'Lihat Kelompok',
	'users_label' => 'Anggota',
	'actions_label' => 'Aksi',
// General Info
	'general_info_label' => 'Informasi Umum',
	'group_name' => 'Nama Kelompok',
	'group_desc' => 'Deskripsi Kelompok',
// Group Access Level
	'access_level_label' => 'Tingkat Akses Kelompok',
	'Administrator' => 'Pengguna dari kelompok ini memiliki akses admin',
	'can_manage_accounts' => 'Pengguna dari kelompok ini dapat mengelola akun',
	'can_change_settings' => 'Pengguna dari kelompok ini dapat merubah setting kalender',
	'can_manage_cats' => 'Pengguna dari kelompok ini dapat mengelola kegiatan kategori',
	'upl_need_approval' => 'Kegiatan yang diajukan memerlukan persetujuan administratif',
// Stats
	'stats_string1' => '<strong>%d</strong> kelompok',
	'stats_string2' => 'Total: <strong>%d</strong> kelompok dalam <strong>%d</strong> halaman',
	'stats_string3' => 'Total: <strong>%d</strong> pengguna dalam <strong>%d</strong> halaman',
// View Group Members
	'group_members_string' => 'Anggota dari kelompok \'%s\'',
	'username_label' => 'Nama Pengguna',
	'firstname_label' => 'Nama Depan',
	'lastname_label' => 'Nama Belakang',
	'email_label' => 'Email',
	'last_access_label' => 'Akses Terakhir',
	'edit_user' => 'Edit Pengguna',
	'delete_user' => 'Hapus Pengguna',
// Misc.
	'add_group_success' => 'Penambahan kelompok berhasil',
	'edit_group_success' => 'Kelompok berhasil diperbarui',
	'delete_confirm' => 'Apakah anda yakin ingin menghapus kelompok ini ?',
	'delete_user_confirm' => 'Apakah anda yakin ingin menghapus pengguna ini ?',
	'delete_group_success' => 'Kelompok berhasil dihapus',
	'no_users_string' => 'Tidak ada pengguna dalam kelompok ini',
// Error messages
	'no_group_name' => 'Anda harus memberikan nama untuk kelompok ini !',
	'no_group_desc' => 'Anda harus memberikan deskripsi untuk kelompok ini !',
	'delete_group_failed' => 'Kelompok ini tidak bisa dihapus',
	'no_groups' => 'Tidak ada kelompok untuk ditampilkan !',
	'group_has_users' => 'Kelompok ini memiliki %d pengguna sehingga tidak dapat dihapus!<br>Harap keluarkan pengguna yang tersisa dari dalam kelompok ini dan coba lagi!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Setting Kalender'
// Links
	,'admin_links_text' => 'Pilih Seksi'
	,'admin_links' => array('Setting Utama','Konfigurasi Template','Pembaruan Produk')
// General Settings
	,'general_settings_label' => 'Umum'
	,'calendar_name' => 'Nama kalender'
	,'calendar_description' => 'Deskripsi kalender'
	,'calendar_admin_email' => 'Email Administrator kalender'
	,'cookie_name' => 'Nama "cookie" yang digunakan oleh skrip'
	,'cookie_path' => 'Path "cookie" yang digunakan oleh skrip'
	,'debug_mode' => 'Aktifkan mode debug'
	,'calendar_status' => 'Status kalender'
// Environment Settings
	,'env_settings_label' => 'Lingkungan'
	,'lang' => 'Bahasa'
		,'lang_name' => 'Bahasa'
		,'lang_native_name' => 'Nama Native'
		,'lang_trans_date' => 'Diterjemahkan pada'
		,'lang_author_name' => 'Penerjemah'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Situs'
	,'charset' => 'Character encoding'
	,'theme' => 'Theme'
		,'theme_name' => 'Nama theme'
		,'theme_date_made' => 'Dibuat pada'
		,'theme_author_name' => 'Perancang'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Situs'
	,'timezone' => 'Perbedaan Timezone'
	,'time_format' => 'Format tampilan waktu'
		,'24hours' => '24 Jam'
		,'12hours' => '12 Jam'
	,'auto_daylight_saving' => 'Otomatis sesuaikan dengan daylight saving (DST)'
	,'main_table_width' => 'Lebar tabel utama (Pixel atau %)'
	,'day_start' => 'Minggu dimulai dengan'
	,'default_view' => 'Tampilan default'
	,'search_view' => 'Aktifkan pencarian'
	,'archive' => 'Tampilkan kegiatan lalu'
	,'events_per_page' => 'Jumlah kegiatan per halaman'
	,'sort_order' => 'Urutan penyaringan default'
		,'sort_order_title_a' => 'Judul A-Z'
		,'sort_order_title_d' => 'Judul Z-A'
		,'sort_order_date_a' => 'Tanggal maju'
		,'sort_order_date_d' => 'Tanggal mundur'
	,'show_recurrent_events' => 'Tampilkan kegiatan yang berulang'
	,'multi_day_events' => 'Kegiatan lebih dari sehari'
		,'multi_day_events_all' => 'Tampilkan seluruh tanggal'
		,'multi_day_events_bounds' => 'Tampilkan tanggal mulai & tanggal selesai saja'
		,'multi_day_events_start' => 'Tampilkan tanggal mulai saja'
	// User Settings
	,'user_settings_label' => 'Setting Pengguna'
	,'allow_user_registration' => 'Bolehkan pendaftaran pengguna'
	,'reg_duplicate_emails' => 'Bolehkan duplikasi email'
	,'reg_email_verify' => 'Aktifkan aktivasi akun melalui email'
// Event View
	,'event_view_label' => 'Tampilan'
	,'popup_event_mode' => 'Pop-up Kegiatan'
	,'popup_event_width' => 'Lebar jendela Pop-up'
	,'popup_event_height' => 'Tinggi jendela Pop-up'
// Add Event View
	,'add_event_view_label' => 'Penambahan'
	,'add_event_view' => 'Mampukan'
	,'addevent_allow_html' => 'Bolehkan <b>HTML</b> dalam deskripsi'
	,'addevent_allow_contact' => 'Bolehkan Kontak'
	,'addevent_allow_email' => 'Bolehkan Email'
	,'addevent_allow_url' => 'Bolehkan URL'
	,'addevent_allow_picture' => 'Bolehkan Gambar'
	,'new_post_notification' => 'Email Admin Jika Kegiatan Membutuhkan Persetujuan'
// Calendar View
	,'calendar_view_label' => 'Bulanan'
	,'monthly_view' => 'Mampukan'
	,'cal_view_show_week' => 'Tampilkan Jumlah Minggu'
	,'cal_view_max_chars' => 'Jumlah karakter maksimum dalam Deskripsi'
// Flyer View
	,'flyer_view_label' => 'Senarai'
	,'flyer_view' => 'Mampukan'
	,'flyer_show_picture' => 'Tampilkan Gambar dalam Tampilan Senarai'
	,'flyer_view_max_chars' => 'Jumlah karakter maksimum dalam deskripsi'
// Weekly View
	,'weekly_view_label' => 'Mingguan'
	,'weekly_view' => 'Mampukan'
	,'weekly_view_max_chars' => 'Jumlah karakter maksimum dalam Deskripsi'
// Daily View
	,'daily_view_label' => 'Harian'
	,'daily_view' => 'Mampukan'
	,'daily_view_max_chars' => 'Jumlah karakter maksimum dalam Deskripsi'
// Categories View
	,'categories_view_label' => 'Kategori'
	,'cats_view' => 'Mampukan'
	,'cats_view_max_chars' => 'Jumlah karakter maksimum dalam Deskripsi'
// Mini Calendar
	,'mini_cal_label' => 'Kalender Mini'
	,'mini_cal_def_picture' => 'Gambar Default'
	,'mini_cal_display_picture' => 'Tampilkan Gambar'
	,'mini_cal_diplay_options' => array('Tidak Ada','Gambar Default', 'Gambar Harian','Gambar Mingguan','Gambar Acak')
// Mail Settings
	,'mail_settings_label' => 'Setting eMail'
	,'mail_method' => 'Metode pengiriman'
	,'mail_smtp_host' => 'SMTP Hosts (dipisahkan dengan semicolon ;)'
	,'mail_smtp_auth' => ' SMTP Authentication'
	,'mail_smtp_username' => 'SMTP Username'
	,'mail_smtp_password' => 'SMTP Password'

// Picture Settings
	,'picture_settings_label' => 'Setting Gambar'
	,'max_upl_dim' => 'Dimensi maksimum upload'
	,'max_upl_size' => 'Besar maksimum file yang diupload (dalam KB)'
	,'picture_chmod' => 'Permission default file yang diupload (CHMOD)'
	,'allowed_file_extensions' => 'Extension file yang boleh diupload'
// Form Buttons
	,'update_config' => 'Simpan Konfigurasi Baru'
	,'restore_config' => 'Kembalikan ke Setting Default'
// Misc.
	,'update_settings_success' => 'Setting berhasil diperbarui'
	,'restore_default_confirm' => 'Apakah anda yakin ingin mengembalikan Setting Default ?'
// Template Configuration
	,'template_type' => 'Tipe Template'
	,'template_header' => 'Modifikasi Header'
	,'template_footer' => 'Modifikasi Footer'
	,'template_status_default' => 'Gunakan template default'
	,'template_status_custom' => 'Gunakan template berikut:'
	,'template_custom' => 'Template custom'

	,'info_meta' => 'Informasi Meta'
	,'info_status' => 'Kontrol status'
	,'info_status_default' => 'Non-aktifkan konten ini'
	,'info_status_custom' => 'Tampilkan konten berikut:'
	,'info_custom' => 'Konten custom'

	,'dynamic_tags' => 'Tag Dinamis'

// Product Updates
	,'updates_check_text' => 'Silakan menunggu sementara informasi diambil dari server...'
	,'updates_no_response' => 'Tidak ada tanggapan dari server. Silakan coba lagi nanti.'
	,'avail_updates' => 'Update yang Tersedia'
	,'updates_download_zip' => 'Download paket ZIP (.zip)'
	,'updates_download_tgz' => 'Download paket TGZ (.tar.gz)'
	,'updates_released_label' => 'Tanggal Release: %s'
	,'updates_no_update' => 'Anda sudah menjalankan versi terbaru dan tidak memerlukan update.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Gambar Default'
	,'daily_pic' => 'Gambar Hari Ini (%s)'
	,'weekly_pic' => 'Gambar Minggu Ini (%s)'
	,'rand_pic' => 'Gambar Acak (%s)'
	,'post_event' => 'Tambah Kegiatan Baru'
	,'num_events' => '%d kegiatan'
	,'selected_week' => 'Minggu ke %d'
);

// ======================================================
// extcalendar.php
// ======================================================

// To Be Done

// ======================================================
// config.inc.php
// ======================================================

// To Be Done

// ======================================================
// install.php
// ======================================================

// To Be Done

// ======================================================
// login.php
// ======================================================

if (defined('LOGIN_PHP'))

$lang_login_data = array(
	'section_title' => 'Layar Login'
// General Settings
	,'login_intro' => 'Masukkan Nama Pengguna dan Kata Sandi anda untuk login'
	,'username' => 'Nama Pengguna'
	,'password' => 'Kata Sandi'
	,'remember_me' => 'Ingat saya'
	,'login_button' => 'Login'
// Errors
	,'invalid_login' => 'Silakan periksa lagi informasi yang anda berikan dan coba lagi!'
	,'no_username' => 'Anda harus memberikan Nama Pengguna !'
	,'already_logged' => 'Anda sudah melakukan login !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done
// ======================================================
// plugins.php
// ======================================================
// To Be Done
// New defined constants, used to make a start with new language system
if (!defined('_EXTCAL_THEMES_INSTALL_HEADING'))
{
	DEFINE('_EXTCAL_THEMES_INSTALL_HEADING', 'Pengelola Tema JCal Pro');
	
	//Common
	DEFINE('_EXTCAL_VERSION', 'Versi');
	DEFINE('_EXTCAL_DATE', 'Tanggal');
	DEFINE('_EXTCAL_AUTHOR', 'Perancang');
	DEFINE('_EXTCAL_AUTHOR_EMAIL', 'E-mail Perancang');
	DEFINE('_EXTCAL_AUTHOR_URL', 'URL Perancang');
	DEFINE('_EXTCAL_PUBLISHED', 'Terbit');
	
	//Plugins
	DEFINE('_EXTCAL_THEME_PLUGIN', 'Tema');
	DEFINE('_EXTCAL_THEME_PLUGCOM', 'Tema/Perintah');
	DEFINE('_EXTCAL_THEME_NAME', 'Nama');
	DEFINE('_EXTCAL_THEME_HEADING', 'Pengelola Tema JCal Pro');
	DEFINE('_EXTCAL_THEME_FILTER', 'Filter');
	DEFINE('_EXTCAL_THEME_ACCESS_LIST', 'Daftar Akses');
	DEFINE('_EXTCAL_THEME_ACCESS_LVL', 'Tingkat Akses');
	DEFINE('_EXTCAL_THEME_CORE', 'Core');
	DEFINE('_EXTCAL_THEME_DEFAULT', 'Default');
	DEFINE('_EXTCAL_THEME_ORDER', 'Urutan');
	DEFINE('_EXTCAL_THEME_ROW', 'Baris');
	DEFINE('_EXTCAL_THEME_TYPE', 'Tipe');
	DEFINE('_EXTCAL_THEME_ICON', 'Ikon');
	DEFINE('_EXTCAL_THEME_LAYOUT_ICON', 'Tata Letak Ikon');
	DEFINE('_EXTCAL_THEME_DESC', 'Deskripsi');
	DEFINE('_EXTCAL_THEME_EDIT', 'Edit');
	DEFINE('_EXTCAL_THEME_NEW', 'Baru');
	DEFINE('_EXTCAL_THEME_DETAILS', 'Detil Plugin');
	DEFINE('_EXTCAL_THEME_PARAMS', 'Parameter');
	DEFINE('_EXTCAL_THEME_ELMS', 'Elemen');
	//Plugin Installer
	DEFINE('_EXTCAL_THEMES_INSTALL_MSG', 'Hanya Theme yang dapat di-uninstal yang ditampilkan - Theme Core tidak dapat dihapus.');
	DEFINE('_EXTCAL_THEME_NONE', 'Tidak ada Theme yang bukan Core terinstal');
	
	//Language Manager
	DEFINE('_EXTCAL_LANG_HEADING', 'Pengelola Bahasa EXTCAL');
	DEFINE('_EXTCAL_LANG_LANG', 'Bahasa');
	
	//Language Installer
	DEFINE('_EXTCAL_LANG_HEADING_INSTALL', 'Instal Bahasa EXTCAL Baru');
	DEFINE('_EXTCAL_LANG_BACK', 'Kembali ke Pengelola Bahasa');
	//
	
	//Global Installer
	DEFINE('_EXTCAL_INS_PACKAGE_UPLOAD', 'Upload File Paket');
	DEFINE('_EXTCAL_INS_PACKAGE_FILE', 'File Paket');
	DEFINE('_EXTCAL_INS_INSTALL', 'Instal dari Direktori');
	DEFINE('_EXTCAL_INS_INSTALL_DIR', 'Direktori Instalasi');
	DEFINE('_EXTCAL_INS_UPLOAD_BUTTON', 'Upload File &amp; Instal');
	DEFINE('_EXTCAL_INS_INSTALL_BUTTON', 'Instal');
}

?>
