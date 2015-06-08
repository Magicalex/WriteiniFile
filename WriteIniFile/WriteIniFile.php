<?php
namespace WriteIniFile;

/**
 * Class WriteIniFile
 *
 */
class WriteIniFile
{
    /**
     * @var string $path_to_file_ini
     * @var array $data_file_ini
     */
    protected $path_to_file_ini,
              $data_file_ini;

    /**
     * Constructor.
     *
     * @param string $file_ini
     */
    public function __construct($file_ini)
    {
        $this->path_to_file_ini = $file_ini;

        if (file_exists($file_ini) === true) {
            $this->data_file_ini = @parse_ini_file($file_ini, true);
        } else {
            $this->data_file_ini = [];
        }

        if (false === $this->data_file_ini) {
            throw new \Exception(sprintf('Unable to parse file ini : %s', $this->path_to_file_ini));
        }
    }

    /**
     * method for change value in the file ini.
     *
     * @param array $new_value
     */
    public function update(array $new_value)
    {
        $this->data_file_ini = array_replace_recursive($this->data_file_ini, $new_value);
    }

    /**
     * method for create file ini.
     *
     * @param array $new_file_ini
     */
    public function create(array $new_file_ini)
    {
        $this->data_file_ini = $new_file_ini;
    }

    /**
     * method for erase file ini.
     *
     */
    public function erase()
    {
        $this->data_file_ini = [];
    }

    /**
     * method for add new value in the file ini.
     *
     * @param array $add_new_value
     */
     public function add(array $add_new_value)
     {
         $this->data_file_ini = array_merge_recursive($this->data_file_ini, $add_new_value);
     }

     /**
     * method for remove some values in the file ini.
     *
     * @param array $add_new_value
     */
     public function rm(array $rm_value)
     {
         $this->data_file_ini = self::arrayDiffRecursive($this->data_file_ini, $rm_value);
     }

    /**
     * method for write data in the file ini.
     *
     * @return bool true for a succes
     */
    public function write()
    {
        $data_array = $this->data_file_ini;
        $file_content = null;
        foreach ($data_array as $key_1 => $groupe) {
            $file_content .= "\n[" . $key_1 . "]\n";
            foreach ($groupe as $key_2 => $value_2) {
                if (is_array($value_2)) {
                    foreach ($value_2 as $key_3 => $value_3) {
                        $file_content .= $key_2 . '[' . $key_3 . '] = ' . self::encode($value_3) . "\n";
                    }
                } else {
                    $file_content .= $key_2 . ' = ' . self::encode($value_2) . "\n";
                }
            }
        }
        $file_content = preg_replace('#^\n#', '', $file_content);
        $result = @file_put_contents($this->path_to_file_ini, $file_content);
        if (false === $result) {
            throw new \Exception(sprintf('Unable to write in the file ini : %s', $this->path_to_file_ini));
        }
        return ($result !== false) ? true : false;
    }

    /**
     * method for encode type for file ini
     *
     * @param mixed $value
     * @return string
     */
    private static function encode($value)
    {
        if ($value == '1' || $value === true) {
            return 'yes';
        }
        if ($value == '' || $value == '0' || $value === false) {
            return 'no';
        }
        if (is_numeric($value)) {
            $value = $value * 1;
            if (is_int($value)) {
                return (int) $value;
            }
            if (is_float($value)) {
                return (float) $value;
            }
        }
        return '"' . $value . '"';
    }

    /**
     * Computes the difference of 2 arrays recursively
     * source : http://php.net/manual/en/function.array-diff.php#91756
     *
     * @param array $array1
     * @param array $array2
     * @return array
     */
    private static function arrayDiffRecursive(array $array1, array $array2)
    {
        $finalArray = [];
        foreach ($array1 as $mKey => $mValue) {
            if (array_key_exists($mKey, $array2)) {
                if (is_array($mValue)) {
                    $arrayDiffRecursive = self::arrayDiffRecursive($mValue, $array2[$mKey]);
                    if (count($arrayDiffRecursive)) {
                        $finalArray[$mKey] = $arrayDiffRecursive;
                    }
                } else {
                    if ($mValue != $array2[$mKey]) {
                        $finalArray[$mKey] = $mValue;
                    }
                }
            } else {
                $finalArray[$mKey] = $mValue;
            }
        }
        return $finalArray;
    }
}
