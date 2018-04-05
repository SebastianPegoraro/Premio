<?php 

namespace AppBundle\Utils;

use Doctrine\Common\Util\Inflector;
use Doctrine\Common\Collections\ArrayCollection;

class Utils {
	
	/**
	 * Devuele el array de palabras (strings) en un string
	 * 
	 * @return string
	 */
	public static function strToWords($q)
	{
		$strTerms = preg_replace('!\s+!', ' ', trim($q));
        return explode(' ', $strTerms);
	}

	/**
	 * Devuelve un array con key y value iguales
	 * con los años desde el anio actual hasta la cantidad de anios hacia atras especificado.
     *
	 * @param integer $cantAniosHaciaAtras cantidad de anios hacia atras.
	 *
	 * @return array
	 */
	public static function anioChoices($cantAniosHaciaAtras)
	{
		$anios = range(date('Y'), date('Y') - $cantAniosHaciaAtras);
		return array_combine($anios, $anios);
	}

	/**
	 * Verifica si un arraycollection tiene duplicado respecto de un atributo de los
	 * elementos en el ArrayCollection
	 *
	 * @param ArrayCollection $collection ArrayCollection a verificar.
	 * @param string $fieldName
	 * 
	 * @return boolean
	 */
	public static function hasArrayCollectionDuplicates(ArrayCollection $collection, $fieldName) {
		$values = array();

		foreach ($collection as $el) {
			$getter = 'get' . Inflector::classify($fieldName); 
        	$value = $el->{$getter}();

            if (is_string($value)) {
				$value = strtolower($value);            	
            }

            if (!is_null($value)) {
            	$values[] = $value;
            }
		}

        if (empty($values)) {
        	return false;
        }

        $countValues = array_count_values($values);

        foreach ($countValues as $count) {
        	if ($count > 1) {
        		return true;
        	}
        }

        return false;
	}

	public static function sanitizeForFileName($str)
	{
		$fileName = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $str);
		$fileName = mb_ereg_replace("([\.]{2,})", '', $fileName);

		return $fileName;
	}
}