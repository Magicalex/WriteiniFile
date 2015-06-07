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
            throw new \Exception("unable to parse file ini : $this->path_to_file_ini");
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
     * method for write data in the file ini.
     *
     * @return bool true for a succes
     */
    public function write()
    {
        $data_array = $this->data_file_ini;
        $file_content = null;

        foreach ($data_array as $key => $groupe_n) {
            $file_content .= "\n[" . $key . "]\n";
            foreach ($groupe_n as $key => $value_n) {
                $file_content .= $key . ' = ' . $this->encode($value_n) . "\n";
            }
        }

        $result = @file_put_contents($this->path_to_file_ini, $file_content);
        if (false === $result) {
            throw new \Exception("unable to write in the file ini : $this->path_to_file_ini");
        }

        return ($result !== false) ? true : false;
    }

    /**
     * method for encode type for file ini
     *
     * @param mixed $value
     * @return string
     */
    private function encode($value)
    {
        if ($value == '1') {
            return 'yes';
        }
        if ($value == '') {
            return 'no';
        }
        return '"' . $value . '"';
    }
}
