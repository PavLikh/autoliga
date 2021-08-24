<?php
#
#
#
trait sortData {

	# getArrayByUniqueValues
	# сортировка массива по уникальным значениям
	# $arrayFromDB - массив полученный из БД
	# $keyColumnName - колонка таблицы в которой объединяем значения
	# $gruopColumnName - колонка табоицы которую группируем
	# возвращает массив [[$keyColumnName] => [[$gruopColumnName],[$gruopColumnName],[$gruopColumnName]]	

	function getArrayByUniqueValues ($arrayFromDB, $keyColumnName, $gruopColumnName):array {
		$array = [];
		foreach ($arrayFromDB as $subArr) {
			$array[$subArr[$keyColumnName]][] = $subArr[$gruopColumnName];
		}

		return $array;
	}

	# getArrayByUniqueValuesKey
	# сортировка массива по уникальным значениям с учетом ключа по полю $key

	function getArrayByUniqueValuesKey ($arrayFromDB, $keyColumnName, $gruopColumnName, $key):array {
		$array = [];
		foreach ($arrayFromDB as $subArr) {
			// $array[$subArr['id']] = 'purpose_id';
			$array[$subArr['id']] = $subArr[$keyColumnName];
			$array[$subArr[$keyColumnName]][$subArr[$key]] = $subArr[$gruopColumnName];
		}

		return $array;
	}

	function delNumericKey ($array):array
	{

		for ($i = 0; $i < count($array); $i++) {
			echo $array[$i];
			if (isnumeric($array[$i])) {
				unset($array[$i]);
			}
		}
	}
}


function namePage ($pageUrl) {
	$result = trim($pageUrl);
	$search = "/\.[^.]*$/";
	$result = preg_replace($search, '', $result);
	return $result;
}

?>