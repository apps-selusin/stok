update
	t13_mutasi a
	left join t06_article b on b.id = a.articleid
    left join t05_subgroup c on c.id = b.SubGroupID
    left join t04_maingroup d on d.id = c.MainGroupID
set
	a.kode = b.kode,
    a.maingroup = CONCAT(d.Kode, ' - ', d.Nama),
    a.subgroup = CONCAT(c.Kode, ' - ', c.Nama),
    a.article = CONCAT(b.Kode, ' - ', b.Nama)
