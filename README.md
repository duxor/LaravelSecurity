# LaravelSecurity

Klasa je pisana za podršku **Laravel** framework-a, a koristi se za manipulaciju korisničkim pravima pristupa.

## Osnovni zahtjevi
Za pravilno funkcionisanje klase potrebno je:

 * Kreirati tabelu log: 
 
 ```php
   Schema::create('pravapristupa', function(Blueprint $table)
   {
   		$table->bigIncrements('id');
        $table->string('naziv', 45);
        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        $table->timestamp('updated_at')->nullable();
   });
   Schema::create('korisnici', function(Blueprint $table)
   {
   		$table->bigIncrements('id');
        $table->unsignedBigInteger('pravapristupa_id');
        $table->foreign('pravapristupa_id')->references('id')->on('pravapristupa');
        $table->string('username', 45);
        $table->string('password', 100);
        $table->string('token', 255)->nullable();
        $table->boolean('online')->default(false);
        $table->tinyInteger('aktivan')->default(1);
        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        $table->timestamp('updated_at')->nullable();
   });
   Schema::create('log', function(Blueprint $table)
   {
      $table->bigIncrements('id');
      $table->timestamp('create_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->unsignedBigInteger('korisnici_id');
      $table->foreign('korisnici_id')->references('id')->on('korisnici');
   }); 
 ``` 
 * Na lokaciju [project folder]/ kopirati fajlove 
 	* Security.php
 	* Log.php
 	* Korisnici.php
 	* PravaPristupa.php
 * Izvršiti osnovna podešavanja tako što ćete izvršiti izmjenu varijabli koje se nalaze u klasi Security:
 	* $salt - proizvoljan niz znakova za povećanje bezbijednosti i složenosti password-a i tokena (preporučuje se da se u stringu nalaze mala i velika slova, znakovi i brojevi, te da bude dužine 15-25 karaktera).
 	* $daminLogURL - adresa do login stranice za pristup administratorskom panelu
 * Kreirati prava pristupa i korisnike.


## Način korištenja
> Nakon što su ispunjeni osnovni zahtjevi, možete početi sa korištenjem klase.

Prava pristupa korisnika u tabeli unošena su tako da se prvo unose oni sa manjim, a onda sa većim pravima, pa će porast ID-ja pratiti i domene korisničkih uticaja.

### Da li je korisnik određenih prava pristupa logovan?
```php
	return Security::autentifikacijaTest($id,$string);
```
 * $id=[number] - broj koji pokazuje pravo pristupa koje se provjerava kod korisnika
 * $string=['min',null] - ukoliko je setovan na 'min', metoda će odgovoriti sa true ukoliko se pravo pristupa korisnika poklapa sa $id ili je veće od njega, inače false; ukoliko je setovan na null, metoda će odgovoriti sa true ukoliko se pravo pristupa korisnika poklapa sa $id, inače false;
> $id i $string u drugim metodama imaju istu ulogu
> Ukoliko se ne navedu $id i $string podrayumijevaju se vrijednosti [2,null]

### Kako odobriti ristup određenoj stranici ukoliko je korisnik određenih prava pristupa logovan?

```php
	$array=['neki','niz'];
	return Security::autentifikacija('administracija.index',compact('array'),$id,$string);
```
> Pristup administrativnoj index strani sa prosleđivanjem podataka kroz promjenjivu $array

### Kako omogućiti korisniku da se loguje?
```php
	return Security::login(Input::get('username'),Input::get('password'),Input::get('return_to_url'));
```
> Korisnik se loguje sa korisničkim imenom i lozinkom, a ukoliko se zahtijeva povratak na prethodnu stranicu onda se prosleđuje i promjenjiva return_to_url.

### Kako omogućiti registraciju korisnika?
```php
	return Security::registracija(Input::get('reg_username'),Input::get('reg_email'),Input::get('reg_password'),Input::get('reg_password_potvrda'),Input::get('reg_prezime'),Input::get('reg_ime'),Input::get('return_to_url'));
```

# Autor

> # *Broje se samo rezultati!*
> Dušan Perišić
> [dusanperisic.com](https://dusanperisic.com) 
