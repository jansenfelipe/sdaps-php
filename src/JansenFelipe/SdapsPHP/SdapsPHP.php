<?php

namespace JansenFelipe\SdapsPHP;

class SdapsPHP {

    /**
     * Command SDAPS
     * $ sdaps.py {$pathProject} setup_tex {$pathTexFile}
     *
     * @param  string $pathProject  Path of project
     * @param  string $pathTexFile  Path of tex file
     * @return string Command executed
     */
    public static function createProject($pathProject, $pathTexFile) {
        self::sdapsExists();

        $command = 'sdaps ' . $pathProject . ' setup_tex ' . $pathTexFile;
        exec(escapeshellcmd($command));
        return $command;
    }

    /**
     * Command SDAPS
     * $ sdaps.py {$pathProject} add {$pathTiffFile}
     *
     * @param  string $pathProject  Path of project
     * @param  string $pathTiffFile  Path of tiff file
     * @return string Command executed
     */
    public static function add($pathProject, $pathTiffFile) {
        self::sdapsExists();

        $command = 'sdaps ' . $pathProject . ' add ' . $pathTiffFile;
        exec(escapeshellcmd($command));
        return $command;
    }

    /**
     * Command SDAPS
     * $ sdaps.py {$pathProject} recognize
     *
     * @param  string $pathProject Path of project
     * @return string Command executed
     */
    public static function recognize($pathProject) {
        self::sdapsExists();

        $command = 'sdaps ' . $pathProject . ' recognize';
        exec(escapeshellcmd($command));
        return $command;
    }

    /**
     * Command SDAPS
     * $ sdaps.py {$pathProject} csv export
     *
     * @param  string $pathProject Path of project
     * @return string PATH_CSV
     */
    public static function csvExport($pathProject) {
        self::sdapsExists();

        exec(escapeshellcmd('rm ' . $pathProject . DIRECTORY_SEPARATOR . 'data_1.csv'));

        $command = escapeshellcmd('sdaps ' . $pathProject . ' csv export');
        exec($command);
        return $pathProject . DIRECTORY_SEPARATOR . 'data_1.csv';
    }

    /**
     * Command SDAPS
     * $ sdaps.py {$pathProject} stamp -r {$quantity}
     *
     * @param  string  $pathProject Path of project
     * @param  integer $quantity
     * @return string Command executed
     */
    public static function stampRandom($pathProject, $quantity) {
        self::sdapsExists();

        $command = 'sdaps ' . $pathProject . ' stamp -r ' . $quantity;
        exec(escapeshellcmd($command));
        return $command;
    }

    /**
     * Command SDAPS
     * $ sdaps.py {$pathProject} stamp -f {$ids}
     *
     * @throws Exception
     * @param  string  $pathProject Path of project
     * @param  array $ids
     * @return boolean
     */
    public static function stampIDs($pathProject, $ids = array()) {
        self::sdapsExists();

        if (empty($ids))
            throw new Exception('ids not found');

        $tmpfname = tempnam(sys_get_temp_dir(), 'ids'); // good 
        $handle = fopen($tmpfname, "w");

        foreach ($ids as $id)
            fwrite($handle, $id . PHP_EOL);

        fclose($handle);

        $command = escapeshellcmd('sdaps ' . $pathProject . ' stamp -f ' . $tmpfname);
        exec($command);

        unlink($tmpfname);
        return true;
    }

    /**
     * Command SDAPS
     * $ sdaps.py {$pathProject} report_tex
     *
     * @param  string $pathProject Path of project
     * @return string PATH_PDF_REPORT
     */
    public static function reportPDF($pathProject) {
        self::sdapsExists();

        exec(escapeshellcmd('rm ' . $pathProject . DIRECTORY_SEPARATOR . 'report_1.pdf'));

        $command = escapeshellcmd('sdaps ' . $pathProject . ' report_tex');
        exec($command);

        return $pathProject . DIRECTORY_SEPARATOR . 'report_1.pdf';
    }

    /**
     * Determines if a command exists on the current environment
     *
     * @throws Exception
     * @return null
     */
    private static function sdapsExists() {
        if (!self::command_exists('sdaps'))
            throw new \Exception('Sdaps command not found. See http://sdaps.org');
    }

    /**
     * Determines if a command exists on the current environment
     *
     * @param string $command The command to check
     * @return bool True if the command has been found ; otherwise, false.
     */
    private static function command_exists($command) {
        $whereIsCommand = (PHP_OS == 'WINNT') ? 'where' : 'which';

        $process = proc_open(
                "$whereIsCommand $command", array(
            0 => array("pipe", "r"), //STDIN
            1 => array("pipe", "w"), //STDOUT
            2 => array("pipe", "w"), //STDERR
                ), $pipes
        );
        if ($process !== false) {
            $stdout = stream_get_contents($pipes[1]);
            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            proc_close($process);

            return $stdout != '';
        }

        return false;
    }

}
