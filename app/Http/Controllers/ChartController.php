<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\UTCDateTime;

class ChartController extends Controller 
{
    private $modosCollection;
    private $sensorCollection;
    private $casaNombre = "El hogar de los sueños";
    
    public function __construct()
    {
        $mongoClient = new Client(env('DB_URI'));
        
        $this->modosCollection = $mongoClient->dbProyecto->modos;
        $this->sensorCollection = $mongoClient->dbProyecto->sensores; 
    }
    
    public function index()
    {
        $modos = $this->modosCollection->find([], ['projection' => ['modo_iniciado' => 1]])->toArray();
        $modosNombres = [];
        
        foreach ($modos as $modo) {
            if (isset($modo['modo_iniciado'])) {
                $modosNombres[] = strtolower($modo['modo_iniciado']);
            }
        }
        
        $conteoModos = [];
        if (empty($modosNombres)) {
            $conteoModos = ['normal' => 8, 'vacaciones' => 4, 'nocturno' => 6];
        } else {
            $conteoModos = array_count_values($modosNombres);
        }
        
        $pipeline = [
            ['$unwind' => '$sensores'],
            ['$match' => ['sensores.estado' => true]],
            ['$group' => [
                '_id' => '$sensores.tipo_sensor',
                'count' => ['$sum' => 1]
            ]]
        ];
        
        $sensoresAgregados = $this->sensorCollection->aggregate($pipeline)->toArray();
        
        $conteoSensoresActivados = ['Luz' => 0, 'Gas' => 0];
        $tieneDataReal = false;
        
        foreach ($sensoresAgregados as $sensor) {
            if (isset($sensor['_id'])) {
                $tipoSensor = ucfirst(strtolower($sensor['_id']));
                if (array_key_exists($tipoSensor, $conteoSensoresActivados)) {
                    $conteoSensoresActivados[$tipoSensor] = $sensor['count'];
                    $tieneDataReal = true;
                }
            }
        }
        
        $pipelineGas = [
            ['$unwind' => '$sensores'],
            ['$match' => [
                'sensores.tipo_sensor' => ['$in' => ['gas', 'Gas']],
                'sensores.estado' => true,
                'sensores.niveles' => ['$exists' => true]
            ]],
            ['$group' => [
                '_id' => '$sensores.niveles',
                'count' => ['$sum' => 1]
            ]]
        ];
        
        $nivelesGasAgregados = $this->sensorCollection->aggregate($pipelineGas)->toArray();
        
        $nivelesGas = ['bajo' => 0, 'medio' => 0, 'alto' => 0];
        $tieneNivelesReales = false;
        
        foreach ($nivelesGasAgregados as $nivel) {
            if (isset($nivel['_id'])) {
                $nivelGas = strtolower($nivel['_id']);
                if (array_key_exists($nivelGas, $nivelesGas)) {
                    $nivelesGas[$nivelGas] = $nivel['count'];
                    $tieneNivelesReales = true;
                }
            }
        }
        
        $alertaGas = $nivelesGas['alto'] > 0;
        
        $casaNombre = $this->casaNombre;
        $fechaActual = date('d/m/Y');
        
        return view('charts', compact(
            'conteoModos', 
            'conteoSensoresActivados', 
            'nivelesGas', 
            'alertaGas',
            'casaNombre',
            'fechaActual'
        ));
    }
    
    public function insertarDatosEjemplo()
    {
        $modos = [
            ['casa' => $this->casaNombre, 'fecha' => date('Y-m-d H:i:s'), 'modo_iniciado' => 'normal'],
            ['casa' => $this->casaNombre, 'fecha' => date('Y-m-d H:i:s'), 'modo_iniciado' => 'normal'],
            ['casa' => $this->casaNombre, 'fecha' => date('Y-m-d H:i:s'), 'modo_iniciado' => 'vacaciones'],
            ['casa' => $this->casaNombre, 'fecha' => date('Y-m-d H:i:s'), 'modo_iniciado' => 'nocturno'],
        ];
        
        foreach ($modos as $modo) {
            $this->modosCollection->insertOne($modo);
        }
        
        $sensoresData = [
            [
                'casa' => $this->casaNombre,
                'fecha' => date('Y-m-d H:i:s'),
                'sensores' => [
                    ['tipo_sensor' => 'luz', 'estado' => true, 'ubicacion' => 'sala'],
                    ['tipo_sensor' => 'gas', 'estado' => true, 'niveles' => 'bajo', 'ubicacion' => 'cocina']
                ]
            ],
            [
                'casa' => $this->casaNombre,
                'fecha' => date('Y-m-d H:i:s'),
                'sensores' => [
                    ['tipo_sensor' => 'luz', 'estado' => true, 'ubicacion' => 'dormitorio'],
                    ['tipo_sensor' => 'gas', 'estado' => true, 'niveles' => 'medio', 'ubicacion' => 'cocina']
                ]
            ],
            [
                'casa' => $this->casaNombre,
                'fecha' => date('Y-m-d H:i:s'),
                'sensores' => [
                    ['tipo_sensor' => 'luz', 'estado' => false, 'ubicacion' => 'baño'],
                    ['tipo_sensor' => 'gas', 'estado' => true, 'niveles' => 'alto', 'ubicacion' => 'cocina']
                ]
            ]
        ];
        
        foreach ($sensoresData as $sensorData) {
            $this->sensorCollection->insertOne($sensorData);
        }
        
        return redirect()->route('charts.index')->with('success', 'Datos de ejemplo insertados correctamente');
    }
}