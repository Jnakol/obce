<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Kraj;
use App\Models\Okres;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\Obce;

class Main extends BaseController
{
    private $kraj;
    private $obce;
    private $okres;
    private $data;
    private $stranek;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->kraj = new Kraj();
        $this->obce = new Obce();
        $navbar = $this->kraj->join('okres', 'kraj.kod = okres.kraj')
            ->where('kraj.kod', '141')
            ->findAll();

        $this->okres = new Okres();
        
        $stranek = 20;
        $this->stranek = $stranek;

        $this->data = [
            'navbar' => $navbar,
            'stranky' => $stranek,
        ];
    }
    public function index()
    {
        echo view('hlavni', $this->data);
    }
    public function okres($id, $str)
    {

        $obceData = $this->okres->join('obec', 'okres.kod = obec.okres')
            ->join('cast_obce', 'obec.kod = cast_obce.obec')
            ->join('ulice', 'cast_obce.kod = ulice.cast_obce')
            ->join('adresni_misto', 'ulice.kod = adresni_misto.ulice')
            ->select('obec.nazev, COUNT(*) AS pocet_adresnich_mist')
            ->groupBy('obec.kod')
            ->where('okres.kod', $id)
            ->orderBy('pocet_adresnich_mist', 'desc')
            ->paginate($str);
        
        $this->stranek = $str;
        $this->data += [
            'obceData' => $obceData,
            'pager' => $this->okres->pager,
            'okres' => $id,
        ];
        echo view('okres', $this->data);
    }
}
