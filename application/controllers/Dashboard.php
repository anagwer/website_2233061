<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('m_login');
        $this->load->model('m_data');

        // Cek session login
        if ($this->session->userdata('status') != "telah_login") {
            redirect('login?alert=belum_login');
        }
    }
    public function index() {
    // Ambil data pengguna dari session
    $id_user = $this->session->userdata('id');
    $data['user'] = $this->db->get_where('pengguna', ['pengguna_id' => $id_user])->row();

    // Hitung data untuk dashboard
    $data['jumlah_artikel']  = $this->m_data->get_data('artikel')->num_rows();
    $data['jumlah_kategori'] = $this->m_data->get_data('kategori')->num_rows();
    $data['jumlah_pengguna'] = $this->m_data->get_data('pengguna')->num_rows();
    $data['jumlah_halaman']  = $this->m_data->get_data('halaman')->num_rows();

    // Tampilkan tampilan
    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_index', $data);
    $this->load->view('dashboard/v_footer');
}
    public function keluar() {
        $this->session->sess_destroy();
        redirect('login?alert=logout');
    }

    // fitur ganti password
    public function ganti_password() {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_ganti_password');
        $this->load->view('dashboard/v_footer');
    }

    public function ganti_password_aksi() {
        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[8]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|matches[password_baru]');

        if ($this->form_validation->run() != false) {
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru');
            $konfirmasi_password = $this->input->post('konfirmasi_password');

            $where = array(
                'pengguna_id' => $this->session->userdata('id'),
                'pengguna_password' => md5($password_lama)
            );

            $cek = $this->m_login->cek_login('pengguna', $where);

            if ($cek->num_rows() > 0) {
                $w = array(
                    'pengguna_id' => $this->session->userdata('id')
                );
                $data = array(
                    'pengguna_password' => md5($password_baru)
                );
                $this->m_data->update_data('pengguna', $data, $where);
                redirect('dashboard/ganti_password?alert=sukses');
            } else {
                redirect('dashboard/ganti_password?alert=gagal');
            }
        } else {
            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_ganti_password');
            $this->load->view('dashboard/v_footer');
        }
    }

    // fitur mengelola kategori
    public function kategori() {
        $data['kategori'] = $this->m_data->get_data('kategori')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_kategori', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function kategori_tambah(){
        $data['kategori'] = $this->m_data->get_data('kategori')->result();
        $this->load->view('dashboard/v_header');
         $this->load->view('dashboard/v_kategori_tambah', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function kategori_tambah_aksi() {
    $this->form_validation->set_rules('kategori', 'Kategori', 'required');

    if ($this->form_validation->run() != false) {
        $kategori = $this->input->post('kategori');
        $data = array(
            'kategori_nama' => $kategori,
            'kategori_slug' => strtolower(url_title($kategori))
        );
        $this->m_data->insert_data('kategori', $data);
        redirect(base_url() . 'dashboard/kategori');
    } else {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_kategori_tambah');
        $this->load->view('dashboard/v_footer');
    }
}
public function kategori_edit($id) {
    $where = array(
        'kategori_id' => $id
    );

    $data['kategori'] = $this->m_data->edit_data('kategori', $where)->result();

    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_kategori_edit', $data);
    $this->load->view('dashboard/v_footer');
}
public function kategori_update() {
    $this->form_validation->set_rules('kategori', 'Kategori', 'required');

    if ($this->form_validation->run() != false) {
        $id = $this->input->post('id');
        $kategori = $this->input->post('kategori');

        $where = array(
            'kategori_id' => $id
        );

        $data = array(
            'kategori_nama' => $kategori,
            'kategori_slug' => strtolower(url_title($kategori))
        );

        $this->m_data->update_data('kategori', $data, $where);

        redirect(base_url() . 'dashboard/kategori');
    } else {
        $id = $this->input->post('id');

        $where = array(
            'kategori_id' => $id
        );

        $data['kategori'] = $this->m_data->edit_data('kategori', $where)->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_kategori_edit', $data);
        $this->load->view('dashboard/v_footer');
    }
}
public function kategori_hapus($id) {
    $where = array(
        'kategori_id' => $id
    );

    $this->m_data->delete_data('kategori', $where);
    redirect(base_url() . 'dashboard/kategori');
}
// Fitur untuk mengelola artikel
public function artikel() {
    $query = "
        SELECT * 
        FROM artikel 
        JOIN kategori ON artikel_kategori = kategori_id 
        JOIN pengguna ON artikel_author = pengguna_id 
        ORDER BY artikel_id DESC
    ";

    $data['artikel'] = $this->db->query($query)->result();

    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_artikel', $data);
    $this->load->view('dashboard/v_footer');
}
public function artikel_tambah() {
    $data['kategori'] = $this->m_data->get_data('kategori')->result();

    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_artikel_tambah', $data);
    $this->load->view('dashboard/v_footer');
}
public function artikel_aksi() {
    // Validasi form: judul wajib diisi dan unik, konten & kategori wajib diisi
    $this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[artikel.artikel_judul]');
    $this->form_validation->set_rules('konten', 'Konten', 'required');
    $this->form_validation->set_rules('kategori', 'Kategori', 'required');

    // Jika gambar tidak diupload, buat error validasi juga
    if (empty($_FILES['sampul']['name'])) {
        $this->form_validation->set_rules('sampul', 'Gambar Sampul', 'required');
    }

    // Jika validasi lolos
    if ($this->form_validation->run() != false) {
        // Konfigurasi upload
        $config['upload_path'] = './gambar/artikel/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        // Proses upload file
        if ($this->upload->do_upload('sampul')) {
            $gambar = $this->upload->data();

            $tanggal    = date('Y-m-d H:i:s');
            $judul      = $this->input->post('judul');
            $slug       = strtolower(url_title($judul));
            $konten     = $this->input->post('konten');
            $sampul     = $gambar['file_name'];
            $author     = $this->session->userdata('id');
            $kategori   = $this->input->post('kategori');
            $status     = $this->input->post('status');

            $data = array(
                'artikel_tanggal'   => $tanggal,
                'artikel_judul'     => $judul,
                'artikel_slug'      => $slug,
                'artikel_konten'    => $konten,
                'artikel_sampul'    => $sampul,
                'artikel_author'    => $author,
                'artikel_kategori'  => $kategori,
                'artikel_status'    => $status
            );

            $this->m_data->insert_data('artikel', $data);
            redirect(base_url() . 'dashboard/artikel');
        } else {
            // Jika upload gagal
            $data['gambar_error'] = $this->upload->display_errors();
            $data['kategori'] = $this->m_data->get_data('kategori')->result();

            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_artikel_tambah', $data);
            $this->load->view('dashboard/v_footer');
        }
    } else {
        // Jika validasi form gagal
        $data['kategori'] = $this->m_data->get_data('kategori')->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_artikel_tambah', $data);
        $this->load->view('dashboard/v_footer');
    }
}
public function artikel_tambah_aksi() {
    $tanggal   = $this->input->post('tanggal');
    $judul     = $this->input->post('judul');
    $slug      = url_title($judul, 'dash', true);
    $konten    = $this->input->post('konten');
    $sampul    = ''; // Misal upload belum diproses
    $author    = $this->session->userdata('nama');
    $kategori  = $this->input->post('kategori');
    $status    = $this->input->post('status');

    $data = array(
        'artikel_tanggal'   => $tanggal,
        'artikel_judul'     => $judul,
        'artikel_slug'      => $slug,
        'artikel_konten'    => $konten,
        'artikel_sampul'    => $sampul,
        'artikel_author'    => $author,
        'artikel_kategori'  => $kategori,
        'artikel_status'    => $status
    );

    $this->m_data->insert_data('artikel', $data);
    redirect(base_url('dashboard/artikel'));
}
public function artikel_edit($id) {
    $where = array(
        'artikel_id' => $id
    );

    $data['artikel'] = $this->m_data->edit_data('artikel', $where)->result();
    $data['kategori'] = $this->m_data->get_data('kategori')->result();

    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_artikel_edit', $data);
    $this->load->view('dashboard/v_footer');
}
public function artikel_update() {
    // Judul, konten, dan kategori wajib diisi
    $this->form_validation->set_rules('judul', 'Judul', 'required');
    $this->form_validation->set_rules('konten', 'Konten', 'required');
    $this->form_validation->set_rules('kategori', 'Kategori', 'required');

    if ($this->form_validation->run() != false) {
        $id         = $this->input->post('id');
        $judul      = $this->input->post('judul');
        $slug       = strtolower(url_title($judul));
        $konten     = $this->input->post('konten');
        $kategori   = $this->input->post('kategori');
        $status     = $this->input->post('status');

        $where = array(
            'artikel_id' => $id
        );

        $data = array(
            'artikel_judul'    => $judul,
            'artikel_slug'     => $slug,
            'artikel_konten'   => $konten,
            'artikel_kategori' => $kategori,
            'artikel_status'   => $status
        );

        $this->m_data->update_data('artikel', $data, $where);

        // Jika ada file sampul yang diupload
        if (!empty($_FILES['sampul']['name'])) {
            $config['upload_path']   = './gambar/artikel/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('sampul')) {
                $gambar = $this->upload->data();
                $data = array(
                    'artikel_sampul' => $gambar['file_name']
                );
                $this->m_data->update_data('artikel', $data, $where);
                redirect(base_url('dashboard/artikel'));
            } else {
                // Jika upload gagal
                $data['gambar_error'] = $this->upload->display_errors();

                $data['artikel']  = $this->m_data->edit_data('artikel', $where)->result();
                $data['kategori'] = $this->m_data->get_data('kategori')->result();

                $this->load->view('dashboard/v_header');
                $this->load->view('dashboard/v_artikel_edit', $data);
                $this->load->view('dashboard/v_footer');
            }
        } else {
            redirect(base_url('dashboard/artikel'));
        }

    } else {
        // Jika validasi gagal
        $id = $this->input->post('id');
        $where = array('artikel_id' => $id);

        $data['artikel']  = $this->m_data->edit_data('artikel', $where)->result();
        $data['kategori'] = $this->m_data->get_data('kategori')->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_artikel_edit', $data);
        $this->load->view('dashboard/v_footer');
    }
}
public function artikel_hapus($id) {
    $where = array(
        'artikel_id' => $id
    );
    $this->m_data->delete_data('artikel', $where);
    redirect(base_url('dashboard/artikel'));
}
// Fungsi untuk mengelola halaman
public function pages() {
    // Mengambil data dari tabel 'halaman'
    $data['halaman'] = $this->m_data->get_data('halaman')->result();

    // Menampilkan tampilan header, konten halaman, dan footer
    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_pages', $data);
    $this->load->view('dashboard/v_footer');
}
public function pages_tambah(){
    $this->load->view('dashboard/v_header');
     $this->load->view('dashboard/v_pages_tambah');
      $this->load->view('dashboard/v_footer');
}
// Fungsi untuk menyimpan data halaman baru
public function pages_aksi() {
    $this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[halaman.halaman_judul]');
    $this->form_validation->set_rules('konten', 'Konten', 'required');

    // Jika validasi lolos
    if ($this->form_validation->run() != false) {
        $judul = $this->input->post('judul');
        $slug = strtolower(url_title($judul)); // Membuat slug dari judul
        $konten = $this->input->post('konten');
        $data = array(
            'halaman_judul'  => $judul,
            'halaman_slug'   => $slug,
            'halaman_konten' => $konten
        );
        $this->m_data->insert_data('halaman', $data);
        redirect(base_url() . 'dashboard/pages');

    } else {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pages_tambah');
        $this->load->view('dashboard/v_footer');
    }
}
// Fungsi untuk menampilkan form edit halaman berdasarkan ID
public function pages_edit($id) {
    $where = array('halaman_id' => $id);
    $data['halaman'] = $this->m_data->edit_data('halaman', $where)->result();
    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_pages_edit', $data);
    $this->load->view('dashboard/v_footer');
}
// Fungsi untuk memproses update data halaman
public function pages_update() {
    $this->form_validation->set_rules('judul', 'Judul', 'required');
    $this->form_validation->set_rules('konten', 'Konten', 'required');
    if ($this->form_validation->run() != false) {
        $id     = $this->input->post('id');
        $judul  = $this->input->post('judul');
        $slug   = strtolower(url_title($judul));
        $konten = $this->input->post('konten');
        $where = array(
            'halaman_id' => $id
        );
        $data = array(
            'halaman_judul'  => $judul,
            'halaman_slug'   => $slug,
            'halaman_konten' => $konten
        );
        $this->m_data->update_data('halaman', $data, $where);
        redirect(base_url() . 'dashboard/pages');

    } else {
        $id = $this->input->post('id');
        $where = array('halaman_id' => $id);
        $data['halaman'] = $this->m_data->edit_data('halaman', $where)->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pages_edit', $data);
        $this->load->view('dashboard/v_footer');
    }
}
// Fungsi untuk menghapus data halaman berdasarkan ID
public function pages_hapus($id) {
    $where = array(
        'halaman_id' => $id
    );
    $this->m_data->delete_data('halaman', $where);
    redirect(base_url() . 'dashboard/pages');
}
// Fitur profil pengguna
public function profil() {
    // Ambil ID pengguna yang sedang login dari session
    $id_pengguna = $this->session->userdata('id');

    // Ambil data pengguna berdasarkan ID
    $where = array(
        'pengguna_id' => $id_pengguna
    );
    $data['pengguna'] = $this->m_data->edit_data('pengguna', $where)->result();

    // Tampilkan halaman profil
    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_profil', $data);
    $this->load->view('dashboard/v_footer');
}
// Fungsi untuk update data profil pengguna
public function profil_update() {
    // Aturan validasi: nama dan email wajib diisi
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');

    // Jika validasi berhasil
    if ($this->form_validation->run() != false) {
        // Ambil ID pengguna dari session
        $id    = $this->session->userdata('id');
        $nama  = $this->input->post('nama');
        $email = $this->input->post('email');

        // Kondisi untuk update berdasarkan ID
        $where = array(
            'pengguna_id' => $id
        );

        // Data yang akan diperbarui
        $data = array(
            'pengguna_nama'  => $nama,
            'pengguna_email' => $email
        );

        // Jalankan update ke database
        $this->m_data->update_data('pengguna', $data, $where);

        // Redirect ke halaman profil dengan alert sukses
        redirect(base_url() . 'dashboard/profil/?alert=sukses');

    } else {
        // Jika validasi gagal, tampilkan kembali halaman profil dengan data lama
        $id_pengguna = $this->session->userdata('id');
        $where = array('pengguna_id' => $id_pengguna);
        $data['pengguna'] = $this->m_data->edit_data('pengguna', $where)->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_profil', $data);
        $this->load->view('dashboard/v_footer');
    }
}
// Fitur untuk menampilkan halaman pengaturan website
public function pengaturan()
{
    // Ambil data pengaturan dari database
    $data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();

    // Tampilkan ke view
    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_pengaturan', $data);
    $this->load->view('dashboard/v_footer');
}
// Fungsi untuk mengupdate pengaturan website
public function pengaturan_update() {
    // Validasi form: nama dan deskripsi wajib diisi
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

    if ($this->form_validation->run() != false) {
        // Ambil data dari form
        $nama            = $this->input->post('nama');
        $deskripsi       = $this->input->post('deskripsi');
        $link_facebook   = $this->input->post('link_facebook');
        $link_tiktok    = $this->input->post('link_tiktok');
        $link_instagram  = $this->input->post('link_instagram');

        // Data yang akan diupdate
        $data = array(
            'nama'           => $nama,
            'deskripsi'      => $deskripsi,
            'link_facebook'  => $link_facebook,
            'link_tiktok'   => $link_tiktok,
            'link_instagram' => $link_instagram,
        );

        // Update data di tabel 'pengaturan'
        // Karena hanya ada satu baris data, WHERE dibiarkan kosong (global update)
        $this->m_data->update_data('pengaturan', $data, []);

        // Periksa apakah ada file logo yang diunggah
        if (!empty($_FILES['logo']['name'])) {
            $config['upload_path']   = './gambar/website/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['overwrite']     = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo')) {
                $gambar = $this->upload->data();
                $logo   = $gambar['file_name'];

                // Update kolom logo di tabel 'pengaturan'
                $this->db->query("UPDATE pengaturan SET logo='$logo'");
            }
        }

        // Redirect ke halaman pengaturan dengan alert sukses
        redirect(base_url() . 'dashboard/pengaturan/?alert=sukses');

    } else {
        // Jika validasi gagal, tampilkan kembali form pengaturan
        $data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengaturan', $data);
        $this->load->view('dashboard/v_footer');
    }
}
public function pengguna() {
        $data['pengguna'] = $this->m_data->get_data('pengguna')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengguna', $data);
        $this->load->view('dashboard/v_footer');
    }
    public function pengguna_tambah() {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengguna_tambah');
        $this->load->view('dashboard/v_footer');
    }
    public function pengguna_tambah_aksi() {
    // Rules untuk form wajib diisi
    $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
    $this->form_validation->set_rules('email', 'Email Pengguna', 'required');
    $this->form_validation->set_rules('username', 'Username Pengguna', 'required');
    $this->form_validation->set_rules('password', 'Password Pengguna', 'required|min_length[8]');
    $this->form_validation->set_rules('level', 'Level Pengguna', 'required');
    $this->form_validation->set_rules('status', 'Status Pengguna', 'required');

    // Jika validasi berhasil
    if ($this->form_validation->run() != false) {
        $nama     = $this->input->post('nama');
        $email    = $this->input->post('email');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password')); // Password di-enkripsi dengan md5
        $level    = $this->input->post('level');
        $status   = $this->input->post('status');

        $data = array(
            'pengguna_nama'     => $nama,
            'pengguna_email'    => $email,
            'pengguna_username' => $username,
            'pengguna_password' => $password,
            'pengguna_level'    => $level,
            'pengguna_status'   => $status
        );

        // Insert data ke database
        $this->m_data->insert_data('pengguna', $data);

        // Redirect ke halaman pengguna
        redirect(base_url() . 'dashboard/pengguna');

    } else {
        // Jika validasi gagal, tampilkan kembali form tambah
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengguna_tambah');
        $this->load->view('dashboard/v_footer');
    }
}
public function pengguna_edit($id) {
    // Membuat kondisi WHERE berdasarkan ID pengguna
    $where = array(
        'pengguna_id' => $id
    );

    // Mengambil data pengguna berdasarkan ID
    $data['pengguna'] = $this->m_data->edit_data('pengguna', $where)->result();

    // Menampilkan form edit pengguna
    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_pengguna_edit', $data);
    $this->load->view('dashboard/v_footer');
}
public function pengguna_update() {
    // Rules untuk wajib diisi
    $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
    $this->form_validation->set_rules('email', 'Email Pengguna', 'required');
    $this->form_validation->set_rules('username', 'Username Pengguna', 'required');
    $this->form_validation->set_rules('level', 'Level Pengguna', 'required');
    $this->form_validation->set_rules('status', 'Status Pengguna', 'required');

    // Jika validasi berhasil
    if ($this->form_validation->run() != false) {
        $id       = $this->input->post('id');
        $nama     = $this->input->post('nama');
        $email    = $this->input->post('email');
        $username = $this->input->post('username');
        $level    = $this->input->post('level');
        $status   = $this->input->post('status');

        // Cek apabila password tidak diisi, maka kolom password tidak akan diupdate
        if ($this->input->post('password') == "") {
            $data = array(
                'pengguna_nama'     => $nama,
                'pengguna_email'    => $email,
                'pengguna_username' => $username,
                'pengguna_level'    => $level,
                'pengguna_status'   => $status
            );
        } else {
            $password = md5($this->input->post('password'));
            $data = array(
                'pengguna_nama'     => $nama,
                'pengguna_email'    => $email,
                'pengguna_username' => $username,
                'pengguna_password' => $password,
                'pengguna_level'    => $level,
                'pengguna_status'   => $status
            );
        }

        $where = array(
            'pengguna_id' => $id
        );

        $this->m_data->update_data('pengguna', $data, $where);
        redirect(base_url() . 'dashboard/pengguna');

    } else {
        // Jika validasi gagal, kembali ke form edit
        $id = $this->input->post('id');
        $where = array(
            'pengguna_id' => $id
        );
        $data['pengguna'] = $this->m_data->get_data('pengguna', $where)->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengguna_edit', $data);
        $this->load->view('dashboard/v_footer');
    }
}
public function pengguna_hapus($id) {
    $where = array(
        'pengguna_id' => $id
    );

    $data['pengguna_hapus'] = $this->m_data->edit_data('pengguna', $where)->row();
    $data['pengguna_lain'] = $this->db->query("SELECT * FROM pengguna WHERE pengguna_id != '$id'")->result();

    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_pengguna_hapus', $data);
    $this->load->view('dashboard/v_footer');
}
public function pengguna_hapus_aksi() {
    $pengguna_hapus = $this->input->post('pengguna_hapus');
    $pengguna_tujuan = $this->input->post('pengguna_tujuan');

    // Hapus data pengguna
    $where = array(
        'pengguna_id' => $pengguna_hapus
    );
    $this->m_data->delete_data('pengguna', $where);

    // Pindahkan semua artikel pengguna yang dihapus ke pengguna tujuan
    $w = array(
        'artikel_author' => $pengguna_hapus
    );
    $d = array(
        'artikel_author' => $pengguna_tujuan
    );
    $this->m_data->update_data('artikel', $d, $w);

    redirect(base_url() . 'dashboard/pengguna');
}
// fitur mengelola portofolio
public function portofolio() {
    $data['portofolio'] = $this->db->query("
        SELECT * FROM portofolio
        JOIN pengguna ON portofolio_author = pengguna_id
        ORDER BY portofolio_id DESC
    ")->result();

    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_portofolio', $data);
    $this->load->view('dashboard/v_footer');
}
public function portofolio_tambah() {
    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_portofolio_tambah');
    $this->load->view('dashboard/v_footer');
}
public function portofolio_aksi(){
    // Validasi: judul dan konten wajib diisi, judul harus unik
    $this->form_validation->set_rules('judul','Judul','required|is_unique[portofolio.portofolio_judul]');
    $this->form_validation->set_rules('konten','Konten','required');

    // Validasi gambar harus diupload
    if (empty($_FILES['sampul']['name'])){
        $this->form_validation->set_rules('sampul', 'Gambar Sampul', 'required');
    }

    if ($this->form_validation->run() != false) {
        // Konfigurasi upload
        $config['upload_path'] = './gambar/portofolio/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('sampul')) {
            // Ambil data gambar
            $gambar     = $this->upload->data();
            $tanggal    = date('Y-m-d H:i:s');
            $judul      = $this->input->post('judul');
            $slug       = strtolower(url_title($judul));
            $konten     = $this->input->post('konten');
            $sampul     = $gambar['file_name'];
            $author     = $this->session->userdata('id');
            $status     = $this->input->post('status');

            // Data yang akan disimpan
            $data = array(
                'portofolio_tanggal' => $tanggal,
                'portofolio_judul'   => $judul,
                'portofolio_slug'    => $slug,
                'portofolio_konten'  => $konten,
                'portofolio_sampul'  => $sampul,
                'portofolio_author'  => $author,
                'portofolio_status'  => $status
            );

            $this->m_data->insert_data('portofolio', $data);
            redirect(base_url('dashboard/portofolio'));
        } else {
            // Upload gagal
            $data['gambar_error'] = $this->upload->display_errors();

            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_portofolio_tambah', $data);
            $this->load->view('dashboard/v_footer');
        }
    } else {
        // Validasi form gagal
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_portofolio_tambah');
        $this->load->view('dashboard/v_footer');
    }
}
public function portofolio_edit($id) {
    $where = array(
        'portofolio_id' => $id
    );

    $data['portofolio'] = $this->m_data->edit_data('portofolio', $where)->result();

    $this->load->view('dashboard/v_header');
    $this->load->view('dashboard/v_portofolio_edit', $data);
    $this->load->view('dashboard/v_footer');
}
public function portofolio_update() {
    // Validasi judul dan konten wajib diisi
    $this->form_validation->set_rules('judul', 'Judul', 'required');
    $this->form_validation->set_rules('konten', 'Konten', 'required');

    if ($this->form_validation->run() != false) {
        $id     = $this->input->post('id');
        $judul  = $this->input->post('judul');
        $slug   = strtolower(url_title($judul));
        $konten = $this->input->post('konten');
        $status = $this->input->post('status');

        $where = array('portofolio_id' => $id);

        $data = array(
            'portofolio_judul'  => $judul,
            'portofolio_slug'   => $slug,
            'portofolio_konten' => $konten,
            'portofolio_status' => $status
        );

        $this->m_data->update_data('portofolio', $data, $where);

        // Jika ada file sampul yang diupload
        if (!empty($_FILES['sampul']['name'])) {
            $config['upload_path']   = './gambar/portofolio/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('sampul')) {
                $gambar = $this->upload->data();
                $data = array(
                    'portofolio_sampul' => $gambar['file_name']
                );
                $this->m_data->update_data('portofolio', $data, $where);
                redirect(base_url('dashboard/portofolio'));
            } else {
                // Jika upload gagal
                $data['gambar_error'] = $this->upload->display_errors();
                $data['portofolio']   = $this->m_data->edit_data('portofolio', $where)->result();

                $this->load->view('dashboard/v_header');
                $this->load->view('dashboard/v_portofolio_edit', $data);
                $this->load->view('dashboard/v_footer');
            }
        } else {
            redirect(base_url('dashboard/portofolio'));
        }

    } else {
        // Validasi gagal
        $id = $this->input->post('id');
        $where = array('portofolio_id' => $id);

        $data['portofolio'] = $this->m_data->edit_data('portofolio', $where)->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_portofolio_edit', $data);
        $this->load->view('dashboard/v_footer');
    }
}
public function portofolio_hapus($id) {
    $where = array(
        'portofolio_id' => $id
    );

    $this->m_data->delete_data('portofolio', $where);
    redirect(base_url() . 'dashboard/portofolio');
}
public function layanan() {
        $data['layanan'] = $this->db->query(
            'SELECT * FROM layanan, pengguna 
             WHERE id_user=pengguna_id 
             ORDER BY id DESC'
        )->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_layanan', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function layanan_tambah() {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_layanan_tambah');
        $this->load->view('dashboard/v_footer');
    }

    public function layanan_aksi() {
        $this->form_validation->set_rules('nama', 'Nama Layanan', 'required|is_unique[layanan.nama]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        if ($this->form_validation->run() != FALSE) {
            $nama = $this->input->post('nama');
            $deskripsi = $this->input->post('deskripsi');
            $status = $this->input->post('status');
            $tanggal = date('Y-m-d H:i:s');
			$author  = $this->session->userdata('id');

            // Upload gambar
            $config['upload_path'] = './gambar/layanan/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            } else {
                $gambar = '';
            }

            $data = array(
                'nama' => $nama,
                'deskripsi' => $deskripsi,
                'tanggal' => $tanggal,
                'id_user' => $author,
                'gambar' => $gambar,
				'status' => $status
            );

            $this->m_data->insert_data('layanan', $data);
            redirect(base_url('dashboard/layanan'));
        } else {
            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_layanan_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }

    public function layanan_edit($id) {
        $where = array('id' => $id);
        $data['layanan'] = $this->m_data->edit_data('layanan', $where)->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_layanan_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    public function layanan_update() {
        $this->form_validation->set_rules('nama', 'Nama Layanan', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        if ($this->form_validation->run() != FALSE) {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $deskripsi = $this->input->post('deskripsi');
            $status = $this->input->post('status');
            $tanggal = date('Y-m-d H:i:s');
			$author  = $this->session->userdata('id');

            // Upload gambar baru jika diunggah
            $config['upload_path'] = './gambar/layanan/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $this->load->library('upload', $config);

            $where = array('id' => $id);
            $data_lama = $this->m_data->edit_data('layanan', $where)->row();
            $gambar_lama = $data_lama->gambar;

            if ($this->upload->do_upload('gambar')) {
                // Hapus gambar lama jika ada
                if ($gambar_lama && file_exists('./gambar/layanan/' . $gambar_lama)) {
                    unlink('./gambar/layanan/' . $gambar_lama);
                }
                $gambar_baru = $this->upload->data('file_name');
            } else {
                $gambar_baru = $gambar_lama;
            }

            $data = array(
                'nama' => $nama,
                'tanggal' => $tanggal,
                'id_user' => $author,
                'deskripsi' => $deskripsi,
                'gambar' => $gambar_baru,
                'status' => $status,

            );

            $this->m_data->update_data('layanan', $data, $where);
            redirect(base_url('dashboard/layanan'));
        } else {
            $id = $this->input->post('id');
            $where = array('id' => $id);
            $data['layanan'] = $this->m_data->edit_data('layanan', $where)->result();
            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_layanan_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function layanan_hapus($id) {
        $where = array('id' => $id);
        $layanan = $this->m_data->edit_data('layanan', $where)->row();

        // Hapus file gambar jika ada
        if (!empty($layanan->gambar) && file_exists('./gambar/layanan/' . $layanan->gambar)) {
            unlink('./gambar/layanan/' . $layanan->gambar);
        }

        $this->m_data->delete_data('layanan', $where);
        redirect(base_url('dashboard/layanan'));
    }
	public function testimoni() {
		$data['testimoni'] = $this->db->get('testimoni')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_testimoni', $data);
		$this->load->view('dashboard/v_footer');
	}

	// TAMPILKAN FORM TAMBAH TESTIMONI
	public function testimoni_tambah() {
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_testimoni_tambah');
		$this->load->view('dashboard/v_footer');
	}

	// AKSI TAMBAH TESTIMONI
	public function testimoni_aksi() {
		$this->form_validation->set_rules('testi', 'Isi Testimoni', 'required');

		if ($this->form_validation->run() != FALSE) {
			$testi = $this->input->post('testi');
			$nama = $this->input->post('nama');
			$tanggal = date('Y-m-d H:i:s');

			// Upload gambar
			$config['upload_path'] = './gambar/testimoni/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = 2048;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('gambar')) {
				$gambar = $this->upload->data('file_name');
			} else {
				$gambar = '';
			}

			$data = array(
				'nama' => $nama,
				'testi' => $testi,
				'tanggal' => $tanggal,
				'gambar' => $gambar,
				'status' => '0'
			);

			$this->m_data->insert_data('testimoni', $data);
			redirect(base_url('dashboard/testimoni'));
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_testimoni_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	// TAMPILKAN FORM EDIT
	public function testimoni_edit($id) {
		$where = array('id' => $id);
		$data['testimoni'] = $this->m_data->edit_data('testimoni', $where)->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_testimoni_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	// AKSI UPDATE TESTIMONI
	public function testimoni_update() {
		$this->form_validation->set_rules('testi', 'Isi Testimoni', 'required');

		if ($this->form_validation->run() != FALSE) {
			$id = $this->input->post('id');
			$nama = $this->input->post('nama');
			$testi = $this->input->post('testi');
			$status = $this->input->post('status');
			$tanggal = date('Y-m-d H:i:s');

			$config['upload_path'] = './gambar/testimoni/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = 2048;
			$this->load->library('upload', $config);

			$where = array('id' => $id);
			$data_lama = $this->m_data->edit_data('testimoni', $where)->row();
			$gambar_lama = $data_lama->gambar;

			if ($this->upload->do_upload('gambar')) {
				if ($gambar_lama && file_exists('./gambar/testimoni/' . $gambar_lama)) {
					unlink('./gambar/testimoni/' . $gambar_lama);
				}
				$gambar_baru = $this->upload->data('file_name');
			} else {
				$gambar_baru = $gambar_lama;
			}

			$data = array(
				'nama' => $nama,
				'testi' => $testi,
				'tanggal' => $tanggal,
				'gambar' => $gambar_baru,
				'status' => $status
			);

			$this->m_data->update_data('testimoni', $data, $where);
			redirect(base_url('dashboard/testimoni'));
		} else {
			$id = $this->input->post('id');
			$where = array('id' => $id);
			$data['testimoni'] = $this->m_data->edit_data('testimoni', $where)->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_testimoni_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	// HAPUS TESTIMONI
	public function testimoni_hapus($id) {
		$where = array('id' => $id);
		$testimoni = $this->m_data->edit_data('testimoni', $where)->row();

		if (!empty($testimoni->gambar) && file_exists('./gambar/testimoni/' . $testimoni->gambar)) {
			unlink('./gambar/testimoni/' . $testimoni->gambar);
		}

		$this->m_data->delete_data('testimoni', $where);
		redirect(base_url('dashboard/testimoni'));
	}
}
