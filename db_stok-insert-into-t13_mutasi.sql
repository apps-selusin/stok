insert into t13_mutasi
	(
	tabelid, url, articleid, kode, nourut,
    tgl, jam, keterangan,
    masukqty,
    masukharga,
    saldoqty,
    saldoharga
    )
    
select
	id, concat('t06_articleview.php?showdetail=&id=', id), id, kode, 0,
    '2018-10-01', '00:00', 'Stok Awal',
    0,
    0,
    0,
    0
from t06_article