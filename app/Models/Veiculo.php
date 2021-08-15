<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;

	/**
 * App\Models\Veiculo
 *
 * @property int $id
 * @property string $placa
 * @property string $uf
 * @property string $cor
 * @property string $marca
 * @property string $modelo
 * @property string $rntrc
 * @property string $tipo
 * @property string $tipo_carroceria
 * @property string $tipo_rodado
 * @property string $tara
 * @property string $capacidade
 * @property string $proprietario_documento
 * @property string $proprietario_nome
 * @property string $proprietario_ie
 * @property string $proprietario_uf
 * @property int $proprietario_tp
 * @property int $ativo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereAtivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereCapacidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereCor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereMarca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereModelo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo wherePlaca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereProprietarioDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereProprietarioIe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereProprietarioNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereProprietarioTp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereProprietarioUf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereRntrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereTara($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereTipoCarroceria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereTipoRodado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereUf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Veiculo extends Model
	{
		use HasFactory;

		protected $fillable = [
			'tipo', 'placa', 'uf', 'cor', 'marca', 'modelo', 'rntrc', 'tipo', 'tipo_carroceria',
			'tipo_rodado', 'tara', 'capacidade', 'proprietario_documento',
			'proprietario_nome', 'proprietario_ie', 'proprietario_uf', 'proprietario_tp'
		];

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
			return self::selectizeList($items);

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
			return self::selectizeList($items);

		}

		public static function tiposCarroceria(): array
		{
			$items = [
				"00" => "NAO APLICÁVEL",
				"01" => "ABERTA",
				"02" => "FECHADA/BAU",
				"03" => "GRANELEIRA",
				"04" => "PORTA CONTAINER",
				"05" => "SLIDER"
			];
			return self::selectizeList($items);

		}

		public static function tiposProprietario(): array
		{
			$items = [
				"0" => "TAC AGREGADO",
				"1" => "TAC INDEPENDENTE",
				"2" => "OUTROS"
			];

			return self::selectizeList($items);
		}

		public static function cUF(): array
		{
			return self::selectizeList(listUfs());
		}

		private static function selectizeList(array $items):array
		{
            $values = [];
            if ($items){
                foreach ($items as $value => $label){
                    $values[] = [
                        'value' => $value,
                        'label' => $value . ' - '. $label
                    ];
                }
            }
			return $values;
		}

//		private function resolveGetSelectize($value){
//
//            return [
//                'value' => $this->attributes[$value],
//                'label' =>'tests'
//            ];
//        }

//        public function getUfAttribute()
//        {
//            return $this->resolveGetSelectize('uf');
//        }

//		public function setUfAttribute($value)
//        {
//            var_dump($value);
//            $this->attributes['uf'] = $value['value'];
//        }
//        public function getProprietarioUfAttribute()
//        {
//            return $this->resolveGetSelectize('proprietario_uf');
//        }

//		public function setProprietarioUfAttribute($value)
//        {
//            $this->attributes['proprietario_uf'] = $value['value'];
//        }
//
//		public function setProprietarioTpAttribute($value)
//        {
//            $this->attributes['proprietario_tp'] = $value['value'];
//        }
//
//		public function setTipoRodadoAttribute($value)
//        {
//            $this->attributes['tipo_rodado'] = $value['value'];
//        }
//		public function setTipoAttribute($value)
//        {
//            $this->attributes['tipo'] = $value['value'];
//        }
//		public function setTipoCarroceriaAttribute($value)
//        {
//            $this->attributes['tipo_carroceria'] = $value['value'];
//        }


	}
