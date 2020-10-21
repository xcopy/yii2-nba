<?php

namespace app\commands;

use Yii;
use yii\helpers\Console;
use yii\console\Controller;
use yii\console\ExitCode;

class StorageController extends Controller
{
    /**
     * Creates the symbolic link to storage directory.
     *
     * @return int
     */
    public function actionLink()
    {
        $target = Yii::getAlias('@storage');
        $link = Yii::getAlias('@app').'/web/storage';

        if (file_exists($link)) {
            $this->stderr("The [$link] link already exists.\n", Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        symlink($target, $link);

        $this->stdout("The [$link] link has been connected to [$target].\n", Console::FG_GREEN);

        return ExitCode::OK;
    }
}
