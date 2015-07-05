# LaravelSecurity

Klasa je pisana za podršku **Laravel** framework-a, a koristi se za manipulaciju korisničkim pravima pristupa.

Za pravilno funkcionisanje klase potrebno je:
 Kreirati tabelu log: 
 Schema::create('log', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->timestamp('create_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('korisnici_id');
            $table->foreign('korisnici_id')->references('id')->on('korisnici');
        });