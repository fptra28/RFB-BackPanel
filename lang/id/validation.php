<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut berisi pesan kesalahan default yang digunakan oleh
    | kelas validator. Beberapa aturan memiliki beberapa versi, seperti aturan
    | ukuran. Silakan ubah pesan-pesan ini sesuai kebutuhan.
    |
    */

    'accepted' => ':attribute harus diterima.',
    'active_url' => ':attribute bukan URL yang valid.',
    'after' => ':attribute harus berupa tanggal setelah :date.',
    'after_or_equal' => ':attribute harus berupa tanggal setelah atau sama dengan :date.',
    'alpha' => ':attribute hanya boleh berisi huruf.',
    'alpha_dash' => ':attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.',
    'alpha_num' => ':attribute hanya boleh berisi huruf dan angka.',
    'array' => ':attribute harus berupa array.',
    'before' => ':attribute harus berupa tanggal sebelum :date.',
    'before_or_equal' => ':attribute harus berupa tanggal sebelum atau sama dengan :date.',
    'between' => [
        'numeric' => ':attribute harus antara :min dan :max.',
        'file' => ':attribute harus antara :min dan :max kilobyte.',
        'string' => ':attribute harus antara :min dan :max karakter.',
        'array' => ':attribute harus memiliki antara :min dan :max item.',
    ],
    'boolean' => 'Kolom :attribute harus bernilai benar atau salah.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'date' => ':attribute bukan tanggal yang valid.',
    'date_equals' => ':attribute harus berupa tanggal yang sama dengan :date.',
    'date_format' => ':attribute tidak cocok dengan format :format.',
    'different' => ':attribute dan :other harus berbeda.',
    'digits' => ':attribute harus :digits digit.',
    'digits_between' => ':attribute harus antara :min dan :max digit.',
    'dimensions' => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'Kolom :attribute memiliki nilai duplikat.',
    'doesnt_start_with' => ':attribute tidak boleh diawali dengan salah satu dari berikut: :values.',
    'email' => ':attribute harus alamat email yang valid.',
    'ends_with' => ':attribute harus diakhiri dengan salah satu dari berikut: :values.',
    'exists' => ':attribute yang dipilih tidak valid.',
    'file' => ':attribute harus berupa berkas.',
    'filled' => 'Kolom :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => ':attribute harus lebih besar dari :value.',
        'file' => ':attribute harus lebih besar dari :value kilobyte.',
        'string' => ':attribute harus lebih besar dari :value karakter.',
        'array' => ':attribute harus memiliki lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => ':attribute harus lebih besar atau sama dengan :value.',
        'file' => ':attribute harus lebih besar atau sama dengan :value kilobyte.',
        'string' => ':attribute harus lebih besar atau sama dengan :value karakter.',
        'array' => ':attribute harus memiliki :value item atau lebih.',
    ],
    'image' => ':attribute harus berupa gambar.',
    'in' => ':attribute yang dipilih tidak valid.',
    'in_array' => 'Kolom :attribute tidak ada di :other.',
    'integer' => ':attribute harus berupa bilangan bulat.',
    'ip' => ':attribute harus alamat IP yang valid.',
    'ipv4' => ':attribute harus alamat IPv4 yang valid.',
    'ipv6' => ':attribute harus alamat IPv6 yang valid.',
    'json' => ':attribute harus berupa string JSON yang valid.',
    'lt' => [
        'numeric' => ':attribute harus kurang dari :value.',
        'file' => ':attribute harus kurang dari :value kilobyte.',
        'string' => ':attribute harus kurang dari :value karakter.',
        'array' => ':attribute harus memiliki kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => ':attribute harus kurang dari atau sama dengan :value.',
        'file' => ':attribute harus kurang dari atau sama dengan :value kilobyte.',
        'string' => ':attribute harus kurang dari atau sama dengan :value karakter.',
        'array' => ':attribute tidak boleh memiliki lebih dari :value item.',
    ],
    'max' => [
        'numeric' => ':attribute tidak boleh lebih dari :max.',
        'file' => ':attribute tidak boleh lebih dari :max kilobyte.',
        'string' => ':attribute tidak boleh lebih dari :max karakter.',
        'array' => ':attribute tidak boleh memiliki lebih dari :max item.',
    ],
    'mimes' => ':attribute harus berupa berkas dengan tipe: :values.',
    'mimetypes' => ':attribute harus berupa berkas dengan tipe: :values.',
    'min' => [
        'numeric' => ':attribute minimal bernilai :min.',
        'file' => ':attribute minimal berukuran :min kilobyte.',
        'string' => ':attribute minimal berisi :min karakter.',
        'array' => ':attribute minimal memiliki :min item.',
    ],
    'not_in' => ':attribute yang dipilih tidak valid.',
    'not_regex' => 'Format :attribute tidak valid.',
    'numeric' => ':attribute harus berupa angka.',
    'password' => 'Kata sandi salah.',
    'present' => 'Kolom :attribute harus ada.',
    'regex' => 'Format :attribute tidak valid.',
    'required' => 'Kolom :attribute wajib diisi.',
    'required_if' => 'Kolom :attribute wajib diisi bila :other adalah :value.',
    'required_unless' => 'Kolom :attribute wajib diisi kecuali :other ada di :values.',
    'required_with' => 'Kolom :attribute wajib diisi bila :values tersedia.',
    'required_with_all' => 'Kolom :attribute wajib diisi bila semua :values tersedia.',
    'required_without' => 'Kolom :attribute wajib diisi bila :values tidak tersedia.',
    'required_without_all' => 'Kolom :attribute wajib diisi bila tidak ada satupun dari :values tersedia.',
    'same' => ':attribute dan :other harus sama.',
    'size' => [
        'numeric' => ':attribute harus bernilai :size.',
        'file' => ':attribute harus berukuran :size kilobyte.',
        'string' => ':attribute harus terdiri dari :size karakter.',
        'array' => ':attribute harus mengandung :size item.',
    ],
    'starts_with' => ':attribute harus diawali dengan salah satu dari berikut: :values.',
    'string' => ':attribute harus berupa string.',
    'timezone' => ':attribute harus zona waktu yang valid.',
    'unique' => ':attribute sudah digunakan.',
    'uploaded' => ':attribute gagal diunggah.',
    'url' => 'Format :attribute tidak valid.',
    'uuid' => ':attribute harus UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa Validasi Khusus
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi khusus untuk atribut menggunakan
    | konvensi "attribute.rule" untuk memberi nama baris. Ini membuatnya cepat
    | untuk menentukan pesan bahasa khusus tertentu untuk aturan atribut tertentu.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'pesan-khusus',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Kustomisasi Nama Atribut Validasi
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk mengganti placeholder atribut kami
    | dengan sesuatu yang lebih ramah pembaca seperti "Alamat E-Mail" alih-alih "email".
    | Ini hanya membantu agar pesan kita lebih ekspresif.
    |
    */

    'attributes' => [],

];
