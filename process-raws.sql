UPDATE raws SET kegiatan_id = 
    (SELECT id  
        FROM pemdas
        WHERE pemdas.nama = raws.nama)
WHERE pemda_id=0


UPDATE raws SET 
    is_proses = 1,
    kegiatan_id =
   (SELECT id  
        FROM kegiatans
        WHERE 
        LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(REPLACE(kegiatans.kegiatan,'\r\n',' ')), ':', ''), ')', ''), '(', ''), ',', ''), '\\', ''), '\/', ''), '\"', ''), '?', ''), '\'', ''), '&', ''), '!', ''), '.', ''), ' ', '-'), '--', '-'), '--', '-')) 
        = 
        LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(REPLACE(raws.kegiatan,'\r\n',' ')), ':', ''), ')', ''), '(', ''), ',', ''), '\\', ''), '\/', ''), '\"', ''), '?', ''), '\'', ''), '&', ''), '!', ''), '.', ''), ' ', '-'), '--', '-'), '--', '-')) 

        )
WHERE is_proses=0


/*
COPY TABLE rawdatas
 */

/*
1. generate pemda_id and bidang_id column
*/
UPDATE raws 
SET 
    is_proses = 1,
    pemda_id = (SELECT id FROM pemdas WHERE pemdas.nama = raws.nama),
    bidang_id = (
        SELECT id FROM bidangs 
        WHERE 
            LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(bidangs.nama), ':', ''), ')', ''), '(', ''), ',', ''), '\\', ''), '\/', ''), '\"', ''), '?', ''), '\'', ''), '&', ''), '!', ''), '.', ''), ' ', '-'), '--', '-'), '--', '-'))
            = 
            LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(raws.bidang), ':', ''), ')', ''), '(', ''), ',', ''), '\\', ''), '\/', ''), '\"', ''), '?', ''), '\'', ''), '&', ''), '!', ''), '.', ''), ' ', '-'), '--', '-'), '--', '-'))
    )
WHERE is_proses=0

/*
2. generate the subbidang_id
*/
UPDATE raws 
SET 
    subbidang_id = (
        SELECT id FROM subbidangs 
        WHERE 
            LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(concat(subbidangs.bidang_id,'-',subbidangs.nama)), ':', ''), ')', ''), '(', ''), ',', ''), '\\', ''), '\/', ''), '\"', ''), '?', ''), '\'', ''), '&', ''), '!', ''), '.', ''), ' ', '-'), '--', '-'), '--', '-'))
            = 
            LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(concat(raws.bidang_id,'-',raws.subbidang)), ':', ''), ')', ''), '(', ''), ',', ''), '\\', ''), '\/', ''), '\"', ''), '?', ''), '\'', ''), '&', ''), '!', ''), '.', ''), ' ', '-'), '--', '-'), '--', '-'))
    )
WHERE subbidang_id=0

/*
3. generate the kegiatan_id
*/
UPDATE raws 
SET 
    kegiatan_id = (
        SELECT id FROM kegiatans 
        WHERE 
            md5(LOWER(concat(kegiatans.subbidang_id,'-',kegiatans.kegiatan)))
            = 
            md5(LOWER(concat(raws.subbidang_id,'-',raws.kegiatan)))
    )
WHERE kegiatan_id=0
/*
3. generate jenis dak
buat field baru dengan nama _jenis dan defaultnya no
*/
UPDATE raws 
SET _jenis = (
    CASE jenis 
        WHEN 'Dana Alokasi Khusus Reguler' THEN 'reguler'
        WHEN 'Dana Alokasi Khusus Afirmasi' THEN 'afirmasi'
        WHEN 'Dana Alokasi Khusus Penugasan' THEN 'penugasan'
        ELSE 'no'
    END)
WHERE _jenis='no'

/*
4. Rename table jadi usulans
remove field jenis,kode,nama,kode_bidang,bidang,subbidang,kode proyek
 */


