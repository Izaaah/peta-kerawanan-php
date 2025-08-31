namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
protected $users;

// Menerima data pengguna yang sudah difilter
public function __construct($users)
{
$this->users = $users;
}

// Mengembalikan data pengguna yang sudah difilter
public function collection()
{
// Menggunakan data yang diteruskan ke konstruktor
return $this->users;
}

// Menambahkan heading untuk file Excel
public function headings(): array
{
return [
'Nama',
'Username',
'Email',
'Peran',
'Status',
'Dibuat Pada',
'Terakhir Diupdate'
];
}
}
