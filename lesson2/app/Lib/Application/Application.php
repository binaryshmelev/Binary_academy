<?php
namespace App\Lib\Application;

use App\Lib\Smartphone\Battery;
use App\Lib\Smartphone\Camera;
use App\Lib\Smartphone\Display;
use App\Lib\Smartphone\Processor;
use App\Lib\Smartphone\Smartphone;

class Application {
    private $phones = [
        ['name' => 'Apple iPhone',
         'vendor' => 'Qualcomm 5555',
         'cores' => 2,
         'display' => '480x320',
         'camera' => 8,
         'battery' => 1234
        ],
        ['name' => 'Meizu M2',
            'vendor' => 'MTK MT6735',
            'cores' => 4,
            'display' => '1280x720',
            'camera' => 5,
            'battery' => 2500
        ],
        ['name' => 'Samsung Galaxy J7',
            'vendor' => 'Exynos 7580',
            'cores' => 8,
            'display' => '1280x720',
            'camera' => 13,
            'battery' => 3000
        ],
    ];

    public function show_info() : string {
        $phone = array_rand($this->phones);
        $name = $this->phones[$phone]['name'];
        $processor = new Processor($this->phones[$phone]['vendor'], $this->phones[$phone]['cores']);
        $display = new Display($this->phones[$phone]['display']);
        $camera = new Camera($this->phones[$phone]['camera']);
        $battery = new Battery($this->phones[$phone]['battery']);
        $smartphone = new Smartphone($name, $processor, $display, $camera, $battery);

        return $smartphone->get_info();
    }
}