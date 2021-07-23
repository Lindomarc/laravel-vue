<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	
	class Vehicle extends Model
	{
		use HasFactory;
		
		public static function tipos(): array
		{
			$items = [
				"02" => "CICLO MOTO",
				"03" => "MOTONETA",
				"04" => "MOTOCICLO",
				"05" => "TRICICLO",
				"06" => "AUTOMÓVEL",
				"07" => "MICRO-ÔNIBUS",
				"08" => "ÔNIBUS",
				"10" => "REBOQUE",
				"11" => "SEMIRREBOQUE",
				"13" => "CAMIONETA",
				"14" => "CAMINHÃO",
				"17" => "CAMINHÃO TRATOR",
				"18" => "TRATOR RODAS",
				"19" => "TRATOR ESTEIRAS",
				"20" => "TRATOR MISTO",
				"21" => "QUADRICICLO",
				"22" => "ESP / ÔNIBUS",
				"23" => "CAMINHONETE",
				"24" => "CARGA/CAM",
				"25" => "UTILITÁRIO",
				"26" => "MOTOR-CASA"
			];
			return self::fixList($items);
			
		}
		
		public static function tiposRodado(): array
		{
			$items = [
				"01" => "TRUCK",
				"02" => "TOCO",
				"03" => "CAVALO MECANICO",
				"04" => "VAN",
				"05" => "UTILITARIO",
				"06" => "OUTROS"
			];
			return self::fixList($items);
			
		}
		
		public static function tiposCarroceria(): array
		{
			$items = [
				"00" => "NAO APLICAVEL",
				"01" => "ABERTA",
				"02" => "FECHADA/BAU",
				"03" => "GRANELEIRA",
				"04" => "PORTA CONTAINER",
				"05" => "SLIDER"
			];
			return self::fixList($items);
			
		}
		
		public static function tiposProprietario(): array
		{
			$items = [
				"0" => "TAC AGREGADO",
				"1" => "TAC INDEPENDENTE",
				"2" => "OUTROS"
			];
			
			return self::fixList($items);
		}
		
		public static function cUF(): array
		{
			$items = [				
				'12' => 'AC',
				'27' => 'AL',
				'13' => 'AM',
				'16' => 'AP',
				'29' => 'BA',
				'23' => 'CE',
				'53' => 'DF',
				'32' => 'ES',
				'52' => 'GO',
				'21' => 'MA',
				'31' => 'MG',
				'50' => 'MS',
				'51' => 'MT',
				'15' => 'PA',
				'25' => 'PB',
				'26' => 'PE',
				'22' => 'PI',
				'41' => 'PR',
				'33' => 'RJ',
				'24' => 'RN',
				'11' => 'RO',
				'14' => 'RR',
				'43' => 'RS',
				'28' => 'SE',
				'42' => 'SC',
				'35' => 'SP',
				'17' => 'TO'
			];
			return self::fixList($items);
		}
		
		private static function fixList(array $items):array
		{
			foreach ($items as $value => $label){
				$values[] = [
					'value' => $value,
					'label' => $value . ' - '. $label
				];
			}
			return $values??[];
		}
		
	}
