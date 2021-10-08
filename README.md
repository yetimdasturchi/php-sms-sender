
# php-sms-sender
Bu kichik PHP dasturi GSM usb modem yordamida SMS xabarlarni yuborish va boshqarish uchun ishlatiladi
# Imkoniyatlar

 - OTP (One time password) orqali avtorizatsiya qilish
 - Kontakt ma'lumotlarini boshqarish
 - Kontakt ma'lumotlarini vcard va xls fayllaridan import qilish
 - Sms xabarlarni guruhlar, raqamlar va kontaktlar asosida yuborish
 - Xabar yuborish vaqtlarini sozlash
 - Xabar holati haqida doimiy tarix

# O'rnatish
1. Barcha fayllar serverga ko'chiriladi 
2. `application/config/database.php` fayliga baza ma'lumotlari kiritiladi
3. Mysql bazaga `kibertexnik_my.sql` fayli yuklanadi
4. `application/config/config.php faylidan` **$config['base_url']** bandiga kerakli server manzili kiritiladi
5. Ma'lumotlar bazidan `my_users` jadvaliga kerakli foydalanuvchi ma'lumotlar kiriladi
6. `gsmsms.py` faylidan `apiurl` o'zgaruvchisiga kerakli server va `ser.port` o'zgaruvchisiga gsm modem port manzili kiritiladi
7. `gsmsms.py` faylini cronjobga boot vaqtida ishga tushirish holati bo'yicha qo'shiladi 

# Muallifdan
Ushbu dastur **Kibertexnik kompyuter injinering maktabi** nomidan ta'limni rivojlantirish uchun opensourcega kiritildi.

Muallif: Manuchehr Usmonov
Telegram: [@kibertexnik](https://t.me/kibertexnik)
Tel: +998(88) 231-22-02
Veb-sayt: www.kibertexnik.uz, www.devcon.uz
E-mail: con9799@mail.ri
