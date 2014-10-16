<?php

namespace JansenFelipe\SdapsPHP;

define('SDAPS_DIR', __DIR__ . '/../../../vendor/sdaps');

class SdapsPHP {

    /**
     * Command SDAPS
     * $ sdaps.py {$pathProject} setup_tex {$pathTexFile}
     *
     * @param  string $pathProject  Path of project
     * @param  string $pathTexFile  Path of tex file
     * @return boolean
     */
    public static function createProject($pathProject, $pathTexFile) {
        if (self::command_exists('python')) {
            $command = escapeshellcmd('python ' . SDAPS_DIR . '/sdaps.py ' . $pathProject . ' setup_tex ' . $pathTexFile);
            exec($command);
            return true;
        } else
            throw new \Exception('Python command not found');
    }

    /**
     * Command SDAPS
     * $ sdaps.py {$pathProject} add {$pathTiffFile}
     *
     * @param  string $pathProject  Path of project
     * @param  string $pathTiffFile  Path of tiff file
     * @return boolean
     */
    public static function add($pathProject, $pathTiffFile) {
        if (self::command_exists('python')) {
            $command = escapeshellcmd('python ' . SDAPS_DIR . '/sdaps.py ' . $pathProject . ' add ' . $pathTiffFile);
            exec($command);
            return true;
        } else
            throw new \Exception('Python command not found');
    }

    /**
     * Command SDAPS
     * $ sdaps.py {$pathProject} recognize
     *
     * @param  string $pathProject Path of project
     * @return boolean
     */
    public static function recognize($pathProject) {
        if (self::command_exists('python')) {
            $command = escapeshellcmd('python ' . SDAPS_DIR . '/sdaps.py ' . $pathProject . ' recognize');
            exec($command);
            return true;
        } else
            throw new \Exception('Python command not found');
    }

    /**
     * Command SDAPS
     * $ sdaps.py {$pathProject} csv export
     *
     * @param  string $pathProject Path of project
     * @return boolean
     */
    public static function csvExport($pathProject) {
        if (self::command_exists('python')) {
            $command = escapeshellcmd('python ' . SDAPS_DIR . '/sdaps.py ' . $pathProject . ' csv export');
            exec($command);
            return true;
        } else
            throw new \Exception('Python command not found');
    }

    /**
     * Command SDAPS
     * $ sdaps.py {$pathProject} report_tex
     *
     * @param  string $pathProject Path of project
     * @return boolean
     */
    public static function reportTex($pathProject) {
        if (self::command_exists('python')) {
            $command = escapeshellcmd('python ' . SDAPS_DIR . '/sdaps.py ' . $pathProject . ' report_tex');
            exec($command);
            return true;
        } else
            throw new \Exception('Python command not found');
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
