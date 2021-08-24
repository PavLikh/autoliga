<?php

require_once 'QueryBuilder.php';
require_once 'servises.php';

class Menu extends App\QueryBuilder
{

	use sortData;

	public function main_menu()
	{
		
		// 2. Prepare the statement
		$statement = $this->pdo->prepare("SELECT purpose.id, purpose.title_ru, feature.sort_flag AS 'flag', feature.name_ru, feature.id AS 'feat_id' FROM purpose LEFT JOIN `feature` ON purpose.id = feature.purpose_id ORDER BY feature.sort_flag");
		$statement->execute(); //выполнить
		$result = $statement->fetchAll(PDO::FETCH_NAMED);

		$arrMainMenu = $this->getArrayByUniqueValuesKey($result, 'title_ru', 'name_ru', 'feat_id');

		$arrMainMenu[10] = ['Наши салоны', 'stores.php'];

		return $arrMainMenu;
	}

	public function getNavChain_old ($arMainMenu,int $currentPurposeId = null, int $currentFeatureId = null)
	{
		$arNavChain = [];
		if ($currentPurposeId) {

			$arNavChain[] = $arMainMenu[$currentPurposeId];
		}

		if ($currentFeatureId) {
			print_r($currentFeatureId);
			

			foreach ($arMainMenu as $key => $feature) {
				if ($key < 10) {
					if (is_array($feature)) {
						if (array_key_exists($currentFeatureId, $feature)) {
							$arNavChain[0] = $key;
							$arNavChain[1] = $feature[$currentFeatureId];
						
						}
					}
				}

			}
			
		}

		return $arNavChain;
	}

	public function getNavChain ($currentPage, $id = null)
	{

		
		switch ($currentPage) {
			case 'purpose':
			$sql = "SELECT purpose.title_ru AS purpose FROM purpose WHERE purpose.id = $id";
			break;

			case 'feature':
			$sql = "SELECT purpose.title_ru AS purpose, feature.name_ru AS feature FROM feature JOIN `purpose` ON purpose.id = feature.purpose_id WHERE feature.id = $id";
			break;

			case 'vehicle':
			$sql = "SELECT purpose.title_ru AS purpose, feature.name_ru AS feature, CONCAT (producer.name , ' ', model.name) AS car_name FROM vehicle
			JOIN model ON vehicle.model_id = model.id
			JOIN feature ON model.feature_id = feature.id
			JOIN purpose ON feature.purpose_id = purpose.id
			JOIN producer ON model.producer_id = producer.id
			WHERE vehicle.id = $id";
			break;

			case '/stores.php':
			return ['stores' => 'Наши салоны'];
			break;

		}


		$statement = $this->pdo->prepare($sql);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_NAMED);

		return $result;
	}

}

$menu = new Menu();


class Catalog extends App\QueryBuilder
{
	private $sql = "SELECT vehicle.id, feature.name_ru AS body, producer.id AS mark_id, producer.name AS mark, model.id AS model_id, model.name AS model,
			engine.type_ru AS engine, vehicle.engine_volume_value AS volume, vehicle.power,
			transmission.type_ru AS transmission, drive.type_ru AS drive,
			color.name_ru AS color,
			color.name_en AS color_en,
			vehicle.year,
			vehicle.price,
			vehicle.discount_id,
			discount.name_ru AS discount,
			store.name_ru AS store,
			vehicle.editable
			FROM `vehicle`
			JOIN model ON vehicle.model_id = model.id
			JOIN feature ON model.feature_id = feature.id
			JOIN purpose ON feature.purpose_id = purpose.id
			JOIN producer ON model.producer_id = producer.id
			JOIN engine ON vehicle.engine_id = engine.id
			JOIN transmission ON vehicle.transmission_id = transmission.id
			JOIN drive ON vehicle.drive_id = drive.id
			JOIN color ON vehicle.color_id = color.id
			JOIN discount ON vehicle.discount_id = discount.id
			JOIN store ON vehicle.store_id = store.id";


