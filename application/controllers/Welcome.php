<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('m_data');
    }

    public function index() {
        // Ambil 3 artikel terbaru yang sudah publish
        $data['artikel'] = $this->db->query("
            SELECT * FROM artikel
            JOIN pengguna ON artikel.artikel_author = pengguna.pengguna_id
            JOIN kategori ON artikel.artikel_kategori = kategori.kategori_id
            WHERE artikel_status = 'publish'
            ORDER BY artikel_id DESC
            LIMIT 3
        ")->result();
        $data['portofolio'] = $this->db->query("
			SELECT * FROM portofolio
			JOIN pengguna ON portofolio.portofolio_author = pengguna.pengguna_id
			WHERE portofolio_status = 'publish'
			ORDER BY portofolio_id DESC
			LIMIT 3
			")->result();

		$data['layanan'] = $this->db->query("
			SELECT * FROM layanan
			WHERE status='1'
			LIMIT 6
			")->result();


		$data['testimoni'] = $this->db->query("
			SELECT * FROM testimoni where status='1'
			LIMIT 6
			")->result();

        // Data pengaturan website
        $data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

        // SEO Meta
        $data['meta_keyword'] = $data['pengaturan']->nama;
        $data['meta_description'] = $data['pengaturan']->deskripsi;

        // Load tampilan
        $this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_homepage', $data);
        $this->load->view('frontend/v_footer', $data);

    }
	public function single($slug)
{
    // Ambil data artikel berdasarkan slug
    $data['artikel'] = $this->db->query("
        SELECT * FROM artikel
        JOIN pengguna ON artikel.artikel_author = pengguna.pengguna_id
        JOIN kategori ON artikel.artikel_kategori = kategori.kategori_id
        WHERE artikel_status = 'publish'
        AND artikel_slug = '$slug'
    ")->result();
    $data['portofolio'] = $this->db->query("
		SELECT * FROM portofolio
		JOIN pengguna ON portofolio.portofolio_author = pengguna.pengguna_id
		WHERE portofolio_status = 'publish'
		ORDER BY portofolio_id DESC
		LIMIT 3
		")->result();

    // Ambil data pengaturan website
    $data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

    // SEO Meta
    if (count($data['artikel']) > 0) {
        $data['meta_keyword'] = $data['artikel'][0]->artikel_judul;
        $data['meta_description'] = substr($data['artikel'][0]->artikel_konten, 0, 100);
    } else {
        $data['meta_keyword'] = $data['pengaturan']->nama;
        $data['meta_description'] = $data['pengaturan']->deskripsi;
    }

    // Tampilkan view
    $this->load->view('frontend/v_header', $data);
    $this->load->view('frontend/v_single', $data);
    $this->load->view('frontend/v_footer', $data);
}
public function blog() {
    // Data pengaturan website
    $data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

    // SEO Meta
    $data['meta_keyword'] = $data['pengaturan']->nama;
    $data['meta_description'] = $data['pengaturan']->deskripsi;

    // Jumlah data artikel
    $jumlah_data = $this->m_data->get_data('artikel')->num_rows();

    // Load library pagination
    $this->load->library('pagination');

    // Konfigurasi pagination
    $config['base_url'] = base_url() . 'blog/';
    $config['total_rows'] = $jumlah_data;
    $config['per_page'] = 3;
    $config['first_link'] = 'First';
    $config['last_link'] = 'Last';
    $config['prev_link'] = 'Prev';
    $config['next_link'] = 'Next';

    $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul></nav></div>';

    $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close'] = '</span></li>';

    $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';

    $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['next_tag_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';

    $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['prev_tag_close'] = '</span></li>';

    $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['first_tag_close'] = '</span></li>';

    $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['last_tag_close'] = '</span></li>';

    // Ambil data halaman saat ini dari URI segment
    $FROM = $this->uri->segment(2);
    if ($FROM == "") {
        $FROM = 0;
    }

    // Inisialisasi pagination
    $this->pagination->initialize($config);

    // Ambil data artikel untuk ditampilkan
    $data['artikel'] = $this->db->query("
        SELECT * FROM artikel, pengguna, kategori
        WHERE artikel_status = 'publish'
        AND artikel_author = pengguna_id
        AND artikel_kategori = kategori_id
        ORDER BY artikel_id DESC
        LIMIT $config[per_page] OFFSET $FROM
    ")->result();

    $data['portofolio'] = $this->db->query("
  SELECT * FROM portofolio
  JOIN pengguna ON portofolio.portofolio_author = pengguna.pengguna_id
  WHERE portofolio_status = 'publish'
  ORDER BY portofolio_id DESC
  LIMIT 3
")->result();

    // Load view
    $this->load->view('frontend/v_header', $data);
    $this->load->view('frontend/v_blog', $data);
    $this->load->view('frontend/v_footer', $data);
}
public function page($slug) {
    // Ambil halaman berdasarkan slug
    $where = array(
        'halaman_slug' => $slug
    );
    $data['halaman'] = $this->m_data->edit_data('halaman', $where)->result();

    // Data pengaturan website
    $data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

    // SEO Meta
    $data['meta_keyword'] = $data['pengaturan']->nama;
    $data['meta_description'] = $data['pengaturan']->deskripsi;

    // Load tampilan halaman
    $this->load->view('frontend/v_header', $data);
    $this->load->view('frontend/v_page', $data);
    $this->load->view('frontend/v_footer', $data);
}
public function kategori($slug)
{
    // Data pengaturan website
    $data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

    // SEO Meta
    $data['meta_keyword'] = $data['pengaturan']->nama;
    $data['meta_description'] = $data['pengaturan']->deskripsi;

    // Hitung jumlah artikel
    $jumlah_artikel = $this->db->query("
        SELECT * FROM artikel
        JOIN pengguna ON artikel_author = pengguna_id
        JOIN kategori ON artikel_kategori = kategori_id
        WHERE artikel_status = 'publish'
        AND kategori_slug = '$slug'
    ")->num_rows();

    // Konfigurasi Pagination
    $this->load->library('pagination');
    $config['base_url'] = base_url().'kategori/'.$slug;
    $config['total_rows'] = $jumlah_artikel;
    $config['per_page'] = 4;
    $config['first_link'] = 'First';
    $config['last_link'] = 'Last';
    $config['prev_link'] = 'Prev';
    $config['next_link'] = 'Next';
    $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul></nav></div>';
    $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close'] = '</span></li>';
    $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['next_tag_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['prev_tag_close'] = '</span></li>';
    $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['first_tag_close'] = '</span></li>';
    $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['last_tag_close'] = '</span></li>';

    // Ambil segment ke-3 (offset)
    $FROM = $this->uri->segment(3);
    if ($FROM == "") {
        $FROM = 0;
    }

    $this->pagination->initialize($config);

    // Ambil data artikel
    $data['artikel'] = $this->db->query("
        SELECT * FROM artikel
        JOIN pengguna ON artikel_author = pengguna_id
        JOIN kategori ON artikel_kategori = kategori_id
        WHERE artikel_status = 'publish'
        AND kategori_slug = '$slug'
        ORDER BY artikel_id DESC
        LIMIT $config[per_page] OFFSET $FROM
    ")->result();

    // Load view
    $this->load->view('frontend/v_header', $data);
    $this->load->view('frontend/v_kategori', $data);
    $this->load->view('frontend/v_footer', $data);
}
public function search()
{
    // Mengambil nilai keyword dari form pencarian
    $cari = htmlentities(trim($this->input->post('cari', true))) ?: '';

    // Jika URI segmen 2 ada, maka nilai $cari diganti
    $cari = ($this->uri->segment(2)) ? $this->uri->segment(2) : $cari;

    // Data pengaturan website
    $data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

    // SEO Meta
    $data['meta_keyword'] = $data['pengaturan']->nama;
    $data['meta_description'] = $data['pengaturan']->deskripsi;

    // Hitung jumlah artikel yang cocok dengan pencarian
    $jumlah_artikel = $this->db->query("
        SELECT * FROM artikel
        JOIN pengguna ON artikel_author = pengguna_id
        JOIN kategori ON artikel_kategori = kategori_id
        WHERE artikel_status = 'publish'
        AND (artikel_judul LIKE '%$cari%' OR artikel_konten LIKE '%$cari%')
    ")->num_rows();

    // Konfigurasi Pagination
    $this->load->library('pagination');
    $config['base_url'] = base_url() . 'search/' . $cari;
    $config['total_rows'] = $jumlah_artikel;
    $config['per_page'] = 4;
    $config['first_link'] = 'First';
    $config['last_link'] = 'Last';
    $config['prev_link'] = 'Prev';
    $config['next_link'] = 'Next';

    $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul></nav></div>';
    $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close'] = '</span></li>';
    $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['next_tag_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['prev_tag_close'] = '</span></li>';
    $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['first_tag_close'] = '</span></li>';
    $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['last_tag_close'] = '</span></li>';

    // Ambil segment ke-3 untuk offset
    $FROM = $this->uri->segment(3);
    if ($FROM == "") {
        $FROM = 0;
    }

    $this->pagination->initialize($config);

    // Ambil data artikel berdasarkan keyword
    $data['artikel'] = $this->db->query("
        SELECT * FROM artikel
        JOIN pengguna ON artikel_author = pengguna_id
        JOIN kategori ON artikel_kategori = kategori_id
        WHERE artikel_status = 'publish'
        AND (artikel_judul LIKE '%$cari%' OR artikel_konten LIKE '%$cari%')
        ORDER BY artikel_id DESC
        LIMIT $config[per_page] OFFSET $FROM
    ")->result();

    $data['cari'] = $cari;

    // Load view
    $this->load->view('frontend/v_header', $data);
    $this->load->view('frontend/v_search', $data);
    $this->load->view('frontend/v_footer', $data);
}
public function notfound()
{
    // Data pengaturan website
    $data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

    // SEO Meta
    $data['meta_keyword'] = $data['pengaturan']->nama;
    $data['meta_description'] = $data['pengaturan']->deskripsi;

    // Load view halaman 404
    $this->load->view('frontend/v_header', $data);
    $this->load->view('frontend/v_notfound', $data);
    $this->load->view('frontend/v_footer', $data);

    // Ambil 3 artikel terbaru yang sudah publish
    $data['artikel'] = $this->db->query("
        SELECT * FROM artikel
        JOIN pengguna ON artikel.artikel_author = pengguna.pengguna_id
        JOIN kategori ON artikel.artikel_kategori = kategori.kategori_id
        WHERE artikel_status = 'publish'
        ORDER BY artikel_id DESC
        LIMIT 3
    ")->result();

    // Ambil 3 portofolio terbaru yang sudah publish
    $data['portofolio'] = $this->db->query("
        SELECT * FROM portofolio
        JOIN pengguna ON portofolio.portofolio_author = pengguna.pengguna_id
        WHERE portofolio_status = 'publish'
        ORDER BY portofolio_id DESC
        LIMIT 3
    ")->result();

    // Data pengaturan website
    $data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

    // SEO Meta
    $data['meta_keyword'] = $data['pengaturan']->nama;
    $data['meta_description'] = $data['pengaturan']->deskripsi;

    // Load tampilan
    $this->load->view('frontend/v_header', $data);
    $this->load->view('frontend/v_homepage', $data);
    $this->load->view('frontend/v_footer', $data);
}
public function portofolio_detail($slug)
{
    // Ambil detail portofolio berdasarkan slug
    $data['portofolio'] = $this->db->query("
        SELECT * FROM portofolio 
        JOIN pengguna ON portofolio.portofolio_author = pengguna.pengguna_id
        WHERE portofolio_slug = '$slug'
        AND portofolio_status = 'publish'
        LIMIT 1
    ")->row();

    // Jika tidak ditemukan, redirect ke notfound
    if (!$data['portofolio']) {
        redirect(base_url('notfound'));
    }

    // Pengaturan website
    $data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

    // SEO Meta
    $data['meta_keyword'] = $data['portofolio']->portofolio_judul;
    $data['meta_description'] = substr(strip_tags($data['portofolio']->portofolio_konten), 0, 150);

    // Tampilkan view
    $this->load->view('frontend/v_header', $data);
    $this->load->view('frontend/v_portofolio_detail', $data);
    $this->load->view('frontend/v_footer', $data);
}
public function layanan()
    {
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

        $data['layanan'] = $this->db->query(
            'SELECT * FROM layanan, pengguna 
             WHERE id_user=pengguna_id and status=1
             ORDER BY id DESC'
        )->result();

        $this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_layanan', $data);
        $this->load->view('frontend/v_footer',$data);
    }

		public function layanan_detail($id)
    {
				$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
				$data['meta_keyword'] = $data['pengaturan']->nama;
				$data['meta_description'] = $data['pengaturan']->deskripsi;

        $data['layanan'] = $this->db->query(
						"SELECT * FROM layanan 
						JOIN pengguna ON layanan.id_user = pengguna.pengguna_id 
						WHERE layanan.id = '$id' 
						ORDER BY layanan.id DESC"
				)->row();

        if (!$data['layanan']) {
            show_404(); 
        }

        $this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_detail_layanan', $data);
        $this->load->view('frontend/v_footer',$data);
    }
	public function testimoni_tambah() {
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
				$data['meta_keyword'] = $data['pengaturan']->nama;
				$data['meta_description'] = $data['pengaturan']->deskripsi;

        $data['testimoni'] = $this->db->query(
            'SELECT * FROM testimoni'
        )->result();
		$this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_testimoni', $data);
        $this->load->view('frontend/v_footer',$data);
	}

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
			redirect(base_url('welcome/testimoni_tambah'));
		} else {
		$this->load->view('frontend/v_header', $data);
        $this->load->view('frontend/v_homepage', $data);
        $this->load->view('frontend/v_footer',$data);
		}
	}
}
