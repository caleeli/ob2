<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class NanoInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nano:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $partidas = [];
    protected $players = [
        'Edwin', 'Micky', 'Sergio', 'Pedro', 'Edson', 'Herbert', 'David'
    ];
    const DE_CUANTOS = 4;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        return;
        //shuffle($this->players);
        $players = $this->players;
        $this->partidas[] = array_splice($players, 0, 4);
        $players = $this->players;
        $this->partidas[] = array_splice($players, 3, 4);
        for ($i = 0; $i < 8; $i++) {
            $min = 1000;
            for ($j = 0; $j < 1000; $j++) {
                $partidas = $this->partidas;
                while(true) {
                    $newPar = $this->sortea();
                    $ok = true;
                    foreach($partidas as $p) {
                        asort($p);
                        asort($newPar);
                        if(json_encode($p)===json_encode($newPar)) {
                            $ok = false;
                            break;
                        }
                    }
                    if($ok) break;
                }
                $partidas[] = $newPar;
                $ev = $this->evalua($partidas);
                if ($ev < $min) {
                    $minPar = $newPar;
                    $min = $ev;
                    if($ev===0) {
                        echo '==========================================';
                        echo 'Maxima diferencia de partidas: ', $ev,"\n";
                        dump($partidas);
                        $this->evalua($partidas, true);
                        echo '==========================================';
                        break;
                    }
                }
            }
            echo 'Maxima diferencia de partidas: ', $ev,"\n";
            $this->partidas[] = $minPar;
        }
        //exec('composer dumpautoload');
        //Artisan::call('nano:migration', ['name' => snake_case($name)]);
        //Artisan::call('nano:migration', ['name' => snake_case($name)]);
    }

    public function sortea()
    {
        $partida = [];
        $players = $this->players;
        for ($i = 0; $i < static::DE_CUANTOS; $i++) {
            $j = array_rand($players);
            $partida[] = $players[$j];
            array_splice($players, $j, 1);
        }
        return $partida;
    }

    public function evalua($partidas, $print=false)
    {
        $players = [];
        foreach ($partidas as $pp) {
            foreach ($pp as $p) {
                @$players[$p] ++;
            }
        }
        $max = -1;
        $min = -1;
        foreach ($players as $p => $c) {
            if ($max == -1 || $max < $c) $max = $c;
            if ($min == -1 || $min > $c) $min = $c;
        }
        if($print) dump($players);
        return $max - $min;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