	public function all_catalog()
	{
		
		$statement = $this->pdo->prepare($this->sql);
		$statement->execute(); //выполнить
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function catalogByPurpose(int $purposeId)
	{
		
		$statement = $this->pdo->prepare($this->sql . " WHERE feature.purpose_id = $purposeId");
		$statement->execute(); //выполнить
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function catalogByFeature (int $featureId)
	{
		
		$statement = $this->pdo->prepare($this->sql . " WHERE feature.id = $featureId");
		$statement->execute(); //выполнить
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}

	public function catalogByProducer ($arProducerId, int $currentPurposeId = null, int $currentFeatureId = null)
	{


		$strProducerId = implode(', ', $arProducerId);

		if ($currentPurposeId) {
			$statement = $this->pdo->prepare($this->sql . " WHERE feature.purpose_id = $currentPurposeId AND producer.id IN ($strProducerId)");
		} elseif ($currentFeatureId) {
			$statement = $this->pdo->prepare($this->sql . " WHERE feature.id = $currentFeatureId AND producer.id IN ($strProducerId)");
		}

		$statement->execute(); //выполнить
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function productLine ()
	{
		$sql = "SELECT vehicle.id, feature.name_ru AS body, producer.id AS mark_id, producer.name AS mark, model.id AS model_id, model.name AS model,
			color.name_en AS color_en,
			vehicle.price,
			vehicle.discount_id,
			discount.name_ru AS discount,
			store.id AS store_id,
			store.name_ru AS store
			FROM `vehicle`
			JOIN model ON vehicle.model_id = model.id
			JOIN feature ON model.feature_id = feature.id			
			JOIN producer ON model.producer_id = producer.id
			JOIN color ON vehicle.color_id = color.id
			JOIN discount ON vehicle.discount_id = discount.id
			JOIN store ON vehicle.store_id = store.id
            JOIN purpose ON purpose.id = feature.purpose_id
            WHERE purpose.id = 1 ORDER BY RAND() LIMIT 4";
		$statement = $this->pdo->prepare($sql);
		$statement->execute(); //выполнить
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}





}

$catalog = new Catalog();


class Filter 
{
	public function getListMark ($arCatalog)
	{
		$array = [];
		foreach ($arCatalog as $key => $value) {
			$result[$value['mark_id']] = $value['mark'];
		}

		return $result;
	}

	public function listMarkModelBase ($arCatalog)
	{
		$array = [];
		foreach ($arCatalog as $key => $value) {
			$arMark[$value['mark_id']] = $value['mark'];
			$arModel[$value['model_id']] = $value['model'];
		}
		
		$result = ['mark' => $arMark, 'model' => $arModel];

		return $result;
	}

	public function filterByProducer ($arFilter, $arCatalog) {
		$arFilter['model'] = null;

		foreach ($arCatalog as $key => $value) {
			$arFilter['model'][$value['model_id']] = $value['model'];
		}

		return $arFilter;
	}



	public function catalogByMark ($arMarkId, $arCatalog)
	{
		
		foreach ($arCatalog as $key => $arVehicle) {
			foreach ($arMarkId as  $value) {
				if ($arVehicle['mark_id'] == $value) {
					$arFilteredCatalog[] = $arVehicle;	
				}
			}
		}

		return $arFilteredCatalog;
	}


	public function catalogByModel ($arModelId, $arCatalog)
	{
	
		foreach ($arCatalog as $key => $arVehicle) {
			foreach ($arModelId as $value) {
				if ($arVehicle['model_id'] == $value) {
					$arFilteredCatalog[] = $arVehicle;	
				}
			}
		}

		return $arFilteredCatalog;
	}

}

$filter = new Filter();

class Detail extends App\QueryBuilder
{

	private $sql = "SELECT vehicle.id, feature.name_ru AS body, producer.id AS mark_id, producer.name AS mark, model.id AS model_id, model.name AS model,
			engine.type_ru AS engine, vehicle.engine_volume_value AS volume, vehicle.power,
			transmission.type_ru AS transmission, drive.type_ru AS drive,
			color.name_ru AS color,
			color.name_en AS color_en,
			vehicle.year,
			vehicle.price,
			vehicle.discount_id,
			discount.name_ru AS discount,
			store.id AS store_id,
			store.name_ru AS store,
			vehicle.editable
			FROM `vehicle`
			JOIN model ON vehicle.model_id = model.id
			JOIN feature ON model.feature_id = feature.id
			JOIN purpose ON feature.purpose_id = purpose.id
			JOIN producer ON model.producer_id = producer.id
			JOIN engine ON vehicle.engine_id = engine.id
			JOIN transmission ON vehicle.transmission_id = transmission.id
			JOIN drive ON vehicle.drive_id = drive.id
			JOIN color ON vehicle.color_id = color.id
			JOIN discount ON vehicle.discount_id = discount.id
			JOIN store ON vehicle.store_id = store.id";

	public function detailData(int $vehicleId)
	{
		

		$statement = $this->pdo->prepare($this->sql . " WHERE vehicle.id = $vehicleId");
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	public function pictureId (int $id)
	{
		if ($id < 10) {
			$photoId = '00' . $id;
		} else if ($id < 100) {
			$photoId = '0' . $id;
		} else {
			$photoId = $id;
		}
		return $photoId;
	}

	public function picture ($arDetail)
	{
		$pictureName = str_replace(' ', '_', mb_strtolower($arDetail['mark'] . '_' . $arDetail['model'] . '_' .$arDetail['color_en']));
		$pictureName = $this->pictureId($arDetail['id']) . '_' . $pictureName;

		return $pictureName;
	}

}

$detail = new Detail();

class Store extends App\QueryBuilder
{

	private $sql = "SELECT store.id AS id, store.name_ru AS name_ru,
		store.address_ru AS address, store.coordinates AS coordinates, region.name_ru AS region
		FROM `store` JOIN region ON store.region_id = region.id";
			
	public function arStores()
	{
		$statement = $this->pdo->prepare($this->sql);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;

	}

	public function storeById(int $storeId)
	{

		$statement = $this->pdo->prepare($this->sql . " WHERE store.id = $storeId");
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);

		return $result;

	}

	public function vehicleByStore ($storeId)
	{

		$sql = "SELECT vehicle.id, feature.name_ru AS body, producer.id AS mark_id, producer.name AS mark, model.id AS model_id, model.name AS model,
			color.name_en AS color_en,
			vehicle.price,
			vehicle.discount_id,
			discount.name_ru AS discount,
			store.id AS store_id,
			store.name_ru AS store
			FROM `vehicle`
			JOIN model ON vehicle.model_id = model.id
			JOIN feature ON model.feature_id = feature.id			
			JOIN producer ON model.producer_id = producer.id
			JOIN color ON vehicle.color_id = color.id
			JOIN discount ON vehicle.discount_id = discount.id
			JOIN store ON vehicle.store_id = store.id WHERE vehicle.store_id = $storeId";

		$statement = $this->pdo->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $result;

	}
}

$store = new Store();

?>
