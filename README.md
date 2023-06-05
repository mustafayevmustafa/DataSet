# CSV Project

Bu layihənin məqsədi məlumatların import və export əməliyyatlarını yerinə yetirmək üçün Laravel istifadə edərək proqram hazırlamaqdır.

## Başlangıç

Aşağıdakı təlimatlar layihənin local mühitdə necə icra olunacağını təsvir edir.

### İlkin şərtlər

Bu layihəni həyata keçirmək üçün sisteminizdə aşağıdakı proqram təminatı quraşdırılmalıdır:

- PHP (versiya 8.1 və ya daha yüksək)
- Composer
- Laravel CLI
- MySQL

### Qurulum

-Standart Laravel proyekti kimidir
-migrate
-database configration
-env'de QUEUE_CONNECTION=database

### İstifadə

--Layihədə job istifadə etidiyim üçün terminalda bu komandı yazın zəhmət olmasa
--php artisan queue:work --queue=imports
-Bu layihədə iki əsas funksiya var: məlumatların import və export olmasi.

### Məlumat İmport

1. Layihəni brauzerinizdə işə salın və import səhifəsinə keçin.

2. CSV faylı seçin və "import" düyməsini basın.

3. Əməliyyat uğurla başa çatdıqdan sonra sizə bildiriş mesajı gələcək və məlumatlar verilənlər bazasında saxlanacaq.


### Məlumat Export

1. Layihəni brauzerinizdə işə salın və export düyməsini basın.

2. İstədiyiniz məlumatların filtrasiyasını edin və "Export" düyməsini basın.

3. CSV faylı endiriləcək.


## Elave Melumat

Layihədə Feature Testlərdən istifadə edərək bir neçə hissəsini test etdim comandi işə salaraq yoxlaya bilərsiniz
php artisan test
Burada məlumat çox olduğundan və ya ola biləcəyindən job istifadə edərək asinxron əməliyyat yerinə yetirməyi üstün tutdum.
Server'de supervisor ilə bu jobları daha dinamik hala gətirə bilərsiniz.

Axtarışın daha optimal aparılması üçün database'de indexlenmeden istifade etdim elave olaraqda scope'ler ile axtarışı yerinə yetirdim.
Hemcinin axtaris etdikden sonra növbəti səhifələrə keçdikdə axtarış nəticəmə uyğun olmasını təmin etdim
